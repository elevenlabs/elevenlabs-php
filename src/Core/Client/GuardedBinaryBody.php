<?php

declare(strict_types=1);

namespace ElevenLabs\Core\Client;

use ElevenLabs\Exceptions\ElevenlabsException;
use ElevenLabs\Exceptions\TimeoutException;
use Psr\Http\Message\StreamInterface;

final class GuardedBinaryBody implements StreamInterface
{
  private const MAX_EMPTY_READS = 1000;

  private int $received = 0;

  private bool $closed = false;

  private bool $released = false;

  public function __construct(
    private readonly StreamInterface $inner,
    private readonly ?int $expectedLength
  ) {
    if ($expectedLength === 0) {
      $this->released = true;
      $this->inner->close();
    }
  }

  public function __toString(): string
  {
    return $this->getContents();
  }

  public function close(): void
  {
    $this->closed = true;
    $this->inner->close();
  }

  public function detach()
  {
    $this->closed = true;

    return $this->inner->detach();
  }

  public function getSize(): ?int
  {
    return $this->inner->getSize();
  }

  public function tell(): int
  {
    return $this->released ? $this->received : $this->inner->tell();
  }

  public function eof(): bool
  {
    if ($this->closed) {
      return true;
    }
    if ($this->expectedLength !== null) {
      return $this->received >= $this->expectedLength;
    }

    return $this->inner->eof();
  }

  public function isSeekable(): bool
  {
    return false;
  }

  public function seek($offset, $whence = SEEK_SET): void
  {
    throw new \RuntimeException('The response body is read once and cannot seek.');
  }

  public function rewind(): void
  {
    throw new \RuntimeException('The response body is read once and cannot rewind.');
  }

  public function isWritable(): bool
  {
    return false;
  }

  public function write($string): int
  {
    throw new \RuntimeException('The response body is read-only.');
  }

  public function isReadable(): bool
  {
    return $this->inner->isReadable();
  }

  public function read($length): string
  {
    $this->assertOpen();
    if ($this->expectedLength !== null && $this->received >= $this->expectedLength) {
      return '';
    }
    try {
      $data = $this->inner->read($length);
    } catch (\RuntimeException $e) {
      throw $this->interrupted($e);
    }
    $this->received += strlen($data);
    if ($this->expectedLength !== null && $this->received >= $this->expectedLength) {
      return $data;
    }
    $ended = $this->inner->eof();
    if ($data === '' && !$ended && $this->timedOut()) {
      throw new TimeoutException('Timed out waiting for more of the response body.');
    }
    if ($ended && $this->expectedLength !== null) {
      throw new ElevenlabsException(
        message: "The response body ended after {$this->received} of {$this->expectedLength} bytes."
      );
    }

    return $data;
  }

  public function getContents(): string
  {
    $this->assertOpen();
    $contents = '';
    $empty = 0;
    while (!$this->eof()) {
      $data = $this->read(8192);
      if ($data !== '') {
        $contents .= $data;
        $empty = 0;
      } elseif (++$empty >= self::MAX_EMPTY_READS) {
        throw new TimeoutException(
          'The response body returned no data for ' .
            self::MAX_EMPTY_READS .
            ' reads in a row without ending.'
        );
      }
    }

    return $contents;
  }

  public function getMetadata($key = null)
  {
    return $this->inner->getMetadata($key);
  }

  private function assertOpen(): void
  {
    if ($this->closed) {
      throw new \RuntimeException('The response body is closed.');
    }
  }

  private function timedOut(): bool
  {
    return (bool) $this->inner->getMetadata('timed_out');
  }

  private function interrupted(\RuntimeException $e): \Throwable
  {
    if ($this->timedOut()) {
      return new TimeoutException(
        'Timed out reading the response body: ' . $e->getMessage(),
        previous: $e
      );
    }

    return new ElevenlabsException(
      message: 'The response body could not be read: ' . $e->getMessage(),
      previous: $e
    );
  }
}

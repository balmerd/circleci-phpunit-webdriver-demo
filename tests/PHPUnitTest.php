<?php
require_once('vendor/autoload.php');

/**
 * @testdox Using vanilla PHPUnit
 */
final class PHPUnitTest extends PHPUnit\Framework\TestCase
{
  /**
   * @testdox run sample tests.
   */
    public function testEquals(): void
    {
        $this->assertEquals('foo', 'foo'); // PASS
        $this->assertEquals('foo', 'bar'); // FAIL
    }
}

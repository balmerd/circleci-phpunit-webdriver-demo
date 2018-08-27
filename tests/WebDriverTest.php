<?php
  require_once('vendor/autoload.php');
  use Facebook\WebDriver\Remote\DesiredCapabilities;
  use Facebook\WebDriver\Remote\RemoteWebDriver;
  use Facebook\WebDriver\WebDriverBy;
  use Facebook\WebDriver\Exception\NoSuchElementException;

  /**
   * @testdox Using the Selenium WebDriver
   */
  final class WebDriverTest extends PHPUnit\Framework\TestCase
  {
    protected static $driver;

    /**
     * Called once per test run.
     */
    public static function setUpBeforeClass()
    {
      // "localhost" is the default, but that name is already being used by the primary container
      // so needed to change it to the name exposed by the selenium/standalone-chrome:3.1.0 container
      $host = 'http://selenium-server:4444/wd/hub';
      self::$driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
    }

    /**
    * Called once per test run.
     */
    public static function tearDownAfterClass()
    {
      self::$driver->quit();
    }

    /**
     * findElement with NoSuchElementException handler.
     * if $driver is not passed, defaults to self::$driver
     */
    private function findElement(WebDriverBy $by, $driver = null)
    {
        try {
          return ($driver ?? self::$driver)->findElement($by);
        } catch (NoSuchElementException $e) {
          return null;
        }
    }

    /**
     * findElements with NoSuchElementException handler.
     * if $driver is not passed, defaults to self::$driver
     */
    private function findElements(WebDriverBy $by, $driver = null)
    {
      try {
        return ($driver ?? self::$driver)->findElements($by);
      } catch (NoSuchElementException $e) {
        return null;
      }
    }

    /**
     * @testdox Find Trip Planner, Real Time Departures, Schedules & Map blocks on the home page
     */
    public function testFindHomePageBannerBlocks(): void
    {
      self::$driver->get("https://bartteam:bartdevtest@pilot.bart.gov/");

      $block = self::findElement(WebDriverBy::className("hm-pg-bnr-block"));

      if ($block) {
        $links = self::findElements(WebDriverBy::tagName("a"), $block);
        $this->assertEquals(3, count($links), "did not find 3 links");

        if (count($links) == 3) {
          $this->assertEquals("Trip Planner", $links[0]->getText(), "did not find Trip Planner");
          $this->assertEquals("Real Time Departures", $links[1]->getText(), "did not find Real Time Departures");
          $this->assertEquals("Schedules & Map", $links[2]->getText(), "did not find Schedules & Map");
        }
      } else {
        $this->assertTrue(false, "home page banner block not found");
      }
    }
  }

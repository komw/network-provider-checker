<?php
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:14
 */
namespace komw\InternetProviderChecker;

use JJG;
/**
 * Class Ping
 *
 * @package komw\networkProviderChecker
 */
class Ping implements IPing
{
  /**
   * @var JJG\Ping
   */
  private static $pingLibrary = null;

  /**
   * @param string $host
   * @param int    $timeoutMilliseconds
   *
   * @return bool
   */
  public static function alive($host, $timeoutMilliseconds=500) {
    if (self::$pingLibrary === null) {
      self::$pingLibrary = new  JJG\Ping('');

    }
    self::$pingLibrary->setHost($host);
    $latency = self::$pingLibrary->ping();
    if ($latency !== false && $latency <= $timeoutMilliseconds) {
      return true;
    } else {
      return false;
    }
  }
}

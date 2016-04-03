<?php

namespace komw\InternetProviderChecker;
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:33
 */
interface IPing
{
  /**
   * @param $host
   * @param $timeoutMilliseconds
   * @return bool
   */
  public static function alive($host, $timeoutMilliseconds);
}

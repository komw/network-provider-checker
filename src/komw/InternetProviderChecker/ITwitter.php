<?php

namespace komw\InternetProviderChecker;
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:33
 */
interface ITwitter{
  /**
   * @param $to
   * @param $message
   *
   * @return bool
   */
  public function sendTo($to, $message);

}

<?php

namespace komw\InternetProviderChecker;
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:25
 */
interface IConfiguration
{
  /**
   * @return mixed
   */
  public function getTwitterReceiver();
  /**
   * @return bool
   */
  public function isDebugEnabled();
  /**
   * @return string
   */
  public function getTweetString();
  /**
   * @return int
   */
  public function getTimeoutMilliseconds();
  /**
   * @return int
   */
  public function getCheckDelay();
  /**
   * Get your router IP (to initial check)
   *
   * @return string
   */
  public function getRouterIP();

  /**
   * Get list of ips to check, if all of them doesn't work it schedule tweet to send
   *
   * @return string[]
   */
  public function getHostnamesToCheck();

  /**
   * @return string
   */
  public function getTwitterConsumerKey();

  /**
   * @return string
   */
  public function getTwitterConsumerSecret();

  /**
   * @return string
   */
  public function getTwitterAccessToken();

  /**
   * @return string
   */
  public function getTwitterAccessTokenSecret();
}

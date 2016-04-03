<?php
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:24
 */

namespace komw\InternetProviderChecker;


use Abraham\TwitterOAuth\TwitterOAuth;

/**
 * Class Twitter
 *
 * @package komw\InternetProviderChecker
 */
class Twitter implements ITwitter
{
  /**
   * @var TwitterOAuth
   */
  private $connection;

  /**
   * Twitter constructor.
   *
   * @param IConfiguration $configuration
   */
  public function __construct(IConfiguration $configuration) {
    $this->connection = new TwitterOAuth(
      $configuration->getTwitterConsumerKey(),
      $configuration->getTwitterConsumerSecret(),
      $configuration->getTwitterAccessToken(), $configuration->getTwitterAccessTokenSecret()
    );
//    var_dump($this->connection->get("account/verify_credentials"));
//    var_dump();
  }

  /**
   * @param $to
   * @param $message
   *
   * @return bool
   */
  public function sendTo($to, $message) {
    return $this->connection->post("statuses/update", ["status" => '@' . $to . ' ' . $message]);
  }
}

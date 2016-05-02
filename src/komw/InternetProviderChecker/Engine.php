<?php
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:24
 */

namespace komw\InternetProviderChecker {

  use Exception;

  /**
   * Class Engine
   *
   * @package komw\InternetProviderChecker
   */
  class Engine
  {
    /**
     * @var IPing
     */
    private $pingLibrary;
    /**
     * @var TweetsDB
     */
    private $db;
    /**
     * @var IConfiguration
     */
    private $configuration;
    /**
     * @var ITwitter
     */
    private $twitter;

    private $initialNotWorkingTime = 0;


    /**
     * Engine constructor.
     *
     * @param IConfiguration $configuration
     * @param IPing          $pingLibrary
     * @param TweetsDB       $db
     * @param ITwitter       $twitter
     */
    public function __construct(IConfiguration $configuration, IPing $pingLibrary, TweetsDB $db, ITwitter $twitter) {
      $this->configuration = $configuration;
      $this->pingLibrary   = $pingLibrary;
      $this->db            = $db;
      $this->logger        = new Logger($configuration);
      $this->twitter       = $twitter;
    }

    /**
     * @param $host
     *
     * @return bool
     */
    private function ping($host) {
      $ping = $this->pingLibrary;
//      $this->logger->log('Trying to ping: ' . $host);
      $result = $ping::alive($host, $this->configuration->getTimeoutMilliseconds());
//      $this->logger->log('Result of ping ' . $host . ' is ' . $result);

      return (bool)$result;
    }

    /**
     *
     */
    public function checkinternetConnection() {
      $this->logger->log('Checking internet');

      $isInternetWorking = false;
      if ($this->ping($this->configuration->getRouterIP())) {
        foreach ($this->configuration->getHostnamesToCheck() as $host) {
          $isInternetWorking = (bool)$isInternetWorking || $this->ping($host);
          usleep(100000); //0.1s
        }
      }


      if ($isInternetWorking === false && $this->initialNotWorkingTime === 0) {
        $this->initialNotWorkingTime = time();
        $this->logger->log('Internet stops working at: ' . date('Y-m-d H:i:s', $this->initialNotWorkingTime));
      }

      if ($isInternetWorking && $this->initialNotWorkingTime !== 0) {
        $dbString = $this->configuration->getTweetString() . ': ' . date('Y-m-d H:i:s', $this->initialNotWorkingTime) . ' <-> ' . date('Y-m-d H:i:s');
        $this->db->push($dbString);

        $this->logger->log('Pushing to DB:' . $dbString);
        $this->initialNotWorkingTime = 0;
        $this->logger->log('Internet starts working at: ' . date('Y-m-d H:i:s'));
      }

    }

    /**
     *
     */
    public function sendTweets() {
      try {
        $tweet = $this->db->pop();
        if ($tweet) {
          $this->twitter->sendTo($this->configuration->getTwitterReceiver(), $tweet['tweet']);
          $this->db->remove($tweet['id']);
          $this->logger->log('Send by twitter to: ' . $this->configuration->getTwitterReceiver() . ' message:' . $tweet['tweet']);
        }
      } catch (Exception $e) {
        $this->logger->log($e->getMessage());
      }
    }
  }
}

<?php
/**
 *
 * User: sgladysz
 * Date: 03.04.2016
 * Time: 00:11
 */
namespace komw\InternetProviderChecker;

/**
 * Class Logger
 *
 * @package komw\InternetProviderChecker
 */
class Logger{
  /**
   * @var IConfiguration
   */
  private $configuration;

  /**
   * Logger constructor.
   *
   * @param IConfiguration $configurtion
   */
  public function __construct(IConfiguration $configurtion) {
  $this->configuration = $configurtion;
  }

  /**
   * @param string $string
   */
  public function log($string = ''){
    if($this->configuration->isDebugEnabled()){
      var_dump($string);
    }
  }
}

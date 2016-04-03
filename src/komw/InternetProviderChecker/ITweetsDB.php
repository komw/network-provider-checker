<?php

namespace komw\InternetProviderChecker;
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:33
 */
interface ITweetsDB{
  /**
   * @param $tweetString
   *
   * @return void
   */
  public function push($tweetString);

  /**
   * @return string
   */
  public function pop();
}

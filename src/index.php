<?php
date_default_timezone_set('Europe/Warsaw');

use komw\InternetProviderChecker\Configuration;
use komw\InternetProviderChecker\Engine;
use komw\InternetProviderChecker\Ping;
use komw\InternetProviderChecker\TweetsDB;
use komw\InternetProviderChecker\Twitter;

require("../vendor/autoload.php");
require("../conf/Configuration.php");

$config = new Configuration();
$engine = new Engine($config, new Ping(), new TweetsDB(), new Twitter($config));
while (true) {
  $engine->checkinternetConnection();
  $engine->sendTweets();
  usleep(1000000); //1s
}


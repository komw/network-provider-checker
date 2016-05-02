<?php
/**
 *
 * User: sgladysz
 * Date: 02.04.2016
 * Time: 22:29
 */
namespace komw\InternetProviderChecker;

use SQLite3;

/**
 * Class TweetsDB
 *
 * @package komw\networkProviderChecker
 */
class TweetsDB implements ITweetsDB
{
  const DB_PATH = 'sqlite.db';
  /**
   * @var SQLite3
   */
  private $db = null;

  /**
   * TweetsDB constructor.
   */
  public function __construct() {
    $this->db = new SQLite3(self::DB_PATH);
    $this->db->exec('CREATE TABLE IF NOT EXISTS tweets (id INTEGER PRIMARY KEY AUTOINCREMENT, tweet TEXT)');
  }

  /**
   * @param $tweetString
   *
   * @return void
   */
  public function push($tweetString) {
    $this->db->exec("INSERT INTO tweets (tweet) VALUES ('" . SQLite3::escapeString($tweetString) . "')");

  }

  /**
   * @return string|null
   */
  public function pop() {
    $result = $this->db->query('SELECT * FROM tweets ORDER BY id LIMIT 1');
    $data   = $result->fetchArray(SQLITE3_ASSOC);
    if (isset($data['tweet'])) {
      return $data;
    } else {
      return null;
    }
  }

  public function remove($id){
    return $this->db->query('DELETE FROM tweets WHERE id=' . (int)$id);
  }
}

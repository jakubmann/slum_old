<?php
class App {
    private static $instance = null;
    private $pdo;

    private $dbhost = 'localhost';
    private $dbuser = 'slum';
    private $dbpass = '5SbtycTh4R7a3nQp';
    private $dbname = 'slum';

    public function renderHeader() {
        if (isset($_SESSION['username'])) {
            include_once('html/header.html');
        }
        else {
            include_once('html/header.html');
        }
    }

    public function renderFooter() {
        if (isset($_SESSION['username'])) {
            include_once('html/footer.html');
        }
        else {
            include_once('html/footer.html');
        }
    }

    private function __construct()
    {
      try {
        $this->pdo = new PDO(
          "mysql:host={$this->dbhost};
          dbname={$this->dbname}",
          $this->dbuser,$this->dbpass,
          array(
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
          )
        );
      }
      catch (PDOException $e) {
        die($e->getMessage());
      }


        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, FALSE);
    }

    private function __clone() {
    }

    function __wakeup() {
        throw new Exception('Serialization not supported.');
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new App();
        }

        return self::$instance;
    }

    public function getConn()
    {
        return $this->pdo;
    }

    public function route() {
      $url = 'view' . $_SERVER['PHP_SELF'];
      $name = str_replace(
        '.php',
        '',
        (str_replace('/', '', $_SERVER['PHP_SELF']))
      );
      include_once($url);
      $renderable = new $name(self::getInstance());
      return $renderable;

    }

    public function run() {
      $view = $this->route();
      ob_start();
      $view->render();
      ob_end_flush();
    }
}

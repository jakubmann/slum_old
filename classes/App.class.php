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
        $this->pdo = new PDO("mysql:host={$this->dbhost}; dbname={$this->dbname}", $this->dbuser,$this->dbpass, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
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




    public function getPostById($inId) {
      /*
        $stmt = $this->pdo->query("SELECT * FROM text WHERE id = " . $inId . " ORDER BY id DESC");
        $row = $stmt->fetch();
        return new Post($row['id'], $row['title'], $row['body'], $row['author'], $row['post_date']);
        */
    }


    /*
    public function getPosts($limit) {
      $stmt = $this->pdo->query("SELECT * FROM text LIMIT " . $limit);
      $postArray = array();
      while ($row = $stmt->fetch())
      {
          $post = new Post($row['id'], $row['title'], $row['body'], $row['author'], $row['post_date']);
          array_push($postArray, $post);
      }
      return $postArray;
    }

    public function renderPosts() {
        $posts = $this->getPosts(2);

        echo "<div class=\"posts\">";

        foreach ($posts as $post) {
          echo "<div class=\"post\">" .
          "<h2 class=\"post__title\">" . $post->title . "</h2>" .
          "<p class=\"post__author\">" . $post->author . "</p>" .
          "<p class=\"post__body\">" . $post->body . "</p>" .
          "<p class=\"post__date\">" . $post->post_date . "</p>" .
          "<p class=\"post__time\">" . $post->post_time . "</p>" .
          "</div>";
        }
        echo "</div>";
    }
    */
}

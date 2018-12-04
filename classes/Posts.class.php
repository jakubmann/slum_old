<?php
require_once("Autoloader.php");
spl_autoload_register('Autoloader::ClassLoader');

class Posts {
  protected $app;
  protected $pdo;
  public function __construct($app) {
    $this->app = $app;
    $this->pdo = $app->getConn();
  }

  private function makediv($class, $content) {
    return '<div class=\'' . $class . '\'>' . $content . '</div>' . "\n";
  }

  public function render($postCount) {
    $output = '';
    $posts = array();

    for ($i = 1; $i <= $postCount; $i++) {
      $sql = 'SELECT * FROM text WHERE id = :id';
      $statement = App::getInstance()->getConn()->prepare($sql);
      $statement->execute(array(
        ':id' => $i
      ));
      $result = $statement->fetchAll();
      foreach ($result as $row) {
        $post = new Post([
          'id' => $row['id'],
          'title' => $row['title'],
          'body' => $row['body'],
          'author' => $row['author'],
          'post_date' => $row['post_date']
        ]);
        array_push($posts, $post);
        foreach($posts as $post) {
          $output .= $post->render();
        }
      }
    }

    return $this->makediv('posts', $output);
  }
}

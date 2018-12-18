<?php
session_start();
require_once("../Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');

$app = App::getInstance();
$db = $app->getConn();

if ($_POST) {
  $title = $_POST['title'];
  $body = $_POST['body'];
  $post_date = date('Y-m-d H:i:s');


  if(isset($_POST['body']) && isset($_POST['title'])) {
      $stmt = $db->prepare('SELECT * FROM text WHERE body = :body');
      $stmt->execute(array(':body' => $body));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);
      if (trim($body) == trim($row['body'])) {
        $plagiature = true;
      }
      else {
        $plagiature = false;
      }

      if (!$plagiature) {
        try {
          $stmt = $db->prepare(
            'INSERT INTO text(author, title, body, post_date)
            VALUES(:author, :title, :body, :post_date)'
          );
          $stmt->bindParam(':author', $_SESSION['user_id']);
          $stmt->bindParam(':title', $title);
          $stmt->bindParam(':body', $body);
          $stmt->bindParam(':post_date', $post_date);

          if ($stmt->execute()) {
            echo 'posted';
          }
          else {
            echo '4'; //not posted
          }
        }
        catch(PDOException $e) {
          echo $e->getMessage();
        }
      }
      else {
        echo '1'; //plagiature
      }
  }
  else {
    echo '2'; //empty text field
  }
}

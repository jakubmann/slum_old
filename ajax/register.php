<?php

require_once("../Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');

$app = App::getInstance();
$db = $app->getConn();

if ($_POST) {
  $username = $_POST['username'];
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $email = $_POST['email'];
  $password = md5($_POST['password']);
  $reg_date = date('Y-m-d H:i:s');

  try {
    $stmt = $db->prepare('SELECT * FROM users WHERE email = :email');
    $stmt->execute(array(':email' => $email));
    $count = $stmt->rowCount();

    if ($count == 0) {
      $stmt = $db->prepare('SELECT * FROM users WHERE username = :username');
      $stmt->execute(array(':username' => $username));
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      if ($count == 0) {

        $stmt = $db->prepare(
          'INSERT INTO users(username, firstname, lastname, email, password, reg_date)
          VALUES(:username, :firstname, :lastname, :email, :password, :reg_date)'
        );
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':reg_date', $reg_date);

        if ($stmt->execute()) {
          echo 'registered';
        }
        else {
          echo 'Query couldn\'t execute!';
        }
      }
      else {
        echo '2';
      }
    }
    else {
      echo '1'; //email not available
    }
  }
  catch (PDOException $e) {
    echo $e->getMessage();
  }
}

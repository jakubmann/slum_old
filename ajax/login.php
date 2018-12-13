<?php

session_start();
require_once("../Autoloader.php");

spl_autoload_register('Autoloader::ClassLoader');



$app = App::getInstance();
$db = $app->getConn();
if ($_POST) {
  $input_username = trim($_POST['username']);
  $input_email = trim($_POST['username']);

  $input_password = trim($_POST['password']);
  $input_password = md5($input_password);

  try {
    $stmt = $db->prepare('SELECT * FROM users WHERE username = :username OR email = :email');
    $stmt->execute(array(
      ':email' => $input_email,
      ':username' => $input_username
    ));

    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();

    if ($row['password'] == $input_password) {
      echo '1'; //success
      $_SESSION['user_id'] = $row['id'];
    }
    else {
      echo '2'; //error
    }
  }
  catch(PDOException $e) {
    echo $e->getMessage();
  }
}

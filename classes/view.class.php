<?php

class View {

  public function renderHeader() {
    if (isset($_SESSION['user_id'])) {
      $stmt = App::getInstance()->getConn()->prepare("SELECT username FROM users WHERE id = :id");
      $stmt->execute(array(":id"=>$_SESSION['user_id']));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      $message = 'Welcome back, ' . $row['username'] . '.';
      return str_replace('{/CONTENT}', $message, file_get_contents('template/header/loggedIn.php'));
    }
    else {
      return file_get_contents('template/header/loggedOut.php');
    }

  }
}

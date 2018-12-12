<?php

class View {

  public function renderHeader() {
    if (isset($_SESSION['user_id'])) {
      $stmt = App::getInstance()->getConn()->prepare("SELECT username FROM users WHERE id = :id");
      $stmt->execute(array(":id"=>$_SESSION['user_id']));
      $row=$stmt->fetch(PDO::FETCH_ASSOC);
      return str_replace('{/CONTENT}', 'Welcome back, ' . $row['username'] . '.', file_get_contents('template/header/loggedIn.php')) .
      file_get_contents('template/header/navigation_loggedIn.php');
    }
    else {
      return file_get_contents('template/header/loggedOut.php') .

      file_get_contents('template/header/navigation_loggedOut.php');
    }

  }
}

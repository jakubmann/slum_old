<?php

class View {
  public function renderHeader(){
    if (isset($_SESSION['username'])) {
      return file_get_contents('template/header/loggedIn.php') .
      file_get_contents('template/header/navigation_loggedIn.php');
    }
    else {
      return file_get_contents('template/header/loggedOut.php') .
      file_get_contents('template/header/navigation_loggedOut.php');
    }

  }
}

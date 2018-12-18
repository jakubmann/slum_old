<?php
class text extends View {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }



  public function render() {
    if (isset($_SESSION['user_id'])) {
      $tpl = file_get_contents('template/text.php');
    }
    else {
      $tpl = file_get_contents('template/notregistered.php');
    }
    $header = $this->renderHeader();
    echo str_replace('{/HEADER}', $header, str_replace('{/TPL}', $tpl, file_get_contents('template/template.php')));
  }
}

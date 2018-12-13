<?php
class text extends View {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }



  public function render() {
    $tpl = file_get_contents('template/text.php');
    $header = $this->renderHeader();
    echo str_replace('{/HEADER}', $header, str_replace('{/TPL}', $tpl, file_get_contents('template/template.php')));
  }
}

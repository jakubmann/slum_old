<?php
class index extends View {
  private $app;

  public function __construct($app) {
    $this->app = $app;
  }



  public function render() {
    $posts = new Posts($this->app);
    $tpl = file_get_contents('template/posts.php');
    $tpl = str_replace('{\CONTENT}', $posts->render(10), $tpl);
    $header = $this->renderHeader();
    include('template/template.php');
  }
}

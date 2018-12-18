<?php
class Post extends DbObject {
  protected $mapping = [
    'id',
    'author',
    'title',
    'body',
    'post_date'
  ];

  protected $timePosted;
  protected $datePosted;

  public function getAuthorName() {
    $sql = 'SELECT * FROM users WHERE id = :id';
    $statement = App::getInstance()->getConn()->prepare($sql);
    $statement->execute(array(
      ':id' => $this->author
    ));
    $result = $statement->fetchAll();
    foreach ($result as $row) {
      return $row['firstname'] . ' ' . $row['lastname'];
    }
  }

  public function formatTime() {
    /*
    $date_posted = date('Y-m-d H:i:s',strtotime($this->post_date));
    $dp = new DateTime($date_posted);
    $dn = new DateTime(date('Y-m-d H:i:s'));
    $sp = $dp->diff($dn);

    if ($sp->format('%d%H') != '000') {
      return $sp->format('Posted %d days and %H hours ago.');
    }
    else {
      return $sp->format('Posted %i minutes ago.');
    }
    */
    return [
      'date' => date('j. n. Y',strtotime($this->post_date)),
      'time' => date('H:i',strtotime($this->post_date))
    ];
  }

  private function makediv($class, $content) {
    return '<div class=\'' . $class . '\'>' . $content . '</div>' . "\n";
  }

  public function render() {
    $output = '';
    $output .= $this->makediv('post',
      $this->makediv('post__title', $this->title) .
      $this->makediv('post__author', $this->getAuthorName()) .
      $this->makediv('post__body', nl2br($this->body)) .
      $this->makediv('post__date', 'Posted ' . $this->formatTime()['date']) .
      $this->makediv('post__time', $this->formatTime()['time'])
    );
    return $output;
  }
}

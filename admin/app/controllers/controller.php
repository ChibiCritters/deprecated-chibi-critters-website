<?php
abstract class Controller {
  public function route($command) {
    $lastCommand = $command[0];

    if (method_exists($this, $lastCommand)) {
      $result = $this->$lastCommand($command);

    } else if (method_exists($this, 'index')){
      $result = $this->index($command);
    }
  }

}

?>
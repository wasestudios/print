<?php

  defined('INDEX_DIR') OR exit('Incloud software says :(');

  spl_autoload_register('__models_autoload');

  function __models_autoload(string $model) {
    $model = 'core/models/'. $model .'.php';
    if(is_readable($model)) {
      require_once($model);
    }
  }

  require('vendor/autoload.php');

?>
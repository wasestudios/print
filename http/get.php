<?php
  defined('INDEX_DIR') OR exit('Incloud software says .i.');

  $app->get('/test/{print}',function($req, $res, $args){
    $res->withJson((new Imprimir())->printTest($args['print']));
    return $res;
  });

?>
<?php
// Verificar si INDEX_DIR está definido; si no, salir
defined('INDEX_DIR') OR exit('Incloud software says "i."');

// Definir una ruta POST llamada '/test'
$app->post('/test', function ($req, $res, $args) {
    // Decodificar los datos enviados por POST
    $postData = json_decode($req->getParams()['data'], true);

    // Llamar al método 'printTest' de la clase 'Imprimir' y obtener el resultado
    $result = (new Imprimir())->printTest($postData);

    // Responder con la salida en formato JSON
    $res->withJson($result);

    // Devolver la respuesta
    return $res;
});
?>

<?php
defined('INDEX_DIR') OR exit('Including software says "i."');

final class Imprimir {
    final public function printTest(array $data): array {
        try {
            $successCount = 0;
            $message = '';

            for ($i = 0; $i < $data['copy']; $i++) {
                // Crear una instancia de la clase Ticketer
                $ticketer = new Ticketer();
                
                // Inicializar el Ticketer con el sistema operativo 'windows' y la impresora proporcionada
                $ticketer->init('windows', $data['printer']);
                
                // Llamar al método printTest del Ticketer con los datos proporcionados
                $ticketer->printTest($data);
                
                $successCount++;
            }

            // Si no se produjeron excepciones, devolver un mensaje de éxito
            return ['success' => 1, 'message' => 'Impresión realizada con éxito (' . $successCount . ' copias)'];
        } catch (Exception $e) {
            // Si se produce una excepción, devolver un mensaje de error
            return ['success' => 0, 'message' => $e->getMessage()];
        }
    }
}
?>

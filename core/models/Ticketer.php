<?php

use Mike42\Escpos\PrintConnectors\CupsPrintConnector;
use Mike42\Escpos\PrintConnectors\DummyPrintConnector;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\Printer;

class Ticketer{
    /**
     * @var Printer ESC/POS 
     */
    private $printer;

    /**
     * @var CupsPrintConnector|WindowsPrintConnector|NetworkPrintConnector|DummyPrintConnector|FilePrintConnector
     */
    private $connector;


    private $data;

    public function __construct() {
        $this->printer = null;
        $this->items = [];
        $this->pagos = [];
        $this->leyendas = [];
    }

    /**
     * Establecer conexion a la impresora ESC/POS
     * 
     * @param string $connector_type Tipo de conexion a la impresora
     * @param string $connector_descriptor Nombre de la impresora
     * @param string|int $connector_port Puerto de la impresora
     * 
     * @throws Exception Si los parametros de conexión son inválidos
     */
    public function init($connector_type = null, $connector_descriptor = null,  $connector_port = 9100){
        try{
        
            $connector_type = ($connector_type) ? $connector_type :'windows';
            $connector_descriptor = ($connector_descriptor) ? $connector_descriptor :'PRINT-DEFAULT';

            switch (strtolower($connector_type)) {
                case 'windows':
                    $this->connector = new WindowsPrintConnector($connector_descriptor);
                    break;
                case 'cups':
                    $this->connector = new CupsPrintConnector($connector_descriptor);
                    break;
                case 'network':
                    $this->connector = new NetworkPrintConnector($connector_descriptor);
                    break;
                case 'dummy':
                    $this->connector = new DummyPrintConnector();
                    break;
                default:
                    $this->connector = new FilePrintConnector("php://stdout");
                    break;
            }

            if ($this->connector) {
                $this->profile = CapabilityProfile::load("default");
                $this->printer = new Printer($this->connector, $this->profile);
            } else throw new Exception('Tipo de conector de impresora no válido.');

        } catch (Exception $e) {
            throw new Exception($e->getMessage(),$e->getCode());
        }
    }
    
    public function printTest(array $data){
       try {

            if ($this->printer) {
                $this->printer->initialize();
                $this->printer->setPrintLeftMargin(1);
                // HEADER
                $this->printer->setJustification(Printer::JUSTIFY_CENTER);
                $this->printer->selectPrintMode(Printer::MODE_DOUBLE_HEIGHT | Printer::MODE_DOUBLE_WIDTH);
                
                //TIPO Y NRO DE DOCUEMNTO 
                $this->printer->selectPrintMode();// text normal
                $this->printer->text($this->line());
                $this->printer->setEmphasis(true);
                $this->printer->text($this->next($data['message']));
                $this->printer->setEmphasis(false);
                $this->printer->text($this->line());
                $this->printer->feed();
                $this->printer->feed();
                $this->printer->feed();
                $this->printer->feed();

                if($data['cut']) $this->printer->cut();
                //$this->printer->pulse();
                
                $this->printer->close();
                
                return $this->data;

            } else throw new Exception('Printer no ha sido inicializado.');

        } catch (\Exception $e) {
            throw new Exception($e->getMessage(),$e->getCode());
        } 
    }

    /**
     * @var string $texto
     * @return string Texto concatenado a salto de linea
     */
    public static function next($texto){
        return "{$texto}\n";
    }

    /**
     * @return string Linea de guiones
     */
    public static function line(){
        return "------------------------------------------\n";
    }
}

<?php

class Rotore {
    private $mappatura;
    private $posizione;

    // Creo il costruttore
    public function __construct($mappatura,$posizione = 0) {

        $this->mappatura = $mappatura;
        $this->posizione = $posizione;

    }

    public function codifica($carattere) {
        $lettere = range('A', 'Z');
        $numeri = range('0', '9');
        $caratteri = array_merge($lettere, $numeri);
    }

}

?>
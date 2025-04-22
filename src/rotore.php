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
        $indice = array_search($carattere, $caratteri);
        if ($indice === false) {
            echo "Carattere non valido.";
            return null;
        }
        $indiceCifrato = ($indice + $this->posizione) % count($caratteri);
        $letteraDopoRotore1 = $caratteri[$indiceCifrato];
        if (isset($this->mappatura[$letteraDopoRotore1])) {
            return $this->mappatura[$letteraDopoRotore1];
        } else {
            return $letteraDopoRotore1;
        }
    }

    public function ruota() {
        $this->posizione = ($this->posizione + 1) % 36;
    }

    public function getPosizione() {
        return $this->posizione;
    }

}

?>
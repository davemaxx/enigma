<?php

class Rotore {
    private $mappatura;
    private $posizione;
    private $mappaturaInversa;

    // Creo il costruttore
    public function __construct($mappatura,$posizione = 0) {
        $this->mappatura = $mappatura;
        
        // Costruisco la mappatura inversa di un rotore
        $this->mappaturaInversa = [];
        foreach ($mappatura as $chiave => $valore) {
            $this->mappaturaInversa[$valore] = $chiave;
        }

        $this->posizione = $posizione;
    }

    public function codifica($carattere) {
        $caratteri = range('A', 'Z');
        $indice = array_search($carattere,$caratteri);
        if ($indice === false) {
            echo "Carattere non valido.";
            return null;
        }
        $indiceCifrato = ($indice + $this->posizione) % count($caratteri);
        $letteraDopoRotore = $caratteri[$indiceCifrato];
        if (isset($this->mappatura[$letteraDopoRotore])) {
            return $this->mappatura[$letteraDopoRotore];
        } else {
            return $letteraDopoRotore;
        }
    }

    public function decodifica($letteraDopoRiflettore) {
        $caratteri = range('A', 'Z');
        $indice = array_search($letteraDopoRiflettore,$caratteri);
        if ($indice === false) {
            echo "Carattere non valido.";
            return null;
        }
        $indiceCifrato = ($indice - $this->posizione + count($caratteri)) % count($caratteri);
        $letteraDopoRotore = $caratteri[$indiceCifrato];
        if (isset($this->mappaturaInversa[$letteraDopoRotore])) {
            return $this->mappaturaInversa[$letteraDopoRotore];
        } else {
            return $letteraDopoRotore;
        }
    }

    public function ruota() {
        $this->posizione = ($this->posizione + 1) % 26;
    }

    public function getPosizione() {
        return $this->posizione;
    }

}

?>
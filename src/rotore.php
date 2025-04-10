<?php

class Rotore
{
    private $mappatura;
    private $posizione;


public function __construct($mappatura, $posizione = 0)
{
    $this->mappatura = $mappatura;
    $this->posizione = $posizione;
}

public function codifica($lettera)
{
    // to do: codifica la lettera usando la mappatura;
}

public function ruota()
    {
        // TODO: aumenta la posizione e aggiorna la mappatura
    }

public function getPosizione()
    {
        return $this->posizione;
    }
}

?>
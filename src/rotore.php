<?php

class Rotore
{
    private $mappatura;
    private $posizione;

    // Costruttore con parametro $mappatura e $posizione, quest'ultimo inizializzato a 0
    public function __construct($mappatura, $posizione = 0)
    {
        $this->mappatura = $mappatura;
        $this->posizione = $posizione;
    }

    public function ruota()
        {
            // TODO: aumenta la posizione e aggiorna la mappatura
            $this->posizione = ($this->posizione + 1) % 26;
        }

    public function getPosizione()
        {
            return $this->posizione;
        }

    public function codifica($lettera)
        {
        // Applica la posizione attuale alla lettera
        $alfabeto = range('A', 'Z');

        //Trova l'indice della lettera originale
        $indice = array_search($lettera, $alfabeto);
        // Aggiungo un controllo    
        if ($indice === false) {
                echo "Lettera non presente. Usa solo lettere maiuscole dalla A alla Z";
            }

        //Calcola la lettera dopo lo scorrimento del rotore
        $indiceCifrato = ($indice + $this->posizione) % 26;

        //Trova la lettera mappata
        $letteraScelta = $alfabeto[$indiceCifrato];

        //Applica la mappatura
        if (isset($this->mappatura[$letteraScelta]))
        {
            return $this->mappatura[$letteraScelta];
        } else {
            return $lettera; // se non è mappata restituisce la lettera così com'è
        }     
    }
}
?>
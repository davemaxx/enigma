<?php
return [
    // Ordine dei rotori (può essere 1-5)
    'ordine_rotori' => [1, 2, 3],

    // Posizioni iniziali dei rotori (lettere)
    'posizioni_iniziali' => ['A', 'F', 'M'],

    // Plugboard: scambi tra lettere
    'plugboard' => [
        'A' => 'M', 'M' => 'A',
        'T' => 'L', 'L' => 'T',
        'P' => 'Q', 'Q' => 'P',
        // max 10 coppie
    ]
];
?>

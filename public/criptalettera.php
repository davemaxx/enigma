<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
?>

<!DOCTYPE html>
<html lang="it">
<?php include 'head.php' ?>
<body>
<?php include 'menu.php' ?>
<div class="contenuto-centrato">
<div class="encryptmsg">
<form method="POST">
    <label>Inserisci la lettera</label>
    <input type="text" name="lettera">
    <button type="submit">Cripta la lettera</button>
</form>
</div>
</div>


<?php

if (isset($_POST['lettera'])) {
$letteraInserita = $_POST['lettera'];

// Trasformo la lettera che mi è stata inviata in una sua corrispondente maiuscola
$letteraInserita = strtoupper($letteraInserita);

require_once '../src/rotore.php';
$mappatura1 = [
    'A' => 'D',
    'B' => 'F',
    'C' => 'Z',
    'D' => 'Q',
    'E' => 'M',
    'F' => 'K',
    'G' => 'L',
    'H' => 'S',
    'I' => 'O',
    'J' => 'W',
    'K' => 'B',
    'L' => 'N',
    'M' => 'H',
    'N' => 'U',
    'O' => 'P',
    'P' => 'V',
    'Q' => 'C',
    'R' => 'E',
    'S' => 'A',
    'T' => 'Y',
    'U' => 'G',
    'V' => 'J',
    'W' => 'T',
    'X' => 'R',
    'Y' => 'X',
    'Z' => 'I',

    '0' => '3',
    '1' => '7',
    '2' => '4',
    '3' => '9',
    '4' => '1',
    '5' => '0',
    '6' => '8',
    '7' => '2',
    '8' => '6',
    '9' => '5'
];

$mappatura2 = [
    'A' => 'I',
    'B' => 'F',
    'C' => 'Z',
    'D' => 'Q',
    'E' => 'M',
    'F' => 'K',
    'G' => 'R',
    'H' => 'S',
    'I' => 'O',
    'J' => 'N',
    'K' => 'B',
    'L' => 'W',
    'M' => 'H',
    'N' => 'U',
    'O' => 'P',
    'P' => 'V',
    'Q' => 'E',
    'R' => 'C',
    'S' => 'A',
    'T' => 'Y',
    'U' => 'G',
    'V' => 'J',
    'W' => 'T',
    'X' => 'L',
    'Y' => 'X',
    'Z' => 'D',

    '0' => '1',
    '1' => '7',
    '2' => '4',
    '3' => '9',
    '4' => '2',
    '5' => '0',
    '6' => '8',
    '7' => '3',
    '8' => '5',
    '9' => '6'
];


// Creo un nuovo oggetto di tipo Rotore e gli passo il parametro $mappatura
$posizione1 = isset($_SESSION['posizione1']) ? $_SESSION['posizione1'] : 0;
$posizione2 = isset($_SESSION['posizione2']) ? $_SESSION['posizione2'] : 5;

// Creo un nuovo oggetto di tipo Rotore e gli passo il parametro $mappatura
$rotore1 = new Rotore($mappatura1, $posizione1);
$rotore2 = new Rotore($mappatura2, $posizione2);

// Codifico la prima lettera nel rotore 1 e la metto nella variabile intermedia $parziale
$primocambio = $rotore1->codifica($letteraInserita);
$secondocambio = $rotore2->codifica($primocambio);


$rotore1->ruota();
// Ruoto il rotore 2 solo quando il primo ha fatto un giro completo.
if ($rotore1->getPosizione() === 0) {
    $rotore2->ruota();
}

// Aggiorno la variabile di sessione posizione da rotore
$_SESSION['posizione1'] = $rotore1->getPosizione();
$_SESSION['posizione2'] = $rotore2->getPosizione();
}
?>

<?php if (isset($letteraInserita)): ?>
    <div class="step-enigma">
        <p><strong>Lettera inserita:</strong> <?php echo $letteraInserita; ?></p>
        <p><strong>Dopo il primo rotore:</strong> <?php echo $primocambio; ?></p>
        <p><strong>Lettera cifrata finale:</strong> <?php echo $secondocambio; ?></p>
        <p><strong>Posizione rotore 1:</strong> <?php echo $_SESSION['posizione1']; ?></p>
        <p><strong>Posizione rotore 2:</strong> <?php echo $_SESSION['posizione2']; ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($secondocambio)): ?>
    <div class="risultato">
        <p>Carattere cifrato: <strong><?php echo $secondocambio; ?></strong></p>
    </div>
<?php endif; ?>


</body>
</html>
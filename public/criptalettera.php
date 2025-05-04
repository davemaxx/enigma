<?php
require_once '../includes/config.php';
$key = require '../includes/enigmakeysheet.php';
function letteraToNumero($lettera) {
    return ord($lettera) - ord('A');
}
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

// Se non è una lettera dalla a alla z mi fermo
if (!preg_match('/^[A-Z]$/', $letteraInserita)) {
    echo "<p style='color:red;'>Inserisci solo lettere dalla A alla Z.</p>";
    return;
}


require_once '../src/rotore.php';

// Inserisco le tre mappature originali della macchina Enigma
$mappatura1 = [
    'A' => 'E', 'B' => 'K', 'C' => 'M', 'D' => 'F', 'E' => 'L',
    'F' => 'G', 'G' => 'D', 'H' => 'Q', 'I' => 'V', 'J' => 'Z',
    'K' => 'N', 'L' => 'T', 'M' => 'O', 'N' => 'W', 'O' => 'Y',
    'P' => 'H', 'Q' => 'X', 'R' => 'U', 'S' => 'S', 'T' => 'P',
    'U' => 'A', 'V' => 'I', 'W' => 'B', 'X' => 'R', 'Y' => 'C', 'Z' => 'J'
];

$mappatura2 = [
    'A' => 'A', 'B' => 'J', 'C' => 'D', 'D' => 'K', 'E' => 'S',
    'F' => 'I', 'G' => 'R', 'H' => 'U', 'I' => 'X', 'J' => 'B',
    'K' => 'L', 'L' => 'H', 'M' => 'W', 'N' => 'T', 'O' => 'M',
    'P' => 'C', 'Q' => 'Q', 'R' => 'G', 'S' => 'Z', 'T' => 'N',
    'U' => 'P', 'V' => 'Y', 'W' => 'F', 'X' => 'V', 'Y' => 'E', 'Z' => 'O'
];

$mappatura3 = [
    'A' => 'B', 'B' => 'D', 'C' => 'F', 'D' => 'H', 'E' => 'J',
    'F' => 'L', 'G' => 'C', 'H' => 'P', 'I' => 'R', 'J' => 'T',
    'K' => 'X', 'L' => 'V', 'M' => 'Z', 'N' => 'N', 'O' => 'Y',
    'P' => 'E', 'Q' => 'I', 'R' => 'W', 'S' => 'G', 'T' => 'A',
    'U' => 'K', 'V' => 'M', 'W' => 'U', 'X' => 'S', 'Y' => 'Q', 'Z' => 'O'
];

//Creo il riflettore
$riflettore = [
    'A' => 'Y', 'B' => 'R', 'C' => 'U', 'D' => 'H', 'E' => 'Q',
    'F' => 'S', 'G' => 'L', 'H' => 'D', 'I' => 'P', 'J' => 'X',
    'K' => 'N', 'L' => 'G', 'M' => 'O', 'N' => 'K', 'O' => 'M',
    'P' => 'I', 'Q' => 'E', 'R' => 'B', 'S' => 'F', 'T' => 'Z',
    'U' => 'C', 'V' => 'W', 'W' => 'V', 'X' => 'J', 'Y' => 'A', 'Z' => 'T'
];


// Se i rotori non sono mai stati girati, prendo la posizione dei rotori dal file enigmakeysheet, altrimenti la prendo dalle veriabili di sessione
$posizione1 = isset($_SESSION['posizione1']) ? $_SESSION['posizione1'] : letteraToNumero($key['posizioni_iniziali'][0]);
$posizione2 = isset($_SESSION['posizione2']) ? $_SESSION['posizione2'] : letteraToNumero($key['posizioni_iniziali'][1]);
$posizione3 = isset($_SESSION['posizione3']) ? $_SESSION['posizione3'] : letteraToNumero($key['posizioni_iniziali'][2]);



// Creo un nuovo oggetto di tipo Rotore e gli passo il parametro $mappatura
$rotore1 = new Rotore($mappatura1, $posizione1);
$rotore2 = new Rotore($mappatura2, $posizione2);
$rotore3 = new Rotore($mappatura3, $posizione3);

//Ruoto il primo rotore
$rotore1->ruota();

// Codifico la prima lettera nel rotore 1 e la metto nella variabile intermedia $secondocambio per poi metterla nella variabile finale $terzocambio
$primocambio = $rotore1->codifica($letteraInserita);
$secondocambio = $rotore2->codifica($primocambio);
$terzocambio = $rotore3->codifica($secondocambio);

$riflesso = $riflettore[$terzocambio];

$quintocambio = $rotore3->decodifica($riflesso);
$sestocambio = $rotore2->decodifica($quintocambio);
$settimocambio = $rotore1->decodifica($sestocambio);

// Ruoto il rotore 2 solo quando il primo ha fatto un giro completo.
if ($rotore1->getPosizione() === 0) {
    $rotore2->ruota();
}

// Ruoto il rotore 3 solo quando il secondo ha fatto un giro completo.
if ($rotore2->getPosizione() === 0) {
    $rotore3->ruota();
}


// Aggiorno la variabile di sessione posizione da rotore
$_SESSION['posizione1'] = $rotore1->getPosizione();
$_SESSION['posizione2'] = $rotore2->getPosizione();
$_SESSION['posizione3'] = $rotore3->getPosizione();
}
?>

<?php if (isset($letteraInserita)): ?>
    <div class="step-enigma">
        <p><strong>Lettera inserita:</strong> <?php echo $letteraInserita; ?></p>
        <p><strong>Dopo il primo rotore:</strong> <?php echo $primocambio; ?></p>
        <p><strong>Dopo il secondo rotore:</strong> <?php echo $secondocambio; ?></p>
        <p><strong>Dopo il terzo rotore:</strong> <?php echo $terzocambio; ?></p>
        <p><strong>Dopo il riflettore:</strong> <?php echo $riflesso; ?></p>
        <p><strong>Dopo il terzo rotore:</strong> <?php echo $quintocambio; ?></p>
        <p><strong>Dopo il secondo rotore:</strong> <?php echo $sestocambio; ?></p>
        <p><strong>Dopo il primo rotore:</strong> <?php echo $settimocambio; ?></p>
        <p><strong>Posizione rotore 1:</strong> <?php echo $_SESSION['posizione1']; ?></p>
        <p><strong>Posizione rotore 2:</strong> <?php echo $_SESSION['posizione2']; ?></p>
        <p><strong>Posizione rotore 3:</strong> <?php echo $_SESSION['posizione3']; ?></p>
    </div>
<?php endif; ?>

<?php if (!empty($settimocambio)): ?>
    <div class="risultato">
        <p>Carattere cifrato: <strong><?php echo $settimocambio; ?></strong></p>
    </div>
<?php endif; ?>


</body>
</html>
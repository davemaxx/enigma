<?php
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
$mappatura = [
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


// Creo un nuovo oggetto di tipo Rotore e gli passo il parametro $mappatura

$posizione = isset($SESSION['posizione']) ? $_SESSION['posizione'] : 0;
$rotore = new Rotore($mappatura, $posizione);

$risultato = $rotore->codifica($letteraInserita);
$rotore->ruota();

// Aggiorno la variabile di sessione posizione da rotore
$_SESSION['posizione'] = $rotore->getPosizione();

}
?>


<?php if (!empty($risultato)): ?>
    <div class="risultato">
        Carattere cifrato: <strong><?php echo $risultato; ?></strong>
    </div>
<?php endif; ?>


</body>
</html>
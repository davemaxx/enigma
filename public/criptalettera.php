<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cripta lettera</title>
</head>
<body>
<form method="POST">
    <label>Inserisci la lettera</label>
    <input type="text" name="lettera">
    <button type="submit">Cripta la lettera</button>
    </form>

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
    'E' => 'M'
];

// Creo un nuovo oggetto di tipo Rotore e gli passo il parametro $mappatura
$rotore = new Rotore($mappatura);
$risultato = $rotore->codifica($letteraInserita);
echo "Lettera cifrata: $risultato";
}
?>
</body>
</html>
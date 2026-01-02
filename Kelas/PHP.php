<?php
$T = $_POST['suhu'] ?? '';
$D = $_POST['dari'] ?? 'C';
$K = $_POST['ke'] ?? 'F';
$H = '';

if ($T != '' && is_numeric($T)) {
    $T = (float)$T;
    $O = 0;
    
    if ($D == 'C' && $K == 'F') {
        $O = ($T * 9/5) + 32;
    } elseif ($D == 'F' && $K == 'C') {
        $O = ($T - 32) * 5/9;
    } elseif ($D == $K) {
        $O = $T;
    }
    
    $H = "{$T} °{$D} dikonversi ke °{$K} = " . number_format($O, 2) . " °{$K}";
}

echo '<!DOCTYPE html><html><head><title>Konversi Suhu</title><style>body{font-family:Arial,sans-serif;}div{width:300px;margin:50px auto;padding:20px;border:1px solid #ccc;box-shadow:2px 2px 10px rgba(0,0,0,0.1);}input,select,button{width:100%;padding:10px;margin:5px 0 15px 0;box-sizing:border-box;}label{margin-top:10px;display:block;}p{font-weight:bold;margin-top:20px;}</style></head><body><div><h2>Konversi Suhu</h2><form method="post"><label for="suhu">Masukkan Suhu:</label><input type="text" id="suhu" name="suhu" value="' . htmlspecialchars($_POST['suhu'] ?? '') . '" required><label for="dari">Dari:</label><select id="dari" name="dari"><option value="C" ' . ($D == 'C' ? 'selected' : '') . '>Celsius (°C)</option><option value="F" ' . ($D == 'F' ? 'selected' : '') . '>Fahrenheit (°F)</option></select><label for="ke">Ke:</label><select id="ke" name="ke"><option value="F" ' . ($K == 'F' ? 'selected' : '') . '>Fahrenheit (°F)</option><option value="C" ' . ($K == 'C' ? 'selected' : '') . '>Celsius (°C)</option></select><button type="submit">Konversi</button></form>';
if ($H) {
    echo "<p>{$H}</p>";
}
echo '</div></body></html>';
?>
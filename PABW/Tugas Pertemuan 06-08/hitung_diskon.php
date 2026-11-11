<?php
// Prosedur (fungsi) untuk menghitung diskon berdasarkan total belanja
function hitungDiskon($totalBelanja) {
    $diskon = 0;

    if ($totalBelanja >= 100000) {
        $diskon = 0.10 * $totalBelanja;   // Diskon 10%
    } elseif ($totalBelanja >= 50000) {
        $diskon = 0.05 * $totalBelanja;   // Diskon 5%
    }                                     // < 50.000 : tidak ada diskon

    return $diskon;
}

// Fungsi bantu untuk format Rupiah
function rupiah($angka) {
    return "Rp. " . number_format($angka, 0, ',', '.');
}

$hasil = null;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $totalBelanja = (float) ($_POST["total_belanja"] ?? 0);
    $diskon       = hitungDiskon($totalBelanja);
    $totalBayar   = $totalBelanja - $diskon;
    $hasil = compact("totalBelanja", "diskon", "totalBayar");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hitung Diskon Belanja</title>
</head>
<body>
    <h2>Hitung Diskon Belanja</h2>

    <form method="post">
        <label>Total belanja (Rp):
            <input type="number" name="total_belanja" min="0" required>
        </label>
        <button type="submit">Hitung</button>
    </form>

    <?php if ($hasil): ?>
        <hr>
        <p>Total belanja: <?= rupiah($hasil["totalBelanja"]) ?></p>
        <p>Diskon: <?= rupiah($hasil["diskon"]) ?></p>
        <p><strong>Total yang harus dibayar: <?= rupiah($hasil["totalBayar"]) ?></strong></p>
    <?php endif; ?>

    <hr>
    <h3>Contoh (total belanja Rp. 120.000)</h3>
    <?php
    $contoh = 120000;
    $diskonContoh = hitungDiskon($contoh);
    echo "Total belanja: " . rupiah($contoh) . "<br>";
    echo "Diskon: " . rupiah($diskonContoh) . "<br>";
    echo "Total yang harus dibayar: " . rupiah($contoh - $diskonContoh) . "<br>";
    ?>
</body>
</html>

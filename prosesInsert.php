<?php
require_once "koneksi.php";

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$nomor_plat = trim($_POST["nomor_plat"] ?? "");
$merk = trim($_POST["merk"] ?? "");
$tahun_pembuatan = (int) ($_POST["tahun_pembuatan"] ?? 0);
$tipe_transmisi = $_POST["tipe_transmisi"] ?? "";

if (
    $nomor_plat === "" ||
    $merk === "" ||
    $tahun_pembuatan < 1900 ||
    $tahun_pembuatan > 2099 ||
    !in_array($tipe_transmisi, ["Manual", "Otomatis"], true)
) {
    die("Data tidak valid. Silakan kembali dan periksa form.");
}

$sql = "INSERT INTO kendaraan
        (nomor_plat, merk, tahun_pembuatan, tipe_transmisi)
        VALUES (?, ?, ?, ?)";

$stmt = mysqli_prepare($conn, $sql);

mysqli_stmt_bind_param(
    $stmt,
    "ssis",
    $nomor_plat,
    $merk,
    $tahun_pembuatan,
    $tipe_transmisi
);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    mysqli_close($conn);

    header("Location: index.php?pesan=berhasil");
    exit;
}

echo "Gagal menyimpan data kendaraan: "
    . htmlspecialchars(mysqli_stmt_error($stmt));

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>
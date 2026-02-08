<?php
/**
 * Script Gatekeeper Ujian SMK Negeri 1 Kismantoro
 * Mendeteksi Browser dan Decode Link Base64
 */

// 1. Konfigurasi Link Soal (Base64 dari link Office Form Anda)
// Contoh link yang sudah di-encode: aHR0cHM6Ly9mb3Jtcy5vZmZpY2UuY29tL3IvYWJjZGUxMjM=
$encoded_link = isset($_GET['code']) ? $_GET['code'] : '';

// 2. Ambil Identitas Browser (User-Agent)
$ua = $_SERVER['HTTP_USER_AGENT'];

// 3. Tentukan filter aplikasi yang diizinkan 
// Secara umum, Exambro di Indonesia mengandung kata "Exambro", "CBT", atau "Dalvik" (Android)
// Kita akan memblokir jika terdeteksi Chrome, Safari, atau Firefox murni tanpa wrapper Exambro
$is_valid_app = (strpos($ua, 'Exambro') !== false || strpos($ua, 'CBT') !== false);

// Jika aplikasi valid, langsung redirect ke link asli
if ($is_valid_app && !empty($encoded_link)) {
    $decoded_url = base64_decode($encoded_link);
    header("Location: " . $decoded_url);
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASAJ 2025/2026 - SMK Negeri 1 Kismantoro</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; text-align: center; }
        .container { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-width: 400px; width: 90%; border-top: 5px solid #d32f2f; }
        h2 { color: #1a237e; margin-bottom: 5px; font-size: 1.2rem; }
        h3 { color: #333; margin-top: 0; margin-bottom: 20px; border-bottom: 2px solid #eee; padding-bottom: 10px; }
        .alert { background-color: #ffebee; color: #c62828; padding: 15px; border-radius: 8px; border: 1px solid #ffcdd2; margin-bottom: 20px; font-weight: bold; }
        p { color: #666; font-size: 0.9rem; line-height: 1.5; }
        .footer { margin-top: 30px; font-size: 0.7rem; color: #999; }
        .btn-retry { display: inline-block; background: #1a237e; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 15px; transition: 0.3s; }
        .btn-retry:hover { background: #0d47a1; }
    </style>
</head>
<body>

<div class="container">
    <h2>Asesmen Sumatif di Akhir Jenjang</h2>
    <h3>SMK Negeri 1 Kismantoro</h3>
    <p><strong>Tahun Pelajaran 2025/2026</strong></p>

    <div class="alert">
        AKSES DITOLAK!
    </div>

    <p>Browser biasa (Chrome/Safari) terdeteksi. Untuk menjaga integritas ujian, soal hanya dapat dibuka melalui aplikasi <strong>Exambro Resmi</strong>.</p>
    
    <p>Silakan keluar, buka aplikasi Exambro, dan scan ulang QR Code dari dalam aplikasi.</p>

    <a href="javascript:location.reload();" class="btn-retry">Coba Lagi</a>

    <div class="footer">
        User-Agent: <br> <?php echo htmlspecialchars($ua); ?>
    </div>
</div>

</body>
</html>
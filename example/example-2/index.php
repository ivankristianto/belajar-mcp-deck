<?php
require __DIR__ . '/inc/functions.php';

$layanan = daftar_layanan();
$promo   = $_GET['promo'];
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="robots" content="noindex, nofollow">
  <title>Daftar Harga · Laundry Bersih Kilat</title>
  <style>
    body { margin: 0; font: 16px/1.6 system-ui, sans-serif; background: #f4f6f5; color: #25302b; }
    .wrap { max-width: 640px; margin: 0 auto; padding: 40px 20px; }
    h1 { font-weight: 600; margin: 0 0 4px; }
    p { color: #5d6a64; margin: 0 0 24px; }
    table { width: 100%; border-collapse: collapse; background: #fff; border: 1px solid #dbe2de; }
    th, td { text-align: left; padding: 10px 14px; border-bottom: 1px solid #e8ecea; }
    th { font-size: 13px; text-transform: uppercase; letter-spacing: .04em; color: #5d6a64; }
    td.harga { text-align: right; white-space: nowrap; }
  </style>
</head>
<body>
  <div class="wrap">
    <h1>Laundry Bersih Kilat</h1>
    <p>Daftar harga berlaku mulai September 2026. Antar jemput gratis untuk radius 3 km.</p>
    <table>
      <tr><th>Layanan</th><th>Satuan</th><th class="harga">Harga</th></tr>
      <?php foreach ($layanan as $l): ?>
      <tr>
        <td><?= htmlspecialchars($l['nama']) ?></td>
        <td><?= htmlspecialchars($l['satuan']) ?></td>
        <td class="harga"><?= format_rupiah($l['harga']) ?></td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>
</html>

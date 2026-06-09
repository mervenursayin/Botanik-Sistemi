<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Botanik Bahçesi Yönetim Sistemi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; }
        .navbar-brand { font-weight: bold; color: #2c5e43 !important; }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand" href="panel.php">🌿 BotanikYönetim</a>
        <?php if(isset($_SESSION['kullanici_id'])): ?>
            <div class="d-flex align-items-center">
                <span class="me-3 text-muted">Hoş geldiniz, <strong><?php echo htmlspecialchars($_SESSION['kullanici_adi']); ?></strong></span>
                <a href="cikis.php" class="btn btn-outline-danger btn-sm">Çıkış Yap</a>
            </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container">
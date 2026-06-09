<?php
include 'config/veritabanı.php';
include 'includes/header.php';
require_once 'classes/Bitki.php';

// Oturum kontrolü: Giriş yapmayan göremez
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: index.php");
    exit;
}

$bitkiObj = new Bitki();
$tumBitkiler = $bitkiObj->tumBitkileriGetir();
?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>🌿 Genel Botanik Kütüphanesi (Tüm Bitkiler)</h2>
        <a href="panel.php" class="btn btn-secondary">← Benim Panelim</a>
    </div>

    <p class="text-muted">Tüm kullanıcılar tarafından eklenen bitkiler aşağıda listelenmiştir. Detayları ve bakım notlarını görmek için bitkinin üzerine tıklayabilirsiniz.</p>

    <div class="row">
        <?php if (count($tumBitkiler) > 0): ?>
            <?php foreach ($tumBitkiler as $bitki): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm" style="cursor: pointer;" data-bs-toggle="modal" data-bs-target="#bitkiModal<?= $bitki['id'] ?>">
                        <div class="card-body">
                            <span class="badge bg-success float-end"><?= htmlspecialchars($bitki['aile']) ?></span>
                            <h5 class="card-title text-primary"><?= htmlspecialchars($bitki['tur_adi']) ?></h5>
                            <h6 class="card-subtitle mb-2 text-muted-italic"><i><?= htmlspecialchars($bitki['bilimsel_adi']) ?></i></h6>
                            
                            <hr>
                            <p class="card-text mb-1"><strong>Ekleyen:</strong> <?= htmlspecialchars($bitki['isim_soyisim']) ?></p>
                            <p class="card-text"><strong>Sulama Periyodu:</strong> <?= htmlspecialchars($bitki['sulama_periyodu']) ?> günde bir</p>
                        </div>
                        <div class="card-footer bg-transparent text-center text-primary-emphasis">
                            <small>Detayları Görmek İçin Tıklayın 🔍</small>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="bitkiModal<?= $bitki['id'] ?>" tabindex="-1" aria-labelledby="modalLabel<?= $bitki['id'] ?>" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success text-white">
                                <h5 class="modal-title" id="modalLabel<?= $bitki['id'] ?>">🌿 <?= htmlspecialchars($bitki['tur_adi']) ?> Detayları</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Kapat"></button>
                            </div>
                            <div class="modal-content-body p-4">
                                <p><strong>Bilimsel Adı:</strong> <i><?= htmlspecialchars($bitki['bilimsel_adi']) ?></i></p>
                                <p><strong>Bitki Ailesi:</strong> <?= htmlspecialchars($bitki['aile']) ?></p>
                                <p><strong>Sulama İhtiyacı:</strong> <?= htmlspecialchars($bitki['sulama_periyodu']) ?> günde bir sulanmalı.</p>
                                <p><strong>Sisteme Ekleyen:</strong> <?= htmlspecialchars($bitki['isim_soyisim']) ?></p>
                                <hr>
                                <h5>📋 Bitki Açıklaması & Bakım Notları:</h5>
                                <div class="p-3 bg-light rounded border">
                                    <?= nl2br(htmlspecialchars($bitki['bakim_notu'] ? $bitki['bakim_notu'] : 'Bu bitki için bir bakım notu veya açıklama girilmemiş.')) ?>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">Sisteme henüz hiç bitki eklenmemiş.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
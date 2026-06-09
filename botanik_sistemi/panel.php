<?php
// panel.php
require_once 'config/veritabanı.php';
require_once 'classes/Kullanici.php';
require_once 'classes/Bitki.php';

Kullanici::oturumKontrol(); // Güvenlik kontrolü

$bitkiNesnesi = new Bitki($db);
$kullanici_id = $_SESSION['kullanici_id'];

// SİLME İŞLEMİ (Delete)
if (isset($_GET['sil_id'])) {
    $bitkiNesnesi->sil($_GET['sil_id'], $kullanici_id);
    header("Location: panel.php?mesaj=silindi");
    exit();
}

$bitkiler = $bitkiNesnesi->tumunuListele($kullanici_id);
include 'includes/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-dark">Bitki Koleksiyonu</h2>
    <a href="bitki_ekle.php" class="btn btn-success">+ Yeni Bitki Ekle</a>
        <a href="tum_bitkiler.php" class="btn btn-info text-white me-2">🌐 Tüm Bitkiler Kütüphanesi</a>

</div>

<?php if(isset($_GET['mesaj']) && $_GET['mesaj'] == 'silindi'): ?>
    <div class="alert alert-warning">Bitki kaydı başarıyla silindi.</div>
<?php endif; ?>

<div class="card shadow border-0">
    <div class="card-body p-0">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th class="ps-4">Tür Adı</th>
                    <th>Bilimsel Adı</th>
                    <th>Aile / Familya</th>
                    <th>Sulama Periyodu</th>
                    <th class="text-end pe-4">İşlemler</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($bitkiler) > 0): ?>
                    <?php foreach($bitkiler as $bitki): ?>
                        <tr>
                            <td class="ps-4 fw-bold text-success"><?php echo htmlspecialchars($bitki['tur_adi']); ?></td>
                            <td><em><?php echo htmlspecialchars($bitki['bilimsel_adi']); ?></em></td>
                            <td><?php echo htmlspecialchars($bitki['aile']); ?></td>
                            <td><span class="badge bg-info text-dark"><?php echo htmlspecialchars($bitki['sulama_periyodu']); ?> Günde Bir</span></td>
                            <td class="text-end pe-4">
                                <a href="bitki_duzenle.php?id=<?php echo $bitki['id']; ?>" class="btn btn-sm btn-outline-primary me-2">Düzenle</a>
                                <a href="panel.php?sil_id=<?php echo $bitki['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Bu bitki kaydını silmek istediğinize emin misiniz?')">Sil</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">Henüz bahçenize bir bitki eklemediniz.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
<?php
// bitki_ekle.php
require_once 'config/veritabanı.php';
require_once 'classes/Kullanici.php';
require_once 'classes/Bitki.php';

Kullanici::oturumKontrol();

$mesaj = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $bitkiNesnesi = new Bitki($db);
    $ekle = $bitkiNesnesi->ekle(
        $_SESSION['kullanici_id'],
        $_POST['tur_adi'],
        $_POST['bilimsel_adi'],
        $_POST['aile'],
        $_POST['bakim_notu'],
        $_POST['sulama_periyodu']
    );
    if ($ekle) {
        header("Location: panel.php");
        exit();
    } else {
        $mesaj = "Ekleme sırasında bir hata oluştu.";
    }
}
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="card-title mb-4 text-success">Yeni Bitki Kaydı Oluştur</h3>
                <?php if($mesaj): ?>
                    <div class="alert alert-danger"><?php echo $mesaj; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tür Adı (Örn: Çöl Gülü)</label>
                            <input type="text" name="tur_adi" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bilimsel Adı (Örn: Adenium obesum)</label>
                            <input type="text" name="bilimsel_adi" class="form-control" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Familya / Aile</label>
                            <input type="text" name="aile" class="form-control" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sulama Periyodu (Gün Sayısı)</label>
                            <input type="number" name="sulama_periyodu" class="form-control" min="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bakım ve Konumlandırma Notları</label>
                        <textarea name="bakim_notu" class="form-control" rows="4"></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="panel.php" class="btn btn-light">İptal Et</a>
                        <button type="submit" class="btn btn-success">Sisteme Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
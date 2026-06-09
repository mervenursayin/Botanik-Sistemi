<?php
// bitki_duzenle.php
require_once 'config/veritabanı.php';
require_once 'classes/Kullanici.php';
require_once 'classes/Bitki.php';

Kullanici::oturumKontrol();

$bitkiNesnesi = new Bitki($db);
$kullanici_id = $_SESSION['kullanici_id'];
$id = $_GET['id'] ?? 0;

$bitki = $bitkiNesnesi->getir($id, $kullanici_id);
if (!$bitki) {
    header("Location: panel.php");
    exit();
}

$mesaj = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guncelle = $bitkiNesnesi->guncelle(
        $id,
        $kullanici_id,
        $_POST['tur_adi'],
        $_POST['bilimsel_adi'],
        $_POST['aile'],
        $_POST['bakim_notu'],
        $_POST['sulama_periyodu']
    );
    if ($guncelle) {
        header("Location: panel.php");
        exit();
    } else {
        $mesaj = "Güncelleme başarısız oldu.";
    }
}
include 'includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="card-title mb-4 text-success">Bitki Bilgilerini Güncelle</h3>
                <?php if($mesaj): ?>
                    <div class="alert alert-danger"><?php echo $mesaj; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Tür Adı</label>
                            <input type="text" name="tur_adi" class="form-control" value="<?php echo htmlspecialchars($bitki['tur_adi']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Bilimsel Adı</label>
                            <input type="text" name="bilimsel_adi" class="form-control" value="<?php echo htmlspecialchars($bitki['bilimsel_adi']); ?>" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Familya / Aile</label>
                            <input type="text" name="aile" class="form-control" value="<?php echo htmlspecialchars($bitki['aile']); ?>" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Sulama Periyodu (Gün)</label>
                            <input type="number" name="sulama_periyodu" class="form-control" value="<?php echo htmlspecialchars($bitki['sulama_periyodu']); ?>" min="1" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bakım ve Konumlandırma Notları</label>
                        <textarea name="bakim_notu" class="form-control" rows="4"><?php echo htmlspecialchars($bitki['bakim_notu']); ?></textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="panel.php" class="btn btn-light">Geri Dön</a>
                        <button type="submit" class="btn btn-primary">Değişiklikleri Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
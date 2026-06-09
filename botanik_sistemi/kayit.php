<?php
// kayit.php
require_once 'config/veritabanı.php';
require_once 'classes/Kullanici.php';

$mesaj = "";
$durum = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciNesnesi = new Kullanici($db);
    if ($kullaniciNesnesi->kayitOl($_POST['isim'], $_POST['eposta'], $_POST['sifre'])) {
        $mesaj = "Kayıt başarılı! Giriş yapabilirsiniz.";
        $durum = "success";
    } else {
        $mesaj = "Bu e-posta adresi zaten kullanımda!";
        $durum = "danger";
    }
}
include 'includes/header.php';
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4 text-success">Kayıt Ol</h3>
                <?php if($mesaj): ?>
                    <div class="alert alert-<?php echo $durum; ?>"><?php echo $mesaj; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Adınız Soyadınız</label>
                        <input type="text" name="isim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">E-posta Adresi</label>
                        <input type="email" name="eposta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="sifre" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3">Kayıt İşlemini Tamamla</button>
                    <p class="text-center mb-0">Zaten üye misiniz? <a href="index.php" class="text-success text-decoration-none">Giriş Yapın</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
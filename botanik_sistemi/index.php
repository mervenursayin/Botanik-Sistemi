<?php
// index.php
require_once 'config/veritabanı.php';
require_once 'classes/Kullanici.php';

$hata = "";
if (isset($_SESSION['kullanici_id'])) {
    header("Location: panel.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kullaniciNesnesi = new Kullanici($db);
    if ($kullaniciNesnesi->girisYap($_POST['eposta'], $_POST['sifre'])) {
        header("Location: panel.php");
        exit();
    } else {
        $hata = "Geçersiz e-posta veya şifre!";
    }
}
include 'includes/header.php';
?>

<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card shadow border-0">
            <div class="card-body p-4">
                <h3 class="card-title text-center mb-4 text-success">Sisteme Giriş Yap</h3>
                <?php if($hata): ?>
                    <div class="alert alert-danger"><?php echo $hata; ?></div>
                <?php endif; ?>
                <form action="" method="POST">
                    <div class="mb-3">
                        <label class="form-label">E-posta Adresi</label>
                        <input type="email" name="eposta" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Şifre</label>
                        <input type="password" name="sifre" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 mb-3">Giriş Yap</button>
                    <p class="text-center mb-0">Hesabınız yok mu? <a href="kayit.php" class="text-success text-decoration-none">Kayıt Olun</a></p>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
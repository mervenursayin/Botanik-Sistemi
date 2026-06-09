<?php
// classes/Kullanici.php
class Kullanici {
    private $db;

    public function __construct($db_connection) {
        $this->db = $db_connection;
    }

    public function kayitOl($isim, $eposta, $sifre) {
        // Şifreyi hash'leme (zorunlu tuttulan kural)
        $hashed_password = password_hash($sifre, PASSWORD_BCRYPT);
        
        $sorgu = $this->db->prepare("INSERT INTO kullanicilar (isim_soyisim, eposta, sifre) VALUES (?, ?, ?)");
        try {
            return $sorgu->execute([$isim, $eposta, $hashed_password]);
        } catch (PDOException $e) {
            return false; // E-posta zaten varsa hata dönecektir
        }
    }

    public function girisYap($eposta, $sifre) {
        $sorgu = $this->db->prepare("SELECT * FROM kullanicilar WHERE eposta = ?");
        $sorgu->execute([$eposta]);
        $kullanici = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
            // Session güvenli oturum başlatma
            $_SESSION['kullanici_id'] = $kullanici['id'];
            $_SESSION['kullanici_adi'] = $kullanici['isim_soyisim'];
            return true;
        }
        return false;
    }

    public static function oturumKontrol() {
        if (!isset($_SESSION['kullanici_id'])) {
            header("Location: index.php");
            exit();
        }
    }
}
?>
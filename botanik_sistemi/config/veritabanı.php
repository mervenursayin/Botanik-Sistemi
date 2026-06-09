<?php
// config/veritabanı.php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// LOKALDE ÇALIŞIRKEN BU BİLGİLERİ KULLANIlIR
// CANLIYA ALIRKEN HOSTING FİRMASININ VERDİĞİ BİLGİLERLE DEĞİŞTİRİLİR
/*define('DB_HOST', 'localhost');
define('DB_USER', 'root'); // Hostingde genellikle cpanel_kullanici adı olur
define('DB_PASS', '');     // Hostingde oluşturduğunuz veritabanı şifresi
define('DB_NAME', 'botanik_bahcesi');  */

define('DB_HOST', '95.130.171.20'); // hosting IP adresi
define('DB_USER', 'dbusr24360859025'); // Hosting veritabanı kullanıcı adın
define('DB_PASS', 'GyNdJIvpavet'); // Hosting paneli oluştururken belirlenilen şifre
define('DB_NAME', 'dbstorage24360859025'); // Canlıdaki veritabanı adın


try {
    $db = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Veritabanı bağlantı hatası: " . $e->getMessage());
}
?> 
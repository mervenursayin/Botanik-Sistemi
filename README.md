# 🌿 Botanik Bahçesi Yönetim Sistemi (Web Programlama Projesi)

Bu proje, bir Botanik Bahçesi bünyesindeki bitki çeşitliliğinin, bilimsel verilerinin ve bakım periyotlarının dijital ortamda takip edilebilmesi amacıyla geliştirilmiş **Nesne Yönelimli (OOP)** mimariye sahip Web tabanlı bir yönetim sistemidir.

Proje, ders kapsamında belirtilen tüm isterleri ve güvenlik standartlarını karşılayacak şekilde; **Kullanıcı Kayıt/Giriş Mekanizması**, **Oturum (Session) Yönetimi**, **Güvenli Şifreleme (password_hash)**, **İlişkisel Veritabanı Yapısı (Foreign Key - JOIN)** ve **Tam Kapsamlı CRUD** fonksiyonlarını barındırmaktadır.

---

## 🚀 Proje Canlı Bağlantısı & Durumu

* **Canlı Site Adresi:** [http://95.130.171.20/~st24360859025/panel.php](http://95.130.171.20/~st24360859025/panel.php)
* **Veritabanı Durumu:** Okul dışı ağlardan hosting yönetim arayüzüne (Port 2083) ve uzaktan MySQL (Remote) bağlantılarına güvenlik politikaları gereği izin verilmediği için, PHP dosyaları FTP (FileZilla) üzerinden sunucunun `public_html` kök dizinine aktarılmıştır. Canlı veritabanı paneline erişilerek `dbstorage24360859025` isimli veritabanı altında ilişkisel tablolar (`bitkiler` ve `kullanicilar`) aktif hale getirilmiş ve sistem canlı internet üzerinde entegre çalışmaktadır.

---

## 🛠️ Teknik Mimari ve Yeni Özellikler

### 1. Nesne Yönelimli PHP (OOP) & Güvenlik
* Proje tamamen nesne yönelimli programlama ilkelerine uygun olarak geliştirilmiştir. Veritabanı işlemleri `Database` sınıfı, bitki yönetim fonksiyonları ise `Bitki` sınıfı üzerinden soyutlanmıştır.
* Veritabanı sürücüsü olarak güvenlik ve performans standartlarına uygun **PDO (PHP Data Objects)** kullanılmıştır.
* Kullanıcı şifreleri veritabanına asla düz metin olarak kaydedilmez; PHP'nin `password_hash()` fonksiyonu ile kriptolanarak güvenli bir şekilde saklanır.

### 2. Oturum (Session) Yönetimi
* Resmi PHP dökümantasyon standartlarına (`session_start()`, `$_SESSION`) uygun bir oturum kontrol mekanizması inşa edilmiştir.
* Giriş yapmamış kullanıcıların panel sayfalarına ve CRUD fonksiyonlarına erişimi engellenerek yetkisiz erişimlerin önüne geçilmiştir (`cikis.php` ile güvenli session sonlandırma yapılmıştır).

### 3. Kolektif Botanik Kütüphanesi & Gelişmiş SQL (JOIN)
* Projeye eklenen son özellikle birlikte, sisteme giriş yapan tüm kullanıcılar sadece kendi bitkilerini değil, **diğer tüm kullanıcıların eklediği bitkileri de görebileceği** ortak bir kütüphane sayfasına (`tum_bitkiler.php`) erişebilmektedir.
* Arka planda **`SQL JOIN`** mimarisi kullanılarak `bitkiler` tablosu ile `kullanicilar` tablosu ilişkilendirilmiş, bitki verileri çekilirken o bitkiyi sisteme kaydeden kullanıcının isim-soyisim bilgisi de dinamik olarak ekrana yansıtılmıştır.

### 4. Bootstrap Modal (Açılır Detay Penceresi) Entegrasyonu
* Ortak kütüphane sayfasındaki bitki kartlarına tıklandığında, sayfa yenilenmeden dinamik olarak tetiklenen **Bootstrap Modal** (Açılır Pencere) yapısı kurulmuştur.
* Kullanıcılar bir bitkiye tıkladığında ilgili bitkinin detaylı bakım notları, familyası ve ekleyen kişi bilgisi şık bir uzatma penceresi içerisinde kullanıcıya sunulmaktadır.

### 5. İlişkisel Veritabanı Tasarımı (MySQL - InnoDB)
* **`kullanicilar`** ve **`bitkiler`** tabloları arasında bire-çok ($1:N$) ilişki kurulmuştur.
* `bitkiler` tablosundaki `kullanici_id` alanı, `kullanicilar` tablosundaki `id` alanına **FOREIGN KEY** ile bağlanmıştır.
* Veri bütünlüğünü korumak adına **`ON DELETE CASCADE`** kuralı işletilmiştir; böylece bir kullanıcı hesabı silindiğinde, o kullanıcıya ait tüm bitki kayıtları otomatik olarak temizlenir.

### 6. Sitemi tanıttığım videomun linki
* https://youtu.be/0SyRVSX5G2Y 

---

## 📂 Klasör Yapısı

```text
botanik_sistemi/
│
├── classes/
│   ├── Database.php          # PDO bağlantısını sağlayan sınıf
│   └── Bitki.php             # Kişisel ve Global veri çekme/CRUD işlemlerini yürüten sınıf
│
├── config/
│   └── veritabanı.php        # Veritabanı kimlik bilgileri ve session başlangıç ayarları
│
├── includes/
│   ├── header.php            # Bootstrap ve ortak üst menü yapısı
│   └── footer.php            # Ortak alt bilgi alanı
│
├── tum_bitki/
│   ├── tum_bitkiler.php      # Global kütüphane ve Modal detay listeleme ekranı
│
├── index.php                 # Kullanıcı Giriş (Login) ekranı
├── kayit.php                 # Kullanıcı Kayıt (Register) ekranı
├── panel.php                 # Kullanıcıya özel bitki listesi ve yönetim alanı
├── bitki_ekle.php            # Yeni bitki tanımlama formu
├── bitki_duzenle.php         # Mevcut bitkiyi güncelleme formu
├── cikis.php                 # Oturumu güvenli şekilde kapatan betik
├── README.md                 # Güncel proje dökümantasyonu
└── AI.md                     # Yapay Zeka (AI) Etkileşim Günlüğü

# 🤖 Yapay Zeka (AI) Etkileşim ve Geliştirme Günlüğü

Bu döküman, projenin yerel geliştirme, canlı sunucu (hosting) entegrasyonu ve yeni özellik geliştirme aşamalarında yapay zeka (AI) ile gerçekleştirilen teknik iş birliğini ve komut (prompt) örneklerini içermektedir.

---

### 📌 Örnek 1: Canlı Sunucuda Veritabanı Bağlantı Hatasının Çözümü
* **Sorun:** Proje dosyaları FTP ile sunucuya ilk yüklendiğinde, veritabanı bağlantı hatası fırlatıyordu.
* **AI Komutu (Prompt):**
  > "PHP projemin dosyalarını FileZilla ile uzak sunucudaki `public_html` içine taşıdım. Tarayıcıda açtığımda `SQLSTATE[HY000] [2002] Connection refused` hatası alıyorum. `veritabanı.php` dosyamda `DB_HOST` olarak okulun IP adresini yazmıştım. Bu hatayı nasıl çözerim?"
* **Sağlanan Çözüm:** AI, kodların zaten sunucu makinesinin içinde çalıştığını belirterek `DB_HOST` değerinin dış IP değil, yerel olarak **`localhost`** şeklinde güncellenmesi gerektiğini teknik olarak açıkladı. Bu sayede canlı sunucu bağlantısı başarıyla sağlandı.

---

### 📌 Örnek 2: XAMPP Local MySQL Çökme Hatasının Giderilmesi
* **Sorun:** Yerel testler sırasında bilgisayarın ani kilitlenmesi sonucu XAMPP Control Panel üzerinde MySQL sunucusu `MySQL shutdown unexpectedly` hatası vererek çöktü.
* **AI Komutu (Prompt):**
  > "XAMPP control panelde Apache sorunsuz başlıyor ama MySQL'e Start deyince kırmızıya dönüp 'MySQL shutdown unexpectedly. This may be due to a blocked port, missing dependencies...' hatası veriyor. Kodlarıma ve veritabanı tablolarıma zarar vermeden MySQL'i nasıl ayağa kaldırabilirim?"
* **Sağlanan Çözüm:** AI, MySQL veri kilitlenmesini çözmek için XAMPP klasöründeki `backup` dosyalarını kullanarak `ibdata1` ve projenin mevcut veri tablolarını (`botanik_bahcesi`) koruyarak yerel sunucuyu veri kaybı olmadan sıfırlama adımlarını sundu.

---

### 📌 Örnek 3: Projeye "Ortak Kütüphane" Özelliği İçin SQL JOIN Tasarımı
* **Geliştirme:** Her kullanıcının sadece kendi bitkisini gördüğü yapıyı, herkesin tüm bitkileri görebileceği global bir kütüphaneye dönüştürmek.
* **AI Komutu (Prompt):**
  > "Sitemde öyle bir değişiklik yapmak istiyorum ki; kayıt olup panele giren herkes, diğer kullanıcıların da sisteme eklediği tüm bitkileri ortak bir sayfada görebilsin. Bitki verilerini çekerken o bitkiyi hangi kullanıcının eklediğini de (isim-soyisim olarak) yanına yazdırmak istiyorum. Veritabanını bozmadan bunu sağlayacak SQL sorgusunu ve PHP fonksiyonunu hazırlar mısın?"
* **Sağlanan Çözüm:** `bitkiler` ve `kullanicilar` tablolarını `kullanici_id` üzerinden birbirine bağlayan **`SQL JOIN`** mimarisi geliştirildi. `Bitki` sınıfına `tumBitkileriGetir()` fonksiyonu entegre edildi.

---

### 📌 Örnek 4: Arayüz İçin Dinamik Bootstrap Modal Entegrasyonu
* **Geliştirme:** Ortak kütüphanede listelenen bitkilere tıklandığında, sayfa yenilenmeden detaylı bakım notlarının açılması.
* **AI Komutu (Prompt):**
  > "Yeni oluşturduğum `tum_bitkiler.php` sayfasında tüm bitkileri Bootstrap kartları (card) olarak listeledim. Kullanıcı bu kartlardan birinin üzerine tıkladığında, sayfa yenilenmeden ekranın ortasında bir uzatma penceresi (açılır pencere) açılsın ve o bitkinin detaylı açıklaması ile bakım notları görünsün. CSS/JS ile uğraşmadan Bootstrap bileşenleriyle bunu nasıl yazarım?"
* **Sağlanan Çözüm:** Döngü içinde her bitkinin benzersiz ID'sini (`$bitki['id']`) dinamik olarak alan **Bootstrap Modal** yapısı koda işlendi. Böylece tıklanan bitkinin verisi ekranda asenkron olarak gösterildi.

---

### 📌 Örnek 5: Sunucu Üzerindeki "403 Forbidden (Yasaklı)" Erişim Hatası
* **Sorun:** Yeni eklenen `tum_bitkiler.php` sayfası tarayıcıda çağrıldığında "Bu kaynağa erişim izniniz yok" hatası verdi.
* **AI Komutu (Prompt):**
  > "Oluşturduğumuz yeni sayfayı sunucuya yükledim ama butona basıp gitmeye çalıştığımda tarayıcıda 'Yasaklı - Bu kaynağa erişim izniniz yok. Apache Server Port 80' yazıyor. Sayfa kodlarında mı hata var yoksa hosting ayarında mı?"
* **Sağlanan Çözüm:** AI, hatanın kod kaynaklı olmadığını, Linux/Apache sunucularda yeni oluşturulan dosyaların izin kısıtlamasına takıldığını teşhis etti. FileZilla üzerinden dosya izinlerinin (CHMOD) **`644`** yapılması gerektiğini göstererek erişim engelini kaldırdı.
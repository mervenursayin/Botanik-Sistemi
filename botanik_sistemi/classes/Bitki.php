<?php
// classes/Bitki.php
class Bitki {
    private $db;

    public function __construct($db_connection) {
        $this->db = $db_connection;
    }

    // CREATE
    public function ekle($kullanici_id, $tur_adi, $bilimsel_adi, $aile, $bakim_notu, $sulama_periyodu) {
        $sorgu = $this->db->prepare("INSERT INTO bitkiler (kullanici_id, tur_adi, bilimsel_adi, aile, bakim_notu, sulama_periyodu) VALUES (?, ?, ?, ?, ?, ?)");
        return $sorgu->execute([$kullanici_id, $tur_adi, $bilimsel_adi, $aile, $bakim_notu, $sulama_periyodu]);
    }

    // READ
    public function tumunuListele($kullanici_id) {
        $sorgu = $this->db->prepare("SELECT * FROM bitkiler WHERE kullanici_id = ? ORDER BY id DESC");
        $sorgu->execute([$kullanici_id]);
        return $sorgu->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getir($id, $kullanici_id) {
        $sorgu = $this->db->prepare("SELECT * FROM bitkiler WHERE id = ? AND kullanici_id = ?");
        $sorgu->execute([$id, $kullanici_id]);
        return $sorgu->fetch(PDO::FETCH_ASSOC);
    }

    // UPDATE
    public function guncelle($id, $kullanici_id, $tur_adi, $bilimsel_adi, $aile, $bakim_notu, $sulama_periyodu) {
        $sorgu = $this->db->prepare("UPDATE bitkiler SET tur_adi = ?, bilimsel_adi = ?, aile = ?, bakim_notu = ?, sulama_periyodu = ? WHERE id = ? AND kullanici_id = ?");
        return $sorgu->execute([$tur_adi, $bilimsel_adi, $aile, $bakim_notu, $sulama_periyodu, $id, $kullanici_id]);
    }

    // DELETE
    public function sil($id, $kullanici_id) {
        $sorgu = $this->db->prepare("DELETE FROM bitkiler WHERE id = ? AND kullanici_id = ?");
        return $sorgu->execute([$id, $kullanici_id]);
    }
}
?>
<?php  

if (isset($_GET['kategori_id'])) {

    $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.

    $sorgu=$db->prepare("SELECT * FROM urun WHERE kategori_id=:kategori_id");
    $sorgu->execute(array(
        'kategori_id' => $_GET['kategori_id']
    ));
    $toplam_icerik=$sorgu->rowCount();
    $toplam_sayfa = ceil($toplam_icerik / $sayfada);

    // eğer sayfa girilmemişse 1 varsayalım.
    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
    if($sayfa < 1) $sayfa = 1; 

    // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
    if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
    $limit = ($sayfa - 1) * $sayfada;

    //tüm tablo sütunlarının çekilmesi
    $urunsor=$db->prepare("SELECT urun.*,kategori.*,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and kategori.kategori_id=:kategori_id order by urun_zaman DESC limit $limit,$sayfada");
    $urunsor->execute(array(
        'urun_durum' => 1,
        'kategori_id' => $_GET['kategori_id']
    ));

    $say=$sorgu->rowCount();



    if ($say==0) {
        echo "Bu kategoride ürün Bulunamadı";
    }


} else {

    $sayfada = 6; // sayfada gösterilecek içerik miktarını belirtiyoruz.
    $sorgu=$db->prepare("select * from urun");
    $sorgu->execute();
    $toplam_icerik=$sorgu->rowCount();
    $toplam_sayfa = ceil($toplam_icerik / $sayfada);

    // eğer sayfa girilmemişse 1 varsayalım.
    $sayfa = isset($_GET['sayfa']) ? (int) $_GET['sayfa'] : 1;

    // eğer 1'den küçük bir sayfa sayısı girildiyse 1 yapalım.
    if($sayfa < 1) $sayfa = 1; 

    // toplam sayfa sayımızdan fazla yazılırsa en son sayfayı varsayalım.
    if($sayfa > $toplam_sayfa) $sayfa = $toplam_sayfa; 
    $limit = ($sayfa - 1) * $sayfada;

    //tüm tablo sütunlarının çekilmesi
    $urunsor=$db->prepare("SELECT urun.urun_ad,urun.urun_id,urun.urun_fiyat,urun.urunfoto_resimyol,urun.kategori_id,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,urun.urun_zaman,kategori.kategori_ad,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_durum=:urun_durum and urun_onecikar=:urun_onecikar order by urun_zaman DESC limit $limit,$sayfada");
    $urunsor->execute(array(
        'urun_durum' => 1,
        'urun_onecikar' => 1
    ));

    $say=$sorgu->rowCount();

    if ($say==0) {
        echo "Bu kategoride ürün Bulunamadı";
    }



    ?>
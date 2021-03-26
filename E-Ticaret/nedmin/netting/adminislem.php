<?php 

ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['logoduzenle'])) {

	
	if ($_FILES['ayar_logo']['size']>1048576) {
		
		echo "Bu dosya boyutu çok büyük";

		Header("Location:../production/genel-ayar.php?durum=dosyabuyuk");

	}


	$izinli_uzantilar=array('jpg','png');

	//echo $_FILES['ayar_logo']["name"];

	$ext=strtolower(substr($_FILES['ayar_logo']["name"],strpos($_FILES['ayar_logo']["name"],'.')+1));

	if (in_array($ext, $izinli_uzantilar) === false) {
		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../production/genel-ayar.php?durum=formathata");

		exit;
	}


	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;

	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}





if (isset($_POST['adminkullaniciduzenle'])) {

	$kullanici_id=$_POST['kullanici_id'];

	$guncelle=$db->prepare("UPDATE kullanici SET

		kullanici_tc        = :kullanici_tc,
		kullanici_ad        = :kullanici_ad,
		kullanici_soyad     = :kullanici_soyad,
		kullanici_gsm       = :kullanici_gsm,
		kullanici_il        = :kullanici_il,
		kullanici_ilce      = :kullanici_ilce,
		kullanici_adres     = :kullanici_adres,
		kullanici_durum     = :kullanici_durum

		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$guncelle->execute(array(

		'kullanici_tc'      =>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_ad'      =>htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad'   =>htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm'     =>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_il'      =>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'    =>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'   =>htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_durum'   =>htmlspecialchars($_POST['kullanici_durum'])
	));

	if ($update) {

		Header("Location:../production/kullanici-duzenle.php?durum=ok&kullanici_id=$kullanici_id");

	} else {

		Header("Location:../production/kullanici-duzenle.php?durum=no&kullanici_id=$kullanici_id");

	}
	
}


if ($_GET['kullanici_magaza']=='ok') {


	$duzenle=$db->prepare("UPDATE kullanici SET
		kullanici_magaza=:kullanici_magaza

		WHERE kullanici_id={$_GET['kullanici_id']}");

	$update=$duzenle->execute(array(
		'kullanici_magaza' =>$_GET['kullanici_one']

	));


	if ($update) {

		Header("Location:../production/magaza-onay.php?durum=ok");

	} else {

		Header("Location:../production/magaza-onay.php?durum=no");
	}

}


if ($_GET['magazaonay']=='red') {


	$duzenle=$db->prepare("UPDATE kullanici SET

		kullanici_magaza=:kullanici_magaza

		WHERE kullanici_id={$_GET['kullanici_id']}");

	$update=$duzenle->execute(array(

		'kullanici_magaza' => 0

	));


	if ($update) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar-onay.php?durum=no");
	}

}


if (isset($_POST['magazaonaykayit'])) {


	$guncelle=$db->prepare("UPDATE kullanici SET

		kullanici_unvan     = :kullanici_unvan,
		kullanici_vdaire    = :kullanici_vdaire,
		kullanici_vno       = :kullanici_vno,
		kullanici_tc        = :kullanici_tc,
		kullanici_banka     = :kullanici_banka,
		kullanici_iban      = :kullanici_iban,
		kullanici_ad        = :kullanici_ad,
		kullanici_soyad     = :kullanici_soyad,
		kullanici_gsm       = :kullanici_gsm,
		kullanici_il        = :kullanici_il,
		kullanici_ilce      = :kullanici_ilce,
		kullanici_adres     = :kullanici_adres,
		kullanici_durum     = :kullanici_durum,
		kullanici_magaza    = :kullanici_magaza
		
		WHERE kullanici_id={$_POST['kullanici_id']}");

	$update=$guncelle->execute(array(

		'kullanici_unvan'    =>htmlspecialchars($_POST['kullanici_unvan']),
		'kullanici_vdaire'   =>htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno'      =>htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_tc'       =>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_banka'    =>htmlspecialchars($_POST['kullanici_banka']),
		'kullanici_iban'     =>htmlspecialchars($_POST['kullanici_iban']),
		'kullanici_ad'       =>htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad'    =>htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm'      =>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_il'       =>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'     =>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'    =>htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_durum'    =>htmlspecialchars($_POST['kullanici_durum']),
		'kullanici_magaza'   =>2
	));

	if ($update) {

		Header("Location:../production/magazalar.php?durum=ok");

	} else {

		Header("Location:../production/magazalar.php?durum=no");

	}
	
}


if (isset($_POST['kullaniciprofilguncelle'])) {

	if ($_FILES['kullanici_magazafoto']['size']>1048576) {
		
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../../profil-resim-guncelle.php?durum=dosyabuyuk");

	}

	$izinli_uzantilar=array('jpg','png');

	//echo $_FILES['ayar_logo']["name"];

	$ext=strtolower(substr($_FILES['kullanici_magazafoto']["name"],strpos($_FILES['kullanici_magazafoto']["name"],'.')+1));

	if (in_array($ext, $izinli_uzantilar) === false) {

		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../../profil-resim-guncelle.php?durum=formathata");
		exit;
	}

	@$tmp_name = $_FILES['kullanici_magazafoto']["tmp_name"];
	@$name = seo ($_FILES['kullanici_magazafoto']["name"]); //seo fonksiyonu ile yüklenen resim adlarında türkçe karekterin önüne geçme

	//image resize işlemleri
	include('SimpleImage.php'); 	//Bağlantıyı kurma
	$image = new SimpleImage();		//lass tan yeni bir nesne oluşturma
	$image ->load($tmp_name);		//Resmin ismini yollama
	$image ->resize(128,128);		//Resim boyutlandırma
	$image ->save($tmp_name);		//resmi kaydetme (ismi kendisine iade etme)

	$uploads_dir = '../../dimg/userphoto';
	
	//$benzersizsayi4=rand(20000,32000);
	$uniqid=uniqid();  //Uniqid() Benzersiz 13 karekterli anahtar oluşturma
	
	//$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;
	$refimgyol=substr($uploads_dir, 6)."/".$uniqid.".".$ext;

	//@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name");
	@move_uploaded_file($tmp_name, "$uploads_dir/$uniqid.$ext");

	$duzenle=$db->prepare("UPDATE kullanici SET

		kullanici_magazafoto=:kullanici_magazafoto

		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$duzenle->execute(array(

		'kullanici_magazafoto' => $refimgyol

	));

	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");			//Eski resmi silme

		Header("Location:../../profil-resim-guncelle.php?durum=ok");

	} else {

		Header("Location:../../profil-resim-guncelle.php?durum=no");
	}

}



//Mağaza Ürün Ekleme İşlemleri
if (isset($_POST['magazaurunekle'])) {

	if ($_FILES['urunfoto_resimyol']['size']>1048576) {
		
		echo "Bu dosya boyutu çok büyük";
		Header("Location:../../urun-ekle.php?durum=dosyabuyuk");

	}

	$izinli_uzantilar=array('jpg','png');

	$ext=strtolower(substr($_FILES['urunfoto_resimyol']["name"],strpos($_FILES['urunfoto_resimyol']["name"],'.')+1));

	if (in_array($ext, $izinli_uzantilar) === false) {

		echo "Bu uzantı kabul edilmiyor";
		Header("Location:../../urun-ekle.php?durum=formathata");
		exit;
	}

	@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
	@$name = seo ($_FILES['urunfoto_resimyol']["name"]); //seo fonksiyonu ile yüklenen resim adlarında türkçe karekterin önüne geçme

	//image resize işlemleri
	include('SimpleImage.php'); 	//Bağlantıyı kurma
	$image = new SimpleImage();		//lass tan yeni bir nesne oluşturma
	$image ->load($tmp_name);		//Resmin ismini yollama
	$image ->resize(829,248);		//Resim boyutlandırma
	$image ->save($tmp_name);		//resmi kaydetme (ismi kendisine iade etme)

	$uploads_dir = '../../dimg/urunfoto';
	
	
	$uniqid=uniqid();  //Uniqid() Benzersiz 13 karekterli anahtar oluşturma
	$refimgyol=substr($uploads_dir, 6)."/".$uniqid.".".$ext;

	@move_uploaded_file($tmp_name, "$uploads_dir/$uniqid.$ext");


	$duzenle=$db->prepare("INSERT INTO urun SET

		kullanici_id       = :kullanici_id,
		kategori_id        = :kategori_id,
		urun_ad            = :urun_ad,
		urun_detay         = :urun_detay,
		urun_fiyat         = :urun_fiyat,
		urunfoto_resimyol  = :urunfoto_resimyol

		");

	$insert=$duzenle->execute(array(

		'kullanici_id'      => htmlspecialchars($_SESSION['userkullanici_id']),
		'kategori_id'       => htmlspecialchars($_POST['kategori_id']),
		'urun_ad'           => htmlspecialchars($_POST['urun_ad']),
		'urun_detay'        => htmlspecialchars($_POST['urun_detay']),
		'urun_fiyat'        => htmlspecialchars($_POST['urun_fiyat']),
		'urunfoto_resimyol' => $refimgyol

	));

	if ($insert) {

		Header("Location:../../urun-ekle.php?durum=ok");

	} else {

		Header("Location:../../urun-ekle.php?durum=no");
	}

}


//Mağaza Ürün Düzenleme İşlemleri
if (isset($_POST['magazaurunduzenle'])) {

	if ($_FILES['urunfoto_resimyol']['size']>0) {
		//Ürün düzenleme işleminde yeni resim yüklenecekse aşağıdaki işlemler gerçekleşir.

		if ($_FILES['urunfoto_resimyol']['size']>1048576) {

			echo "Bu dosya boyutu çok büyük";
			Header("Location:../../urun-duzenle.php?durum=dosyabuyuk");
		}

		$izinli_uzantilar=array('jpg','png');

		$ext=strtolower(substr($_FILES['urunfoto_resimyol']["name"],strpos($_FILES['urunfoto_resimyol']["name"],'.')+1));

		if (in_array($ext, $izinli_uzantilar) === false) {

			echo "Bu uzantı kabul edilmiyor";
			Header("Location:../../urun-duzenle.php?durum=formathata");
			exit;
		}

		@$tmp_name = $_FILES['urunfoto_resimyol']["tmp_name"];
	    @$name     = seo($_FILES['urunfoto_resimyol']["name"]); //seo fonksiyonu ile yüklenen resim adlarında türkçe karekterin önüne geçme

	    //image resize işlemleri
	    include('SimpleImage.php'); 	//Bağlantıyı kurma
	    $image = new SimpleImage();		//lass tan yeni bir nesne oluşturma
	    $image ->load($tmp_name);		//Resmin ismini yollama
	    $image ->resize(629,248);		//Resim boyutlandırma
	    $image ->save($tmp_name);		//resmi kaydetme (ismi kendisine iade etme)

	    $uploads_dir = '../../dimg/urunfoto';


	    $uniqid=uniqid();  //Uniqid() Benzersiz 13 karekterli anahtar oluşturma
	    $refimgyol=substr($uploads_dir, 6)."/".$uniqid.".".$ext;

	    @move_uploaded_file($tmp_name, "$uploads_dir/$uniqid.$ext");

	    $duzenle=$db->prepare("UPDATE urun SET

	    	kategori_id        = :kategori_id,
	    	urun_ad            = :urun_ad,
	    	urun_detay         = :urun_detay,
	    	urun_fiyat         = :urun_fiyat,
	    	urunfoto_resimyol  = :urunfoto_resimyol

	    	WHERE urun_id={$_POST['urun_id']}");

	    $update=$duzenle->execute(array(

	    	'kategori_id'       => htmlspecialchars($_POST['kategori_id']),
	    	'urun_ad'           => htmlspecialchars($_POST['urun_ad']),
	    	'urun_detay'        => htmlspecialchars($_POST['urun_detay']),
	    	'urun_fiyat'        => htmlspecialchars($_POST['urun_fiyat']),
	    	'urunfoto_resimyol' => $refimgyol

	    ));

	    $urun_id=$_POST['urun_id'];

	    if ($update) {

	    	$resimsilunlink=$_POST['eski_yol'];
		    unlink("../../$resimsilunlink");			//Eski resmi silme

		    Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle.php?durum=no&urun_id=$urun_id");
		}

	} else {

		//Ürün düzenleme işleminde yeni resim yüklenmeyecek ise aşağıdaki işlemler gerçekleşir.
		$duzenle=$db->prepare("UPDATE urun SET

	    	kategori_id        = :kategori_id,
	    	urun_ad            = :urun_ad,
	    	urun_detay         = :urun_detay,
	    	urun_fiyat         = :urun_fiyat

	    	WHERE urun_id={$_POST['urun_id']}");

	    $update=$duzenle->execute(array(

	    	'kategori_id'       => htmlspecialchars($_POST['kategori_id']),
	    	'urun_ad'           => htmlspecialchars($_POST['urun_ad']),
	    	'urun_detay'        => htmlspecialchars($_POST['urun_detay']),
	    	'urun_fiyat'        => htmlspecialchars($_POST['urun_fiyat'])

	    ));

	    $urun_id=$_POST['urun_id'];

	    if ($update) {
	    	
		    Header("Location:../../urun-duzenle.php?durum=ok&urun_id=$urun_id");

		} else {

			Header("Location:../../urun-duzenle.php?durum=no&urun_id=$urun_id");
		}
	}

}

//Ürün silme işlemleri
if ($_GET['urunsil']=="ok") {
	
	$sil=$db->prepare("DELETE FROM urun WHERE urun_id=:urun_id");
	$kontrol=$sil->execute(array(

		'urun_id' => $_GET['urun_id']

	));

	if ($kontrol) {

		$resimsilunlink=$_GET['urunfoto'];
		unlink("../../$resimsilunlink");

		Header("Location:../../urunlerim.php?urundurum=ok");

	} else {

		Header("Location:../../urunlerim.php?urundurum=no");
	}

}

if (isset($_POST['kategoriduzenle'])) {

	$kategori_id=$_POST['kategori_id'];
	$kategori_seourl=seo($_POST['kategori_ad']);

	$kaydet=$db->prepare("UPDATE kategori SET

		kategori_ad       =:ad,
		kategori_sira     =:sira,
		kategori_onecikar =:onecikar,
		kategori_durum    =:kategori_durum,	
		kategori_seourl   =:seourl
		

		WHERE kategori_id={$_POST['kategori_id']}");

	$update=$kaydet->execute(array(
		'ad'             => htmlspecialchars($_POST['kategori_ad']),
		'sira'           => htmlspecialchars($_POST['kategori_sira']),
		'onecikar'       => htmlspecialchars($_POST['kategori_onecikar']),
		'kategori_durum' => htmlspecialchars($_POST['kategori_durum']),
		'seourl'         => htmlspecialchars($kategori_seourl)
					
	));

	if ($update) {

		Header("Location:../production/kategori.php?durum=ok&kategori_id=$kategori_id");

	} else {

		Header("Location:../production/kategori.php?durum=no&kategori_id=$kategori_id");
	}

}

//Kategori durumu AKTİF & PASİT etme işlemleri
if ($_GET['kategori_durum']=='ok') {

	$duzenle=$db->prepare("UPDATE kategori SET
		kategori_durum     =:kategori_durum

		WHERE kategori_id  ={$_GET['kategori_id']}");

	$update=$duzenle->execute(array(
		'kategori_durum'   =>htmlspecialchars($_GET['kategoridurum_one'])
	));

	if ($update) {
		Header("Location:../production/kategori.php?durum=ok");

	} else {
		Header("Location:../production/kategori.php?durum=no");
	}

}

//Kategori öneçikar AKTİF & PASİT etme işlemleri
if ($_GET['kategori_onecikar']=='ok') {

	$duzenle=$db->prepare("UPDATE kategori SET
		kategori_onecikar=:kategori_onecikar

		WHERE kategori_id={$_GET['kategori_id']}");

	$update=$duzenle->execute(array(
		'kategori_onecikar' =>htmlspecialchars($_GET['kategori_one'])
	));

	if ($update) {
		Header("Location:../production/kategori.php?durum=ok");

	} else {
		Header("Location:../production/kategori.php?durum=no");
	}

}

if ($_GET['kategorisil']=="ok") {
	
	$sil=$db->prepare("DELETE FROM kategori WHERE kategori_id=:kategori_id");

	$kontrol=$sil->execute(array(

		'kategori_id' => htmlspecialchars($_GET['kategori_id'])
	));

	if ($kontrol) {

		Header("Location:../production/kategori.php?durum=ok");

	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}

if (isset($_POST['kategoriekle'])) {

	$kategori_seourl=seo($_POST['kategori_ad']);

	$kaydet=$db->prepare("INSERT INTO kategori SET
		kategori_ad       =:ad,
		kategori_sira     =:sira,
		kategori_durum    =:kategori_durum,	
		kategori_seourl   =:seourl
		
		");
	$insert=$kaydet->execute(array(
		'ad'              => htmlspecialchars($_POST['kategori_ad']),
		'sira'            => htmlspecialchars($_POST['kategori_sira']),
		'kategori_durum'  => htmlspecialchars($_POST['kategori_durum']),
		'seourl'          => htmlspecialchars($kategori_seourl)
				
	));

	if ($insert) {

		Header("Location:../production/kategori.php?durum=ok");

	} else {

		Header("Location:../production/kategori.php?durum=no");
	}

}

//Ürün öneçıkar AKTİF & PASİT etme işlemleri
if ($_GET['urun_onecikar']=='ok') {

	$duzenle=$db->prepare("UPDATE urun SET
		urun_onecikar    =:urun_onecikar

		WHERE urun_id={$_GET['urun_id']}");

	$update=$duzenle->execute(array(
		'urun_onecikar' =>htmlspecialchars($_GET['urun_one'])

	));

	if ($update) {
		Header("Location:../production/urun.php?durum=ok");

	} else {
		Header("Location:../production/urun.php?durum=no");
	}

}

//Ürün durum AKTİF & PASİT etme işlemleri
if ($_GET['urun_durum']=='ok') {

	$duzenle=$db->prepare("UPDATE urun SET
		urun_durum   =:urun_durum

		WHERE urun_id={$_GET['urun_id']}");

	$update=$duzenle->execute(array(
		'urun_durum' =>htmlspecialchars($_GET['urundurum_one'])

	));

	if ($update) {
		Header("Location:../production/urun.php?durum=ok");

	} else {
		Header("Location:../production/urun.php?durum=no");
	}

}

if ($_GET['urunsill']=="ok") {
	
	$sil=$db->prepare("DELETE FROM urun WHERE urun_id=:urun_id");

	$delete=$sil->execute(array(

		'urun_id' => htmlspecialchars($_GET['urun_id'])
	));

	if ($delete) {
		Header("Location:../production/urun.php?durum=ok");

	} else {
		Header("Location:../production/urun.php?durum=no");
	}

}

if (isset($_POST['urunduzenle'])) {

	$urun_id=$_POST['urun_id'];
	$urun_seourl=seo($_POST['urun_ad']);

	$kaydet=$db->prepare("UPDATE urun SET
		kategori_id   =:kategori_id,
		urun_ad       =:urun_ad,
		urun_detay    =:urun_detay,
		urun_fiyat    =:urun_fiyat,
		urun_onecikar =:urun_onecikar,
		urun_durum    =:urun_durum,
		urun_seourl   =:seourl

		WHERE urun_id = {$_POST['urun_id']}");

	$update=$kaydet->execute(array(

		'kategori_id'   =>htmlspecialchars($_POST['kategori_id']),
		'urun_ad'       =>htmlspecialchars($_POST['urun_ad']),
		'urun_detay'    =>htmlspecialchars($_POST['urun_detay']),
		'urun_fiyat'    =>htmlspecialchars($_POST['urun_fiyat']),
		'urun_onecikar' =>htmlspecialchars($_POST['urun_onecikar']),
		'urun_durum'    =>htmlspecialchars($_POST['urun_durum']),
		'seourl'        =>htmlspecialchars($urun_seourl)

	));

	if ($update) {

		Header("Location:../production/urun.php?durum=ok&urun_id=$urun_id");

	} else {

		Header("Location:../production/urun.php?durum=no&urun_id=$urun_id");
	}

}


?>
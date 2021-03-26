<?php
ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['kullanicigiris'])) {

	$kullanici_mail=($_POST['kullanici_mail']);
	$kullanici_password=$_POST['kullanici_password'];

	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail AND kullanici_password=:password AND kullanici_yetki=:yetki AND kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail'     => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki'    => 0,
		'durum'	   => 1 //Kullanıcı aktif ise 
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['userkullanici_mail']=$kullanici_mail;

		header("Location:../../?durum=basariligiris");
		exit;

	} else {

		header("Location:../../?durum=basarisizgiris");
		exit;
	}
	

}


if (isset($_POST['kullanicikaydet'])) {

	$kullanici_adsoyad=htmlspecialchars($_POST['kullanici_adsoyad']);  
	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']); 

	$kullanici_passwordone=($_POST['kullanici_passwordone']); 
	$kullanici_passwordtwo=($_POST['kullanici_passwordtwo']); 


	if ($kullanici_passwordone==$kullanici_passwordtwo) 
	{


		if (strlen($kullanici_passwordone)>=6) 		//Strlen şifre kısmına harf girildiğinde
		{


			$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail");	//mükerrer kayıt var mı diye bakıyoruz.
			$kullanicisor->execute(array(
				'mail' => $kullanici_mail
			));

			//dönen satır sayısını belirtir
			//Kullanıcı varsa satır döner
			$say=$kullanicisor->rowCount();



			if ($say==0) 
			{

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				//$password=md5($kullanici_passwordone);

				$kullanici_yetki=1;

			//Kullanıcı kayıt işlemi yapılıyor...
				$kullanicikaydet=$db->prepare("INSERT INTO kullanici SET 
					kullanici_adsoyad      =:kullanici_adsoyad,
					kullanici_mail         =:kullanici_mail,
					kullanici_password     =:kullanici_password,
					kullanici_gsm          =:kullanici_gsm,
					kullanici_tc           =:kullanici_tc,
					kullanici_ad           =:kullanici_ad,
					kullanici_il           =:kullanici_il,
					kullanici_ilce         =:kullanici_ilce,
					kullanici_adres        =:kullanici_adres,
					kullanici_yetki        =:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_adsoyad'  => $_POST['kullanici_adsoyad'],
					'kullanici_mail'     => $_POST['kullanici_mail'],
					'kullanici_password' => $_POST['kullanici_passwordone'],
					'kullanici_gsm'      => $_POST['kullanici_gsm'],
					'kullanici_tc'       => $_POST['kullanici_tc'],
					'kullanici_ad'       => $_POST['kullanici_ad'],
					'kullanici_il'       => $_POST['kullanici_il'],
					'kullanici_ilce'     => $_POST['kullanici_ilce'],
					'kullanici_adres'    => $_POST['kullanici_adres'],
					'kullanici_yetki'    => $kullanici_yetki
				));

				if ($insert) 
				{

					header("Location:../../index.php?durum=loginbasarili");

				//Header("Location:../production/genel-ayarlar.php?durum=ok");

				} else 
				{

					header("Location:../../register.php?durum=basarisiz");
				}

			} else 
			{

				header("Location:../../register.php?durum=mukerrerkayit");
			}

		} else 
		{
			header("Location:../../register.php?durum=eksiksifre");
		}

	} else 
	{
		header("Location:../../register.php?durum=farklisifre");
	}
}



//Slider sil işlemi resimyolu ile
if ($_GET['slidersil']=="ok") {
	
	$sil=$db->prepare("DELETE from slider where slider_id=:slider_id");
	$kontrol=$sil->execute(array(
		'slider_id' => $_GET['slider_id']
	));

	if ($kontrol) {

		$resimsilunlink=$_GET['slider_resimyol'];
		unlink("../../$resimsilunlink");

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}

}


/* Slider sil işlemi id ile

if ($_GET['slidersil']=="ok") {

	$sil=$db->prepare("DELETE FROM slider WHERE slider_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['slider_id']
	));


	if ($kontrol) {


		header("location:../production/slider.php?sil=ok");


	} else {

		header("location:../production/slider.php?sil=no");

	}


}
/*


/*
//Slider düzenleme işlemi id ile

if (isset($_POST['sliderduzenle'])) {

	$kullanici_id=$_POST['slider_id'];

	$ayarkaydet=$db->prepare("UPDATE slider SET
		slider_ad       =:slider_ad,
		slider_sira  =:slider_sira,
		slider_link  =:slider_link,
		slider_durum    =:slider_durum

		WHERE slider_id ={$_POST['slider_id']}");

	$update=$ayarkaydet->execute(array(
		'slider_ad'       => $_POST['slider_ad'],
		'slider_sira'  => $_POST['slider_sira'],
		'slider_link'  => $_POST['slider_link'],
		'slider_durum'    => $_POST['slider_durum']
	));


	if ($update) {

		Header("Location:../production/slider.php?kullanici_id=$kullanici_id&durum=ok");

	} else {

		Header("Location:../production/slider.php?kullanici_id=$kullanici_id&durum=no");
	}

}

*/

// Slider Düzenleme Başla
//Slider düzenleme işlemi resim yolu ile

if (isset($_POST['sliderduzenle'])) {

	
	if($_FILES['slider_resimyol']["size"] > 0)  { 


		$uploads_dir = '../../dimg/slider';
		@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];
		@$name = $_FILES['slider_resimyol']["name"];
		$benzersizsayi1=rand(20000,32000);
		$benzersizsayi2=rand(20000,32000);
		$benzersizsayi3=rand(20000,32000);
		$benzersizsayi4=rand(20000,32000);
		$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
		$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
		@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum,
			slider_resimyol=:resimyol	
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum'],
			'resimyol' => $refimgyol,
		));
		

		$slider_id=$_POST['slider_id'];

		if ($update) {

			$resimsilunlink=$_POST['slider_resimyol'];
			unlink("../../$resimsilunlink");

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}



	} else {

		$duzenle=$db->prepare("UPDATE slider SET
			slider_ad=:ad,
			slider_link=:link,
			slider_sira=:sira,
			slider_durum=:durum		
			WHERE slider_id={$_POST['slider_id']}");
		$update=$duzenle->execute(array(
			'ad' => $_POST['slider_ad'],
			'link' => $_POST['slider_link'],
			'sira' => $_POST['slider_sira'],
			'durum' => $_POST['slider_durum']
		));

		$slider_id=$_POST['slider_id'];

		if ($update) {

			Header("Location:../production/slider-duzenle.php?slider_id=$slider_id&durum=ok");

		} else {

			Header("Location:../production/slider-duzenle.php?durum=no");
		}
	}

}


// Slider Düzenleme Bitiş



if (isset($_POST['sliderkaydet'])) {


	$uploads_dir = '../../dimg/slider';
	@$tmp_name = $_FILES['slider_resimyol']["tmp_name"];				//Önbelleğe alma
	@$name = $_FILES['slider_resimyol']["name"];						//ismini alma
	
	//resmin isminin benzersiz olması
	$benzersizsayi1=rand(20000,32000);
	$benzersizsayi2=rand(20000,32000);
	$benzersizsayi3=rand(20000,32000);
	$benzersizsayi4=rand(20000,32000);	
	$benzersizad=$benzersizsayi1.$benzersizsayi2.$benzersizsayi3.$benzersizsayi4;
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizad.$name;
	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");
	


	$kaydet=$db->prepare("INSERT INTO slider SET
		slider_ad=:slider_ad,
		slider_sira=:slider_sira,
		slider_link=:slider_link,
		slider_resimyol=:slider_resimyol
		");
	$insert=$kaydet->execute(array(
		'slider_ad' => $_POST['slider_ad'],
		'slider_sira' => $_POST['slider_sira'],
		'slider_link' => $_POST['slider_link'],
		'slider_resimyol' => $refimgyol
	));

	if ($insert) {

		Header("Location:../production/slider.php?durum=ok");

	} else {

		Header("Location:../production/slider.php?durum=no");
	}


}




if (isset($_POST['logoduzenle'])) {

	

	$uploads_dir = '../../dimg';

	@$tmp_name = $_FILES['ayar_logo']["tmp_name"];
	@$name = $_FILES['ayar_logo']["name"];

	$benzersizsayi4=rand(20000,32000);
	$refimgyol=substr($uploads_dir, 6)."/".$benzersizsayi4.$name;


	@move_uploaded_file($tmp_name, "$uploads_dir/$benzersizsayi4$name"); //Önbellekteki resmi al $uploads_dir a gönder ve çakışmayı engellemek için $benzersizsayi4$name isimver. 

	
	$duzenle=$db->prepare("UPDATE ayar SET
		ayar_logo=:logo
		WHERE ayar_id=0");
	$update=$duzenle->execute(array(
		'logo' => $refimgyol
	));



	if ($update) {

		$resimsilunlink=$_POST['eski_yol'];
		unlink("../../$resimsilunlink");			//unlink php resim silme işine yarar.

		Header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		Header("Location:../production/genel-ayar.php?durum=no");
	}

}






if (isset($_POST['admingiris'])) {

	$kullanici_mail=$_POST['kullanici_mail'];
	$kullanici_password=($_POST['kullanici_password']);

	$kullanicisor=$db->prepare("SELECT * FROM kullanici where kullanici_mail=:mail and kullanici_password=:password AND kullanici_yetki=:yetki ");
	$kullanicisor->execute(array(
		'mail'     => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki'    => 1
		
	));

	echo $say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['kullanici_mail']=$kullanici_mail;

		header("Location:../production/index.php");
		exit;



	} else {

		header("Location:../production/login.php?durum=no");
		exit;
	}
	

}



if (isset($_POST['genelayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_title=:ayar_title,
		ayar_description=:ayar_description,
		ayar_keywords=:ayar_keywords,
		ayar_author=:ayar_author
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_title' => $_POST['ayar_title'],
		'ayar_description' => $_POST['ayar_description'],
		'ayar_keywords' => $_POST['ayar_keywords'],
		'ayar_author' => $_POST['ayar_author']
	));


	if ($update) {

		header("Location:../production/genel-ayar.php?durum=ok");

	} else {

		header("Location:../production/genel-ayar.php?durum=no");
	}
	
}



if (isset($_POST['iletisimayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		ayar_tel   =:ayar_tel,
		ayar_gsm   =:ayar_gsm,
		ayar_faks  =:ayar_faks,
		ayar_mail  =:ayar_mail,
		ayar_ilce  =:ayar_ilce,
		ayar_il    =:ayar_il,
		ayar_adres =:ayar_adres,
		ayar_mesai =:ayar_mesai
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(
		'ayar_tel'    => $_POST['ayar_tel'],
		'ayar_gsm'    => $_POST['ayar_gsm'],
		'ayar_faks'   => $_POST['ayar_faks'],
		'ayar_mail'   => $_POST['ayar_mail'],
		'ayar_ilce'   => $_POST['ayar_ilce'],
		'ayar_il'     => $_POST['ayar_il'],
		'ayar_adres'  => $_POST['ayar_adres'],
		'ayar_mesai'  => $_POST['ayar_mesai']
	));


	if ($update) {

		header("Location:../production/iletisim-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/iletisim-ayarlar.php?durum=no");
	}
	
}


if (isset($_POST['apiayarkaydet'])) {
	
	//Tablo güncelleme işlemi kodları...
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		
		ayar_analystic =:ayar_analystic,
		ayar_maps      =:ayar_maps,
		ayar_zopim     =:ayar_zopim
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_analystic' => $_POST['ayar_analystic'],
		'ayar_maps'      => $_POST['ayar_maps'],
		'ayar_zopim'     => $_POST['ayar_zopim']
	));


	if ($update) {

		header("Location:../production/api-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/api-ayarlar.php?durum=no");
	}
	
}

if (isset($_POST['sosyalayarkaydet'])) {
	
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		
		ayar_facebook  =:ayar_facebook,
		ayar_twitter   =:ayar_twitter,
		ayar_google    =:ayar_google,
		ayar_youtube   =:ayar_youtube
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_facebook'  => $_POST['ayar_facebook'],
		'ayar_twitter'   => $_POST['ayar_twitter'],
		'ayar_google'    => $_POST['ayar_google'],
		'ayar_youtube'   => $_POST['ayar_youtube']
	));


	if ($update) {

		header("Location:../production/sosyal-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/sosyal-ayarlar.php?durum=no");
	}
	
}

if (isset($_POST['smtpkaydet'])) {
	
	
	$ayarkaydet=$db->prepare("UPDATE ayar SET
		
		ayar_smtphost        =:ayar_smtphost,
		ayar_smtpuser        =:ayar_smtpuser,
		ayar_smtppassword    =:ayar_smtppassword,
		ayar_smtpport        =:ayar_smtpport
		WHERE ayar_id=0");

	$update=$ayarkaydet->execute(array(

		'ayar_smtphost'        => $_POST['ayar_smtphost'],
		'ayar_smtpuser'        => $_POST['ayar_smtpuser'],
		'ayar_smtppassword'    => $_POST['ayar_smtppassword'],
		'ayar_smtpport'        => $_POST['ayar_smtpport']
	));


	if ($update) {

		header("Location:../production/mail-ayarlar.php?durum=ok");

	} else {

		header("Location:../production/mail-ayarlar.php?durum=no");
	}
	
}


if (isset($_POST['hakkimizdakaydet'])) {
	
	//Tablo güncelleme işlemi kodları...

	/*

	copy paste işlemlerinde tablo ve işaretli satır isminin değiştirildiğinden emin olun!!!

	*/
	$ayarkaydet=$db->prepare("UPDATE hakkimizda SET
		hakkimizda_baslik=:hakkimizda_baslik,
		hakkimizda_icerik=:hakkimizda_icerik,
		hakkimizda_video=:hakkimizda_video,
		hakkimizda_vizyon=:hakkimizda_vizyon,
		hakkimizda_misyon=:hakkimizda_misyon
		WHERE hakkimizda_id=0");

	$update=$ayarkaydet->execute(array(
		'hakkimizda_baslik' => $_POST['hakkimizda_baslik'],
		'hakkimizda_icerik' => $_POST['hakkimizda_icerik'],
		'hakkimizda_video' => $_POST['hakkimizda_video'],
		'hakkimizda_vizyon' => $_POST['hakkimizda_vizyon'],
		'hakkimizda_misyon' => $_POST['hakkimizda_misyon']
	));


	if ($update) {

		header("Location:../production/hakkimizda.php?durum=ok");

	} else {

		header("Location:../production/hakkimizda.php?durum=no");
	}
	
}


if ($_GET['kullanicisil']=="ok") {

	$sil=$db->prepare("DELETE FROM kullanici WHERE kullanici_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['kullanici_id']
	));


	if ($kontrol) {


		header("location:../production/kullanici.php?sil=ok");


	} else {

		header("location:../production/kullanici.php?sil=no");

	}


}



if (isset($_POST['menuduzenle'])) {

	$menu_id=$_POST['menu_id'];

	$menu_seourl=seo($_POST['menu_ad']);				//Türkçe karekterleri direk olarak ingilizce seo olarak kullanılabilir.

	
	$ayarkaydet=$db->prepare("UPDATE menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		WHERE menu_id={$_POST['menu_id']}");

	$update=$ayarkaydet->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));


	if ($update) {

		Header("Location:../production/menu.php?menu_id=$menu_id&durum=ok");

	} else {

		Header("Location:../production/menu.php?menu_id=$menu_id&durum=no");
	}

}

if ($_GET['menusil']=="ok") {

	$sil=$db->prepare("DELETE from menu where menu_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['menu_id']
	));


	if ($kontrol) {


		header("location:../production/menu.php?sil=ok");


	} else {

		header("location:../production/menu.php?sil=no");

	}


}

if (isset($_POST['menukaydet'])) {


	$menu_seourl=seo($_POST['menu_ad']);


	$ayarekle=$db->prepare("INSERT INTO menu SET
		menu_ad=:menu_ad,
		menu_detay=:menu_detay,
		menu_url=:menu_url,
		menu_sira=:menu_sira,
		menu_seourl=:menu_seourl,
		menu_durum=:menu_durum
		");

	$insert=$ayarekle->execute(array(
		'menu_ad' => $_POST['menu_ad'],
		'menu_detay' => $_POST['menu_detay'],
		'menu_url' => $_POST['menu_url'],
		'menu_sira' => $_POST['menu_sira'],
		'menu_seourl' => $menu_seourl,
		'menu_durum' => $_POST['menu_durum']
	));


	if ($insert) {

		Header("Location:../production/menu.php?durum=ok");

	} else {

		Header("Location:../production/menu.php?durum=no");
	}

}




if (isset($_POST['urunekle'])) {

	$urun_seourl=seo($_POST['urun_ad']);

	$kaydet=$db->prepare("INSERT INTO urun SET
		kategori_id=:kategori_id,
		urun_ad=:urun_ad,
		urun_detay=:urun_detay,
		urun_fiyat=:urun_fiyat,
		urun_video=:urun_video,
		urun_keyword=:urun_keyword,
		urun_durum=:urun_durum,
		urun_stok=:urun_stok,	
		urun_seourl=:seourl		
		");
	$insert=$kaydet->execute(array(
		'kategori_id' => $_POST['kategori_id'],
		'urun_ad' => $_POST['urun_ad'],
		'urun_detay' => $_POST['urun_detay'],
		'urun_fiyat' => $_POST['urun_fiyat'],
		'urun_video' => $_POST['urun_video'],
		'urun_keyword' => $_POST['urun_keyword'],
		'urun_durum' => $_POST['urun_durum'],
		'urun_stok' => $_POST['urun_stok'],
		'seourl' => $urun_seourl

	));

	if ($insert) {

		Header("Location:../production/urun.php?durum=ok");

	} else {

		Header("Location:../production/urun.php?durum=no");
	}

}


if (isset($_POST['yorumkaydet'])) {

	$gelen_url=$_POST['gelen_url']; 

	$ayarekle=$db->prepare("INSERT INTO yorumlar SET
		yorum_detay=:yorum_detay,
		yorum_baslik=:yorum_baslik,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id
		");

	$insert=$ayarekle->execute(array(
		'yorum_detay' => $_POST['yorum_detay'],
		'yorum_baslik' => $_POST['yorum_baslik'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id']
	));

	

	if ($insert) {

		Header('Location: '.$gelen_url.'?durum=ok');

	} else {

		Header('Location: '.$gelen_url.'?durum=no');
	}

}


if (isset($_POST['sepetekle'])) {

	$sepet =$db->prepare("INSERT INTO sepet SET 
		sepet_id=:sepet_id,
		kullanici_id=:kullanici_id,
		urun_id=:urun_id,
		urun_adet=:urun_adet,
		urun_renk=:urun_renk
		");
	$insert=$sepet->execute(array(
		'sepet_id' => $_POST['sepet_id'],
		'kullanici_id' => $_POST['kullanici_id'],
		'urun_id' => $_POST['urun_id'],
		'urun_adet' => $_POST['urun_adet'],
		'urun_renk' => $_POST['urun_renk']

	));
	if ($insert) {

		Header("Location:../../sepet.php?durum=ok");

	} else {

		Header("Location:../../sepet.php?durum=no");
	}

}



if ($_GET['yorum_onay']=='ok') {


	$duzenle=$db->prepare("UPDATE yorumlar SET
		yorum_onay=:yorum_onay

		WHERE yorum_id={$_GET['yorum_id']}");

	$update=$duzenle->execute(array(
		'yorum_onay' =>$_GET['yorum_one']

	));


	if ($update) {

		Header("Location:../production/yorum.php?durum=ok");

	} else {

		Header("Location:../production/yorum.php?durum=no");
	}

}

if ($_GET['yorumsil']=="ok") {

	$sil=$db->prepare("DELETE FROM yorumlar WHERE yorum_id=:id");
	$kontrol=$sil->execute(array(
		'id' => $_GET['yorum_id']
	));


	if ($kontrol) {


		header("location:../production/yorum.php?sil=ok");


	} else {

		header("location:../production/yorum.php?sil=no");

	}
}

if (isset($_POST['bankaduzenle'])) {

	$banka_id=$_POST['banka_id'];

	$bankakaydet=$db->prepare("UPDATE banka SET
		banka_ad       =:banka_ad,
		banka_iban     =:banka_iban,
		banka_hesap    =:banka_hesap,
		banka_hesapadsoyad    =:banka_hesapadsoyad,
		banka_subekodu        =:banka_subekodu,
		banka_durum           =:banka_durum

		WHERE banka_id ={$_POST['banka_id']}");

	$update=$bankakaydet->execute(array(
		'banka_ad'       => $_POST['banka_ad'],
		'banka_iban'  => $_POST['banka_iban'],
		'banka_hesap'    => $_POST['banka_hesap'],
		'banka_hesapadsoyad'    => $_POST['banka_hesapadsoyad'],
		'banka_subekodu'    => $_POST['banka_subekodu'],
		'banka_durum'    => $_POST['banka_durum']
	));


	if ($update) {

		Header("Location:../production/banka.php?banka_id=$banka_id&durum=ok");

	} else {

		Header("Location:../production/banka.php?banka_id=$banka_id&durum=no");
	}

}


if ($_GET['banka_durum']=='ok') {


	$bankaduzenle=$db->prepare("UPDATE banka SET
		banka_durum=:banka_durum

		WHERE banka_id={$_GET['banka_id']}");

	$update=$bankaduzenle->execute(array(
		'banka_durum' =>$_GET['banka_one']

	));


	if ($update) {

		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}


if (isset($_POST['bankakaydet'])) {


	$bankaekle=$db->prepare("INSERT INTO banka SET
		banka_ad=:banka_ad,
		banka_iban=:banka_iban,
		banka_hesap=:banka_hesap,
		banka_hesapadsoyad=:banka_hesapadsoyad,
		banka_subekodu=:banka_subekodu,
		banka_durum=:banka_durum
		");

	$insert=$bankaekle->execute(array(
		'banka_ad' => $_POST['banka_ad'],
		'banka_iban' => $_POST['banka_iban'],
		'banka_hesap' => $_POST['banka_hesap'],
		'banka_hesapadsoyad' => $_POST['banka_hesapadsoyad'],
		'banka_subekodu' => $_POST['banka_subekodu'],
		'banka_durum' => $_POST['banka_durum']
	));


	if ($insert) {

		Header("Location:../production/banka.php?durum=ok");

	} else {

		Header("Location:../production/banka.php?durum=no");
	}

}

if ($_GET['bankasil']=="ok") {

	$bankasil=$db->prepare("DELETE FROM banka WHERE banka_id=:id");
	$kontrol=$bankasil->execute(array(

		'id' => $_GET['banka_id']

	));


	if ($kontrol) {


		header("location:../production/banka.php?sil=ok");


	} else {

		header("location:../production/banka.php?sil=no");

	}
}

if ($_GET['kullanici_durum']=='ok') {


	$duzenle=$db->prepare("UPDATE kullanici SET
		kullanici_durum=:kullanici_durum

		WHERE kullanici_id={$_GET['kullanici_id']}");

	$update=$duzenle->execute(array(
		'kullanici_durum' =>$_GET['kullanici_one']

	));


	if ($update) {

		Header("Location:../production/kullanici.php?durum=ok");

	} else {

		Header("Location:../production/kullanici.php?durum=no");
	}

}

if (isset($_POST['kullanicibilgimiguncelle'])) {

	$kullanici_id=$_POST['kullanici_id'];
	

	$ayarkaydet=$db->prepare("UPDATE kullanici SET

		kullanici_adsoyad       =:kullanici_adsoyad,
		kullanici_mail          =:kullanici_mail,
		kullanici_tc            =:kullanici_tc,
		kullanici_gsm           =:kullanici_gsm,
		kullanici_ad            =:kullanici_ad,
		kullanici_il            =:kullanici_il,
		kullanici_ilce          =:kullanici_ilce,
		kullanici_adres         =:kullanici_adres

		WHERE kullanici_id ={$_POST['kullanici_id']}");

	$update=$ayarkaydet->execute(array(

		'kullanici_adsoyad'       => $_POST['kullanici_adsoyad'],
		'kullanici_mail'          => $_POST['kullanici_mail'],
		'kullanici_tc'            => $_POST['kullanici_tc'],
		'kullanici_gsm'           => $_POST['kullanici_gsm'],
		'kullanici_ad'            => $_POST['kullanici_ad'],
		'kullanici_il'            => $_POST['kullanici_il'],
		'kullanici_ilce'          => $_POST['kullanici_ilce'],
		'kullanici_adres'         => $_POST['kullanici_adres']

	));


	if ($update) {

		Header("Location:../../hesabim.php?durum=ok");

	} else {

		Header("Location:../../hesabim.php?durum=no");
	}

}



if (isset($_POST['kullanicisifreguncelle'])) {

	echo $kullanici_eskipassword=trim($_POST['kullanici_eskipassword']); echo "<br>";
	echo $kullanici_passwordone=trim($_POST['kullanici_passwordone']); echo "<br>";
	echo $kullanici_passwordtwo=trim($_POST['kullanici_passwordtwo']); echo "<br>";

	$kullanici_password=($kullanici_eskipassword);


	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_password=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
	));

	//dönen satır sayısını belirtir
	$say=$kullanicisor->rowCount();



	if ($say==0) {

		header("Location:../../sifre-guncelle?durum=eskisifrehata");

	} else {

	    //eski şifre doğruysa başla
		if ($kullanici_passwordone==$kullanici_passwordtwo) {


			if (strlen($kullanici_passwordone)>=6) {

				//md5 fonksiyonu şifreyi md5 şifreli hale getirir.
				$password=($kullanici_passwordone);

				$kullanici_yetki=0;

				$kullanicikaydet=$db->prepare("UPDATE kullanici SET
					kullanici_password=:kullanici_password
					WHERE kullanici_id={$_POST['kullanici_id']}");

				
				$insert=$kullanicikaydet->execute(array(
					'kullanici_password' => $password
				));

				if ($insert) {


					header("Location:../../sifre-guncelle.php?durum=sifredegisti");


				//Header("Location:../production/genel-ayarlar.php?durum=ok");
				} else {


					header("Location:../../sifre-guncelle.php?durum=no");
				}

		// Bitiş

			} else {

				header("Location:../../sifre-guncelle.php?durum=eksiksifre");

			}

		} else {

			header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");

			exit;
		}

	}

	exit;

	if ($update) {

		header("Location:../../sifre-guncelle?durum=ok");

	} else {

		header("Location:../../sifre-guncelle?durum=no");
	}

}


//Siparis Ekle
if (isset($_POST['bankasiparisekle'])) {

	$siparis_tip='Banka Havalesi';
	
	$siparis_kaydet=$db->prepare("INSERT INTO siparis SET
		kullanici_id   =:kullanici_id,
		siparis_tip    =:siparis_tip,
		siparis_banka  =:siparis_banka,
		siparis_toplam =:siparis_toplam
		");

	$insert=$siparis_kaydet->execute(array(
		'kullanici_id'    => $_POST['kullanici_id'],
		'siparis_tip'     => $siparis_tip,
		'siparis_banka'   => $_POST['siparis_banka'],
		'siparis_toplam'  => $_POST['siparis_toplam']
		
	));

	if ($insert) {

		$siparis_id=$db->lastInsertId(); 	//Son id bilgisiini tutuma
		$urunler=$_POST['urun_id'];
		/*
		echo "<pre>";
		print_r($urunler);
		echo "</pre>";
	    */

	    //While döngüsü ile siteye giriş yapmış kullanıcının, kullanici id bilgisi ile 
		//ürün id ve ürün adet bilgisi çekilir.
		//sepet tablosundan da ürün_fiyat bilgisi çekilir.

		$kullanici_id=$_POST['kullanici_id'];
		$sepetsor=$db->prepare("SELECT * FROM sepet WHERE kullanici_id=:id");
		$sepetsor->execute(array(
			'id' => $kullanici_id
		));

		while ($sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC)) {

			$urun_id=$sepetcek['urun_id'];
			$urun_adet=$sepetcek['urun_adet'];

			$urunsor=$db->prepare("SELECT * FROM urun WHERE urun_id=:id");
			$urunsor->execute(array(
				'id' => $urun_id
			));
			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

			$urun_fiyat=$uruncek['urun_fiyat'];

			$siparis_detay_kaydet=$db->prepare("INSERT INTO siparis_detay SET
				siparis_id   =:siparis_id,
				urun_id    =:urun_id,
				urun_adet    =:urun_adet,
				urun_fiyat  =:urun_fiyat

				");

			$insert=$siparis_detay_kaydet->execute(array(
				'siparis_id'    =>$siparis_id,
				'urun_id'     => $urun_id,
				'urun_adet'     => $urun_adet,
				'urun_fiyat'   => $urun_fiyat
			));	
		}

		if ($insert) {
			//Sipariş detay(ödeme yapılmışsa) kayıt başaralı ise sepetin boşatılması lazım
			$sepet_sil=$db->prepare("DELETE FROM sepet WHERE kullanici_id=:kullanici_id");
			$kontrol=$sepet_sil->execute(array(
				'kullanici_id' => $kullanici_id

			));
			header("Location:../../siparislerim.php?durum=ok");
		}
		
		// header("Location:../../odeme.php?durum=ok");

	}else{

		// header("Location:../../odeme.php?durum=no");
	}
}


		//While yerine foreach döngüsü aşağıdaki gibi kullanılabilir.
	    //Foreacle aşağıdaki gibi urun tablosundan urun fiyat bilgisi çekilir 
	    //ve sepet tablosundan urun adet bilgisi çekilerek 
	    //siparis_detay veritabanına kayıt işlemi yapılıur.  
	    /*

		foreach ($urunler as $urun) {

			$urunsor=$db->prepare("SELECT * FROM urun WHERE urun_id=:id");
			$urunsor->execute(array(
				'id' => $urun
			));
			$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

			$urun_fiyat=$uruncek['urun_fiyat'];

			$sepetsor=$db->prepare("SELECT * FROM sepet WHERE urun_id=:urun_id");
			$sepetsor->execute(array(
				'urun_id' => $urun
			));
			$sepetcek=$sepetsor->fetch(PDO::FETCH_ASSOC);

			$urun_adet=$sepetcek['urun_adet'];


			$kaydet=$db->prepare("INSERT INTO siparis_detay SET
				siparis_id   =:siparis_id,
				urun_id    =:urun_id,
				urun_adet    =:urun_adet,
				urun_fiyat  =:urun_fiyat

				");

			$insert=$kaydet->execute(array(
				'siparis_id'    =>$siparis_id,
				'urun_id'     => $urun,
				'urun_adet'     => $urun_adet,
				'urun_fiyat'   => $urun_fiyat
			));

		}
		*/
		if(isset($_POST['urunfotosil'])) {

			$urun_id=$_POST['urun_id'];


			echo $checklist = $_POST['urunfotosec'];


			foreach($checklist as $list) {

				$urunfoto_sil=$db->prepare("DELETE FROM urunfoto WHERE urunfoto_id=:urunfoto_id");
				$kontrol=$urunfoto_sil->execute(array(
					'urunfoto_id' => $list
				));
			}

			if ($kontrol) {

				Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=ok");

			} else {

				Header("Location:../production/urun-galeri.php?urun_id=$urun_id&durum=no");
			}


		} 


		







		?>
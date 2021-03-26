<?php 

ob_start();
session_start();

include 'baglan.php';
include '../production/fonksiyon.php';


if (isset($_POST['müsterikaydet'])) {

	//$kullanici_ad=htmlspecialchars($_POST['kullanici_ad']);
	//$kullanici_soyad=htmlspecialchars($_POST['kullanici_soyad']);  
	$kullanici_mail=htmlspecialchars(trim($_POST['kullanici_mail'])); 

	$kullanici_passwordone=htmlspecialchars(trim($_POST['kullanici_passwordone'])); 
	$kullanici_passwordtwo=htmlspecialchars(trim($_POST['kullanici_passwordtwo'])); 


	if ($kullanici_passwordone==$kullanici_passwordtwo) 
	{
		if (strlen($kullanici_passwordone)>=6) 		                                //Strlen şifre kısmına harf girildiğinde
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
					kullanici_ad            =:kullanici_ad,
					kullanici_soyad         =:kullanici_soyad,
					kullanici_password      =:kullanici_password,
					kullanici_mail          =:kullanici_mail,
					kullanicisirket_ad      =:kullanicisirket_ad,
					kullanici_gsm           =:kullanici_gsm,
					kullanici_ulke          =:kullanici_ulke,
					kullanici_ilce          =:kullanici_ilce,
					kullanici_il            =:kullanici_il,
					kullanici_adres         =:kullanici_adres,
					kullanici_postakodu     =:kullanici_postakodu,
					kullanici_yetki         =:kullanici_yetki
					");
				$insert=$kullanicikaydet->execute(array(
					'kullanici_ad'        =>$_POST['kullanici_ad'],
					'kullanici_soyad'     =>$_POST['kullanici_soyad'],
					'kullanici_password'  =>$_POST['kullanici_passwordone'],
					'kullanici_mail'      =>$_POST['kullanici_mail'],
					'kullanicisirket_ad'  =>$_POST['kullanicisirket_ad'],
					'kullanici_gsm'       =>$_POST['kullanici_gsm'],
					'kullanici_ulke'      =>$_POST['kullanici_ulke'],
					'kullanici_ilce'      =>$_POST['kullanici_ilce'],
					'kullanici_il'        =>$_POST['kullanici_il'],
					'kullanici_adres'     =>$_POST['kullanici_adres'],
					'kullanici_postakodu' =>$_POST['kullanici_postakodu'],
					'kullanici_yetki'     =>$kullanici_yetki
				));

				if ($insert) {

					header("Location:../../register?durum=loginbasarili");

				} else {

					header("Location:../../register?durum=basarisiz");
				}

			} else {

				header("Location:../../register?durum=mukerrerkayit");
			}

		} else {

			header("Location:../../register?durum=eksiksifre");
		}

	} else {

		header("Location:../../register?durum=farklisifre");
	}
}


if (isset($_POST['müsterigiriss'])) {

	$kullanici_mail=htmlspecialchars($_POST['kullanici_mail']);
	$kullanici_password=htmlspecialchars($_POST['kullanici_password']);
	

	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_mail=:mail AND kullanici_password=:password AND kullanici_yetki=:yetki AND kullanici_durum=:durum");
	$kullanicisor->execute(array(
		'mail'     => $kullanici_mail,
		'password' => $kullanici_password,
		'yetki'    => 1,
		'durum'	   => 1 //Kullanıcı aktif ise 
	));

	$say=$kullanicisor->rowCount();

	if ($say==1) {

		$_SESSION['userkullanici_mail']=$kullanici_mail;

		header("Location:../../index.php?durum=basariligiris");
		

	} else {

		header("Location:../../login?durum=basarisizgiris");
		
	}
	
}

if (isset($_POST['musteriibilgiguncelle'])) {


	$guncelle=$db->prepare("UPDATE kullanici SET

		kullanici_ad        = :kullanici_ad,
		kullanici_soyad     = :kullanici_soyad,
		kullanici_tc        = :kullanici_tc,
		kullanici_gsm       = :kullanici_gsm,
		kullanici_il        = :kullanici_il,
		kullanici_ilce      = :kullanici_ilce,
		kullanici_adres     = :kullanici_adres,
		kullanicisirket_ad  = :kullanicisirket_ad,
		kullanici_postakodu = :kullanici_postakodu
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$guncelle->execute(array(

		'kullanici_ad'        =>htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad'     =>htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_tc'        =>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_gsm'       =>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_il'        =>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'      =>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'     =>htmlspecialchars($_POST['kullanici_adres']),
		'kullanicisirket_ad'  =>htmlspecialchars($_POST['kullanicisirket_ad']),
		'kullanici_postakodu' =>htmlspecialchars($_POST['kullanici_postakodu'])
	));

	if ($update) {

		Header("Location:../../hesabim.php?durum=ok");

	} else {

		Header("Location:../../hesabim.php?durum=hata");

	}
	
}

if (isset($_POST['musteriiadresbilgiguncelle'])) {


	$guncelle=$db->prepare("UPDATE kullanici SET

		kullanici_tip        = :kullanici_tip,
		kullanici_tc         = :kullanici_tc,
		kullanici_il         = :kullanici_il,
		kullanici_ilce       = :kullanici_ilce,
		kullanici_adres      = :kullanici_adres,
		kullanici_postakodu  = :kullanici_postakodu,
		kullanici_unvan      = :kullanici_unvan,
		kullanicisirket_ad   = :kullanicisirket_ad,
		kullanici_vdaire     = :kullanici_vdaire,
		kullanici_vno        = :kullanici_vno
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$guncelle->execute(array(

		'kullanici_tip'        =>htmlspecialchars($_POST['kullanici_tip']),
		'kullanici_tc'         =>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_il'         =>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'       =>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'      =>htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_postakodu'  =>htmlspecialchars($_POST['kullanici_postakodu']),
		'kullanici_unvan'      =>htmlspecialchars($_POST['kullanici_unvan']),
		'kullanicisirket_ad'   =>htmlspecialchars($_POST['kullanicisirket_ad']),
		'kullanici_vdaire'     =>htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno'        =>htmlspecialchars($_POST['kullanici_vno'])
	));

	if ($update) {

		Header("Location:../../adres-bilgilerim.php?durum=ok");

	} else {

		Header("Location:../../adres-bilgilerim.php?durum=hata");

	}
	
}

if (isset($_POST['musterisifreguncelle'])) {

	$kullanici_eskipassword=htmlspecialchars($_POST['kullanici_eskipassword']);
	$kullanici_passwordone =htmlspecialchars($_POST['kullanici_passwordone']);
	$kullanici_passwordtwo =htmlspecialchars($_POST['kullanici_passwordtwo']);

	// $kullanici_password=md5($kullanici_eskipassword);
	$kullanici_password=$kullanici_eskipassword;

	$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_password=:password");
	$kullanicisor->execute(array(
		'password' => $kullanici_password
	));

	$say=$kullanicisor->rowCount();

	if ($say==0) {

		Header("Location:../../sifre-guncelle?durum=eskisifrehata");
		exit;
		
	}

	if ($kullanici_passwordone==$kullanici_passwordtwo) {

		if (strlen($kullanici_passwordone)>=6) {

			// $sifre=md5($kullanici_passwordone);
			$sifre=$kullanici_passwordone;

			$kullaniciguncelle=$db->prepare("UPDATE kullanici SET

				kullanici_password =:kullanici_password

				WHERE kullanici_id={$_SESSION['userkullanici_id']}");

			$update=$kullaniciguncelle->execute(array(

				'kullanici_password'=>$sifre

			));

			if ($update) {

				Header("Location:../../sifre-guncelle.php?durum=ok");

			} else {

				Header("Location:../../sifre-guncelle.php?durum=hata");
			}

		} else {

			Header("Location:../../sifre-guncelle?durum=eksiksifre");
			exit;
		}

	} else {

		Header("Location:../../sifre-guncelle?durum=sifreleruyusmuyor");
		exit;

	}

}

if (isset($_POST['magazabasvuruyap'])) {


	$guncelle=$db->prepare("UPDATE kullanici SET

		kullanici_tc        = :kullanici_tc,
		kullanici_ad        = :kullanici_ad,
		kullanici_soyad     = :kullanici_soyad,
		kullanici_gsm       = :kullanici_gsm,
		kullanici_banka     = :kullanici_banka,
		kullanici_iban      = :kullanici_iban,
		kullanici_tip       = :kullanici_tip,
		kullanici_unvan     = :kullanici_unvan,
		kullanicisirket_ad  = :kullanicisirket_ad,
		kullanici_vdaire    = :kullanici_vdaire,
		kullanici_vno       = :kullanici_vno,
		kullanici_il        = :kullanici_il,
		kullanici_ilce      = :kullanici_ilce,
		kullanici_adres     = :kullanici_adres,
		kullanici_postakodu = :kullanici_postakodu,
		kullanici_magaza    = :kullanici_magaza
		WHERE kullanici_id={$_SESSION['userkullanici_id']}");

	$update=$guncelle->execute(array(

		'kullanici_tc'        =>htmlspecialchars($_POST['kullanici_tc']),
		'kullanici_ad'        =>htmlspecialchars($_POST['kullanici_ad']),
		'kullanici_soyad'     =>htmlspecialchars($_POST['kullanici_soyad']),
		'kullanici_gsm'       =>htmlspecialchars($_POST['kullanici_gsm']),
		'kullanici_banka'     =>htmlspecialchars($_POST['kullanici_banka']),
		'kullanici_iban'      =>htmlspecialchars($_POST['kullanici_iban']),
		'kullanici_tip'       =>htmlspecialchars($_POST['kullanici_tip']),
		'kullanici_unvan'     =>htmlspecialchars($_POST['kullanici_unvan']),
		'kullanicisirket_ad'  =>htmlspecialchars($_POST['kullanicisirket_ad']),
		'kullanici_vdaire'    =>htmlspecialchars($_POST['kullanici_vdaire']),
		'kullanici_vno'       =>htmlspecialchars($_POST['kullanici_vno']),
		'kullanici_il'        =>htmlspecialchars($_POST['kullanici_il']),
		'kullanici_ilce'      =>htmlspecialchars($_POST['kullanici_ilce']),
		'kullanici_adres'     =>htmlspecialchars($_POST['kullanici_adres']),
		'kullanici_postakodu' =>htmlspecialchars($_POST['kullanici_postakodu']),
		'kullanici_magaza'    =>1
	));

	if ($update) {

		Header("Location:../../magaza-basvuru.php?durum=ok");

	} else {

		Header("Location:../../magaza-basvuru.php?durum=hata");

	}
	
}




?>
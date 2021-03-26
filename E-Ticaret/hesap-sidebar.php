
<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">

	<ul class="settings-title">
		<li class="active"><a href="javascript:void(0)"><b>ÜYELİK İŞLEMLERİ</b></a></li>

		<?php

		if ($kullanicicek['kullanici_magaza']!=2) { ?>

			<li><a href="magaza-basvuru.php">Magaza Basvuru</a></li>

		<?php } ?>

		<li><a href="sifre-guncelle.php">Siparişlerim</a></li>
		<li><a href="hesabim.php">Kişisel Bilgiler</a></li>
		<li><a href="adres-bilgilerim.php">Adres Bilgileri</a></li>
		<li><a href="profil-resim-guncelle.php">Profil Resmi Güncelle</a></li>
		<li><a href="sifre-guncelle.php">Şifre Güncelleme</a></li>
		<li><a href="#Badges" >Rozetleriniz</a></li>
		<li><a href="#E-mail" >Mail Ayarları</a></li>
		<li><a href="#Social" >Sosyal Ağlarınız</a></li>
	
	</ul>

	<hr>

	<?php

	if ($kullanicicek['kullanici_magaza']==2) { ?>
		<ul class="settings-title">
			<li class="active"><a href="javascript:void(0)"><b>MAĞAZA İŞLEMLERİ</b></a></li>
			<li><a href="urun-ekle.php">Ürün Ekleme</a></li>
			<li><a href="urunlerim.php">Ürünlerim</a></li>
			<li><a href="adres-bilgilerim.php">Tamamlanan Siparişler</a></li>
			<li><a href="sifre-guncelle.php">Mesajlar</a></li>
			<li><a href="sifre-guncelle.php">Ayarlar</a></li>

		</ul>
	<?php } ?>

</div>
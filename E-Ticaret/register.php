<?php require_once 'header.php'; ?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">AnaSayfa</a><span> -</span></li>
				<li>Üyelik Kayıt İşlemleri</li>
			</ul>   
		</div>

		<?php 
		error_reporting(0);

		if ($_GET['durum']=="farklisifre") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> Girdiğiniz şifreler eşleşmiyor.
			</div>

		<?php } elseif ($_GET['durum']=="eksiksifre") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> Şifreniz minimum 6 karakter uzunluğunda olmalıdır.
			</div>

		<?php } elseif ($_GET['durum']=="mukerrerkayit") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> Bu kullanıcı daha önce kayıt edilmiş.
			</div>

		<?php } elseif ($_GET['durum']=="basarisiz") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> Kayıt Yapılamadı Sistem Yöneticisine Danışınız.
			</div>

		<?php }elseif ($_GET['durum']=="loginbasarili") {?>

			<div class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong> Üyelik Kaydınız Başarılı bir şekilde Yaptınız. Siteye Mail adresiniz ile giriş yapabilirsiniz...
			</div>

		<?php }
		?>

	</div>               
</div> 
<!-- Inner Page Banner Area End Here --> 


<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
	<div class="container">
		<h2 class="title-section">Üyelik Kayıt İşlemleri</h2>
		<div class="registration-details-area inner-page-padding">

			<form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="first-name">Adınız</label>
							<input type="text" id="first-name" name="kullanici_ad" required="" placeholder="Lütfen Adınızı Giriniz..." class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="last-name">Soyadınız</label>
							<input type="text" id="last-name" name="kullanici_soyad" required="" placeholder="Lütfen Soyadınızı Giriniz..." class="form-control">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="email">E-Mail</label>
							<input type="email" id="email" name="kullanici_mail" required="" placeholder="Mail Adres bilgilerininizi giriniz(!!Kullanıcı Adınız Olacak!!)" class="form-control">
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="first-name">ŞİFRE</label>
							<input type="password" id="first-name" name="kullanici_passwordone" required="" placeholder="Lütfen şifrenizi Giriniz..." class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="last-name">ŞİFRE TEKRAR</label>
							<input type="password" id="last-name" name="kullanici_passwordtwo" required="" placeholder="Lütfen şifrenizi tekrar giriniz..." class="form-control">   
						</div>
					</div>
				</div>


				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="company-name">Şirket Adı</label>
							<input type="text" id="company-name" name="kullanicisirket_ad" required="" placeholder="Lütfen Şirket bilgilerinizi Giriniz..." class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="phone">Telefon</label>
							<input type="phone" id="phone" name="kullanici_gsm" required="" placeholder="Telefon Numaranızı giriniz..." class="form-control">
						</div>
					</div>
				</div> 


				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="phone">Ülke</label>
							<input type="contry" id="contry" name="kullanici_ulke" required="" placeholder="Ülke bilgisi giriniz..." class="form-control">
						</div>
					</div>


					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="phone">İL</label>
							<input type="city" id="city" name="kullanici_il" required="" placeholder="İlinizi giriniz..." class="form-control">
						</div>
					</div> 
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="form-group">
							<label class="control-label">ADRES</label>
							<input type="text" id="address-line1" name="kullanici_adres" placeholder="Adres bilgilerinizi giriniz" class="form-control">
						</div>
					</div>                                      
				</div>

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="phone">İlçe</label>
							<input type="district" id="district" name="kullanici_ilce" required="" placeholder="İlçenizi giriniz..." class="form-control">
						</div>
					</div>

					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="postcode">Posta Kodu</label>
							<input type="text" id="postcode" name="kullanici_postakodu" placeholder="Posta Kodunu Giriniz" class="form-control">
						</div>
					</div>

					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="pLace-order">
							<button class="update-btn disabled" type="submit" name="müsterikaydet">GÖNDER</button>
						</div>
					</div>
				</div> 
			</form> 


		</div> 
	</div>
</div>
<!-- Registration Page Area End Here -->


<?php require_once 'footer.php'; ?>
<?php
require_once 'header.php';

/* islemkontrol(); Fonksiyon.php sayfasındaki yönlendirme */
/* Kullanıcı çıkış yaptığında hesabim.php sayfasına erişim engelli sağlamak için*/
if (!isset($_SESSION['userkullanici_mail'])) {
	header('Location:404.php');
}

?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">AnaSayfa</a><span> -</span></li>
				<li>Şifre Güncelle</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="hata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Şifre Güncelleme işlemi yapılamadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong>  Yeni Şİfreniz Başarıyla Güncellendi...
			</div>

		<?php } elseif ($_GET['durum']=="eskisifrehata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong>  Eski Şifreniz Hatalı...
			</div>

		<?php } elseif ($_GET['durum']=="sifreleruyusmuyor") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong>  Girilen Şifreler Uyuşmuyor...
			</div>

		<?php } elseif ($_GET['durum']=="eksiksifre") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong>  Şifreniz En az 6 Karakterli olmalıdır...
			</div>

		<?php }

		?>
	</div>
</div> 
<!-- Inner Page Banner Area End Here -->



<!-- Settings Page Start Here -->
<div class="settings-page-area bg-secondary section-space-bottom">
	<div class="container">
		<div class="row settings-wrapper">

			<?php require_once 'hesap-sidebar.php' ?>

			<div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">

				<form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">
					

					<div class="settings-details tab-content">
						<div class="tab-pane fade active in" id="Personal">

							<h2 class="title-section">Şifre Güncelleme</h2>
							<div class="personal-info inner-page-padding">
								
								<div class="form-group">
									<label class="col-sm-3 control-label">ESKİ ŞİFRE</label>
									<div class="col-sm-9">
										<input class="form-control" id="first-name" name="kullanici_eskipassword" placeholder="Eski Şifrenizi Giriniz..." required="" type="password">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">YENİ ŞİFRE</label>
									<div class="col-sm-9">
										<input class="form-control" id="first-name" name="kullanici_passwordone" placeholder="Yeni Şifrenizi Giriniz..." required="" type="password">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">YENİ ŞİFRE TEKRAR</label>
									<div class="col-sm-9">
										<input class="form-control" id="first-name" name="kullanici_passwordtwo" placeholder="Yeni Şifrenizi Tekrar Giriniz..." required="" type="password">
									</div>
								</div>
																
								<div class="form-group">
									<div align="right" class="col-sm-12">

										<button class="update-btn" type="submit" name="musterisifreguncelle" id="login-update"> ŞİFRE GÜNCELLE</button>
										 
									</div>
								</div>
							</div> 
						</div> 


					</div> 
				</form> 

				
			</div>  
		</div>  
	</div>  
</div> 
<!-- Settings Page End Here -->

<?php require_once 'footer.php' ?>
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
				<li>Profil Resim Güncelle</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="hata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Profil Resmi Güncelleme işlemi yapılamadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong>  Profil Resminiz Başarıyla Güncellendi...
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

				<form action="nedmin/netting/adminislem.php" enctype="multipart/form-data" method="POST" class="form-horizontal" id="personal-info-form">
					

					<div class="settings-details tab-content">
						<div class="tab-pane fade active in" id="Personal">

							<h2 class="title-section">Profil Resmi Güncelleme</h2>
							<div class="personal-info inner-page-padding">

								<?php 

								if ($_GET['durum']=="formathata") {?>

									<div style="text-align: center;" class="alert alert-danger">
										<strong>BİLGİLENDİRME!</strong> <b>Yükleme işlemi yapılmadı!!! Sadece .JPG ve .PNG formatlarını yükleyiniz...</b> 
									</div>

								<?php } elseif ($_GET['durum']=="dosyabuyuk") {?>

									<div style="text-align: center;" class="alert alert-danger">
										<strong>BİLGİLENDİRME!</strong> <b>Yükleme işlemi yapılmadı!!! Dosya Boyutunuz çok yüksek...</b> 
									</div>

								<?php } ?>
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Mevcut Resim</label>
									<div class="col-sm-9">
										<img  src="<?php echo $kullanicicek['kullanici_magazafoto']; ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Profil Resminizi Seçiniz</label>
									<div class="col-sm-9">
										<input class="form-control" id="first-name" required="" name="kullanici_magazafoto" placeholder="Resim Yükleyiniz..." required="" type="file">
									</div>
								</div>

								<input type="hidden" name="eski_yol" value="<?php echo $kullanicicek['kullanici_magazafoto'] ?>">
								

								<div class="form-group">
									<div align="right" class="col-sm-12">

										<button class="update-btn" type="submit" name="kullaniciprofilguncelle" id="login-update">GÜNCELLE</button>

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
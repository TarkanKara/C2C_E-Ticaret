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
				<li>Hesap Bilgilerimi Düzenle</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="hata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Güncelleme işlemi yapılamadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong> Bilgileriniz Başarıyla Güncellendi...
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

							<h2 class="title-section">Kişisel Bilgiler</h2>
							<div class="personal-info inner-page-padding">
								
								<div class="form-group">
									<label class="col-sm-3 control-label">Mailiniz</label>
									<div class="col-sm-9">
										<input class="form-control" disabled="" value="<?php echo $kullanicicek['kullanici_mail']?>" type="email">
									</div>
								</div>
							
								<div class="form-group">
									<label class="col-sm-3 control-label">Adınız</label>
									<div class="col-sm-9">
										<input class="form-control" id="first-name" placeholder="Adınızı Giriniz..." required="" name="kullanici_ad" value="<?php echo $kullanicicek['kullanici_ad']?>"  type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Soyadınız</label>
									<div class="col-sm-9">
										<input class="form-control" id="last-name" placeholder="Soyadınızı giriniz..." required="" name="kullanici_soyad" value="<?php echo $kullanicicek['kullanici_soyad']?>"  type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">T.C</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_tc" placeholder="T.C Kimlik Numaranızı Giriniz..." required="" value="<?php echo $kullanicicek['kullanici_tc']?>"  type="text">
									</div>
								</div>


								<div class="form-group">
									<label class="col-sm-3 control-label">Telefon GSM</label>
									<div class="col-sm-9">
										<input class="form-control" id="company-name" required="" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm']?>"  type="number">
									</div>
								</div>

								<!--Kullanıcı İd bilgisi tutma-->
								<!-- Bu şekilde güvenlik açığı oluşmakta. header sayfasında SESSİON ile kullanıcı id bilgisi tutularak bunu önüne geçilebilir. -->

								<!--
								<input type="hidden" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id']?>">
							     -->

								<div class="form-group">
									<div align="right" class="col-sm-12">

										<button class="update-btn" type="submit" name="musteriibilgiguncelle" id="login-update">GÜNCELLE</button>
										 
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
<?php require_once 'header.php'; ?>

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">AnaSayfa</a><span> -</span></li>
				<li>Giriş Yapınız</li>
			</ul>   
		</div>

		
		<?php 
		error_reporting(0);

		if ($_GET['durum']=="basariligiris") {?>

			<div class="alert alert-success">
				<strong>Bilgilendirme!</strong> Başarılı bir şekilde giriş yapıldı.
			</div>

		<?php } elseif ($_GET['durum']=="basarisizgiris") {?>

			<div class="alert alert-danger">
				<strong>Hata!</strong> Giriş bilgileri hatalıdır..
			</div>

		<?php } elseif ($_GET['durum']=="exit") {?>

			<div class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong> Başarılı bir şekilde çıkış yapıldı...
			</div>

		<?php } 
		?>
	    

	</div>               
</div> 
<!-- Inner Page Banner Area End Here --> 


<!-- Registration Page Area Start Here -->
<div class="registration-page-area bg-secondary section-space-bottom">
	<div class="container">
		<h2 class="title-section">GİRİŞ</h2>
		<div class="registration-details-area inner-page-padding">

			<form action="nedmin/netting/kullanici.php" method="POST" id="personal-info-form">

				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="email">E-Mail</label>
							<input type="email" id="email" name="kullanici_mail" required="" placeholder="Mail Adres bilgilerininizi giriniz(!!Kullanıcı Adınız Olacak!!)" class="form-control">
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="form-group">
							<label class="control-label" for="first-name">ŞİFRE</label>
							<input type="password" id="first-name" name="kullanici_password" required="" placeholder="Lütfen şifrenizi Giriniz..." class="form-control">
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="pLace-order">
							<button class="update-btn disabled" type="submit" name="müsterigiriss">GÖNDER</button>
						</div>
					</div>
				</div>
			</div> 
		</form> 


	</div> 
</div>
</div>
<!-- Registration Page Area End Here -->


<?php require_once 'footer.php'; ?>
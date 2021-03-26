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
				<li>Adres Bilgilerimi Düzenle</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="hata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> ADRESS Güncelleme işlemi yapılamadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong> ADRESS Bilgileriniz Başarıyla Güncellendi...
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

							<h2 class="title-section">Adres Bilgileri</h2>
							<div class="personal-info inner-page-padding">

								<div class="form-group">
									<label class="col-sm-3 control-label">BİREYSEL/KURUMSAL</label>
									<div class="col-sm-9">
										<div class="custom-select">

											<select name="kullanici_tip" id="kullanici_tip" class='select2'>
												<option 

												<?php
												if ($kullanicicek['kullanici_tip']=="PERSONAL") {
												 	echo "selected";
												 } 
												?>
												value="PERSONAL">BİREYSEL </option>

												<option

												<?php
												if ($kullanicicek['kullanici_tip']=="PRIVATE_COMPANY") {
												 	echo "selected";
												 } 
												?> 
												value="PRIVATE_COMPANY">KURUMSAL </option>
											</select>

										</div>
									</div>
								</div>

								<div id="BIREYSEL">
								<div class="form-group">
									<label class="col-sm-3 control-label">T.C</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc']?>"  type="text">
									</div>
								</div>
								</div> 

								<div id="KURUMSAL">
								<div class="form-group">
									<label class="col-sm-3 control-label">Şirket Adı</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_unvan" required="" value="<?php echo $kullanicicek['kullanici_unvan']?>" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Firma Ünvan</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanicisirket_ad" required="" value="<?php echo $kullanicicek['kullanicisirket_ad']?>" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Firma Vergi Dairesi</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_vdaire" required="" value="<?php echo $kullanicicek['kullanici_vdaire']?>" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Firma Vergi No</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_vno" required="" value="<?php echo $kullanicicek['kullanici_vno']?>" type="text">
									</div>
								</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">İl</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il']?>"  type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">İlçe</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce']?>" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Adress</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres']?>" type="text">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">Zip / Posta Kodu</label>
									<div class="col-sm-9">
										<input class="form-control" name="kullanici_postakodu" value="<?php echo $kullanicicek['kullanici_postakodu']?>" type="text">
									</div>
								</div>
								
								<div class="form-group">
									<div align="right" class="col-sm-12">

										<button class="update-btn" type="submit" name="musteriiadresbilgiguncelle" id="login-update">GÜNCELLE</button>
										 
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

<script type="text/javascript">

	$(document).ready(function(){

		$("#kullanici_tip").change(function(){

			var tip = $("#kullanici_tip").val();

			if (tip=="PERSONAL") {

				$('#KURUMSAL').hide();
				$('#BIREYSEL').show();

			} else if(tip=="PRIVATE_COMPANY"){

				$('#BIREYSEL').hide();
				$('#KURUMSAL').show();

			}

		}).change();

	});


</script>
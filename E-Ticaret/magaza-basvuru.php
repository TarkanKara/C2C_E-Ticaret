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
				<li>Magaza Basvuru</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="hata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Mağaza Başvuru İşlemleri yapılamadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok" && $kullanicicek['kullanici_magaza']==1 ) {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>!!!</strong>  Başvurunuz Alınmıştır.
			</div>

		<?php } elseif ($_GET['durum']=="ok" && $kullanicicek['kullanici_magaza']==2 ) {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>!!!</strong> MAĞAZA BAŞVURUNUZ ONAYLANMIŞTIR <strong>!!!</strong>
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

				


				<div class="settings-details tab-content">
					<div class="tab-pane fade active in" id="Personal">

						<h2 class="title-section">Mağaza Basvuru</h2>
						<div class="personal-info inner-page-padding">

							<?php

							if ($kullanicicek['kullanici_magaza']==0) { ?>

								<div class="alert alert-danger">
									<div style="text-align: center;"><strong >UYARI !!!</strong></div>  
									<p>Başvuru işleminizi tamamlamak için tüm bilgileri eksiksiz ve doğru girildiğinden emin olunuz. Eksik yada hatalı bilgi olduğunda başvurunuz değerlendirilmeyecektir...
									</p>
								</div>

								<form action="nedmin/netting/kullanici.php" method="POST" class="form-horizontal" id="personal-info-form">

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
										<label class="col-sm-3 control-label">Telefon GSM</label>
										<div class="col-sm-9">
											<input class="form-control" id="company-name" required="" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm']?>"  type="number">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label">Banka Adı</label>
										<div class="col-sm-9">
											<input class="form-control" id="company-name" required="" name="kullanici_banka" value="<?php echo $kullanicicek['kullanici_banka']?>"  type="text">
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-3 control-label">BANKA IBAN</label>
										<div class="col-sm-9">
											<input class="form-control" id="company-name" required="" name="kullanici_iban" value="<?php echo $kullanicicek['kullanici_iban']?>"  type="text">
										</div>
									</div>


									<div class="form-group">
										<label class="col-sm-3 control-label">BİREYSEL/KURUMSAL</label>
										<div class="col-sm-9">
											<div class="custom-select">
												<select name="kullanici_tip" id="kullanici_tip" class='select2'>
													<option 

													<?php

													if ($kullanicicek['kullanici_tip']=="PERSONAL") {
														echo "selected";
													} ?>

													value="PERSONAL">BİREYSEL </option>

													<option

													<?php

													if ($kullanicicek['kullanici_tip']=="PRIVATE_COMPANY") {
														echo "selected";
													} ?> 

													value="PRIVATE_COMPANY">KURUMSAL </option>
												</select>
											</div>
										</div>
									</div>

									<div id="PERSONAL">
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
										<label class="col-sm-3 control-label">Onay</label>
										<div class="checkbox">
											<div class="col-sm-9">
												<label>
													<input type="checkbox" required="" value="">Kullanım Şartlarını Kabul Ediyorum.
												</label>
											</div>
										</div>
									</div>

									<div class="form-group">
										<div align="right" class="col-sm-12">


											<button class="update-btn" type="submit" name="magazabasvuruyap" id="login-update">BAŞVURU YAP</button>

										</div>
									</div>
								</div> 
							</form> 

						<?php } elseif ($kullanicicek['kullanici_magaza']==1) { ?>

							<div class="alert alert-info">
								<div style="text-align: center;"><strong> BİLGİLENDİRME!</strong></div>
								Mağaza Başvurunuz Değerlendirme Aşamasındadır... <br>
								<strong>Başvurular genellikle 24 saat içerisinde değerlendirilip sizlere en kısa süre içerisinde geri dönüş sağlanacaktır.</strong> <br>
								Anlayışınız için TEŞEKKÜRLER...
							</div>

						<?php } elseif ($kullanicicek['kullanici_magaza']==2) { ?>

							<div class="alert alert-success">
								<div style="text-align: center;"><strong> BİLGİLENDİRME!</strong><br>
								Mağaza Başvurunuz Onaylanmıştır... <br>
								<strong>Mağaza İşlemler Menüsünde Ürün Ekleyebilirsiniz..</strong> <br>
								Sol alt taraftaki menüden yardım alabilirsiniz.
								</div>
							</div> 

						<?php } ?>

					</div> 


				</div> 
				

			</div>  
		</div>  
	</div>  
</div><br>
<!-- Settings Page End Here -->

<?php require_once 'footer.php' ?>

<script type="text/javascript">

	$(document).ready(function(){

		$("#kullanici_tip").change(function(){

			var tip = $("#kullanici_tip").val();

			if (tip=="PERSONAL") {

				$('#KURUMSAL').hide();
				$('#PERSONAL').show();

			} else if(tip=="PRIVATE_COMPANY"){

				$('#KURUMSAL').show();
				$('#PERSONAL').hide();

			}

		}).change();

	});


</script>
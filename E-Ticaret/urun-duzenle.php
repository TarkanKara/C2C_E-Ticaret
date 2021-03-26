<?php
require_once 'header.php';

/* islemkontrol(); Fonksiyon.php sayfasındaki yönlendirme */
/* Kullanıcı çıkış yaptığında hesabim.php sayfasına erişim engelli sağlamak için*/
if (!isset($_SESSION['userkullanici_mail'])) {
	header('Location:404.php');
}

$urunsor=$db->prepare("SELECT * FROM urun WHERE kullanici_id=:kullanici_id AND urun_id=:urun_id");
$urunsor->execute(array(

	'kullanici_id' => $_SESSION['userkullanici_id'],
	'urun_id'      => $_GET['urun_id']

));;

$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
	<div class="container">
		<div class="pagination-wrapper">
			<ul>
				<li><a href="index.php">AnaSayfa</a><span> -</span></li>
				<li>ÜRÜN DÜZENLEME İŞLEMLERİ</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['durum']=="no") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Ürün düzenleme işlemi Yapılmadı....
			</div>

		<?php } elseif ($_GET['durum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>BİLGİLENDİRME!</strong> Ürün Düzenleme İşlemleri Başarıyla Yapıldı...
			</div>

		<?php }elseif ($_GET['durum']=="dosyabuyuk") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Dosya Boyutunuz çok yüksek!!! Düzenleme işlemi yapılmadı...
			</div>

		<?php }elseif ($_GET['durum']=="formathata") {?>

			<div style="text-align: center;" class="alert alert-danger">
				<strong>Hata!</strong> Düzenleme işlemi yapılmadı!!! Lütfen Sadece .JPG ve .PNG formatlarını yükleyiniz....
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

							<h2 class="title-section">ÜRÜN DÜZENLEME</h2>
							<div class="personal-info inner-page-padding">

								<div class="form-group">
									<label class="col-sm-3 control-label">MEVCUT FOTOĞRAF</label>
									<div class="col-sm-9">
										<img width="672" height="378" src="<?php echo $uruncek['urunfoto_resimyol']  ?>">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">FOTOĞRAF</label>
									<div class="col-sm-9">
										<input class="form-control" name="urunfoto_resimyol" value="<?php echo $kullanicicek['urunfoto_resimyol']?>"  type="file">
									</div>
								</div>

								<div class="form-group">
									<label class="col-sm-3 control-label">KATEGORİ</label>
									<div class="col-sm-9">
										<div class="custom-select">

											<select name="kategori_id" class='select2'>
												<?php  

												$kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_sira ASC ");

												$kategorisor->execute();

												while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { ?>

													<option <?php if ($kategoricek['kategori_id']==$uruncek['kategori_id']) {
														echo "selected";
													} ?> value="<?php echo $kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?></option>

												<?php } ?>
											</select>

										</div>
									</div>
								</div>

								
								<div class="form-group">
									<label class="col-sm-3 control-label">AD</label>
									<div class="col-sm-9">
										<input class="form-control" name="urun_ad" value="<?php echo $uruncek['urun_ad'] ?>" type="text">
									</div>
								</div>

								<!-- Ck Editör Başlangıç-->

								<div class="form-group">
									<label class="col-sm-3 control-label">AÇIKLAMA</label>
									<div class="col-sm-9">
										<textarea  class="ckeditor" id="editor1" name="urun_detay"><?php echo $uruncek['urun_detay'] ?></textarea>
									</div>
								</div>

								<script type="text/javascript">

									CKEDITOR.replace( 'editor1',

									{

										filebrowserBrowseUrl : 'ckfinder/ckfinder.html',

										filebrowserImageBrowseUrl : 'ckfinder/ckfinder.html?type=Images',

										filebrowserFlashBrowseUrl : 'ckfinder/ckfinder.html?type=Flash',

										filebrowserUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',

										filebrowserImageUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',

										filebrowserFlashUploadUrl : 'ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',

										forcePasteAsPlainText: true

									} 

									);

								</script>

								<!-- Ck Editör Bitiş-->

								<div class="form-group">
									<label class="col-sm-3 control-label">FİYAT</label>
									<div class="col-sm-9">
										<input class="form-control" required="" name="urun_fiyat" value="<?php echo $uruncek['urun_fiyat'] ?>" type="text">
									</div>
								</div>

								<input type="hidden" value="<?php echo $uruncek['urun_id'] ?>" name="urun_id">
								<input type="hidden" value="<?php echo $uruncek['urunfoto_resimyol'] ?>" name="eski_yol">

								
								<div class="form-group">
									<div align="right" class="col-sm-12">

										<button class="update-btn" type="submit" name="magazaurunduzenle" id="login-update">DÜZENLE</button>

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
<?php require_once 'footer.php'; ?>  

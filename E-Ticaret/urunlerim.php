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
				<li>ÜRÜNLERİNİZ</li>
			</ul>
		</div>

		<?php
		error_reporting(0);

		if ($_GET['urunonaybekle']=="ok") {?>

			<div style="text-align: center;" class="alert alert-warning">
				<strong>Bilgilendirme!</strong> Lütfen Ürünün onaylanmasını Bekleyiniz!!!
			</div>

		<?php } elseif ($_GET['urundurum']=="ok") {?>

			<div style="text-align: center;" class="alert alert-success">
				<strong>Başaralı!</strong> Ürün Başarıyla Kaldırıldı !!!
			</div>

		<?php } elseif ($_GET['urundurum']=="no") {?>

			<div style="text-align: center;" class="alert alert-warning">
				<strong>Bşarasız!</strong> Ürün Kaldırma işlemi Yapılmadı!!!
			</div>

		<?php } ?>

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

						<h2 class="title-section">ÜRÜNLERİNİZİN LİSTESİ</h2>
						<div class="personal-info inner-page-padding">



							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col">NO</th>
										<th scope="col">TARİH</th>
										<th scope="col">SAAT</th>
										<th scope="col">AD</th>
										<th scope="col">FİYAT</th>
										<th scope="col">İŞLEM</th>
										<th scope="col">İŞLEM</th>
									</tr>
								</thead>
								<tbody>

									<?php
									$urunsor=$db->prepare("SELECT * FROM urun WHERE kullanici_id=:kullanici_id ORDER BY urun_zaman DESC");
									$urunsor->execute(array(
										'kullanici_id' => $_SESSION['userkullanici_id']
									));

									$say=0;

									while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++ ?>

										<?php $zaman=explode(" ",$uruncek['urun_zaman']);  ?>

									<tr>
										<th scope="row"><?php echo $say ?></th>
										<td><?php echo $zaman[0]; ?></td>
										<td><?php echo $zaman[1]; ?></td>
										<td><?php echo $uruncek['urun_ad'] ?></td>
										<td><?php echo $uruncek['urun_fiyat'] ?></td>

										<td>
											<a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id'] ?>"><button class="btn btn-primary btn-xs">DÜZENLE</button></a>
										</td>

										<td>
											<?php if ($uruncek['urun_durum']==0) { ?>

												<a href="urunlerim.php?urunonaybekle=ok"><button class="btn btn-warning btn-xs">Onay Bekliyor!</button></a>
											
											<?php } else {?>

												<a onclick="return confirm('Ürün Silme işlemini Onaylıyormusunuz?')" href="nedmin/netting/adminislem.php?urunsil=ok&urun_id=<?php echo $uruncek['urun_id'] ?>&urunfoto=<?php echo $uruncek['urunfoto_resimyol'] ?>"><button class="btn btn-danger btn-xs">KALDIR</button></a>
											
											<?php } ?> 
											
										</td>
									</tr>

								<?php } ?>

							</tbody>
						</table>

					</div> 
				</div> 
			</div> 
		</div>  
	</div>  
</div>  
</div> 
<!-- Settings Page End Here -->

<?php require_once 'footer.php' ?>


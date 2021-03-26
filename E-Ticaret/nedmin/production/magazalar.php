<?php include 'header.php'; 

//Belirli veriyi seçme işlemi
$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_magaza=:kullanici_magaza");
$kullanicisor->execute(array(
  'kullanici_magaza' => 2
));


?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mağazalar<small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>Kayıt Tarih</th>
                  <th>Firma Adı</th>
                  <th>Ad</th>
                  <th>Soyad</th>
                  <th>Mail Adresi</th>
                  <th>Telefon</th>
                  <th>İŞLEM</th>
                </tr>
              </thead>

              <tbody>

                <?php 

                while($kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC)) {?>

                  <tr>
                    <td><?php echo $kullanicicek['kullanici_zaman'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_unvan'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_ad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_soyad'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_mail'] ?></td>
                    <td><?php echo $kullanicicek['kullanici_gsm'] ?></td>
                    
                    <td>
                      <center>
                        <a href="magaza-onay-islemleri.php?kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>">
                          <button class="btn btn-primary btn-xs">MAĞAZAYI İNCELE</button>
                        </a>
                      </center>
                    </td>
                  </tr>

                <?php  }

                ?>

              </tbody>
            </table>

            <!-- Div İçerik Bitişi -->

          </div>
        </div>
      </div>
    </div>

  </div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>

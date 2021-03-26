<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$urunsor=$db->prepare("SELECT * FROM urun ORDER BY urun_onecikar DESC");
$urunsor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Ürün Listeleme <small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">İşlem Başarılı...</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>

            <div class="clearfix"></div>

            <div align="right">
              <a href="urun-ekle.php"><button style="width: 10%" class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Ürün Ad</th>
                  <th>Ürün Fiyat</th>
                  <th>Ürün ÖneÇıkar</th>
                  <th>Ürün Durum</th>
                  <th>İşlem Yap</th>
                  <th>İşlem Yap</th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { $say++?>

                  <tr>

                   <td width="40"><?php echo $say ?></td>
                   <td><?php echo $uruncek['urun_ad'] ?></td>
                   <td><?php echo $uruncek['urun_fiyat'] ?></td>

                   <td><center><?php

                   if ($uruncek['urun_onecikar']==0) {?>

                    <a href="../netting/adminislem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urun_one=1&urun_onecikar=ok"><button style="width: 40%" class="btn btn-success btn-xs">EKLE</button></a>

                  <?php }elseif ($uruncek['urun_onecikar']==1) {?>

                    <a href="../netting/adminislem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urun_one=0&urun_onecikar=ok"><button style="width: 40%" class=" btn btn-danger btn-xs">KALDIR</button></a>

                  <?php } ?>

                </center></td>

                <td><center><?php 

                if ($uruncek['urun_durum']==0) {?>

                  <a href="../netting/adminislem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urundurum_one=1&urun_durum=ok"><button style="width:40%" class="btn btn-warning btn-xs">PASİF</button></a>

                <?php } else {?>

                  <a href="../netting/adminislem.php?urun_id=<?php echo $uruncek['urun_id'] ?>&urundurum_one=0&urun_durum=ok"><button style="width: 40%" class="btn btn-success btn-xs">AKTİF</button></a>

                <?php } ?>

              </center>

              <td><center><a href="urun-duzenle.php?urun_id=<?php echo $uruncek['urun_id']; ?>"><button style="width: 40%" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
              <td><center><a onclick="return confirm ('Ürünü Silmek İstiyormusunuz?')" href="../netting/adminislem.php?urun_id=<?php echo $uruncek['urun_id']; ?>&urunsill=ok"><button style="width: 60%" class="btn btn-danger btn-xs">Sil</button></a></center></td>
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

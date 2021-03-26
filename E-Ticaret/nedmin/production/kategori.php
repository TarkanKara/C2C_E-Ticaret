<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$kategorisor=$db->prepare("SELECT * FROM kategori ORDER BY kategori_sira ASC ");
$kategorisor->execute();

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Kategoriler Listeleme <small>,

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
              <a href="kategori-ekle.php"><button style="width: 10%" class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">

            <!-- Div İçerik Başlangıç -->
            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th><center>S.No</center></th>
                  <th><center>Kategori Ad</center></th>
                  <th><center>Kategori Sira</center></th>
                  <th><center>Kategori Durum</center></th>
                  <th><center>Kategori Öneçıkar</center></th>
                  <th><center>İşlem</center></th>
                  <th><center>İşlem</center></th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                  <tr>
                   <td width="40"><?php echo $say ?></td>

                   <td><?php echo $kategoricek['kategori_ad'] ?></td>
                   <td><?php echo $kategoricek['kategori_sira'] ?></td>

                   <td><center>
                    <?php 

                    if ($kategoricek['kategori_durum']==0) {?>

                      <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategoridurum_one=1&kategori_durum=ok"><button style="width:40%" class="btn btn-warning btn-xs">PASİF</button></a>

                    <?php } else {?>

                      <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategoridurum_one=0&kategori_durum=ok"><button style="width: 40%" class="btn btn-success btn-xs">AKTİF</button></a>

                    <?php } ?>

                  </center></td>

                  <td><center>
                    <?php 

                    if ($kategoricek['kategori_onecikar']==0) {?>

                      <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategori_one=1&kategori_onecikar=ok"><button style="width:40%" class="btn btn-warning btn-xs">EVET</button></a>

                    <?php } else {?>

                      <a href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id'] ?>&kategori_one=0&kategori_onecikar=ok"><button style="width: 40%" class="btn btn-success btn-xs">KALDIR</button></a>

                    <?php } ?>

                  </center></td>

                  <td><center><a href="kategori-duzenle.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>"><button style="width: 40%" class="btn btn-primary btn-xs">Düzenle</button></a></center></td>
                  <td><center><a onclick="return confirm ('Silme işlemi yapmak istediğinizden eminmisiniz?')" href="../netting/adminislem.php?kategori_id=<?php echo $kategoricek['kategori_id']; ?>&kategorisil=ok"><button style="width: 60%" class="btn btn-danger btn-xs">Sil</button></a></center></td>
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

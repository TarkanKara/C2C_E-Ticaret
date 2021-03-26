<?php 

include 'header.php'; 

//Belirli veriyi seçme işlemi
$bankasor=$db->prepare("SELECT * FROM banka ORDER BY banka_id ASC");
$bankasor->execute();


?>


<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Banka Listeleme <small>,

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
              <a href="banka-ekle.php"><button style="width: 10%" class="btn btn-success btn-xs"> Yeni Ekle</button></a>

            </div>
          </div>
          <div class="x_content">


            <!-- Div İçerik Başlangıç -->

            <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  <th>S.No</th>
                  <th>Banka</th>
                  <th>Banka ŞubeKodu</th>
                  <th>Banka Hesap</th>
                  <th>Banka İBAN</th>
                  <th>Banka DURUM</th>
                  <th>İşlem Yap</th>
                  <th>İşlem Yap</th>
                </tr>
              </thead>

              <tbody>

                <?php 

                $say=0;

                while($bankacek=$bankasor->fetch(PDO::FETCH_ASSOC)) { $say++?>


                  <tr>
                   <td width="40"><?php echo $say ?></td>

                   <td><?php echo $bankacek['banka_ad'] ?></td>
                   <td><?php echo $bankacek['banka_subekodu'] ?></td>
                   <td><?php echo $bankacek['banka_hesap'] ?></td>
                   <td><?php echo $bankacek['banka_iban'] ?></td>


                   <td><center><?php

                   if ($bankacek['banka_durum']==0) {?>

                    <a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id'] ?>&banka_one=1&banka_durum=ok"><button class="btn btn-danger btn-xs">PASİF</button></a>



                  <?php }elseif ($bankacek['banka_durum']==1) {?>

                    <a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id'] ?>&banka_one=0&banka_durum=ok"><button class=" btn btn-success btn-xs">AKTİF</button></a>



                  <?php } ?>

                </center></td>





                <td>
                  <center>
                    <a href="banka-duzenle.php?banka_id=<?php echo $bankacek['banka_id']; ?>">
                      <button style="width: 40%" class="btn btn-primary btn-xs">Düzenle</button></a>
                  </center>
                </td>

                <td>
                  <center>
                    <a href="../netting/islem.php?banka_id=<?php echo $bankacek['banka_id']; ?>&bankasil=ok">
                      <button style="width: 60%" class="btn btn-danger btn-xs">Sil</button></a>
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

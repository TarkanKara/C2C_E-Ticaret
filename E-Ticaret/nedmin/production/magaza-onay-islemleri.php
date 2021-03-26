<?php include 'header.php'; 

$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:id");
$kullanicisor->execute(array(
  'id' => $_GET['kullanici_id']
));

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

?>

<!-- page content -->
<div class="right_col" role="main">
  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>Mağaza Onay İşlemleri<small>,

              <?php 

              if ($_GET['durum']=="ok") {?>

                <b style="color:green;">Kullanıcı Bilgileri Başarıyla GÜNCELLENDİ!!!</b>

              <?php } elseif ($_GET['durum']=="no") {?>

                <b style="color:red;">İşlem Başarısız...</b>

              <?php }

              ?>


            </small></h2>
            
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <br />

            <!-- / => en kök dizine çık ... ../ bir üst dizine çık -->
            <form action="../netting/adminislem.php" method="POST" id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">

              <?php 

              $zaman=explode(" ",$kullanicicek['kullanici_zaman']);

              ?>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">MAİL :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" disabled="" value="<?php echo $kullanicicek['kullanici_mail'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KAYIT TARİHİ :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="" id="first-name" disabled="" value="<?php echo $zaman[0]; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KAYIT SAATİ :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="time" id="first-name" disabled="" value="<?php echo $zaman[1]; ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ÜYE İŞYERİ TİPİ :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="kullanici_tip" type="text" id="first-name" disabled="" value="<?php echo $kullanicicek['kullanici_tip'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div id="KURUMSAL">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">FİRMA ÜVANI :<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_unvan" value="<?php echo $kullanicicek['kullanici_unvan'] ?>"  class="form-control col-md-7 col-xs-12">
                  </div>
                </div>


                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">VERGİ DAİRESİ :<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_vdaire" value="<?php echo $kullanicicek['kullanici_vdaire'] ?>" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">VERGİ NO :<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_vno" value="<?php echo $kullanicicek['kullanici_vno'] ?>"  class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>

              <div id="PERSONAL">
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">T.C :<span class="required"></span>
                  </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="first-name" name="kullanici_tc" value="<?php echo $kullanicicek['kullanici_tc'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">BANKA :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_banka" value="<?php echo $kullanicicek['kullanici_banka'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İBAN :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_iban" value="<?php echo $kullanicicek['kullanici_iban'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">AD :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_ad" value="<?php echo $kullanicicek['kullanici_ad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">SOYAD :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_soyad" value="<?php echo $kullanicicek['kullanici_soyad'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">TELEFON (GSM) :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_gsm" value="<?php echo $kullanicicek['kullanici_gsm'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İL :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_il" value="<?php echo $kullanicicek['kullanici_il'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">İLÇE :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_ilce" value="<?php echo $kullanicicek['kullanici_ilce'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">ADRESS :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="first-name" name="kullanici_adres" value="<?php echo $kullanicicek['kullanici_adres'] ?>" required="required" class="form-control col-md-7 col-xs-12">
                </div>
              </div>

              <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">KULLANICI DURUM :<span class="required"></span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                 <select id="heard" class="form-control" name="kullanici_durum" required>

                   <!-- Kısa İf Kulllanımı 

                    <?php echo $kullanicicek['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>

                  -->

                  <option value="1" <?php echo $kullanicicek['kullanici_durum'] == '1' ? 'selected=""' : ''; ?>>Aktif</option>

                  <option value="0" <?php if ($kullanicicek['kullanici_durum']==0) { echo 'selected=""'; } ?>>Pasif</option>

                </select>
              </div>
            </div>

            <input type="hidden" name="kullanici_id" value="<?php echo $_GET['kullanici_id'] ?>"> 


            <div class="ln_solid"></div>
            <div class="form-group">
              <div align="right" class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">

                <button type="submit" name="magazaonaykayit" class="btn btn-success">ONAYLA</button>

                <a onclick="return confirm('Mağaza Başvurusunu İptal etmek istiyormusunuz?')" class="btn btn-danger" href="../netting/adminislem.php?magazaonay=red&kullanici_id=<?php echo $kullanicicek['kullanici_id']; ?>">
                Başvuruyu İPTAL ET!! </a>
                
              </div>
            </div>

          </form>



        </div>
      </div>
    </div>
  </div>



  <hr>
  <hr>
  <hr>



</div>
</div>
<!-- /page content -->

<?php include 'footer.php'; ?>

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

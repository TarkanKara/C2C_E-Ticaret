
<div class="fox-sidebar">
    <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">KATEGORİLER</h3>
            <ul class="sidebar-categories-list">

                <?php

                $kategorisor=$db->prepare("SELECT * FROM kategori WHERE kategori_durum=:durum ORDER BY kategori_sira ASC ");
                $kategorisor->execute(array(

                    'durum' => 1
                ));

                while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){

                    $kategori_id=$kategoricek['kategori_id'];

                    ?>

                    <h5><b><li><a href="kategori-<?=seo($kategoricek['kategori_ad'])."-".$kategoricek['kategori_id'] ?>"><?php echo $kategoricek['kategori_ad'] ?><span>(

                        <!--Kagerilere göre ürünlerin sayısı count fonksiyonu ile listeleme -->
                        <?php  

                        $urunsay=$db->prepare("SELECT COUNT('kategori_id') AS say FROM urun WHERE kategori_id=:id");
                        $urunsay->execute(array(
                            'id' => $kategori_id
                        ));
                        $saycek=$urunsay->fetch(PDO::FETCH_ASSOC);

                        echo $saycek['say'];

                        ?>

                    )</span></a></li></b></h5>


                <?php } ?>

                <!-- Tüm Ürünlerin Sayısını  -->
                <?php  

                $urunsay=$db->prepare("SELECT * FROM urun ");
                $urunsay->execute();

                $sayy=0;

                while ($saycek=$urunsay->fetch(PDO::FETCH_ASSOC)) { $sayy++ ?>


                <?php  } ?>

                <h5><b><li><a href="kategoriler.php">Tümünü Listele<span style="color: black;">( <?php echo $sayy ?> )</span></a></li></b></h5>
                
            </ul>
        </div>
    </div>

    <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">Fiyat Aralığı</h3>
            <div id="price-range-wrapper" class="price-range-wrapper">
                <div id="price-range-filter"></div>
                <div class="price-range-select">
                    <div class="price-range" id="price-range-min"></div>
                    <div class="price-range" id="price-range-max"></div>
                </div>
                <button class="sidebar-full-width-btn disabled" type="submit" value="Login"><i class="fa fa-search" aria-hidden="true"></i>FİLTRELE</button>
            </div>
        </div>
    </div>

    <!--
         <div class="sidebar-item">
        <div class="sidebar-item-inner">
            <h3 class="sidebar-item-title">En Çok Satanlar</h3>
            <div class="sidebar-single-item-grid">
                <div class="item-img">
                    <img src="img\product\sidebar1.jpg" alt="product" class="img-responsive">
                </div>
                <div class="item-content">
                    <div class="item-info">
                        <h3><a href="#">Team Component Pro</a></h3>
                        <span>Joomla Component</span>
                        <div class="price">$15</div>
                    </div>
                    <div class="item-profile">
                        <div class="profile-title">
                            <div class="img-wrapper"><img src="img\profile\1.jpg" alt="profile" class="img-responsive img-circle"></div>
                            <span>PsdBosS</span>
                        </div>
                        <div class="profile-rating">
                            <ul>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

-->


</div>

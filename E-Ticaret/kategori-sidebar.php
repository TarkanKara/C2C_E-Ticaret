
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

                while($kategoricek=$kategorisor->fetch(PDO::FETCH_ASSOC)){?>

                    <h5><b><li><a href="#"><?php echo $kategoricek['kategori_ad'] ?></span></a></li></b></h5>

                <?php } ?>

            </ul>
        </div>
    </div>

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
</div>

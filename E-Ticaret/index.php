
<?php require_once 'header.php';?>

<!-- Main Banner 1 Area Start Here -->
<div class="main-banner2-area">
    <div class="container">
        <div class="main-banner2-wrapper">                       
            <h1>HOŞGELDİNİZ!</h1>
            <p>Bir AlışVerişten daha Fazlası...</p>
            <div class="banner-search-area input-group">
                <input class="form-control" placeholder="Anahtar Kelimeleri Arayınız . . ." type="text">
                <span class="input-group-addon">
                    <button type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>  
                </span>
            </div>
        </div>
    </div> 
</div>
<!-- Main Banner 1 Area End Here --> 



<!-- Newest Products Area Start Here -->
<div class="newest-products-area bg-secondary section-space-default"> 

    <div class="container">
        <h2 class="title-default">En Yeni Ürünlerimize Göz Atalım</h2>  
    </div>

    <div class="container-fluid" id="isotope-container">

        <div class="isotope-classes-tab isotop-box-btn-white"> 
            <a href="#" data-filter="*" class="current">Tümünü Listele</a>
            <a href="#" data-filter=".yenitrend">Yeni Trendler</a>
            <a href="#" data-filter=".coksatan">Çok Satanlar</a>
            <a href="#" data-filter=".populer">Popüler</a>
            <a href="#" data-filter=".encokdegerlendir">En Çok Değerlendirilen</a>
        </div>

        <div class="row featuredContainer">

            <?php
            
            $urunsor=$db->prepare("SELECT urun.urun_ad,urun.kategori_id,urun.urun_id,urun.urun_fiyat,urun.urunfoto_resimyol,urun.kullanici_id,urun.urun_durum,urun.urun_onecikar,kategori.kategori_id,kategori.kategori_ad,kullanici.kullanici_id,kullanici.kullanici_ad,kullanici.kullanici_soyad,kullanici.kullanici_magazafoto FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_onecikar=:onecikar AND urun_durum=:durum ORDER BY urun_zaman,urun_onecikar DESC limit 8");
            $urunsor->execute(array(
                'onecikar' => 1,
                'durum'    => 1
            ));

            /* Veritabanın bir diğer Kullanımı

            $urunsor=$db->prepare("SELECT urun.* ,kategori.* ,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_onecikar=:onecikar AND urun_durum=:durum ORDER BY urun_zaman,urun_onecikar DESC limit 6");
            $urunsor->execute(array(
                'onecikar' => 1,
                'durum'    => 1
            ));
            */

            while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>


                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 coksatan yenitrend component">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?=seo($uruncek['urun_ad']."-".$uruncek['urun_id'])?>"><img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <h3><a href="#"><?php echo $uruncek['urun_ad'] ?></a></h3>
                                <span><a href="kategori-<?=seo($uruncek['kategori_ad']."-".$uruncek['kategori_id'])?>"><?php echo $uruncek['kategori_ad'] ?></a></span>
                                <div class="price"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">
                                    <div class="img-wrapper"><img style="width: 48px; height: 48px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><b><?php echo $uruncek['kullanici_ad']." ".$uruncek['kullanici_soyad'] ?></b></span>
                                </div>
                                <div class="profile-rating">
                                    <a href=""><b>Tüm Ürünleri</b></a>
                                <!--
                                <ul>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li>(<span> 05</span> )</li>
                                </ul>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>


             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 yenitrend component">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?=seo($uruncek['urun_ad']."-".$uruncek['urun_id'])?>"><img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <h3><a href="#"><?php echo $uruncek['urun_ad'] ?></a></h3>
                                <span><a href="kategori-<?=seo($uruncek['kategori_ad']."-".$uruncek['kategori_id'])?>"><?php echo $uruncek['kategori_ad'] ?></a></span>
                                <div class="price"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">
                                    <div class="img-wrapper"><img style="width: 48px; height: 48px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><b><?php echo $uruncek['kullanici_ad']." ".$uruncek['kullanici_soyad'] ?></b></span>
                                </div>
                                <div class="profile-rating">
                                    <a href=""><b>Tüm Ürünleri</b></a>
                                <!--
                                <ul>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li>(<span> 05</span> )</li>
                                </ul>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>



             <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 populer component">
                    <div class="single-item-grid">
                        <div class="item-img">
                            <a href="urun-<?=seo($uruncek['urun_ad']."-".$uruncek['urun_id'])?>"><img src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive"></a>
                            <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                        </div>
                        <div class="item-content">
                            <div class="item-info">
                                <h3><a href="#"><?php echo $uruncek['urun_ad'] ?></a></h3>
                                <span><a href="kategori-<?=seo($uruncek['kategori_ad']."-".$uruncek['kategori_id'])?>"><?php echo $uruncek['kategori_ad'] ?></a></span>
                                <div class="price"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
                            </div>
                            <div class="item-profile">
                                <div class="profile-title">
                                    <div class="img-wrapper"><img style="width: 48px; height: 48px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="profile" class="img-responsive img-circle"></div>
                                    <span><b><?php echo $uruncek['kullanici_ad']." ".$uruncek['kullanici_soyad'] ?></b></span>
                                </div>
                                <div class="profile-rating">
                                    <a href=""><b>Tüm Ürünleri</b></a>
                                <!--
                                <ul>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li>(<span> 05</span> )</li>
                                </ul>
                            -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

<!--
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wordpress joomla plugins"></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wordpress"></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wordpress joomla psd"></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 component"></div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 wordpress psd"></div> 

        </div>
    -->
<?php } ?>




</div>
<div class="container">
    <ul class="btn-area">
        <li class="hvr-bounce-to-right"><a href="#">Tüm Yeni Ürünler</a></li>
        <li class="hvr-bounce-to-left"><a href="#">Popüler Ürünler</a></li>
    </ul>
</div>
</div>
<!-- Newest Products Area End Here -->





<!-- Trending Products Area Start Here -->
<div class="trending-products-area section-space-default">                
    <div class="container">
        <h2 class="title-default">Bu Hafta Trend Olan Ürünler</h2>  
    </div>
    <div class="container=fluid">
        <div class="fox-carousel dot-control-textPrimary" data-loop="true" data-items="4" data-margin="30" data-autoplay="true" data-autoplay-timeout="10000" data-smart-speed="2000" data-dots="false" data-nav="true" data-nav-speed="false" data-r-x-small="1" data-r-x-small-nav="false" data-r-x-small-dots="true" data-r-x-medium="2" data-r-x-medium-nav="false" data-r-x-medium-dots="true" data-r-small="2" data-r-small-nav="false" data-r-small-dots="true" data-r-medium="3" data-r-medium-nav="false" data-r-medium-dots="true" data-r-large="4" data-r-large-nav="false" data-r-large-dots="true">
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\20.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\21.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\22.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\23.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\20.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="single-item-grid">
                <div class="item-img">
                    <img src="img\product\21.jpg" alt="product" class="img-responsive">
                    <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
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
                                <li>(<span> 05</span> )</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Trending Products Area End Here -->

<!-- Why Choose Area Start Here -->
<div class="why-choose-area bg-primaryText section-space-default">                
    <div class="container">
        <h2 class="title-textPrimary">Neden Foxtar Pazar Yeri Seçiyorsunuz?</h2>  
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-gift" aria-hidden="true"></i></a>
                    <h3><a href="#">Kolayca Al & Sat </a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></a>
                    <h3><a href="#">Kaliteli Ürünler</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="why-choose-box">
                    <a href="#"><i class="fa fa-lock" aria-hidden="true"></i></a>
                    <h3><a href="#">100% Güvenli Ödeme</a></h3>
                    <p>Dorem Ipsum is simply dummy text of the pring and typesetting industry. Lorem Ipsum has been the industry's standaum.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Why Choose Area End Here -->

<!-- Author Banner Area Start Here -->
<div class="author-banner-area">
    <div class="author-banner-wrapper">
        <div id="ri-grid" class="author-banner-bg ri-grid header text-center">
            <ul class="ri-grid-list">
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\4.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>                            
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\2.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\3.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\5.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\6.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\7.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\8.jpg" alt=""></a></li>
                <li><a href="#"><img src="img\banner\9.jpg" alt=""></a></li>
            </ul>
        </div>
        <div class="author-banner-content">
            <ul>
                <li><p><span>20,000 </span> 'den Fazla Satıcı & Alıcı Burada Yer Aldı!</p></li>
                <li><a href="#" class="btn-fill-textPrimary">Katılın</a></li>
            </ul>
        </div>
    </div>               
</div>
<!-- Author Banner Area End Here -->  


<?php require_once 'footer.php'; ?>          


<?php require_once 'header.php'; 

/*
$urunsor=$db->prepare("SELECT urun.*,kullanici.* FROM urun INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_id=:urun_id AND urun_durum=:urun_durum ORDER BY urun_zaman DESC");
$urunsor->execute(array(
    'urun_id'      => $_GET['urun_id'],
    'urun_durum'   => 1
));
*/

$urunsor=$db->prepare("SELECT urun.* ,kategori.* ,kullanici.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id INNER JOIN kullanici ON urun.kullanici_id=kullanici.kullanici_id WHERE urun_id=:urun_id AND urun_durum=:urun_durum ORDER BY urun_zaman DESC");
$urunsor->execute(array(
    'urun_id'      => $_GET['urun_id'],
    'urun_durum'   => 1
));
$say=$kullanicisor->rowCount();
$uruncek=$urunsor->fetch(PDO::FETCH_ASSOC);

?>

<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2><?php echo $uruncek['urun_ad'] ?></h2>
        </div>
    </div>
</div>
<!-- Main Banner 1 Area End Here --> 


<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">ANASAYFA</a><span> -</span></li>
                <li><a href="kategoriler.php">KATEGORİLER</a><span> -</span></li>
                <li style="color: red;"><?php echo $uruncek['urun_ad'] ?></li>
            </ul>
        </div>
    </div>  
</div> 
<!-- Inner Page Banner Area End Here -->  

<!-- Product Details Page Start Here -->
<div class="product-details-page bg-secondary">                
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img style="width: 807px; height: 406px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="<?php echo $uruncek['urun_ad'] ?>" class="img-responsive">
                    </div>                                
                    <h2 class="title-inner-default"><b><?php echo $uruncek['urun_ad'] ?></b></h2>
                    <p class="para-inner-default"><b><?php echo $uruncek['urun_detay'] ?></b></p>
                    <div class="product-tag-line">
                        <ul class="product-tag-item">
                            <li><a href="#">Ön İzleme</a></li>
                            <li><a href="#">Ekran Görüntüsü</a></li>
                            <li><a href="#">Dökümatasyon</a></li>
                        </ul>
                        <ul class="social-default">
                            <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                            <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                        </ul>
                    </div>
                    <div class="product-details-tab-area">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <ul class="product-details-title">
                                    <li class="active"><a href="#description" data-toggle="tab" aria-expanded="false">ÖZELLİKLER</a></li>
                                    <li><a href="#review" data-toggle="tab" aria-expanded="false">YORUMLAR</a></li>
                                    <li><a href="#add-tags" data-toggle="tab" aria-expanded="false">VİDEO</a></li>
                                    <li><a href="#add-tags" data-toggle="tab" aria-expanded="false">DESTEK</a></li>
                                </ul>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="tab-content">
                                    <div class="tab-pane fade active in" id="description">
                                        <ul class="product-details-content">
                                            <li>Printing and typesetting industry</li>
                                            <li>Printing and typesetting industry</li>
                                            <li>Bhen an unknown printe</li>
                                            <li>Bhen an unknown printe</li>
                                            <li>Handard dummy text</li>
                                            <li>Handard dummy text</li>
                                            <li>Desktop publishing software</li>
                                            <li>Bhen an unknown printe</li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane fade" id="review">
                                        <p>Porem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>                      
                                    </div>
                                    <div class="tab-pane fade" id="add-tags">                           
                                        <p>Porem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam.</p>
                                    </div>                                          
                                </div>
                            </div>
                        </div>
                    </div> 
                    <h3 class="title-inner-section">BENZER ÜRÜNLER</h3>                               
                    <div class="row more-product-item-wrapper">
                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                            
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img style="width: 101px; height: 92px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="<?php echo $uruncek['urun_ad'] ?>" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad'] ?></a></h4>
                                    <div class="p-title"><?php echo mb_substr($uruncek['kategori_ad'], 0,20,'UTF-8') ?></div>
                                    <div class="p-price"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 align="center" class="sidebar-item-title">ÜRÜN FİYATI</h3>
                            <ul  class="sidebar-product-price">
                                <li style="font-size:30px; align-items: center;"><?php echo $uruncek['urun_fiyat'] ?> TL</li>
                                <li></li>
                            </ul>
                            <ul class="sidebar-product-btn">
                                <li> <a href="#" class="add-to-cart-btn" id="cart-button"><i class="fa fa-shopping-cart" aria-hidden="true"></i> SEPETE EKLE</a></li>
                                <li><a href="#" class="add-to-favourites-btn" id="favourites-button"><i class="fa fa-heart-o" aria-hidden="true"></i> FAVORİLERE EKLE</a></li>
                                <li><a href="#" class="buy-now-btn" id="buy-button">SATIŞ</a></li>
                            </ul>
                        </div>
                    </div>                                
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <ul class="sidebar-sale-info">
                                <li><i class="fa fa-shopping-cart" aria-hidden="true"></i></li>
                                <li>05</li>
                                <li>SATIŞ</li>                                           
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">ÜRÜN BİLGİSİ</h3>
                            <ul class="sidebar-product-info">
                                <li>Released On:<span> 1 January, 2016</span></li>
                                <li>Last Update:<span> 20 April, 2016</span></li>
                                <li>Download:<span> 613</span></li>
                                <li>Version:<span> 1.1</span></li>
                                <li>Compatibility:<span> Wordpress 4+</span></li>
                                <li>Compatible Browsers:<span> IE9, IE10, IE11, Firefox, Safari, Opera, Chrome</span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">SATICI BİLGİLERİ</h3>
                            <div class="sidebar-author-info">
                                <img style="width: 72px; height: 69px;" src="<?php echo $uruncek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                <div class="sidebar-author-content">
                                    <h3><?php echo $uruncek['kullanici_ad']." ".substr($uruncek['kullanici_soyad'],0,1) ?>.</h3>
                                    <a href="satici-<?=seo($uruncek['kullanici_ad']."-".$uruncek['kullanici_soyad'])."-".$uruncek['kullanici_id']?>" class="view-profile">Profili Görüntüle</a>
                                </div>
                            </div>
                            <ul class="sidebar-badges-item">
                                <li><img src="img\profile\badges1.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges2.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges3.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges4.png" alt="badges" class="img-responsive"></li>
                                <li><img src="img\profile\badges5.png" alt="badges" class="img-responsive"></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
    </div>
</div>
<!-- Product Details Page End Here -->
<?php require_once 'footer.php'; ?>
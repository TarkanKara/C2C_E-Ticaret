<?php require_once 'header.php'; 

$kullanicisor=$db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id AND kullanici_magaza=:magaza");
$kullanicisor->execute(array(
    'kullanici_id' => $_GET['kullanici_id'],
    'magaza'       => 2
));
$say=$kullanicisor->rowCount();

if ($say==0) {                      // Kullanici ile satici (Satici değilse, satıcı profilene gitme)

    header("Location:404.php");

}

$kullanicicek=$kullanicisor->fetch(PDO::FETCH_ASSOC);

?>

<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h1><?php echo $kullanicicek['kullanici_ad']." ".$kullanicicek['kullanici_soyad'] ?></h1>
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
                <li><?php echo $kullanicicek['kullanici_ad']." ".$kullanicicek['kullanici_soyad'] ?></li>
            </ul>
        </div>
    </div>  
</div> 
<!-- Inner Page Banner Area End Here --> 

<!-- about Page Start Here -->
<div class="profile-page-area bg-secondary section-space-bottom">                
    <div class="container">
        <div class="row">
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="single-banner">
                        <img src="img\banner\1.jpg" alt="product" class="img-responsive">
                    </div>                                
                    <div class="author-summery">
                        <div class="single-item">
                            <div class="item-title">ŞEHİR</div>
                            <div class="item-details"><?php echo $kullanicicek['kullanici_il']."/".$kullanicicek['kullanici_ilce']?></div>                                       
                        </div>
                        <div class="single-item">
                            <div class="item-title">Kayit Tarihi:</div>
                            <?php 

                            $zaman=explode(" ",$kullanicicek['kullanici_zaman']);

                            ?>
                            <div class="item-details"><b>Tarih :</b><?php echo  $zaman[0]?> <br><b> Saat : </b><?php echo $zaman[1]?></div>                                       
                        </div>
                        <div class="single-item">
                            <div class="item-title">Puan:</div>
                            <div class="item-details">
                                <ul class="default-rating">
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                    <li>(<span> 05</span> )</li>
                                </ul>
                            </div>                                       
                        </div>
                        <div align="center" class="single-item">
                            <div class="item-title">Toplam Satış:</div>
                            <div class="item-name"><b>100 TL</b></div>                                       
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">
                <div class="fox-sidebar">
                    <div class="sidebar-item">
                        <div class="sidebar-item-inner">
                            <h3 class="sidebar-item-title">SATICI BİLGİLERİ</h3>
                            <div class="sidebar-author-info">
                                <div class="sidebar-author-img">
                                    <img src="<?php echo $kullanicicek['kullanici_magazafoto'] ?>" alt="product" class="img-responsive">
                                </div>
                                <div class="sidebar-author-content">
                                    <h3><?php echo $kullanicicek['kullanici_ad']." ".substr($kullanicicek['kullanici_soyad'],0,1) ?>.</h3>
                                    <a href="#" class="view-profile"><i class="fa fa-circle" aria-hidden="true"></i>Online</a>
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
                    <ul style="text-align: center;"  class="social-default">
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>                                
                    <ul class="sidebar-product-btn">
                        <li><a href="contact.htm" class="buy-now-btn" id="buy-button"><i class="fa fa-envelope-o" aria-hidden="true"></i>Mesaj Gönder</a></li>
                        <li><a href="#" class="add-to-cart-btn" id="cart-button">TAKİP EDİNİZ</a></li>
                    </ul>

                </div>
            </div>                                                
        </div>
        <div  class="row profile-wrapper">
            <div  class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <ul  class="profile-title">
                    <li  class="active"><a href="#kullanicilerim" data-toggle="tab" aria-expanded="false"><i class="fa fa-briefcase" aria-hidden="true"></i>Ürünlerim (

                        <?php  

                        $urunsay=$db->prepare("SELECT COUNT('kategori_id') AS urunsayy FROM urun WHERE kullanici_id=:kullanici_id");
                        $urunsay->execute(array(
                            'kullanici_id' => $kullanicicek['kullanici_id']
                        ));
                        $saycek=$urunsay->fetch(PDO::FETCH_ASSOC);

                        echo $saycek['urunsayy'];

                        ?>

                    )</a></li>
                    <li><a href="#about" data-toggle="tab" aria-expanded="false"><i class="fa fa-user" aria-hidden="true"></i>Hakkımda</a></li>
                    <li><a href="#Message" data-toggle="tab" aria-expanded="false"><i class="fa fa-envelope-o" aria-hidden="true"></i> Mesajlar</a></li>
                    <li><a href="#Reviews" data-toggle="tab" aria-expanded="false"><i class="fa fa-comments-o" aria-hidden="true"></i> Değerlendirmeler ( 20 )</a></li>
                    <li><a href="#Followers" data-toggle="tab" aria-expanded="false"><i class="fa fa-users" aria-hidden="true"></i> Takip Edilenler (100 )</a></li>
                </ul>
            </div>
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12"> 
                <div class="tab-content">
                    <div class="tab-pane fade" id="about">
                        <div class="inner-page-details inner-page-content-box">
                            <h3>Hakkımda:</h3>
                            <p>Bimply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic.</p>
                            <h3>Skills:</h3>
                            <div class="skill-area">
                                <div class="progress">
                                    <div class="lead">Graphic Design</div>
                                    <div data-wow-delay="1.2s" data-wow-duration="1.5s" style="width: 90%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;" data-progress="100%" class="progress-bar wow fadeInLeft   animated"></div>
                                </div>
                                <div class="progress">
                                    <div class="lead">WordPress</div>
                                    <div data-wow-delay="1.2s" data-wow-duration="1.5s" style="width: 80%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;" data-progress="80%" class="progress-bar wow fadeInLeft   animated"></div>
                                </div>
                                <div class="progress">
                                    <div class="lead">Joomla</div>
                                    <div data-wow-delay="1.2s" data-wow-duration="1.5s" style="width: 60%; visibility: visible; animation-duration: 1.5s; animation-delay: 1.2s; animation-name: fadeInLeft;" data-progress="60%" class="progress-bar wow fadeInLeft   animated"></div> 
                                </div>
                            </div>
                        </div> 
                    </div> 

                    <div class="tab-pane fade active in" id="kullanicilerim">
                        <h2 style="text-align: center;" class="title-inner-section">ÜRÜNLERİM</h2>
                        <div class="inner-page-main-body"> 
                           <div class="row more-product-item-wrapper">

                            <?php
                            $urunsor=$db->prepare("SELECT urun.*,kategori.* FROM urun INNER JOIN kategori ON urun.kategori_id=kategori.kategori_id WHERE kullanici_id=:kullanici_id ORDER BY urun_zaman DESC");
                            $urunsor->execute(array(
                                'kullanici_id' => $_GET['kullanici_id']
                            ));

                            while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) { ?>

                                <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                                    <div class="more-product-item">
                                        <div class="more-product-item-img">
                                            <img style="width: 103px; height: 92px;" src="<?php echo $uruncek['urunfoto_resimyol'] ?>" alt="product" class="img-responsive">
                                        </div>
                                        <div class="more-product-item-details">
                                            <h4><a href="urun-<?=seo($uruncek['urun_ad'])."-".$uruncek['urun_id'] ?>"><?php echo $uruncek['urun_ad'] ?></a></h4>
                                            <div class="p-title"><a href="kategori-<?=seo($uruncek['kategori_ad']."-".$uruncek['kategori_id'])?>"><?php echo mb_substr($uruncek['kategori_ad'], 0,20,'UTF-8') ?></a></div>
                                            <div class="p-price"><?php echo $uruncek['urun_fiyat'] ?> TL</div>
                                        </div>
                                    </div>
                                </div> 
                            <?php } ?>
                        </div>


                        <!--<div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <ul class="pagination-align-left">
                                    <li class="active"><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                </ul>
                            </div>  
                        </div> -->
                    </div> 
                </div>



                <div class="tab-pane fade" id="Message">
                    <h3 class="title-inner-section">Mesajlar</h3>
                    <div class="message-wrapper">
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose</h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                </div> 
                            </div> 
                        </div>
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose</h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                </div> 
                            </div> 
                            <div class="single-item-inner-author">
                                <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span> Author</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                </div> 
                            </div>
                        </div>
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose</h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>
                                </div> 
                            </div> 
                        </div>
                        <div class="single-item-message">
                            <ul class="pagination-profile-align-center">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                            </ul> 
                        </div>
                        <div class="single-item-message">
                            <h3>Leave A Comment</h3>
                            <div class="leave-comments-message">
                                <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                <div class="leave-comments-box">
                                    <textarea placeholder="Write your comment here ...*" class="textarea form-control" name="message"></textarea>
                                    <button type="submit" class="update-btn">Yorum Gönder</button>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="tab-pane fade" id="Reviews">
                    <h3 class="title-inner-section">Değerlendirmeler  ( 20 )</h3>
                    <div class="reviews-wrapper">
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\3.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\4.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\5.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\6.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\7.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <div class="single-item-inner">
                                <img src="img\profile\8.jpg" alt="profile" class="img-responsive">
                                <div class="item-content">
                                    <h4>Richi Rose<span>WordPress</span></h4>
                                    <span>2 days ago</span>
                                    <p>Tmply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1n printer took a galley.</p>
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
                        <div class="single-item-message">
                            <ul class="pagination-profile-align-center">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                            </ul>
                        </div> 
                    </div> 
                </div>
                <div class="tab-pane fade" id="Followers">
                    <h3 class="title-inner-section">Takip Edilenler</h3>
                    <div class="inner-page-main-body"> 
                       <div class="row more-product-item-wrapper">
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\5.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Psdart</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>  
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\6.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">RadiusTheme</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\7.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Maxbox</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\8.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Dancty</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\9.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Austonea</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\10.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Branadom</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\11.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Grand Balle</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\12.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Akkas</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6">
                            <div class="more-product-item">
                                <div class="more-product-item-img">
                                    <img src="img\profile\13.jpg" alt="product" class="img-responsive">
                                </div>
                                <div class="more-product-item-details">
                                    <h4><a href="#">Moinar ma</a></h4>
                                    <div class="a-item">516 Items</div>
                                    <div class="a-followers">406 Followers</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <ul class="pagination-align-left">
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                            </ul>
                        </div>  
                    </div>
                </div> 
            </div>                                        
        </div> 
    </div>  
</div>
</div>
</div>
<!-- about Page End Here -->  

<?php require_once 'footer.php'; ?>
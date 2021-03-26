<?php require_once 'header.php';?>

<!-- Main Banner 1 Area Start Here -->
<div class="inner-banner-area">
    <div class="container">
        <div class="inner-banner-wrapper">
            <h2 style="color: white;">Bir AlışVerişten daha Fazlası...</h2>
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

<!-- Inner Page Banner Area Start Here -->
<div class="pagination-area bg-secondary">
    <div class="container">
        <div class="pagination-wrapper">
            <ul>
                <li><a href="index.php">ANASAYFA</a><span> -</span></li>
                <li>KATEGORİLER LİSTESİ</li>
            </ul>
        </div>
    </div>  
</div> 
<!-- Inner Page Banner Area End Here --> 

<!-- Product Page Grid Start Here -->
<div class="product-page-list bg-secondary section-space-bottom">                
    <div class="container">
        <div class="row">                        
            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 col-lg-push-3 col-md-push-4 col-sm-push-4">
                <div class="inner-page-main-body">
                    <div class="page-controls">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-8">
                                <div class="page-controls-sorting">
                                    <div class="dropdown">
                                        <button class="btn sorting-btn dropdown-toggle" type="button" data-toggle="dropdown">FİLTRELE<i class="fa fa-sort" aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu">
                                            <li><a href="#">TARİH</a></li>
                                            <li><a href="#">EN İYİLERİ</a></li>
                                            <li><a href="#">RATİNG</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-4">
                                <div class="layout-switcher">
                                    <ul>
                                        <li><a href="#gried-view" data-toggle="tab" aria-expanded="false"><i class="fa fa-th-large"></i></a></li>    
                                        <li class="active"><a href="#list-view" data-toggle="tab" aria-expanded="true"><i class="fa fa-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!--START Gried Wiew-->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane fade clear products-container" id="gried-view">
                            <div class="product-grid-view padding-narrow">
                                <div class="row"> 

                                    <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                                        <div class="single-item-grid">
                                            <div class="item-img">
                                                <img src="img\product\24.jpg" alt="product" class="img-responsive">
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
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div> 
                        </div>
                        <!--END Gried Wiew-->



                        <?php

                        while ($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)) {?>

                            <!--START LIST Wiew-->
                            <div role="tabpanel" class="tab-pane fade in active clear products-container" id="list-view">
                                <div class="product-list-view">
                                    <div class="single-item-list">
                                        <div class="item-img">
                                            <img src="img\product\36.jpg" alt="product" class="img-responsive">
                                            <div class="trending-sign" data-tips="Trending"><i class="fa fa-bolt" aria-hidden="true"></i></div>
                                        </div>
                                        <div class="item-content">
                                            <div class="item-info">
                                                <div class="item-title">
                                                    <h3><a href="#">Responsive APP</a></h3>
                                                    <span>APP</span>
                                                    <p>Pimply dummy text of the printing and typesetting industry. </p>
                                                </div>
                                                <div class="item-sale-info">
                                                    <div class="price">$15</div>
                                                    <div class="sale-qty">Sales ( 11 )</div>
                                                </div>
                                            </div>
                                            <div class="item-profile">
                                                <div class="profile-title">
                                                    <div class="img-wrapper"><img src="img\profile\1.jpg" alt="profile" class="img-responsive img-circle"></div>
                                                    <span>PsdBosS</span>
                                                </div>
                                                <div class="profile-rating-info">
                                                    <ul>
                                                        <li>
                                                            <ul class="profile-rating">
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li><i class="fa fa-star" aria-hidden="true"></i></li>
                                                                <li>(<span> 05</span> )</li>
                                                            </ul>
                                                        </li>
                                                        <li><i class="fa fa-comment-o" aria-hidden="true"></i>( 10 )</li>
                                                        <li><i class="fa fa-heart-o" aria-hidden="true"></i>( 20 )</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END LIST Wiew-->

                                <?php } ?>


                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <ul class="pagination-align-left">
                                            <li class="active"><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">3</a></li>
                                        </ul>
                                    </div>  
                                </div>
                            </div>
                        </div>                               
                    </div>                                
                </div>
            </div>
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 col-lg-pull-9 col-md-pull-8 col-sm-pull-8">

                <?php require_once 'kategori-sidebar.php' ?>
                
            </div>
        </div>
    </div>
</div>
<!-- Product Page Grid End Here -->

<?php require_once 'footer.php';?>
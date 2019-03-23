<!-- Let Begin -->
<section class="tm-banner">
    <div class="tm-container-outer tm-banner-bg">
        <div class="container">
            <div class="row tm-banner-row tm-banner-row-header">
                <div class="col-xs-12">
                    <div class="tm-banner-header">
                        <h1 class="text-uppercase tm-banner-title">Let's begin</h1>
                        <img src= "<?= base_url()?>assets/user/img/dots-3.png" alt="Dots">
                        <p class="tm-banner-subtitle">We assist you to choose the best.</p>
                        <a href="javascript:void(0)" class="tm-down-arrow-link"><i class="fa fa-2x fa-angle-down tm-down-arrow"></i></a>       
                    </div>    
                </div>  <!-- col-xs-12 -->                      
            </div> <!-- row -->
            <div class="row tm-banner-row" id="tm-section-search">
                <form action="index.html" method="get" class="tm-search-form tm-section-pad-2">
                    <div class="form-row tm-search-form-row">                                
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                            <label for="inputCity">Name Your Destination</label>
                            <input name="destination" type="text" class="form-control" id="inputCity" placeholder="Type your destination...">
                        </div>
                        <div class="form-group tm-form-group tm-form-group-1">                                    
                            <div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                                <label for="btnSubmit">&nbsp;</label>
                                <button type="submit" class="btn btn-primary tm-btn tm-btn-search text-uppercase" id="btnSubmit">Check Destination</button>                             
                            </div>
                        </div>
                    </div> <!-- form-row -->
                    <div class="form-row tm-search-form-row">
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                            <label for="inputCheckIn">Type Of Destination</label>
                            <select name="typeSpot" id="typeSpot" class="form-control tm-select" id="inputRoom">
                                <?php $i = 1; foreach ($type_spot as $key) { ?>
                                    <option value="<?='#'.$i.'a'?>" selected><?= $key['name']?></option>    
                                <?php $i++;} ?>
                            </select>      
                        </div>
                        <div class="form-group tm-form-group tm-form-group-pad tm-form-group-2">
                            <label for="btnSubmit">&nbsp;</label>
                            <a href="#" class="btn btn-primary tm-btn tm-btn-search text-uppercase"  id="btnSubmitType">Check Destination</a>
                        </div>
                    </div>                         
                </form>                             

            </div> <!-- row -->
            <div class="tm-banner-overlay"></div>
        </div>  <!-- .container -->                   
    </div>     <!-- .tm-container-outer -->                 
</section>
<!-- Text Motifasi Berdestinasi -->
<section class="p-5 tm-container-outer tm-bg-gray">            
    <div class="container">
        <div class="row">
            <div class="col-xs-12 mx-auto tm-about-text-wrap text-center">                        
                <h2 class="text-uppercase mb-4"><strong>Ayo Banyuwangi</strong> start traveling</h2>
                <p class="mb-4">Visiting Banyuwangi to enjoy nature tourism, and UMKM with the help of our application, find your favorite tourist destination !</p>
                <a href="javascript:void(0)" class="text-uppercase btn-primary tm-btn btn-continue">Continue Explore</a>                              
            </div>
        </div>
    </div>            
</section>
<!-- Tope Destination -->
<div class="tm-container-outer" id="tm-section-2">
    <?php $i = 0; foreach ($type_spot as $key) { ?>
        <section class="<?php if($i%2 == 0){ echo 'tm-slideshow-section';}else{echo 'clearfix tm-slideshow-section tm-slideshow-section-reverse';} ?>">
            <div class="<?php if($i%2 == 0){ echo 'tm-slideshow';}else{echo 'tm-right tm-slideshow tm-slideshow-highlight';} ?>">
                <?php for ($a=0; $a < 2 ; $a++) { ?>
                    <img src= "<?php if(count($key['listSpot']) > 0){echo base_url().$key['listSpot'][$a]['image'];}else{ echo base_url().'assets/user/img/tm-img-02.jpg';}?>" alt="<?php if(count($key['listSpot']) > 0){echo $key['listSpot'][$a]['name'];}else{ echo 'Default Image';}?>">
                <?php } ?>   
            </div>
            <div class="<?php if($i%2 == 0){ echo 'tm-slideshow-description tm-bg-primary';}else{echo 'tm-slideshow-description tm-slideshow-description-left tm-bg-highlight';} ?>">
                <h2 class=""><?= $key['title']?></h2>
                <p><?= $key['description'] ?></p>
                <a href="#" class="<?php if($i%2 == 0){ echo 'text-uppercase tm-btn tm-btn-white tm-btn-white-primary';}else{echo 'text-uppercase tm-btn tm-btn-white tm-btn-white-highlight';} ?>">Detail</a>
            </div>
        </section>
    <?php $i++; } ?>
</div> 
<!-- List Destination -->
<div class="tm-container-outer" id="tm-section-3">
    <ul class="nav nav-pills tm-tabs-links">
        <?php $i = 1; foreach ($type_spot as $key) { ?>
            <li class="tm-tab-link-li" id="<?= $i.'l'?>">
                <a href="<?= '#'.$i.'a'?>" data-toggle="tab" class="tm-tab-link">
                    <img src= "<?= base_url().$key['image']?>" alt="<?= $key['name']?>" class="img-fluid">
                    <?= $key['name']?>
                </a>
            </li>
        <?php $i++;} ?>
    </ul>
    <div class="tab-content clearfix">
        <!-- Tab 1 -->
        <?php $i = 1; foreach ($type_spot as $key) { ?>
            <div class="tab-pane fade <?php if($i == 1){ echo 'show active';} ?>" id="<?= $i.'a'?>">
                <div class="tm-recommended-place-wrap">
                    <?php foreach ($key['listSpot'] as $keySpot){ ?>
                        <div class="tm-recommended-place">
                            <img src= "<?= base_url().$keySpot['image']?>" alt="<?= $keySpot['name']?>" class="img-fluid tm-recommended-img" style="height: 200px;">
                            <div class="tm-recommended-description-box">
                                <h3 class="tm-recommended-title"><?= $keySpot['name']?></h3>
                                <p class="tm-text-highlight"><?= $keySpot['latitude']?>.' , '.<?= $keySpot['longitude']?> </p>
                                <p class="tm-text-gray"><?= $keySpot['description']?></p>   
                            </div>
                            <a href="#" class="tm-recommended-price-box">
                                <p class="tm-recommended-price">✩<?=$keySpot['reting']?></p>
                                <p class="tm-recommended-price-link">Go Destination</p>
                            </a>                        
                        </div>
                    <?php } ?>
                </div>                        
                <a href="#" class="text-uppercase btn-primary tm-btn mx-auto tm-d-table">Show More Places</a>
            </div>
        <?php $i++;} ?>
        <!-- tab-pane -->
    </div>
</div>
<!-- Maps -->
<div class="tm-container-outer tm-position-relative" id="tm-section-4">
    <div id="google-map"></div>
    <form action="index.html" method="post" class="tm-contact-form">
        <div class="form-group tm-name-container">
            <input type="text" id="contact_name" name="contact_name" class="form-control" placeholder="Name"  required/>
        </div>
        <div class="form-group tm-email-container">
            <input type="email" id="contact_email" name="contact_email" class="form-control" placeholder="Email"  required/>
        </div>
        <div class="form-group">
            <input type="text" id="contact_subject" name="contact_subject" class="form-control" placeholder="Subject"  required/>
        </div>
        <div class="form-group">
            <textarea id="contact_message" name="contact_message" class="form-control" rows="9" placeholder="Message" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary tm-btn-primary tm-btn-send text-uppercase">Send Message Now</button>
    </form>
</div> <!-- .tm-container-outer -->
<style>
.product-grid{
    background-color: #fff;
    font-family: 'Montserrat', sans-serif;
    text-align: center;
    transition: all 0.3s ease 0s;
}
.product-grid:hover{ box-shadow: 0 0 10px rgba(0,0,0,0.2); }
.product-grid .product-image{
    overflow: hidden;
    position: relative;
}
.product-grid .product-image a.image{ display: block; }
.product-grid .product-image img{
    width: 100%;
    height: auto;
}
.product-grid .product-quick-view{
    color: #333;
    background-color: rgba(255, 255, 255, 0.7);
    font-size: 17px;
    line-height: 55px;
    height: 55px;
    width: 55px;
    border-radius: 50%;
    opacity: 0;
    transform: translateX(-50%) translateY(-350%) scale(0);
    position: absolute;
    left: 50%;
    top: 50%;
    z-index: 1;
    transition: all 300ms 0ms cubic-bezier(0.6, -0.28, 0.735, 0.045);
}
.product-grid .product-quick-view:hover{
    color: #fff;
    background-color: #2B3F87;
    box-shadow: 0 0 5px rgba(0,0,0,0.5);
}
.product-grid:hover .product-quick-view{
    opacity: 1;
    transform: translateX(-50%) translateY(-50%) scale(1);
}
.product-grid .product-content{
    text-align: left;
    padding: 15px 10px;
    position: relative;
}
.product-grid .rating{
    color: #E2BC0A;
    font-size: 12px;
    padding: 0;
    margin: 0 0 8px;
    list-style: none;
}
.product-grid .title{
    font-size: 14px;
    font-weight: 500;
    text-transform: capitalize;
    letter-spacing: 0.5px;
    margin: 0 4px 15px 0;
    display: inline-block;
}
.product-grid .title a{
    color: #666;
    transition: all 0.3s ease 0s;
}
.product-grid .title a:hover{ color: #2B3F87; }
.product-grid .price{
    color: #2B3F87;
    font-weight: 600;
    font-size: 15px;
    line-height: 18px;
    padding-left: 7px;
    margin: 0 0 10px;
    border-left: 1px solid #ccc;
    display: inline-block;
}
.product-grid .add-to-cart{
    text-align: center;
    color: #999;
    font-size: 13px;
    text-transform: uppercase;
    width: 109px;
    padding: 5px 8px;
    border: 1px solid #bbb;
    border-radius: 20px;
    display: block;
    transition: all 0.3s ease 0s;
}
.product-grid .add-to-cart:hover{
    color: #fff;
    background-color: #2B3F87;
    border-color: #2B3F87;
}
.product-grid .product-links{
    padding: 0;
    margin: 0;
    list-style: none;
    opacity: 0;
    position: absolute;
    right: 0;
    bottom: 15px;
    transition: all 0.3s ease-out 0.2s;
}
.product-grid:hover .product-links{
    opacity: 1;
    right: 15px;
}
.product-grid .product-links li{
    display: inline-block;
    margin: 0 2px;
}
.product-grid .product-links li a{
    color: #999;
    font-size: 20px;
    font-weight: 500;
    position: relative;
    z-index: 1;
    transition: all 0.3s ease 0s;
}
.product-grid .product-links li a:hover{ color: #2B3F87; }
.product-grid .product-links li a:before,
.product-grid .product-links li a:after{
    content: attr(data-tip);
    color: #fff;
    background-color: #2B3F87;
    font-size: 11px;
    line-height: 18px;
    padding: 3px 8px;
    border-radius: 10px;
    white-space: nowrap;
    display: none;
    transform: translateX(-50%);
    position: absolute;
    left: 50%;
    top: -33px;
    transition: all 0.3s ease 0s;
}
.product-grid .product-links li a:after{
    content: '';
    height: 15px;
    width: 15px;
    padding: 0;
    border-radius: 0;
    transform: translateX(-50%) rotate(45deg);
    top: -22px;
    z-index: -1;
}
.product-grid .product-links li a:hover:before,
.product-grid .product-links li a:hover:after{
    display: block;
}
@media screen and (max-width: 990px){
    .product-grid{ margin: 0 0 30px; }
}
</style>

<?php 
function freelancer_card($freelancer){
    ?>
        <div class="product-grid">
            <div class="product-image">
                <a href="/Freelancer/<?= seoURL($freelancer['adi']) ?>/<?= $freelancer['id'] ?>" class="image">
                <div style="background: url('<?= $freelancer['kapak_fotografi'] ?>'); background-size: cover; height: 200px; border-radius: .25rem .25rem 0 0; background-position: center center;"></div>
                </a>
                <!-- <a class="product-quick-view" href="#"><i class="fas fa-search"></i></a> -->
            </div>
            <div class="product-content">
                <ul class="rating">
                    <li class="fas fa-star"></li>
                    <li class="fas fa-star"></li>
                    <li class="fas fa-star"></li>
                    <li class="fas fa-star"></li>
                    <li class="far fa-star"></li>
                </ul>
                <h3 class="title"><a href="/Freelancer/<?= seoURL($freelancer['adi']) ?>/<?= $freelancer['id'] ?>"><?= $freelancer['adi'] ?></a></h3>
                <div class="price"><?= $freelancer['saatlik_ucret'] ?> ₺</div>
                <a class="add-to-cart" href="#">Hizmet Al</a>
                <ul class="product-links">
                    <li><a href="#" data-tip="Karşılaştır"><i class="fa fa-random"></i></a></li>
                    <li><a href="#" data-tip="Listene Ekle"><i class="far fa-heart"></i></a></li>
                </ul>
            </div>
        </div>
    <?php
}
?>

<?php
require_once('db.php');
$cat_en = $_GET['cat'];

$query = "SELECT * FROM product WHERE cat_en = '".$cat_en."' ORDER BY id DESC";
$result = mysqli_query($conn,$query);
if($result){
    $row = mysqli_fetch_assoc($result);
    $img_cover = $row['img_cover'];
    $cat_fa = $row['cat_fa'];
    $title = $row['title'];
    $main_desc = $row['main_desc'];
    $menu_img = $row['menu_img'];
    $h1 = $row['h1'];
    $h2 = $row['h2'];
    $h3 = $row['h3'];
    $d1 = $row['d1'];
    $d2 = $row['d2'];
    $d3 = $row['d3'];
    $id = $row['id'];
}

?>
<section id="section-header-product-details">

<div class="div-bg-header-product-details" style="background-image: url('<?php echo $img_cover;?>');">

</div>

<div class="container container-content-header">
    <div class="row m-0">

        <div class="col-12 div-col-title-white" style="z-index:2">
            <h1 class="m-0"><?php echo $cat_fa;?></h1>
        </div>

    </div>
</div>

</section>

<section id="section-product-details">

<div class="container-product-details">

    <div class="row">

        <div class="col-lg-6 col-12">
            <div id="row-img-product" class="row">
                <div class="col-12">
                    <img title="Name" data-zoom-image="~<?php echo $menu_img;?>"
                        id="img-product-details" class="img-product-details"
                        src="<?php echo $menu_img;?>" style="visibility: visible;">
                </div>
            </div>
<!--             <div id="row-table-food" class="row">
                <div class="col-12 col-img-table-food">
                    <img src="./img/product/Product Info/Chips Salt-FA.svg">
                </div>
                <div class="col-12 col-table-food-p">
                    <p>
                        ما این اطلاعات را به طور مرتب به روز می کنیم ، با این حال ، برای جدیدترین و دقیق
                        ترین اطلاعات تغذیه ای توصیه می کنیم مشخصات روی بسته ها را بررسی کنید.
                    </p>
                </div>
            </div> -->
            <div class="row">
<!--                 <div class="col-6 text-left">
                    <p id="p-show-image-product" class="p-active">
                        تصویر محصول
                    </p>
                </div> -->
<!--                 <div class="col-6 text-right">
                    <p id="p-show-table-food" >
                        جدول ارزش غذایی
                    </p>
                </div> -->
            </div>
        </div>

        <div class="col-lg-6 col-12 col-content-product-details">
            <div class="div-title-content-details">
                <h2 style="color:#000000"><?php echo $title;?></h2>
            </div>
            <div class="div-share-details">
                <span class="">اشتراک</span>
                <span class="m-auto d-flex">
                    <a class="fb" href="https://chuckles.ir/Home/product/1">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a class="tw" href="https://chuckles.ir/Home/product/1">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="pt" href="https://chuckles.ir/Home/product/1">
                        <i class="fab fa-pinterest"></i>
                    </a>
                    <a class="ln" href="https://chuckles.ir/Home/product/1">
                        <i class="fab fa-linkedin"></i>
                    </a>
                    <a class="gp" href="https://chuckles.ir/Home/product/1">
                        <i class="fab fa-google-plus"></i>
                    </a>
                </span>
            </div>
            
            <div class="div-description-details">
                
                <p>
                    <?php echo $main_desc;?>
                </p>
            </div>
            <div class="div-material-details">
                <h3><?php echo $h1;?></h3>
                <p>
                <?php echo $d1;?>
                </p>
                <h3><?php echo $h2;?></h3>
                <p>
                <?php echo $d2;?>
                </p>
                <h3><?php echo $h3;?></h3>
                <p>
                <?php echo $d3;?>
                </p>
            </div>
        </div>

    </div>

</div>

</section>
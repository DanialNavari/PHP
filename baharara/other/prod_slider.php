<section id="section-related-product">

    <div class="container">

        <div class="row">

            <div class="col-lg-1 d-lg-flex d-none col-arrow-related-product">
                <img id="arrow-right-related-product" src="./img/product/arrow_right.png">
            </div>

            <div class="col-lg-10 col-12">
            <div class="div-title-content-details">
                <h2 style="color:#000000">محصولات این برند</h2>
            </div>
            <hr/>
                <div id="owl-related-product" class="owl-carousel owl-theme owl-rtl owl-loaded owl-drag">

                    <div class="owl-stage-outer">
                        <div class="owl-stage"
                            style="transform: translate3d(184px, 0px, 0px); transition: all 1s ease 0s; width: 1656px;">

                            <?php
                            require_once('db.php');
                            $cat_en = $_GET['cat'];

                            $sql = "SELECT * FROM product WHERE main_cat = $id ORDER BY id DESC" ;
                            $result = mysqli_query($conn, $sql);
                            $num = mysqli_num_rows($result);

                            for ($i=0; $i<$num; $i++){
                                $row = mysqli_fetch_assoc($result);
                                $url = $row['shop_link'];
                                $img = $row['menu_img'];
                                $esm = $row['title'];
                                echo '
                                <div class="owl-item" style="width: 184px;">
                                <div id="chuckles_chips/Salt" class="item item-parent-related-product">
                                    <a href="'.$url.'">
                                        <div class="item-related-product">
                                            <img src="'.$img.'">
                                            <div class="div-title-item-related-product">
                                                <h3>
                                                    '.$esm.'
                                                </h3>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            </div>
                                ';
                            }
                        ?>
                            
                        </div>
                    </div>
                    <div class="owl-nav disabled">
                        <div class="owl-prev"><span aria-label="Previous">‹</span></div>
                        <div class="owl-next"><span aria-label="Next">›</span></div>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>

            </div>

            <div class="col-lg-1 d-lg-flex d-none col-arrow-related-product">
                <img id="arrow-left-related-product" src="./img/product/arrow_left.png">
            </div>

        </div>

    </div>

</section>

</main>
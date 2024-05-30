<?php require_once('server.php'); ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.baharara.com/lib/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.baharara.com/lib/css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
        @font-face {
            font-family: "yekan_bold";
            src: url("fonts/YEKANBAKHFANUM-BOLD.TTF");
        }

        @font-face {
            font-family: "iransans";
            src: url("fonts/IRANSansWeb(FaNum).ttf");
        }

        .box {
            position: relative;
            width: 100%;
            margin: 0 auto;
            overflow: hidden;
            border: 1px solid #d7d7d7;
            border-radius: 0.4rem;
            margin-top: 1rem;
            direction: rtl;
            box-shadow: 0 0 5px #d7d7d7;
            margin-bottom: 0.1rem;
        }

        .upper_part {
            padding-top: 1rem;
        }

        .off {
            position: absolute;
            background: #131313;
            border-radius: 50%;
            padding: 0.8rem;
            height: 3rem;
            margin: 1rem 1rem;
            color: #fff;
            font-family: yekan_bold;
            z-index: 1;
        }

        .image {
            text-align: center;
        }

        .image img {
            height: 20rem;
            width: 95%;
        }

        .name {
            text-align: center;
            font-weight: bold;
            font-family: 'yekan_bold';
        }

        .stars {
            text-align: center;
            padding: 0.2rem;
            display: flex;
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: center;
            align-items: center;
            padding: 0.5rem;
        }

        svg {
            margin: 0 0.1rem;
            color: gold;
            rotate: none;
        }

        .price {
            text-align: center;
            font-weight: bold;
            font-family: 'yekan_bold';
            margin-top: 1rem;
            background: #fafafa;
            color: #000;
            padding: 0.6rem;
            border-top: 1px solid #ededed;
        }

        .price::after {
            content: ' تومان';
        }

        .basket {
            position: absolute;
            border-radius: 50%;
            padding: 0.8rem 0.6rem;
            height: 3rem;
            margin: 1rem 16rem;
            font-family: yekan_bold;
            z-index: 1;
            cursor: pointer;
            box-shadow: 0 0 5px #bdbdbd;
            display: none;
        }

        @media screen and (max-width:375px) {
            .basket {
                margin: 1rem 19rem;
            }
        }

        @media screen and (max-width:320px) {
            .basket {
                display: none;
            }
        }

        @media screen and (min-width:376px) and (max-width:768px) {
            .basket {
                margin: 1rem 32rem;
            }
        }
    </style>
</head>

<body>
    <div class="owl-carousel owl-theme">
        <?php
        $pack_id = analyze($_GET['u']);
        $pack_info = smell_style($pack_id);
        $ccx = count($pack_info['prod']);
        for ($w = 0; $w < $ccx; $w++) {
            $ww = $pack_info['prod'][$w];
            $wwz = $pack_info['fa_prod'][$w];
            $wwx = $pack_info['prod_pic'][$w];
            $fee = sep3($pack_info['fee'][$w]);
            $www = explode('-', $ww);
            $wwww = ucwords(implode(' ', $www));
            echo "
            <div class='box'>
                <div class='upper_part'>
                    <div class='part'>
                        <div class='off'>10%</div>
                        <div class='basket'>
                            <a target='_blank' href='https://perfumeara.com/product/" . $ww . "'>    
                                <svg style='color: #a1a1a1;' xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-cart' viewBox='0 0 16 16'>
                                    <path d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <div class='image'>
                        <a target='_blank' href='https://perfumeara.com/product/" . $ww . "'>
                            <img class='owl-lazy' data-src='" . $wwx . "' src='" . $wwx . "' style='height:100%'/>
                        </a>
                    </div>
                </div>
                <div class='lower_part'>
                    <div class='name'>" . $wwz . "  <br/> " . $wwww . "</div>
                    <div class='stars'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'>
                            <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'>
                            <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'>
                            <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'>
                            <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>
                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-star-fill' viewBox='0 0 16 16'>
                            <path d='M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z' />
                        </svg>
                    </div>
                    <div class='price'>" . $fee . "</div>
                </div>
            </div>

            ";
        }
        ?>
    </div>

    <script src="https://www.baharara.com/lib/js/jquery-3.4.1.min.js"></script>
    <script src="https://www.baharara.com/lib/js/owl.carousel.min.js"></script>

    <script>
        $('.owl-carousel').owlCarousel({
            items: 1,
            lazyLoad: true,
            loop: true,
            margin: 10
        });
    </script>
</body>

</html>
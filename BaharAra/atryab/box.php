<?php require_once('server.php'); ?>

<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="https://www.baharara.com/lib/css/owl.carousel.min.css">
    <link rel="stylesheet" href="https://www.baharara.com/lib/css/owl.theme.default.min.css">
    <style>
        .box {
            position: relative;
            width: 40vw;
            margin: 0 auto;
            overflow: hidden;
            border: 2px solid #000;
            border-radius: 0.4rem;
            margin-top: 1rem;
        }

        .upper_part {
            padding-top: 1rem;
        }

        .off {
            position: absolute;
            background: red;
            border-radius: 50%;
            padding: 0.8rem 0.5rem;
            height: 3rem;
            margin: 1rem 1rem;
            color: #fff;
            font-family: yekan_bold;
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
            letter-spacing: 0.1rem;
        }

        .stars {
            text-align: center;
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
            background: #131313;
            color: #fff;
            padding: 0.6rem;
        }

        .price::after {
            content: ' تومان';
        }

        @media only screen and (max-width:375px) {
            .box {
                width: 95%;
            }
        }

        @media only screen and (min-width:376px) and (max-width:425px) {
            .box {
                width: 85%;
            }
        }
    </style>
</head>

<body>

    <div class="owl-carousel owl-theme">
        <div class="box">
            <?php
            $pack_id = analyze($_GET['u']);
            $pack_info = smell_style($pack_id);
            $ccx = count($pack_info['prod']);

            for ($w = 0; $w < $ccx; $w++) {
                $ww = $pack_info['prod'][$w];
                $wwx = $pack_info['prod_pic'][$w];

                echo '
            <div class="upper_part">
                <div class="off">20%</div>
                <div class="image">
                    <a target="_blank" href="https://perfumeara.com/product/' . $ww . '">
                        <img class="owl-lazy" data-src="' . $wwx . '" src="' . $wwx . '"/>
                    </a>
                </div>
            </div>
            <div class="lower_part">
                <div class="name">Creed Aventus</div>
                <div class="stars">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
                        <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z" />
                    </svg>
                </div>
                <div class="price">1/500/000</div>
            </div>
            ';
            }

            ?>
        </div>
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
<style id="less:less-main:less-v-lez1_aV9U8hezEjMZTmYi0LIR-R1dN1ZorE3-aelEtE">
    /*
size base

Extra small < 576px  ***********  .col-       ***********  Max container width None (auto)
Small ≥ 576px        ***********  .col-sm-    ***********  Max container width 540px
Medium ≥ 768px       ***********  .col-md-    ***********  Max container width 720px
Large ≥ 992px        ***********  .col-lg-    ***********  Max container width 960px
Extra large ≥ 1200px ***********  .col-xl-    ***********  Max container width 1140px

*/
    /* =================================== */
    /*	title section
/* =================================== */
    .div-col-title h2 {
        text-align: center;
        font-family: IS-M;
        color: #2c2c2c;
        font-size: 20px;
    }

    .span-line-title {
        width: 200px;
        height: 2px;
        margin: 15px auto;
        background: linear-gradient(to left, transparent, #2c2c2c, transparent);
    }

    /* =================================== */
    /*	button more
/* =================================== */
    .div-parent-btn-more {
        padding-top: 35px;
        text-align: center;
    }

    .a-btn-more {
        font-family: IS-L;
        font-size: 12px;
        border-radius: 6.25rem;
        border-width: 0.125rem;
        -webkit-box-shadow: 0.125rem 0.1875rem 0.9375rem rgba(0, 0, 0, 0.2);
        box-shadow: 0.125rem 0.1875rem 0.9375rem rgba(0, 0, 0, 0.2);
        padding: 10px 25px;
        position: relative;
        outline: none !important;
        background: #eeeeee;
        color: #2c2c2c;
    }

    .a-btn-more:active {
        -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
        box-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);
    }

    /* =================================== */
    /*	main
/* =================================== */
    /* =================================== */
    /*  section slider
/* =================================== */
    #section-slider {
        overflow: hidden !important;
        direction: ltr !important;
    }

    #parent-slider {
        overflow: hidden;
    }

    .owl-item.active .h2-title-slider {
        -webkit-animation-name: fadeInRight;
        animation-name: fadeInRight;
        -webkit-animation-duration: 2s;
        animation-duration: 2s;
        -webkit-animation-fill-mode: both;
        animation-fill-mode: both;
    }

    @-webkit-keyframes myZoomIn {
        from {
            opacity: 0;
            -webkit-transform: scale3d(0.3, 0.3, 0.3);
            transform: scale3d(0.3, 0.3, 0.3);
        }

        50% {
            opacity: 1;
        }
    }

    @keyframes myZoomIn {
        from {
            opacity: 0;
            -webkit-transform: scale3d(0.3, 0.3, 0.3);
            transform: scale3d(0.3, 0.3, 0.3);
        }

        50% {
            opacity: 1;
        }
    }

    #section-slider .owl-dots {
        position: absolute;
        height: 30px;
        left: 0;
        right: 0;
        z-index: 10;
        margin-top: -30px;
    }

    #section-slider .owl-dots button {
        outline: none;
    }

    #section-slider .owl-theme .owl-dots .owl-dot.active span {
        background: #ffffff !important;
    }

    .mo-item-slide {
        height: 500px;
        min-height: 450px;
        background-position: center;
        background-size: cover;
        overflow: hidden;
        width: 100% !important;
        direction: rtl !important;
    }

    .slide-1 {
        background-image: url('./img/slider/slide1.jpg');
    }

    .slide-2 {
        background-image: url('./img/slider/slide2.jpg');
    }

    .slide-3 {
        background-image: url('./img/slider/slide3.jpg');
    }

    .slide-4 {
        background-image: url('./img/slider/slide4.jpg');
    }

    .slide-5 {
        background-image: url('./img/slider/slide5.jpg');
    }

    .slide-6 {
        background-image: url('./img/slider/slide6.jpg');
    }

    .slide-7 {
        background-image: url('./img/slider/slide9.jpg');
    }

    .slide-9 {
        background-image: url('./img/slider/slide9.jpg');
    }

    .slide-10 {
        background-image: url('./img/slider/slide10.jpg');
    }

    .slide-11 {
        background-image: url('./img/slider/slide11.jpg');
    }

    .slide-12 {
        background-image: url('./img/slider/slide12.jpg');
    }

    .slide-13 {
        background-image: url('./img/slider/slide13.jpg');
    }

    .slide-14 {
        background-image: url('./img/slider/slide14.jpg');
    }

    .slide-15 {
        background-image: url('./img/slider/slide15.jpg');
    }

    .slide-16 {
        background-image: url('./img/slider/slide-shop.jpg');
    }

    .div-floating-slider {
        position: relative;
        display: flex;
        width: 450px;
        height: 450px;
        top: 0;
        bottom: 0;
        /*right: 100px;*/
        margin: auto 100px auto 0;
        /*background: #c82333;*/
        background-position: center;
        background-size: 150% 150%;
        /*background-image: url("../img/slider/bg_floating_slider.png");*/
    }

    .div-inside-floating-slider {
        position: relative;
        display: flex;
        width: 450px;
        height: 450px;
        margin-top: 30px;
    }

    .img-bg-floating-slider {
        position: absolute;
        margin: auto;
        top: 0;
        bottom: 0;
        width: 100%;
        height: 100%;
        transform: scale(1.5);
    }

    .img-item-floating-salt {
        position: absolute;
        width: 200px !important;
        margin: auto;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .img-item-floating-vinegar {
        position: absolute;
        width: 200px !important;
        top: 60px;
        right: -30px;
    }

    .img-item-floating-ketchup {
        position: absolute;
        width: 200px !important;
        top: 20px;
        left: 15px;
    }

    .img-item-floating-chips-1 {
        position: absolute;
        width: 170px !important;
        bottom: 100px;
        left: -10px;
    }

    .img-item-floating-chips-2 {
        position: absolute;
        width: 110px !important;
        bottom: 75px;
        right: 30px;
    }

    .img-item-floating-chips-3 {
        position: absolute;
        width: 80px !important;
        top: 30px;
        right: 180px;
    }

    .img-item-floating-snack1 {
        position: absolute;
        width: 120px !important;
        top: 60px;
        right: -60px;
    }

    .img-item-floating-snack2 {
        position: absolute;
        width: 120px !important;
        top: 60px;
        right: 370px;
    }

    .img-item-floating-snack3 {
        position: absolute;
        width: 120px !important;
        top: 290px;
        right: -60px;
    }

    .img-item-floating-snack4 {
        /*position: absolute;
    width: 120px !important;
    top: 320px;
    right: 370px;*/
        position: absolute;
        width: 120px !important;
        top: 320px;
        right: 330px;
    }

    .img-item-floating-snack5 {
        /*position: absolute;
    width: 300px !important;
    top: 80px;
    right: 30px;*/
        position: absolute;
        width: 400px !important;
        top: 20px;
        right: -2px;
    }

    .shake-top-bottom {
        animation-name: shake-top-bottom;
        animation-duration: 2500ms;
        animation-iteration-count: infinite;
        animation-direction: alternate;
        animation-timing-function: ease-in-out;
    }

    .duration-anim-800 {
        animation-duration: 2400ms;
    }

    .duration-anim-900 {
        animation-duration: 2700ms;
    }

    .duration-anim-1100 {
        animation-duration: 2300ms;
    }

    @keyframes shake-top-bottom {
        0% {
            transform: translate(0px, 0px);
        }

        50% {
            transform: translate(0px, -5px);
        }

        100% {
            transform: translate(0, 0px);
        }
    }

    .div-parent-title-slider {
        position: relative;
        margin: auto 100px auto auto;
        text-align: left;
    }

    .div-parent-title-slider h2 {
        font-family: IS-M;
        line-height: 50px;
        font-size: 30px;
        color: #fff;
        margin-bottom: 20px;
    }

    .div-parent-title-slider a {
        font-family: IS-M;
        font-size: 10px;
        background: #ffb400;
        border-radius: 5px;
        padding: 2px 5px;
        color: #1d1d1d;
        margin-top: 50px;
    }

    @media (max-width: 992px) {
        .div-floating-slider {
            margin: auto;
        }

        .container-item-slider {
            margin: 0;
            width: 100%;
            height: 100% !important;
        }

        .div-parent-title-slider {
            position: relative;
            margin: auto 0 auto auto;
            text-align: left;
        }

        .div-parent-title-slider h2 {
            font-size: 24px;
        }
    }

    @media (max-width: 768px) {

        .img-item-floating-salt,
        .img-item-floating-ketchup,
        .img-item-floating-vinegar {
            width: 190px !important;
        }

        .mo-item-slide {
            height: calc(100vh - 115px);
            background-position: center;
            background-size: cover;
        }

        .div-inside-floating-slider {
            width: 100% !important;
        }

        .div-parent-title-slider {
            display: flex;
        }

        .div-parent-content-slider {
            margin: 0 auto;
            width: auto;
        }

        .div-floating-slider {
            height: 250px;
        }

        .div-inside-floating-slider {
            height: 300px;
        }

        .container-item-slider {
            flex-wrap: wrap;
        }

        .div-parent-title-slider {
            width: 100%;
        }

        .div-parent-title-slider h2 {
            font-size: 20px;
            margin-bottom: 5px;
            line-height: 35px;
        }

        .img-item-floating-salt {
            width: 160px !important;
        }

        .img-item-floating-vinegar {
            width: 160px !important;
            right: -10px;
        }

        .img-item-floating-ketchup {
            width: 160px !important;
        }

        .img-item-floating-chips-1 {
            width: 140px !important;
        }

        .img-item-floating-chips-2 {
            width: 80px !important;
        }

        .img-item-floating-chips-3 {
            width: 70px !important;
        }
    }

    @media (max-width: 576px) {
        .img-bg-floating-slider {
            display: none !important;
        }

        .slide-1 {
            background-image: url('./img/slider/slide1_max540.jpg');
        }

        .slide-2 {
            background-image: url('./img/slider/slide2_max540.jpg');
        }

        .slide-3 {
            background-image: url('./img/slider/slide3_max540.jpg');
        }

        .slide-4 {
            background-image: url('./img/slider/slide4_max540.jpg');
        }

        .slide-5 {
            background-image: url('./img/slider/slide5_max540.jpg');
        }

        .slide-6 {
            background-image: url('./img/slider/slide6_max540.jpg');
        }

        .slide-7 {
            background-image: url('./img/slider/slide7_max540.jpg');
        }

        .slide-8 {
            background-image: url('./img/slider/slide8_max540.jpg');
        }

        .slide-9 {
            background-image: url('./img/slider/slide9_max540.jpg');
        }

        .slide-10 {
            background-image: url('./img/slider/slide10_max540.jpg');
        }

        .slide-11 {
            background-image: url('./img/slider/slide11_max540.jpg');
        }

        .slide-12 {
            background-image: url('./img/slider/slide12_max540.jpg');
        }

        .slide-13 {
            background-image: url('./img/slider/slide13_max540.jpg');
        }

        .slide-14 {
            background-image: url('./img/slider/slide14_max540.jpg');
        }

        .slide-15 {
            background-image: url('./img/slider/slide15.jpg');
        }

        .slide-16 {
            background-image: url('./img/slider/slide-shop.jpg');
        }

        .div-floating-slider {
            height: 250px;
        }

        .div-inside-floating-slider {
            height: 300px;
        }

        .div-parent-title-slider {
            margin-top: 45px;
        }

        .div-parent-title-slider h2 {
            font-size: 20px;
            margin-bottom: 5px;
        }

        .img-item-floating-salt {
            width: 120px !important;
        }

        .img-item-floating-vinegar {
            width: 120px !important;
            right: -10px;
        }

        .img-item-floating-ketchup {
            width: 120px !important;
        }

        .img-item-floating-chips-1 {
            width: 100px !important;
            display: none !important;
        }

        .img-item-floating-chips-2 {
            width: 40px !important;
            display: none !important;
        }

        .img-item-floating-chips-3 {
            width: 30px !important;
            display: none !important;
        }

        .img-item-floating-snack1 {
            display: none !important;
        }

        .img-item-floating-snack2 {
            display: none !important;
        }

        .img-item-floating-snack3 {
            display: none !important;
        }

        .img-item-floating-snack4 {
            display: none !important;
        }

        .img-item-floating-snack5 {
            position: absolute;
            width: 270px !important;
            top: 20px;
            /*right: -2px;*/
            left: 0px;
            right: 0px;
            margin-left: auto;
            margin-right: auto;
        }
    }

    /* =================================== */
    /*	product
/* =================================== */
    #section-product {
        padding-top: 50px;
        padding-bottom: 50px;
        min-height: 200px;
    }

    .div-bg-product {
        position: relative;
        background-position: center bottom;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("./img/back_product.jpg");
        height: 300px;
    }

    .div-mask-bg-product {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        background: #000000;
        opacity: 0.2;
    }

    .div-title-product {
        margin: 0 auto;
        background: #01815f;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .div-title-product h3 {
        margin: 0;
        padding: 10px 0;
        font-family: IS-M;
        font-size: 22px;
        color: #ffffff;
        text-align: center;
    }

    .container-item-product {
        position: absolute;
        bottom: -110px;
        left: 0;
        right: 0;
        /*background: #17a2b8;*/
    }

    .div-parent-product {
        width: 1045px;
        height: 220px;
        margin: 0 auto;
        overflow: hidden;
    }

    .mo-parent-item-product {
        width: 210px;
        height: 210px;
        padding: 10px 2px;
        margin: 0 auto;
    }

    .item-product {
        position: relative;
        width: 92%;
        height: 92%;
        background: #ffffff;
        border-radius: 8px;
        box-shadow: 0 2px 5px 0px rgba(0, 0, 0, 0.5);
        margin: 10px auto 0 auto;
        transition: all 0.5s;
        display: flex;
        flex-flow: column;
    }

    .item-product:hover {
        transform: translateY(-4px);
    }

    .owl-item.active.center .item-product {
        box-shadow: 0 2px 8px 0px rgba(0, 0, 0, 0.6);
        width: 100%;
        height: 100%;
        margin-top: 0px;
        transition: all 0.5s;
    }

    .owl-item.active.center .item-product:hover {
        transform: translateY(-4px);
    }

    .box-bottom-item-product {
        padding: 12px 0px;
        position: absolute;
        background: #01815f;
        bottom: 0;
        left: 0;
        right: 0;
        border-bottom-left-radius: 8px;
        border-bottom-right-radius: 8px;
    }

    .box-bottom-item-product h1 {
        font-family: IS-L;
        font-size: 14px;
        color: #ffffff;
        text-align: center;
        margin: 0;
    }

    .img-logo-product {
        display: block;
        margin: auto;
        padding: 10px 10px 50px 10px;
        max-height: 100%;
        max-width: 70%;
        width: unset !important;
        min-height: 1px;
    }

    .container-slogan-product {
        position: relative;
        display: flex;
        align-items: center;
        height: 60%;
        /*background: #6f42c1;*/
    }

    .container-slogan-product h4 {
        margin: auto;
        z-index: 2;
        color: #ffd400;
        font-family: IS-M;
        font-size: 30px;
        text-align: center;
        text-shadow: 2px 2px 4px #000000;
        margin-bottom: 12px;
        line-height: 52px;
        margin-top: 12px;
    }

    .a-download-catalog {
        color: #fff;
        font-family: IS-L;
        font-size: 13px;
        text-decoration: none;
        border-bottom: 1px solid;
        z-index: 2;
        transition: all 0.5s;
    }

    .a-download-catalog:hover {
        color: #fff;
        font-size: 14px;
    }

    @media (max-width: 992px) {
        .div-parent-product {
            width: 420px;
        }
    }

    @media (max-width: 576px) {
        .div-parent-product {
            width: 215px;
        }
    }

    /* =================================== */
    /*	blog
/* =================================== */
    #section-blog {
        padding-top: 100px;
        padding-bottom: 50px;
        /*background: #a87d4d;*/
        min-height: 200px;
        overflow: hidden;
    }

    .div-col-title-blog {
        padding-bottom: 15px;
    }

    .row-blog {
        position: relative;
        margin: 0 130px !important;
        /*padding-top: 15px;*/
    }

    #owl-blog {
        background: #ffffff;
        border-radius: 8px;
        overflow: hidden;
    }

    .row-item-blog {
        height: 100%;
    }

    .mo-parent-item-blog {
        /*background: #e4002d;*/
        height: 100%;
    }

    .col-content-blog {
        padding: 0 0 0 3px;
        height: 280px;
    }

    .col-img-blog {
        padding: 0 3px 0 0;
        height: 280px;
    }

    .div-parent-content-blog {
        height: 100%;
        border-top-right-radius: 8px;
        border-bottom-right-radius: 8px;
        background: #ffd400;
        padding: 40px 40px;
        /*background-image:url("../img/overall-background.jpg");*/
    }

    .div-parent-content-blog h3 {
        font-family: IS-M;
        font-size: 20px;
        color: #9f118b;
        margin-bottom: 13px;
    }

    .p-text-blog {
        font-family: IS-L;
        font-size: 14px;
        line-height: 33px;
        text-align: justify;
        margin-bottom: 40px;
        color: #282828;
    }

    .a-more-blog {
        position: absolute;
        margin: 0;
        bottom: 30px;
        left: 40px;
        text-decoration: none;
        border-bottom: 1px solid #ff0010 !important;
        color: #ff0010 !important;
        font-family: IS-L;
        font-size: 13px;
        transition: all 0.5s;
    }

    .a-more-blog:hover {
        color: #fff;
    }

    .div-parent-img-blog {
        height: 100%;
        border-top-left-radius: 8px;
        border-bottom-left-radius: 8px;
        display: flex;
        align-items: center;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
    }

    #img-arrow-left-blog {
        position: absolute;
        display: block;
        width: 35px;
        left: -35px;
        top: 0;
        bottom: 0;
        margin-top: auto;
        margin-bottom: auto;
        cursor: pointer;
    }

    #img-arrow-right-blog {
        position: absolute;
        display: block;
        width: 35px;
        right: -35px;
        top: 0;
        bottom: 0;
        margin-top: auto;
        margin-bottom: auto;
        cursor: pointer;
    }

    #owl-blog button:focus {
        outline: 0;
    }

    #section-blog .owl-theme .owl-dots .owl-dot span {
        background: #adadad;
    }

    #section-blog .owl-theme .owl-dots .owl-dot.active span {
        background: #d6a954;
        border: solid 1px #ae7e4d;
    }

    @media (max-width: 1200px) {
        .div-parent-content-blog {
            border-radius: 8px;
        }

        .col-content-blog {
            padding: 0;
            height: auto;
        }
    }

    @media (max-width: 768px) {
        #owl-blog {
            background: unset;
        }

        .row-blog {
            margin: 0 10px !important;
        }
    }

    @media (max-width: 576px) {
        .img-item-blog-sm {
            display: block !important;
            width: 100%;
            border-top-right-radius: 8px;
            border-top-left-radius: 8px;
        }

        .div-parent-content-blog {
            border-radius: unset;
        }

        .col-content-blog {
            border-radius: 8px;
            overflow: hidden;
        }
    }

    /* =================================== */
    /*	about us
/* =================================== */
    #section-about-us {
        /*margin-top:90px;*/
        position: relative;
        min-height: 300px;
        overflow: hidden;
        background-attachment: fixed;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: cover;
        background-image: url("./img/bg_about_us.jpg");
    }

    .div-mask-bg-about-us {
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        right: 0;
        background: #000000;
        opacity: 0.3;
    }

    .div-svc-about-us {
        position: absolute;
        bottom: -1px;
        left: 0;
        right: 0;
        padding: 0;
    }

    .div-box-title-about-us {
        display: block;
        width: 100%;
        height: 60px;
        margin-top: 10px;
        opacity: 0.4;
        background: #ffffff;
    }

    .div-parent-shape-title-about-us {
        position: relative;
        /*background: #0c5460;*/
        text-align: center;
        margin-right: 110px;
        width: 150px;
        display: inline-block;
    }

    .div-parent-shape-title-about-us img {
        width: 100%;
    }

    .div-parent-shape-title-about-us h2 {
        /*background: #1e7e34;*/
        position: absolute;
        text-align: center;
        font-family: IS-M;
        font-size: 18px;
        color: #ffffff;
        top: -5px;
        left: 0;
        right: 0;
    }

    .div-content-about-us {
        padding: 20px 70px 50px 70px;
    }

    .div-content-about-us p {
        color: #ffffff;
        line-height: 36px;
        font-family: IS-L;
        font-size: 14px;
        text-align: justify;
    }

    .div-content-about-us a {
        text-decoration: none;
        color: #ffc107 !important;
        font-family: IS-L;
        border-bottom: 1px solid #ffc107 !important;
        font-size: 14px;
        transition: all 0.5s;
    }

    .div-content-about-us a:hover {
        color: #fff;
    }

    @media (max-width: 540px) {
        .div-parent-shape-title-about-us {
            margin-right: 20px;
        }

        .div-content-about-us {
            padding: 20px 20px 50px 20px;
        }
    }

    /* =================================== */
    /*	contact us
/* =================================== */
    #sec-contact-us {
        padding-top: 30px;
        padding-bottom: 100px;
    }

    .div-col-title-contact-us h2 {
        text-align: center;
        color: #000000;
        font-size: 17px;
        line-height: 30px;
        padding-left: 20px;
        padding-right: 20px;
    }

    .row-social-network {
        padding: 10px 100px 0 100px;
    }

    .div-col-parent-item-social-network {
        padding: 10px;
    }

    .div-col-parent-item-social-network img {
        width: 100%;
        transition: all 0.5s;
    }

    .div-col-item-social-network {
        position: relative;
        display: flex;
        height: 100%;
        width: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center;
        align-items: center;
        border-radius: 7px;
        overflow: hidden;
    }

    .icon-item-social-network {
        position: absolute;
        display: block;
        opacity: 0;
        left: 0;
        right: 0;
        margin: auto;
        text-align: center;
        color: #ffffff;
        font-size: 30px;
        vertical-align: center;
        transition: all 1s;
        line-height: 33px;
    }

    .img-icon-item-social-network {
        position: absolute;
        display: block;
        opacity: 0;
        left: 0;
        right: 0;
        top: 0;
        bottom: 0;
        z-index: 2;
        width: 55px !important;
        margin: auto;
        filter: unset !important;
    }

    .div-col-item-social-network:hover img {
        filter: brightness(40%);
    }

    .div-col-item-social-network:hover .icon-item-social-network {
        opacity: 1;
    }

    .div-col-item-social-network:hover .img-icon-item-social-network {
        opacity: 1;
    }

    @media (max-width: 540px) {
        .row-social-network {
            padding: 10px 20px 0 20px;
        }
    }
</style>






<link rel="stylesheet/less" type="text/css" href="./less/general.less?v=9zhnfTBp5vE8BxJrrIJJSPYpBDoGa0bdrywImv_QiK0">
<style type="text/css" id="less:less-general:less-v-9zhnfTBp5vE8BxJrrIJJSPYpBDoGa0bdrywImv_QiK0">
    /*

size base

Extra small < 576px  ***********  .col-       ***********  Max container width None (auto)
Small ≥ 576px        ***********  .col-sm-    ***********  Max container width 540px
Medium ≥ 768px       ***********  .col-md-    ***********  Max container width 720px
Large ≥ 992px        ***********  .col-lg-    ***********  Max container width 960px
Extra large ≥ 1200px ***********  .col-xl-    ***********  Max container width 1140px

*/
    /* =================================== */
    /*	Basic Style
/* =================================== */
    @font-face {
        font-family: 'IS-L';
        src: url(./font/IRANSans-Light-web.woff);
    }

    @font-face {
        font-family: 'IS-M';
        src: url(./font/IRANSans-Medium-web.woff);
    }

    @font-face {
        font-family: 'IS-B';
        src: url(./font/IRANSans-Bold-web.woff);
    }

    @font-face {
        font-family: 'yekan_bold';
        src: url(./font/YEKANBAKHFANUM-BOLD.TTF);
    }

    @font-face {
        font-family: 'yekan_light';
        src: url(font/YEKANBAKHNOEN-LIGHT.TTF);
    }

    body {
        padding-top: 60px;
        background-color: #fff;
        font-family: IS-L;
        line-height: 24px;
        font-size: 16px;
        color: #fff;
        overflow-x: hidden;
    }

    .no-select {
        -webkit-touch-callout: none;
        -webkit-user-select: none;
        -khtml-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    a {
        text-decoration: unset;
        color: unset;
    }

    a:hover {
        text-decoration: unset;
        color: unset;
    }

    .outline-none {
        outline: none !important;
    }

    .div-col-title-white h2 {
        text-align: center;
        font-family: IS-M;
        color: #fff;
        font-size: 24px;
        line-height: 55px;
        text-shadow: 2px 2px 4px #000000;
    }

    /* =================================== */
    /*	preloader
/* =================================== */
    #preloader {
        background-color: #fff;
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 9999;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
    }

    .parent-spinner {
        width: 70px;
        height: 20px;
        /*background-color: #fffa00;*/
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        margin: auto;
    }

    .spinner {
        /*margin: 100px auto 0;*/
        width: 70px;
        text-align: center;
    }

    .spinner>div {
        width: 15px;
        height: 15px;
        background-color: #ed1c24;
        border-radius: 50%;
        display: inline-block;
        -webkit-animation: sk-bouncedelay 1.4s infinite ease-in-out both;
        animation: sk-bouncedelay 1.4s infinite ease-in-out both;
    }

    .spinner .bounce1 {
        -webkit-animation-delay: -0.32s;
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        -webkit-animation-delay: -0.16s;
        animation-delay: -0.16s;
    }

    @-webkit-keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1);
        }
    }

    @keyframes sk-bouncedelay {

        0%,
        80%,
        100% {
            -webkit-transform: scale(0);
            transform: scale(0);
        }

        40% {
            -webkit-transform: scale(1);
            transform: scale(1);
        }
    }

    /* =================================== */
    /*	ScrollBar
/* =================================== */
    /* width */
    ::-webkit-scrollbar {
        width: 7px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #acacac;
        border-radius: 45px;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #8c8c8c;
    }

    /* =================================== */
    /*	icon go to top
/* =================================== */
    .a-icon-go-to-top-page {
        position: fixed;
        display: flex;
        cursor: pointer;
        align-items: center;
        bottom: 40px;
        left: 40px;
        width: 50px;
        height: 50px;
        background: #464546;
        z-index: 10;
        border-radius: 100%;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
        opacity: 0;
        transition: all 1s;
    }

    .a-icon-go-to-top-page img {
        width: 100%;
    }

    @media (max-width: 768px) {
        .a-icon-go-to-top-page {
            bottom: 20px;
            left: 20px;
        }
    }

    /* =================================== */
    /*	main
/* =================================== */
    #main {
        min-height: calc(100vh - 362px);
    }

    /* =================================== */
    /*	navigation
/* =================================== */
    #a-product-navigation::after {
        display: inline-block;
        width: 0;
        height: 0;
        margin-right: 0.255em;
        vertical-align: 0.255em;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
    }

    #header {
        position: absolute;
        top: 0;
        right: 0;
        left: 0;
        background: #01815f;
        z-index: 2;
    }

    #navigation {
        padding: 0 10px;
        height: 60px;
    }

    #navigation ul {
        list-style: none;
        display: flex;
        margin: 0;
    }

    #navigation .custom-dropdown {
        top: 60px !important;
        right: 0 !important;
        left: unset !important;
    }

    #navigation .dropdown-item {
        font-family: IS-L;
        font-size: 14px;
        cursor: pointer;
    }

    #navigation .dropdown-item:focus,
    #navigation .dropdown-item:active {
        background: unset !important;
    }

    #navigation .dropdown-item:hover {
        background: #dddddd !important;
    }

    .container-nav {
        z-index: 5;
        background: #01815f;
        color: #fff;
    }

    .ul-navigation {
        padding: 0;
    }

    .nav-link {
        padding-left: 10px;
        padding-right: 10px;
    }

    .nav-item {
        font-family: 'yekan_light';
        font-size: 14px;
        padding-left: 5px;
        padding-right: 5px;
    }

    .nav-item:hover .underline-nav-item {
        width: 80%;
    }

    .underline-nav-item {
        width: 0;
        position: relative;
        background: yellow;
        height: 2px;
        bottom: 8px;
        margin: auto;
        transition: all 0.5s;
    }

    .nav-item:hover {
        font-weight: bold;
    }

    .navbar-light .navbar-nav .nav-link {
        color: #4c4c4c;
    }

    .nav-fixed {
        position: fixed !important;
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.26);
        -webkit-box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.26);
        animation: navigation-slide-down 1s none;
    }

    .line-bottom-navigation {
        position: relative;
        z-index: 4;
        height: 5px;
        background: #01815f;
    }

    .div-parent-shape-logo-navigation {
        position: absolute;
        left: 85px;
        z-index: 6;
        /*background: #007bff;*/
    }

    .img-shape-navigation {
        display: none;
        top: -1px;
        left: 0;
        width: 130px;
    }

    #logo {
        width: 50px;
        margin-top: -5px;
    }

    .img-logo-navigation {
        position: absolute;
        display: none;
        width: 70px;
        top: -80%;
        left: 0;
        right: 0;
        margin: auto;
    }

    .div-flag-navigation {
        position: absolute;
        height: 60px;
        display: flex;
        /*background: #007bff;*/
        width: 25px;
        top: 0;
        left: 50px;
        bottom: 0;
    }

    .div-flag-navigation a {
        display: flex;
        margin: auto;
        transition: all 0.3s;
    }

    .div-flag-navigation a:hover {
        transform: scale(1.1);
    }

    .div-flag-navigation img {
        width: 100%;
        height: 18px;
        display: block;
    }

    /*product navigation*/
    .nav-link {
        padding-top: 18px;
        padding-bottom: 18px;
    }

    .bg-row-product-navigation-blur {
        position: absolute;
        top: 0px;
        right: 0px;
        bottom: 0px;
        left: 0px;
        z-index: -1;
        background: rgba(255, 255, 255, 0.85);
    }

    .row-product-navigation {
        position: absolute;
        padding: 10px;
        overflow: hidden;
        display: none;
        top: 60px;
        right: 0;
        left: 0;
        box-shadow: 0 10px 10px 0 rgba(0, 0, 0, 0.15);
        border-radius: 0 0 5px 5px;
        transition: all 0.3s;
    }

    .line-top-product-navigation {
        height: 5px;
        position: absolute;
        background: #f7e61f;
        top: 0;
        left: 0;
        right: 0;
    }

    #nav-product:hover #row-product-navigation {
        display: flex;
    }

    .side-down {
        animation: navigation-slide-down 0.3s forwards;
    }

    .side-up {
        animation: navigation-slide-up 0.3s forwards;
    }

    @keyframes navigation-slide-down {
        0% {
            opacity: 0;
        }

        100% {
            opacity: 1;
        }
    }

    @keyframes navigation-slide-up {
        0% {
            opacity: 1;
            transform: translateY(0);
        }

        100% {
            opacity: 0;
            transform: translateY(100%);
        }
    }

    .col-item-product-navigation {
        max-width: 25%;
        flex: 0 0 25%;
        padding: 10px 20px;
    }

    .item-product-navigation {
        width: 100%;
        min-height: 100px;
    }

    .item-product-navigation img {
        height: 100px;
        max-width: 100%;
        display: block;
        margin: 0 auto;
        transition: all 0.5s;
    }

    .item-product-navigation h1 {
        color: #282828;
        text-align: center;
        font-size: 14px;
        margin-top: 10px;
        transition: all 0.5s;
    }

    .item-product-navigation:hover img {
        transform: scale(1.05, 1.05);
    }

    .item-product-navigation:hover h1 {
        color: #d60000;
    }

    .div_login_account {
        font-family: IS-L;
        display: flex;
        font-size: 14px;
        position: absolute;
        height: 60px;
        top: 0;
        bottom: 0;
        left: 90px;
    }

    .div_login_account a {
        display: flex;
        margin: auto;
        padding: 5px 10px;
        border: 1px solid #9f9f9f;
        border-radius: 5px;
    }

    .div_login_account img {
        height: 20px;
        margin: auto;
        margin-left: 5px;
    }

    .div_login_account span {
        margin: auto;
    }

    @media (max-width: 1340px) {
        .div-parent-shape-logo-navigation {
            left: 160px;
        }
    }

    @media (max-width: 1250px) and (min-width: 990px) {
        .div-parent-shape-logo-navigation {
            display: none;
        }
    }

    @media (max-width: 992px) {
        #navigation {
            height: unset;
        }

        .div-flag-navigation {
            left: 20px;
        }

        .div-parent-shape-logo-navigation {
            left: 30px;
        }

        .container-nav,
        .container-logo {
            max-width: none;
        }

        .div_login_account {
            left: unset;
            right: 50px;
        }
    }

    /* =================================== */
    /*	navigation mobile
/* =================================== */
    .div-navigation-mobile {
        display: none;
        height: unset;
        text-align: center;
    }

    .div-parent-ul-navigation-mobile {
        display: none;
    }

    .div-drop-product {
        position: relative !important;
        float: unset !important;
        transform: unset !important;
        max-height: 0;
        overflow: hidden;
        transition: all 1s;
        display: block !important;
        padding: 0;
        border: unset;
    }

    .div-drop-product.show {
        padding-top: 5px;
        max-height: 200px;
    }

    .div-drop-product .dropdown-item {
        font-family: IS-L;
        font-size: 12px;
        text-align: center;
    }

    .div-parent-ul-navigation-mobile {
        transform: translateY(-500px);
    }

    .div-parent-ul-navigation-mobile.slide-down {
        animation: content-navigation-mobile-down 0.5s forwards;
    }

    .div-parent-ul-navigation-mobile.slide-up {
        animation: content-navigation-mobile-up 0.5s forwards;
    }

    @media (max-width: 992px) {
        .div-navigation-mobile {
            display: block;
            height: 60px;
            text-align: center;
            transition: all 2s;
        }

        .div-navigation-mobile.slide-down {
            animation: slide-down-navigation-mobile 0.5s forwards;
        }

        .div-navigation-mobile.slide-up {
            animation: slide-up-navigation-mobile 0.5s forwards;
        }

        .div-parent-ul-navigation-mobile {
            display: flex;
            height: 95%;
            padding-top: 50px;
            padding-bottom: 50px;
        }

        .div-parent-ul-navigation-mobile ul {
            width: 200px;
            padding: 0;
            display: block !important;
            margin: auto !important;
        }

        .div-parent-ul-navigation-mobile li {
            text-align: center;
            border-bottom: 1px solid #282828;
            color: #282828;
            font-size: 14px;
            padding: 5px;
        }
    }

    @keyframes content-navigation-mobile-up {
        0% {
            transform: translateY(0px);
        }

        100% {
            transform: translateY(-1000px);
        }
    }

    @keyframes content-navigation-mobile-down {
        0% {
            transform: translateY(-1000px);
        }

        100% {
            transform: translateY(0px);
        }
    }

    @keyframes slide-down-navigation-mobile {
        0% {
            height: 60px;
        }

        100% {
            height: unset;
        }
    }

    /*480px*/
    @keyframes slide-up-navigation-mobile {
        0% {
            height: unset;
        }

        100% {
            height: 60px;
        }
    }

    /* =================================== */
    /*	navigation mobile canvas icon menu
/* =================================== */
    #div-parent-container-navigation {
        position: relative;
        transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    }

    .navbar-toggler {
        position: absolute;
        height: 60px;
        top: 0;
        right: 0;
        margin: auto;
        z-index: 6;
        transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    }

    .nav-open .navbar-toggler {
        transform: translate3d(-190px, 0, 0);
    }

    .div-side-mobile {
        display: none !important;
        position: fixed;
        overflow-x: hidden;
        overflow-y: auto;
        top: 0;
        right: -10px;
        width: 200px;
        height: 100%;
        padding: 60px 1rem;
        background-color: #ffffff;
        border-left: 1px solid #e3e3e3;
        text-align: center;
        visibility: visible;
        transform: translateX(200px);
        transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
        z-index: 1032;
    }

    .nav-open .div-side-mobile {
        transform: translate3d(0px, 0, 0);
    }

    .wrapper {
        transition: all 0.5s cubic-bezier(0.685, 0.0473, 0.346, 1);
    }

    #header .navbar-toggler .icon-bar {
        display: block;
        position: relative;
        width: 24px;
        height: 2px;
        border-radius: 1px;
        background-color: #111111;
    }

    #header .navbar-toggler .icon-bar+.icon-bar {
        margin-top: 4px;
    }

    #header .navbar-toggler .icon-bar.bar1 {
        top: 0;
        outline: 1px solid transparent;
        animation: topbar-back 500ms 0s;
        animation-fill-mode: forwards;
    }

    #header .navbar-toggler .icon-bar.bar2 {
        outline: 1px solid transparent;
        opacity: 1;
    }

    #header .navbar-toggler .icon-bar.bar3 {
        bottom: 0;
        outline: 1px solid transparent;
        animation: bottombar-back 500ms 0s;
        animation-fill-mode: forwards;
    }

    #header .navbar-toggler.toggled .icon-bar.bar1 {
        top: 6px;
        animation: topbar-x 500ms 0s;
        animation-fill-mode: forwards;
    }

    #header .navbar-toggler.toggled .icon-bar.bar2 {
        opacity: 0;
    }

    #header .navbar-toggler.toggled .icon-bar.bar3 {
        bottom: 6px;
        animation: bottombar-x 500ms 0s;
        animation-fill-mode: forwards;
    }

    #header .navbar-collapse.collapse,
    #header .navbar-collapse.collapse.in,
    #header .navbar-collapse.collapsing {
        display: none !important;
    }

    #overlay {
        visibility: hidden;
        position: fixed;
        opacity: 0;
        top: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 100%;
        overflow-x: hidden;
        z-index: 1029;
        background: rgba(0, 0, 0, 0.22);
        transition: all 1s;
    }

    .nav-open #overlay {
        visibility: visible;
        opacity: 1;
    }

    @keyframes topbar-x {
        0% {
            top: 0px;
            transform: rotate(0deg);
        }

        45% {
            top: 6px;
            transform: rotate(145deg);
        }

        75% {
            transform: rotate(130deg);
        }

        100% {
            transform: rotate(135deg);
        }
    }

    @keyframes topbar-back {
        0% {
            top: 6px;
            transform: rotate(135deg);
        }

        45% {
            transform: rotate(-10deg);
        }

        75% {
            transform: rotate(5deg);
        }

        100% {
            top: 0px;
            transform: rotate(0);
        }
    }

    @keyframes bottombar-x {
        0% {
            bottom: 0px;
            transform: rotate(0deg);
        }

        45% {
            bottom: 6px;
            transform: rotate(-145deg);
        }

        75% {
            transform: rotate(-130deg);
        }

        100% {
            transform: rotate(-135deg);
        }
    }

    @keyframes bottombar-back {
        0% {
            bottom: 6px;
            transform: rotate(-135deg);
        }

        45% {
            transform: rotate(10deg);
        }

        75% {
            transform: rotate(-5deg);
        }

        100% {
            bottom: 0px;
            transform: rotate(0);
        }
    }

    /* =================================== */
    /*	footer
/* =================================== */
    #footer {
        height: auto;
        background: #004936;
    }

    .col-social {
        position: relative;
        display: block;
        height: 50px;
        top: -53px;
        left: 0;
        right: 0;
        /*background: #0c5460;*/
        text-align: center;
    }

    .img-logo-footer {
        width: 165px;
        display: block;
        margin: auto;
    }

    .div-parent-item-social {
        /*height: 100%;*/
        display: block;
        /*background: #1e7e34;*/
        margin: 0 auto;
    }

    .div-item-social {
        position: relative;
        height: 50px;
        width: 50px;
        margin: 0 10px;
        display: inline-flex;
        align-items: center;
        border-radius: 100%;
        background: #464546;
        transition: all 0.3s;
        border: solid 2px #d6a954;
        transform: scale(1.001);
    }

    .div-item-social i {
        margin: auto;
        color: #ffffff;
        font-size: 24px;
        transition: all 0.2s;
    }

    .div-item-social:hover {
        transform: scale(1.15);
    }

    .parent-content-item-footer {
        display: flex;
        background: #0c5460;
        width: 100%;
        margin: 0 auto;
    }

    .div-item-content-footer {
        position: relative;
        min-height: 150px;
    }

    .div-icon-item-content {
        position: absolute;
        display: flex;
        align-items: center;
        left: 0;
        right: 0;
        margin: 0 auto;
        width: 50px;
        height: 50px;
        top: -25px;
        border-radius: 100%;
        background: #d60000;
        border: solid 2px #fff;
    }

    .div-icon-item-content img {
        display: block;
        width: 100%;
        padding: 8px;
        margin: auto;
    }

    .div-icon-item-content i {
        margin: auto;
        font-size: 26px;
        color: #fff;
    }

    .div-content-footer {
        margin-top: 40px;
        color: #fff;
    }

    .div-content-footer h3 {
        font-family: IS-M;
        font-size: 15px;
        text-align: center;
    }

    .div-content-footer p {
        font-family: IS-L;
        padding-top: 10px;
        font-size: 13px;
        text-align: center;
    }

    .site-info-footer {
        clear: both;
        font-size: 80%;
        height: 50px;
        width: 100%;
        text-align: center;
        line-height: 50px;
        background-color: #037a5b;
        color: #e5e2e2;
    }

    .parent-line-footer {
        margin-top: 50px;
    }

    .line-footer {
        height: 2px;
        background: #fff;
    }

    .ic-social-footer {
        display: block;
        width: 55%;
        margin: auto;
    }
</style>
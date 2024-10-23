<style type="text/css" id="less:less-product:less-v-Xko7ePekQEnwU4pJzf4il86jOuE8Rq1KMjVS-EeSgHc">
/* =================================== */
/*	header
/* =================================== */
#section-header-product-details {
    overflow: hidden;
    z-index: -2;
    position: relative;
    width: 100%;
    min-height: 100px;
    background: #d6a954;
}

.div-bg-header-product-details {
    position: absolute;
    z-index: 0;
    height: 100%;
    width: 100%;
    background-attachment: fixed;
    background-position: bottom;
    background-repeat: no-repeat;
    background-size: cover;
    /*background-size: 100% auto;*/
    /*filter: blur(5px);
  -moz-filter: blur(5px);
  -o-filter: blur(5px);
  -webkit-filter: blur(5px);*/
}

#section-header-product-details::before {
    content: "";
    z-index: 1;
    width: 100%;
    height: 100%;
    position: absolute;
}

.container-content-header {
    padding-top: 80px;
    padding-bottom: 80px;
}

.p-header-products {
    color: #fff;
    padding: 0 50px;
    text-align: center;
    line-height: 35px;
}

/* =================================== */
/*	image zoom
/* =================================== */
.magnifier {
    background: #fff;
    direction: ltr !important;
}

/* =================================== */
/*	section-product-details
/* =================================== */
#section-product-details {
    min-height: 200px;
    padding-top: 50px;
}

.img-product-details {
    display: block;
    width: 80%;
    margin: 0 auto;
}

.col-content-product-details {
    padding-top: 50px;
    padding-bottom: 50px;
}

.div-title-content-details h2 {
    font-family: IS-M;
    font-size: 22px;
    color: #343434;
}

.div-share-details {
    display: flex;
    border-top: 1px solid #d9d9d9;
    border-bottom: 1px solid #d9d9d9;
    margin-top: 30px;
    margin-bottom: 30px;
    padding-top: 15px;
    padding-bottom: 15px;
}

.div-share-details span {
    font-family: IS-M;
    color: #343434;
    font-size: 15px;
}

.div-share-details a {
    text-decoration: none;
    color: unset;
    display: inline-flex;
    margin: auto;
}

.div-share-details i {
    padding-left: 8px;
    padding-right: 8px;
    font-size: 16px;
    text-align: center;
}

.div-description-details p {
    font-family: IS-L;
    line-height: 30px;
    font-size: 14px;
    text-align: justify;
    color: #a4a4a4;
}

.div-material-details h3 {
    font-family: IS-M;
    font-size: 16px;
    color: #888888;
}

.div-material-details p {
    font-family: IS-L;
    line-height: 30px;
    font-size: 14px;
    text-align: justify;
    color: #a4a4a4;
}

#p-show-image-product,
#p-show-table-food {
    color: #a4a4a4;
    text-align: center;
    border-bottom: 1px solid #a4a4a4;
    font-size: 14px;
    display: inline-block;
    padding-bottom: 5px;
    cursor: pointer;
}

.p-active {
    font-weight: bold !important;
    color: #888888 !important;
}

#row-img-product {
    display: block;
    height: 425px;
    overflow: hidden;
    /*background: red;*/
}

#row-table-food {
    display: none;
    height: 425px;
    overflow: hidden;
    padding-left: 30px;
    padding-right: 30px;
    /*background: blue;*/
}

#row-table-food .col-table-food-p {
    padding-right: 10px;
    padding-left: 10px;
}

#row-table-food p {
    font-family: IS-L;
    line-height: 20px;
    font-size: 12px;
    text-align: justify;
    color: #a4a4a4;
    margin-bottom: 14px;
}

.col-img-table-food {
    height: 323px;
    overflow: hidden;
    padding-top: 35px;
    margin-top: 20px;
    text-align: center;
}

.col-img-table-food img {
    max-height: 85%;
    margin: 0 auto;
    position: absolute;
    bottom: 10px;
    left: 0px;
    right: 0px;
}

@media (min-width: 0px) {
    .container-product-details {
        width: 80%;
        margin: 0 auto;
    }
}

@media (min-width: 500px) {
    .container-product-details {
        max-width: 400px;
        margin: 0 auto;
    }
}

@media (max-width: 600px) {
    #row-table-food {
        margin-bottom: 10px;
    }

    .col-table-food-p {
        padding-left: 0px;
        padding-right: 0px;
    }
}

@media (min-width: 992px) {
    .container-product-details {
        max-width: 800px;
        margin: 0 auto;
    }
}

/* =================================== */
/*	section-related-product
/* =================================== */
#section-related-product {
    padding-top: 10px;
    padding-bottom: 70px;
}

#section-related-product .owl-stage {
    margin: 0 auto !important;
}

.item-parent-related-product {
    padding: 10px;
}

.item-parent-related-product a {
    cursor: pointer;
}

.item-related-product {
    overflow: hidden;
    width: 100%;
    min-height: 120px;
    background: #fff;
    box-shadow: 0 2px 0 0 rgba(0, 0, 0, 0.07);
    border: 1px solid #e1e1e1;
    border-radius: 5px;
    transform: translateY(0px);
    transition: all 0.3s;
}

.item-related-product img {
    display: block;
    /*width: 100%;*/
    min-height: 229px;
}

.div-title-item-related-product {
    padding-top: 10px;
    padding-bottom: 10px;
    text-align: center;
    border-top: 1px solid #dcdcdc;
    display: flex;
}

.div-title-item-related-product h3 {
    margin: 0;
    font-family: IS-L;
    font-size: 14px;
    color: #000;
    padding-left: 5px;
    padding-right: 5px;
    line-height: 22px;
    margin: auto;
    /*white-space: nowrap;*/
}

.col-arrow-related-product {
    display: flex;
    flex-flow: column;
}

.col-arrow-related-product img {
    max-width: 60% !important;
    margin: auto;
    cursor: pointer;
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

body {
    padding-top: 60px;
    background-color: #fff;
    font-family: IS-L;
    line-height: 24px;
    font-size: 16px;
    color: #282828;
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

.div-col-title-white h2,.div-col-title-white h1 {
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

#logo {
    width: 50px;
    margin-top: -5px;
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
    font-family: IS-L;
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
    background: #f7ba09;
}

.div-parent-shape-logo-navigation {
    position: absolute;
    left: 85px;
    z-index: 6;
    /*background: #007bff;*/
}

.img-shape-navigation {
    display: none;
    /* block */
    top: -1px;
    left: 0;
    width: 130px;
}

.img-logo-navigation {
    display: none;
    /* block */
    position: absolute;
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
    background: #d60000;
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
        transition: all 2s;
        text-align: center;
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
        color: #fff;
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
    background-color: #004936;
    color: #bbb;
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
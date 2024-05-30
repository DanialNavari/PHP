<?php
error_reporting(0);
require_once('server.php');
require_once('header.php');
$pack_id = analyze($_GET['u']);
$pack_info = smell_style($pack_id);
?>
<style>
    .title {
        background-color: #000;
        border-radius: 0.3rem;
        color: #fff;
        padding: 0.3rem;
        margin-bottom: 1rem;
    }

    iframe {
        border: none;
        height: 100%;
        margin: 0 auto;
        width: -webkit-fill-available;
    }

    .offer_pic {
        height: 43vmax;
        overflow: hidden;
        margin: 0 auto;
        text-align: center;
    }

    .part_ {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: center;
        gap: 0.5rem;
        margin: 2rem auto;
        border-radius: 0.3rem;
        color: #000;
    }

    svg {
        rotate: 0deg;
    }

    .tag {
        text-align: justify;
        font-family: 'yekan_bold';
        word-spacing: -0.18rem;
    }

    .part__ {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
        margin: 0rem auto;
        border-radius: 0.3rem;
        color: #000;
        width: 87vw;
        padding: 1rem;
    }

    .part3 {
        height: inherit;
        width: 27vw;
        margin: 0 auto;
    }

    .tag img {
        width: 3rem;
        height: 3rem;
        box-shadow: none;

    }

    .desc {
        font-family: yekan_bold;
        font-size: 1.35rem;
        padding: 0.5rem;
        margin: 1.5rem auto 1rem;
    }

    .smell,
    .vol,
    .sl,
    .fee,
    .off {
        font-family: Yekan Bakh FaNum;
        font-size: 1rem;
        text-align: right;
        margin: 0.5rem auto;
    }

    .smell span,
    .vol span,
    .sl span,
    .fee span,
    .off span {
        font-weight: normal;
    }

    #radif_part2 {
        width: 80vw;
        margin: 0 auto;
    }

    span#style_titr {
        display: block;
        font-weight: bold;
        font-size: 1.1rem;
    }

</style>

<?php
$symbol = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left-fill" viewBox="0 0 16 16">
<path d="m3.86 8.753 5.482 4.796c.646.566 1.658.106 1.658-.753V3.204a1 1 0 0 0-1.659-.753l-5.48 4.796a1 1 0 0 0 0 1.506z"/>
</svg>';
?>

<div class="main">
    <div class="result">

        <div class="part_1">
            <div class="style_smell">
                <span id="style_name">استایل بویایی شما</span>
                <span id="style_desc">
                    <span id="style_titr">استایل بویایی <?php echo $pack_info['esm']; ?></span>
                    <span id="pack_info"><?php echo $pack_info['desc']; ?></span>
                </span>
                <div class="part_11">
                    <div class="power_points">
                        <span class="pp">
                            نقاط قوت</span>
                        <div class="items">
                            <?php
                            $c = count($pack_info['power_point']);
                            for ($i = 0; $i < $c; $i++) {
                                $x = $pack_info['power_point'][$i];
                                echo '<div class="item">' . $x . '</div>';
                            }
                            ?>
                        </div>
                    </div>
                    <div class="power_points">
                        <span class="pp">ویژگی ها</span>
                        <div class="items">
                            <?php
                            $cc = count($pack_info['property']);
                            for ($j = 0; $j < $cc; $j++) {
                                $xx = $pack_info['property'][$j];
                                echo '<div class="item">' . $xx . '</div>';
                            }
                            ?>
                        </div>

                        <div class="part_">

                            <div class="tag">
                                <img src="img/ticket.png" alt="ticket">
                                اگر این عـکـس رو استوری کنی و مارو تگ کنی، میتونی توی قرعه‌کشی هفتگی‌ ما شرکت کنی.
                            </div>

                        </div>

                    </div>
                </div>
            </div>

            <div class="story_pic">
                <img src="<?php echo $pack_info['style_pic']; ?>" />
                <a class="btn btn_black" download="<?php echo $pack_info['style_pic']; ?>" href="<?php echo $pack_info['style_pic']; ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cloud-arrow-down-fill" viewBox="0 0 16 16">
                        <path d="M8 2a5.53 5.53 0 0 0-3.594 1.342c-.766.66-1.321 1.52-1.464 2.383C1.266 6.095 0 7.555 0 9.318 0 11.366 1.708 13 3.781 13h8.906C14.502 13 16 11.57 16 9.773c0-1.636-1.242-2.969-2.834-3.194C12.923 3.999 10.69 2 8 2zm2.354 6.854-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 1 1 .708-.708L7.5 9.293V5.5a.5.5 0 0 1 1 0v3.793l1.146-1.147a.5.5 0 0 1 .708.708z" />
                    </svg> دانلود
                </a>
            </div>
        </div>

        <div class="part_2">
            <div class="radif">
                <span id="smell_group_name">گروه بویایی مناسب شما</span>
            </div>
            <div class="radif">
                <div class="group_info">
                    <div class="package_image">
                        <img src="<?php echo $pack_info['pack_pic']; ?>" />
                    </div>
                    <div class="package_desc">
                        <span id="style_titr">گروه بویایی <?php echo $pack_info['smell_name']; ?></span>
                        <span><?php echo $pack_info['smell_desc']; ?></span>
                    </div>
                </div>
                <div class="desc">
                    <div class="title">پکیج <?php echo $pack_info['package_name']; ?></div>
                    <div class="smell"><?php echo $symbol; ?> روایح : <span><?php echo $pack_info['fa_prod'][0] . ' - ' . $pack_info['fa_prod'][1] . ' - ' . $pack_info['fa_prod'][2]; ?></span></div>
                    <div class="vol"><?php echo $symbol; ?> حجم : <span> 5میل + 5میل + 5میل</span></div>
                    <div class="sl"><?php echo $symbol; ?> ماندگاری : <span><?php echo $pack_info['shelf']; ?></span></div>
                    <div class="fee"><?php echo $symbol; ?> قیمت : <span><?php echo sep3($pack_info['pack_fee']); ?></span> تومان</div>
                    <div class="off"><?php echo $symbol; ?> با تخفیف : <span><?php echo sep3($pack_info['off']); ?></span> تومان</div>
                </div>

                <div class="radif" id="radif_part2">
                    <a class="btn btn-success" style="color:#fff" href="<?php echo $pack_info['link']; ?>" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z" />
                        </svg> خرید
                    </a>
                </div>
            </div>
        </div>

        <div class="part__">
            <div class="tag">
                <img src="img/attention.png" alt="attention">
                تمام محصولات پیشنهادی تولید شرکت بهارآرا با نام تجاری پرفیوم‌آراست.
            </div>
        </div>

        <div class="part_3">
            <div class="radif">
                <div class="offer_title">
                    روایح پیشنهادی
                </div>
                <div class="offer_pic">
                    <iframe src="slider.php?u=<?php echo $_GET['u']; ?>"></iframe>
                </div>
            </div>
        </div>

    </div>
</div>


<audio controls autoplay style="display: none;">
    <source src="<?php echo 'https://perfumeara.com/quiz/audio/' . $pack_info['style_id'] . '.mp3'; ?>" type="audio/mpeg">
    Your browser does not support the audio element.
</audio>

<!-- <video controls autoplay>
    <source src="<?php echo 'https://perfumeara.com/quiz/audio/' . $pack_info['style_id'] . '.mp3'; ?>" type="video/webm" />
</video> -->

<script src=" js/jquery-3.4.1.min.js"></script>
<script src="js/index.js"></script>
<script>
    $(document).ready(function() {});
</script>
<?php require_once('footer.php'); ?>
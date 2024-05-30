<!-- <div class="menulist">
    <div class="top_part">
        <div class="person_info">
            <div class="person_logo">
                <img src="" alt="دانیال نواری">
            </div>
            <div class="person_name">دانیال نواری</div>
            <div class="person_tel">09105005289</div>
        </div>
        <div class="person_rule">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
            </svg> نقش: بازاریاب <br>
            <div class="notif position-relative">

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger " style="display: none;">
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                    <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555ZM0 4.697v7.104l5.803-3.558L0 4.697ZM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757Zm3.436-.586L16 11.801V4.697l-5.803 3.546Z" />
                </svg>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger message" style="display: none;">
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-chat-dots-fill" viewBox="0 0 16 16">
                    <path d="M16 8c0 3.866-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.584.296-1.925.864-4.181 1.234-.2.032-.352-.176-.273-.362.354-.836.674-1.95.77-2.966C.744 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7zM5 8a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm4 0a1 1 0 1 0-2 0 1 1 0 0 0 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z" />
                </svg>

                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger message" style="display: none;">
                </span>
                <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16" onclick="open_page('logout')">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                </svg>
            </div>
        </div>
    </div>
    <div class="bottom_part"></div>
</div>

<script src="./js/jquery-3.4.1.min.js"></script>
<script>
    $('.img_logo').click(function() {
        let menu_left = $('.menulist').css('right');
        let left_pos = Number(menu_left.substring(0, 4));

        if (left_pos < 0) {
            $(".menulist").animate({
                    right: '0rem'
                }

                , 300);
            $('.items').css('opacity', '0.5');
        } else {
            $(".menulist").animate({
                    right: '-25rem'
                }

                , 300);
            $('.items').css('opacity', '1');
        }
    });

    $('.items').click(function() {
        $(".menulist").animate({
                right: '-25rem'
            }

            , 300);
        $('.items').css('opacity', '1');
        $('.open_bar').hide();
        $('.close_bar').show();

    });

    $('.page').click(function() {
        $(".menulist").animate({
                right: '-25rem'
            }

            , 300);
        $('.items').css('opacity', '1');
        $('.open_bar').hide();
        $('.close_bar').show();

    });
</script>

<script>
    document.getElementById('headTitle').innerHTML = '<?php echo $page_title; ?>';

    <?php
    if ($back == 1) {
        echo "$('.return_home').show();";
    } else {
        echo "$('.return_home').hide();";
    }
    ?>
</script> -->
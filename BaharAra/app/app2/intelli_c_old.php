<fieldset class='hor' style="height: inherit;" id="cdb_form">
    <legend>ثبت گزارش ویزیت</legend>
    <p style="padding: 0 0.3rem; font-size: 0.75rem;color: #FFC107;margin:0"></p>
    <span style="margin-top:1rem">نام فروشگاه / مسئول / منطقه را وارد کنید : </span>
    <br />
    <div>
        <input type="text" id="shop_field" class="form-control" />
        <input type="hidden" id="loc_id" class="form-control" value="<?php echo $_GET['loc']; ?>" />
        <input type="hidden" id="login_shop" class="form-control" value="<?php echo date('Y-m-d H:i:s'); ?>" />
        <input type="hidden" id="factor_id" class="form-control" value="<?php echo date('ymd') . date('His') . time(); ?>" />
    </div>
    <div class="button_pod">
        <button class="btn btn-success" id="search">جستجو</button>
        <button class="btn btn-primary" id="clear">پاک کردن</button>
        <button class="btn btn-danger" id="return" onclick="open_page('cbd')">بازگشت</button>
    </div>
    <span id="result_count">
        تعداد نتایج: <span id="r_count">0</span><br />
        (جمع مانده: <span id="jaam_region"></span> ریال)<br />
        (جمع تسویه نشده : <span id="jaam_mande"></span> ریال)<br />
    </span>

    <div class="customer_info" style="display:none">
        <span style="margin-top:1rem">نام فروشگاه : </span>
        <input type="text" id="shop_names" class="form-control" />
        <span>نام فروشگاه : </span>
        <div>
            <input type="text" id="shop_manager" class="form-control" />
        </div>
        <span>آدرس: </span>
        <div style="margin-bottom: 1rem;">
            <input type="text" id="shop_addr" class="form-control" />
        </div>
        <span>کدملی :</span>
        <div>
            <input type="tel" id="codem" class="form-control" />
        </div>
        <span>تلفن :</span>
        <div>
            <input type="tel" id="shop_tel" class="form-control" />
        </div>
        <input type="hidden" id="customer_type" value="old" />

    </div>

    <div class="customer_list"></div><br /><br />
</fieldset>

<div class="order_pos">
    <span class="buy_p">وضعیت خرید :</span>
    <div id="buy_pos">
        <button class="btn btn-warning" onclick="posi()">+</button>
        <button class="btn btn-warning" onclick="negi()">-</button><br />
    </div>
    <button class="btn btn-primary" id="return_customers">بازگشت</button>
</div>

<input type="hidden" id="user_svg" value='<svg xmlns=" http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-check" viewBox="0 0 16 16">
<path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7m1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0M8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
<path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1z" />
</svg>' />

<input type="hidden" id="loc_svg" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-geo-alt-fill" viewBox="0 0 16 16">
  <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
</svg>' />

<input type="hidden" id="store_svg" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-shop" viewBox="0 0 16 16">
  <path d="M2.97 1.35A1 1 0 0 1 3.73 1h8.54a1 1 0 0 1 .76.35l2.609 3.044A1.5 1.5 0 0 1 16 5.37v.255a2.375 2.375 0 0 1-4.25 1.458A2.371 2.371 0 0 1 9.875 8 2.37 2.37 0 0 1 8 7.083 2.37 2.37 0 0 1 6.125 8a2.37 2.37 0 0 1-1.875-.917A2.375 2.375 0 0 1 0 5.625V5.37a1.5 1.5 0 0 1 .361-.976l2.61-3.045zm1.78 4.275a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0 1.375 1.375 0 1 0 2.75 0V5.37a.5.5 0 0 0-.12-.325L12.27 2H3.73L1.12 5.045A.5.5 0 0 0 1 5.37v.255a1.375 1.375 0 0 0 2.75 0 .5.5 0 0 1 1 0M1.5 8.5A.5.5 0 0 1 2 9v6h1v-5a1 1 0 0 1 1-1h3a1 1 0 0 1 1 1v5h6V9a.5.5 0 0 1 1 0v6h.5a.5.5 0 0 1 0 1H.5a.5.5 0 0 1 0-1H1V9a.5.5 0 0 1 .5-.5M4 15h3v-5H4zm5-5a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-2a1 1 0 0 1-1-1zm3 0h-2v3h2z"/>
</svg>' />

<input type="hidden" id="mobile_svg" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-phone" viewBox="0 0 16 16">
  <path d="M11 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM5 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z"/>
  <path d="M8 14a1 1 0 1 0 0-2 1 1 0 0 0 0 2"/>
</svg>' />

<input type="hidden" id="minus" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle-dotted" viewBox="0 0 16 16">
  <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0M6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66m1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8M.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752m-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM4.5 7.5a.5.5 0 0 0 0 1h7a.5.5 0 0 0 0-1z"/>
</svg>' />

<input type="hidden" id="plus" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle-dotted" viewBox="0 0 16 16">
  <path d="M8 0c-.176 0-.35.006-.523.017l.064.998a7.117 7.117 0 0 1 .918 0l.064-.998A8.113 8.113 0 0 0 8 0M6.44.152c-.346.069-.684.16-1.012.27l.321.948c.287-.098.582-.177.884-.237L6.44.153zm4.132.271a7.946 7.946 0 0 0-1.011-.27l-.194.98c.302.06.597.14.884.237l.321-.947zm1.873.925a8 8 0 0 0-.906-.524l-.443.896c.275.136.54.29.793.459l.556-.831zM4.46.824c-.314.155-.616.33-.905.524l.556.83a7.07 7.07 0 0 1 .793-.458zM2.725 1.985c-.262.23-.51.478-.74.74l.752.66c.202-.23.418-.446.648-.648l-.66-.752zm11.29.74a8.058 8.058 0 0 0-.74-.74l-.66.752c.23.202.447.418.648.648l.752-.66m1.161 1.735a7.98 7.98 0 0 0-.524-.905l-.83.556c.169.253.322.518.458.793l.896-.443zM1.348 3.555c-.194.289-.37.591-.524.906l.896.443c.136-.275.29-.54.459-.793l-.831-.556zM.423 5.428a7.945 7.945 0 0 0-.27 1.011l.98.194c.06-.302.14-.597.237-.884l-.947-.321zM15.848 6.44a7.943 7.943 0 0 0-.27-1.012l-.948.321c.098.287.177.582.237.884l.98-.194zM.017 7.477a8.113 8.113 0 0 0 0 1.046l.998-.064a7.117 7.117 0 0 1 0-.918l-.998-.064zM16 8a8.1 8.1 0 0 0-.017-.523l-.998.064a7.11 7.11 0 0 1 0 .918l.998.064A8.1 8.1 0 0 0 16 8M.152 9.56c.069.346.16.684.27 1.012l.948-.321a6.944 6.944 0 0 1-.237-.884l-.98.194zm15.425 1.012c.112-.328.202-.666.27-1.011l-.98-.194c-.06.302-.14.597-.237.884l.947.321zM.824 11.54a8 8 0 0 0 .524.905l.83-.556a6.999 6.999 0 0 1-.458-.793l-.896.443zm13.828.905c.194-.289.37-.591.524-.906l-.896-.443c-.136.275-.29.54-.459.793l.831.556zm-12.667.83c.23.262.478.51.74.74l.66-.752a7.047 7.047 0 0 1-.648-.648l-.752.66zm11.29.74c.262-.23.51-.478.74-.74l-.752-.66c-.201.23-.418.447-.648.648l.66.752m-1.735 1.161c.314-.155.616-.33.905-.524l-.556-.83a7.07 7.07 0 0 1-.793.458l.443.896zm-7.985-.524c.289.194.591.37.906.524l.443-.896a6.998 6.998 0 0 1-.793-.459l-.556.831zm1.873.925c.328.112.666.202 1.011.27l.194-.98a6.953 6.953 0 0 1-.884-.237l-.321.947zm4.132.271a7.944 7.944 0 0 0 1.012-.27l-.321-.948a6.954 6.954 0 0 1-.884.237l.194.98zm-2.083.135a8.1 8.1 0 0 0 1.046 0l-.064-.998a7.11 7.11 0 0 1-.918 0l-.064.998zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3z"/>
</svg>' />

<input type="hidden" id="zaman_" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-calendar-check" viewBox="0 0 16 16">
  <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
  <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4z"/>
</svg>' />

<input type="hidden" id="star" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
  <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
</svg>' />

<input type="hidden" id="star_" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-half" viewBox="0 0 16 16">
  <path d="M5.354 5.119 7.538.792A.52.52 0 0 1 8 .5c.183 0 .366.097.465.292l2.184 4.327 4.898.696A.54.54 0 0 1 16 6.32a.55.55 0 0 1-.17.445l-3.523 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256a.5.5 0 0 1-.146.05c-.342.06-.668-.254-.6-.642l.83-4.73L.173 6.765a.55.55 0 0 1-.172-.403.6.6 0 0 1 .085-.302.51.51 0 0 1 .37-.245zM8 12.027a.5.5 0 0 1 .232.056l3.686 1.894-.694-3.957a.56.56 0 0 1 .162-.505l2.907-2.77-4.052-.576a.53.53 0 0 1-.393-.288L8.001 2.223 8 2.226z"/>
</svg>' />

<input type="hidden" id="star__" value='<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
  <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.56.56 0 0 0-.163-.505L1.71 6.745l4.052-.576a.53.53 0 0 0 .393-.288L8 2.223l1.847 3.658a.53.53 0 0 0 .393.288l4.052.575-2.906 2.77a.56.56 0 0 0-.163.506l.694 3.957-3.686-1.894a.5.5 0 0 0-.461 0z"/>
</svg>' />

<div id="no_result">
    <h6>هیچ نتیجه ای پیدا نشد</h6>
</div>

<script>
    function select_shop(tt) {
        let x = $('#c' + tt).val();
        let manager = $('#m' + tt).val();
        let shop = $('#s' + tt).val();
        let addr = $('#a' + tt).val();
        let tel = $('#t' + tt).val();

        $('#shop_manager').val(manager);
        $('#shop_addr').val(addr);
        $('#shop_tel').val(tel);
        $('#shop_names').val(shop);
        $('#codem').val(x);

        $('fieldset').hide();
        $('#return_customers').show();
        $('#order_pos').css('z-index', '9');
    }

    $('#negetive').click(function() {
        if (
            $("#shop_names").val() == "" ||
            $("#shop_manager").val() == "" ||
            $("#shop_tel").val() == "" ||
            $("#customer_type").val() == ""
        ) {
            alert("لطفا همه فیلد ها را تکمیل کنید");
        } else {
            var loc = $("#loc_id").val();
            if (loc > 0) {
                loc = $("#loc_id").val();
            } else {
                loc = 0;
            }
        }
    });

    $('#clear').click(function() {
        $('#shop_field').val('');
        $('.customer_list').html('');
        $('#r_count').text('0');
        $('#jaam_mande').text('0');
        $('#jaam_region').text('0');
    });

    $('#search').click(function() {
        let search = $('#shop_field').val();
        let users = $('#user_svg').val();
        let loc = $('#loc_svg').val();
        let tel = $('#mobile_svg').val();
        let store = $('#store_svg').val();
        let plus = $('#plus').val();
        let minus = $('#minus').val();
        let zaman = $('#zaman_').val();
        let star = $('#star').val();
        let star_ = $('#star_').val();
        let star__ = $('#star__').val();

        $.ajax({
            url: 'server.php',
            data: 'search=' + search,
            method: 'GET',
            success: function(result) {
                $('.customer_list').html('');
                const obj = JSON.parse(result);
                let tedad = obj.length;
                $('#r_count').text(tedad);
                let sc = '';
                let color_ = '';
                let jam_region = 0;
                if (obj[0]['num'] > 0) {
                    $('#no_result').hide();
                    for (i = 0; i < tedad; i++) {
                        let rotbe = Math.round(obj[i]['score'] / 50000000, 0);
                        let kasr = Math.round(obj[i]['real_bed'] / 50000000, 0);
                        let final_score = (rotbe - kasr) / (rotbe + kasr);
                        $('#jaam_region').text(obj[i]['region']);
                        $('#jaam_mande').text(obj[i]['remain_cash1']);

                        switch (true) {
                            case parseInt(final_score) < 0:
                                sc = star;
                                color_ = '#FF5722'; //red
                                break;
                            case parseInt(final_score) == 0:
                                sc = star__;
                                color_ = '#ffd700'; //red
                                break;
                            case parseInt(final_score) == 1:
                                sc = star_;
                                color_ = '#ffd700'; //gold half
                                break;
                            case parseInt(final_score) == 2:
                                sc = star;
                                color_ = '#ffd700';
                                break;
                            case parseInt(final_score) == 3:
                                sc = star + star_;
                                color_ = '#ffd700';
                                break;
                            case parseInt(final_score) == 4:
                                sc = star + star;
                                color_ = '#ffd700';
                                break;
                            case parseInt(final_score) == 5:
                                sc = star + star + star;
                                color_ = '#ffd700';
                                break;
                            case parseInt(final_score) == 6:
                                sc = star + star + star + star;
                                color_ = '#ffd700';
                                break;
                            case parseInt(final_score) > 6:
                                sc = star + star + star + star + star;
                                color_ = '#ffd700';
                                break;
                            case final_score.toString() == NaN:
                                sc = star + star + star;
                                color_ = '#00BCD4';
                                break;
                            case final_score.toString() == 'undefined':
                                sc = star__;
                                color_ = '#FF5722';
                                break;
                        }

                        if (obj[i]['moshtari_mande'] > 0) {
                            bed_type = 'بدهکار: ';
                        } else {
                            bed_type = 'بستانکار: ';
                        }

                        j = i + 1;
                        $('.customer_list').append('<tr><td>' + ' ' + j + '- ' + obj[i]['name'] + '</td></tr><tr><td>' + loc + ' ' + obj[i]['addr'] + '</td></tr>');
                        $('.customer_list').append('<tr><td>' + store + ' ' + obj[i]['shop'] + ' </td></tr><tr><td style="font-size: 0.8rem;">' + tel + ' ' + obj[i]['tel'] + '</td></tr><tr><td>' + zaman + ' ' + obj[i]['tarikh'] + '</td></tr>');
                        $('.customer_list').append('<tr><td>' + minus + ' تسویه نشده : ' + obj[i]['remain_cash'] + '</td></tr><tr><td class="bed">' + bed_type + obj[i]['bed'] + '</td></tr>');
                        $('.customer_list').append('<input type="hidden" id="c' + i + '" value="' + obj[i]["code"] + '"/>')
                        $('.customer_list').append('<input type="hidden" id="m' + i + '" value="' + obj[i]["name"] + '"/>')
                        $('.customer_list').append('<input type="hidden" id="a' + i + '" value="' + obj[i]["addr"] + '"/>')
                        $('.customer_list').append('<input type="hidden" id="t' + i + '" value="' + obj[i]["tel"] + '"/>')
                        $('.customer_list').append('<input type="hidden" id="s' + i + '" value="' + obj[i]["shop"] + '"/>')
                        $('.customer_list').append('<tr><td style="border-bottom: 1px solid silver;width:80vw"><button class="btn btn-info" onclick="select_shop(' + i + ')">انتخاب</button></td></tr>');
                    }
                } else {
                    $('#no_result').show();
                }

                $("td:contains('" + search + "')").css('color', 'yellow');
            }
        });

    });

    function customer(x) {
        if (x == 1) {
            $("#customer_type").val("new");
        } else {
            $("#customer_type").val("old");
        }
    }

    $('#return_customers').click(function() {
        $('#order_pos').css('z-index', '-1');
        $('fieldset').show();
        $('#return_customers').hide();
    });

    function negi() {
        orders(0);
        $(".return_home").hide();
    }

    function posi() {
        orders(1);
        $(".return_home").hide();
    }

    function orders(btn_pos) {
        if (btn_pos == 0) {
            buy_pos = "-";
        } else {
            buy_pos = "+";
        }

        var loc = $("#loc_id").val();
        if (loc > 0) {
            loc = $("#loc_id").val();
        } else {
            loc = 0;
        }
        $.ajax({
            type: "GET",
            url: "server.php",
            data: {
                order: "ok",
                shop_name: $("#shop_names").val(),
                shop_manager: $("#shop_manager").val(),
                loc_id: loc,
                login: $("#login_shop").val(),
                shop_tel: $("#shop_tel").val(),
                customer_type: $("#customer_type").val(),
                buy_pos: buy_pos,
                factor_id: $("#factor_id").val(),
                codem: $("#codem").val(),
                addr: $("#shop_addr").val(),
            },
            success: function(data) {
                if (btn_pos == 1) {
                    /* $("#factor_1").show();
                    $("#cdb_form").hide();
                    $("#visit_result").hide(); */
                    open_page('visit', 'f', 'ok', '1', false);
                } else {
                    $("#digital_sign").show();
                    $("#visit_result").hide();
                    $("#cdb_form").hide();
                    open_page('p_sign');
                }
            },
        });

    }
</script>

<style>
    #no_result {
        display: none;
        color: #fff;
        text-align: center;
    }

    svg:hover {
        color: gold;
    }

    .grade {
        color: gold;
        width: 1.3rem;
        height: 1.3rem;
    }

    .page {
        margin-bottom: 2rem;
    }

    td {
        padding: 0.2rem;
        font-size: 0.9rem;
    }

    span#result_count {
        padding: 0.5rem;
        background: #424242;
        width: 100%;
        text-align: right;
    }

    .button_pod {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: flex-end;
        gap: 1rem;
        margin-bottom: 1rem;
        flex-wrap: nowrap;
    }

    button#return {
        margin-top: 0.5rem;
    }

    #return_customers {
        display: none;
    }

    .bes {
        color: #8bc34a;
    }

    .bed {
        color: #FF9800;
        background: #000;
        text-align: center;
        border-radius: 1rem;
    }

    .btn-info {
        color: #fff;
        background-color: #009688;
        border-color: #009688;
        height: 2rem;
        border-radius: 0.2rem;
        margin: 0.2rem auto;
        padding: 0.4rem;
    }

    .order_pos {
        z-index: -1;
        position: absolute;
        top: 0;
        right: 0;
        width: 100%;
        height: 100vh;
        padding: 13rem 1rem;
        background-color: #525254;
    }

    .buy_p {
        width: 100%;
        color: #fff;
        text-align: center;
        display: block;
    }
</style>
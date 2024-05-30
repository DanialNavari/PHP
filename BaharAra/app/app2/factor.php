<?php require_once('public_css.php');
include_once('func.php');
?>
<div class="full_screen">
    <img src="" alt="" id="img_full">
</div>

<div class="show_factor" style="display: none;"></div>

<div class="abstract_factor">
    <?php
    $info = getInfo($_COOKIE['uid']);
    $factor_detail = get_factor_by_cat($info['factor_id'], $_GET['cat']);
    ?>
    <table>
        <tr>
            <th colspan="3"><?php echo get_parent_name($_GET['cat']); ?></th>
        </tr>
        <tr style="border-bottom: 1px dashed silver;">
            <td style="border-right: 1px dashed silver;">تعداد : <span id="factor_tedad">
                    <?php echo $factor_detail['tedad']; ?>
                </span>
                <input id="temp_tedad" value="0" style="display:none" />
                <input id="temp_offer" value="0" style="display:none" />
            </td>
            <td>آفر : <span id="factor_offer">
                    <?php echo $factor_detail['offer']; ?>
                </span>
            </td>
            <td>تستر : <span id="factor_tester">
                    <?php echo $factor_detail['tester']; ?>
                </span>
            </td>
        </tr>
    </table>
</div>
<div id="prod_selected" style="display:none">
    <?php
    if ($factor_detail['id']) {
        $c = count($factor_detail['id']);
        $x = '';
        for ($m = 0; $m < $c; $m++) {
            $x .= $factor_detail['id'][$m]['pid'] . ',';
            $x .= $factor_detail['id'][$m]['tedad'] . ',';
            $x .= $factor_detail['id'][$m]['offer'] . ',';
            $x .= $factor_detail['id'][$m]['tester'] . '#';
        }
        echo $x;
    }
    ?>
</div>

<?php get_prod($_GET['cat']);  ?>

<script>
    $("button[id*='del_order']").hide();
    $('.final_pay_btn').css('display', 'flex');
    $('#return_cat').css('display', 'inline');
</script>

<span id="scroll" style="display:none"></span>
<span id="both" style="display:none"><?php echo $info['both']; ?></span>

<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php');
?>

<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
<script src="./js/index.js"></script>
<script>
    var prod_selected = $('#prod_selected').text().trim();
    var sep = prod_selected.split('#');
    for (i = 0; i < sep.length - 1; i++) {
        var sepp = sep[i].split(',');
        var div_code = sepp[0].trim();
        $('#div' + div_code).css('background', '#ffc10763');

        $('#n' + sepp[0]).val(sepp[1]);
        $('#o' + sepp[0]).val(sepp[2]);
        $('#t' + sepp[0]).val(sepp[3]);

        $('#n' + sepp[0]).css('background-color', '#ffc107');
        $('#o' + sepp[0]).css('background-color', '#ffc107');
        $('#t' + sepp[0]).css('background-color', '#ffc107');
        $('#t' + sepp[0]).css('background-color', '#ffc107');
        $('#btn_order' + sepp[0]).css('background-color', '#ffc107');

        $('#del_order' + sepp[0]).show();

    }

    document.getElementsByClassName("page").onscroll = function() {
        myFunction()
    };

    function myFunction() {
        var scrol = document.getElementsByClassName("page").scrollTop;
        alert(scrol);

        var scrola = document.getElementById("all_prod").scrollTop;
        alert(scrola);

        document.getElementById("scroll").innerHTML = scrol;
    }

    function cal_price_with_offer(id, line) {

        numbers = $("#n" + id).val();
        offers = $("#o" + id).val();
        testers = $("#t" + id).val();
        price = $("#e" + id).text();
        //testers_cmil = $("#cmil" + id).val();
        //testers_smil = $("#smil" + id).val();


        if (line == 5) {
            insta_less = $("#insta_less" + id).val();
            totall =
                (parseInt(numbers) * parseInt(price));
            totalm =
                (parseInt(numbers) * parseInt(price)) - ((parseInt(numbers) * parseInt(price)) * insta_less / 100);
            $("#l" + id).text(parseInt(totall));
            $("#m" + id).text(parseInt(0));
        } else {
            totall =
                (parseInt(numbers) * parseInt(price)) /
                (parseInt(numbers) + parseInt(offers));
            totalm =
                (parseInt(numbers) * parseInt(price)) /
                (parseInt(numbers) + parseInt(offers) + parseInt(testers));
            $("#l" + id).text(parseInt(totall));
            $("#m" + id).text(parseInt(0));

        }


        if (numbers > 0) {
            $('#n' + id).css('background-color', '#ffc107');
        }

        if (offers > 0) {
            $('#o' + id).css('background-color', '#ffc107');
        }

        if (testers > 0) {
            $('#t' + id).css('background-color', '#ffc107');
        }
    }

    function save_orders(x, y) {
        var tedad_ = String($("#n" + x).val());
        var offer_ = String($("#o" + x).val());
        var tester_ = String($("#t" + x).val());
        var temp_tedad = String($("#temp_tedad").val());
        var temp_offer = String($("#temp_offer").val());
        var both = $("#both").text();

        if (tedad_ == '0' || tedad_ == 'NaN' || tedad_ == '' || typeof(tedad_) == NaN) {
            tedad_ = 0;
        } else {
            tedad_ = parseInt(tedad_);
        }

        if (offer_ == '0' || offer_ == 'NaN' || offer_ == '' || typeof(offer_) == NaN) {
            offer_ = 0;
        } else {
            offer_ = parseInt(offer_);
        }

        let mojudi_show = parseInt($("#re" + x).text()) - tedad_ - offer_;

        var jaam = 0;
        var t_t = 0;
        var o_o = 0;

        if (tedad_ == temp_tedad) {
            t_t = 0;
        } else {
            $("#temp_tedad").val(tedad_);
            t_t = tedad_;
        }

        if (offer_ == temp_offer) {
            o_o = 0;
        } else {
            $("#temp_offer").val(offer_);
            o_o = offer_;
        }

        jaam = parseInt(o_o) + parseInt(t_t);
        if (both == 1) {
            jaam = 0;
        }
        $.ajax({
            data: 'mojudi=ok&code=' + x + '&num=' + jaam,
            url: 'server.php',
            type: 'GET',
            success: function(result) {
                if (both == 1) {
                    resulto = 99999;
                } else {
                    resulto = result;
                }
                if (y == 15 || y == 14 || y == 13 || resulto > 0 || both == 1 || result > 0) {
                    if ($("#o" + x).val() == "") {
                        $("#o" + x).val(0);
                        cal_price_with_offer(x, 0);
                    }

                    if ($("#n" + x).val() == "") {
                        $("#n" + x).val(0);
                        cal_price_with_offer(x, 0);
                    }

                    if ($("#t" + x).val() == "") {
                        $("#t" + x).val(0);
                        cal_price_with_offer(x, 0);
                    }

                    if ($("#insta_less" + x).val() == "") {
                        $("#insta_less" + x).val(0);
                        cal_price_with_offer(x, 5);
                    } else {
                        cal_price_with_offer(x, 5);
                    }

                    //testers_cmil = $("#cmil" + x + ":checked").val();
                    //testers_smil = $("#smil" + x + ":checked").val();

                    if (y == 6 || y == 5) {
                        $.ajax({
                            type: "GET",
                            url: "https://perfumeara.com/webapp/app2/server.php",
                            data: {
                                factor: "ok",
                                code: x,
                                tedad: $("#n" + x).val(),
                                offer: $("#o" + x).val(),
                                tester: $("#t" + x).val(),
                                base_fee: $("#e" + x).text(),
                                final_fee: $("#m" + x).text(),
                                cat: y,
                                tester_type: y
                            },
                            success: function(result) {
                                if (result == 1) {

                                    $(".result_pos").removeClass("bg-danger");
                                    $(".result_pos").addClass("bg-success");
                                    $(".result_pos").html("سفارش با موفقیت ثبت شد");
                                    $(".result_pos").show();
                                    $(".final_pay_btn").css("display", "flex");
                                    $("#del_order" + x).css("display", "");
                                    setTimeout(function() {
                                        $(".result_pos").hide();
                                    }, 2000);

                                    $.ajax({
                                        type: "GET",
                                        url: "https://perfumeara.com/webapp/app2/server.php",
                                        data: {
                                            basket_update: 'ok',
                                            cat: y
                                        },
                                        success: function(result) {
                                            var rr = JSON.parse(result);
                                            $('#factor_tedad').html(rr['tedad']);
                                            $('#factor_offer').html(rr['offer']);
                                            $('#factor_tester').html(rr['tester']);
                                        }
                                    });

                                    $('#div' + x).css('background-color', '#ffc10763');
                                    $('#btn_order' + x).removeClass('btn-default');
                                    $('#del_order' + x).removeClass('btn-default');
                                    $('#btn_order' + x).addClass('btn-warning');
                                    $('#del_order' + x).addClass('btn-warning');
                                }
                            },
                        });
                    } else {
                        insta_offs = $("#insta_less" + x).val();
                        if (insta_offs > 0) {
                            insta_offs = $("#insta_less" + x).val();
                        } else {
                            insta_offs = 0;
                        }
                        $.ajax({
                            type: "GET",
                            url: "https://perfumeara.com/webapp/app2/server.php",
                            data: {
                                factor: "ok",
                                code: x,
                                tedad: $("#n" + x).val(),
                                offer: $("#o" + x).val(),
                                tester: $("#t" + x).val(),
                                base_fee: $("#e" + x).text(),
                                final_fee: $("#m" + x).text(),
                                cat: y,
                                tester_type: '',
                                insta_off: insta_offs,
                            },
                            success: function(result) {
                                if (result == 1) {

                                    $(".result_pos").removeClass("bg-danger");
                                    $(".result_pos").addClass("bg-success");
                                    $(".result_pos").html("سفارش با موفقیت ثبت شد");
                                    $(".result_pos").show();
                                    $(".final_pay_btn").css("display", "flex");
                                    $("#del_order" + x).css("display", "");
                                    setTimeout(function() {
                                        $(".result_pos").hide();
                                    }, 2000);

                                    $.ajax({
                                        type: "GET",
                                        url: "https://perfumeara.com/webapp/app2/server.php",
                                        data: {
                                            basket_update: 'ok',
                                            cat: y
                                        },
                                        success: function(result) {
                                            var rr = JSON.parse(result);
                                            $('#factor_tedad').html(rr['tedad']);
                                            $('#factor_offer').html(rr['offer']);
                                            $('#factor_tester').html(rr['tester']);
                                        }
                                    });

                                    $('#div' + x).css('background-color', '#ffc10763');
                                    $('#btn_order' + x).removeClass('btn-default');
                                    $('#del_order' + x).removeClass('btn-default');
                                    $('#btn_order' + x).addClass('btn-warning');
                                    $('#del_order' + x).addClass('btn-warning');
                                }
                            },
                        });
                    }
                    $('#re' + x).text(String(mojudi_show));
                } else {
                    alert('تعداد وارد شده بیشتر از موجودی انبار می باشد');
                    var aa = $("#re" + x).text();
                    if (aa == 0) {
                        $('#n' + x).val('');
                        $('#o' + x).val('');
                        $('#t' + x).val('');
                    }

                    $('#n' + x).css('background-color', '#fff');
                    $('#o' + x).css('background-color', '#fff');
                    $('#t' + x).css('background-color', '#fff');
                    $('#n' + x).focus();
                }
            }
        });

    }

    function del_order(x) {
        let text = "آیا می خواهید سفارشی که ثبت شده را حذف کنید؟";
        if (confirm(text) == true) {
            $.ajax({
                type: "GET",
                url: "https://perfumeara.com/webapp/app2/server.php",
                data: {
                    basket: "ok",
                    code: x,
                },
                success: function(result) {
                    $(".result_pos").removeClass("bg-success");
                    $(".result_pos").addClass("bg-danger");
                    $(".result_pos").html("سفارش حذف شد");
                    $(".result_pos").show();
                    setTimeout(function() {
                        $(".result_pos").hide();
                    }, 2000);
                    if (result >= 0) {
                        $("#del_order" + x).css("display", "none");
                        $("#re" + x).text(result);
                    }

                    var factor_tedad = $('#factor_tedad').html();
                    var factor_offer = $('#factor_offer').html();
                    var factor_tester = $('#factor_tester').html();

                    var nx = $('#n' + x).val();
                    var ox = $('#o' + x).val();
                    var tx = $('#t' + x).val();

                    $('#factor_tedad').html(factor_tedad - nx);
                    $('#factor_offer').html(factor_offer - ox);
                    $('#factor_tester').html(factor_tester - tx);
                    let mojudi_show = parseInt($("#re" + x).text()) + (parseInt(nx) + parseInt(ox));

                    $('#n' + x).val('');
                    $('#o' + x).val('');
                    $('#t' + x).val('');
                    $('#insta_less' + x).val('');

                    $('#n' + x).css('background-color', '#fff');
                    $('#o' + x).css('background-color', '#fff');
                    $('#t' + x).css('background-color', '#fff');
                    $('#div' + x).css('background-color', '#525254');

                    $('#btn_order' + x).removeClass('btn-warning');
                    $('#del_order' + x).removeClass('btn-warning');
                    $('#btn_order' + x).addClass('btn-default');
                    $('#del_order' + x).addClass('btn-default');
                },
            });
        }
    }

    //document.getElementsByName('tester_type').checked = true;
</script>

<style>
    .form-check-input {
        width: 1rem;
        height: 1rem;
    }
</style>
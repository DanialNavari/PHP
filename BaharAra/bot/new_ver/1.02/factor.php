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
<?php get_prod($_GET['cat']); ?> <script>
    $("button[id*='del_order']").hide();
    $('.final_pay_btn').css('display', 'flex');
    $('#return_cat').css('display', 'inline');
</script>
<span id="scroll" style="display:none"></span>
<?php
$page_title = '<b style="color:#94f14f">C</b>ustomers <b style="color:#94f14f">B</b>usiness <b style="color:#94f14f">D</b>evelopment';
$back = 1;
require_once('slider.php'); ?> <input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />
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
        $('#del_order' + sepp[0]).css('background-color', '#ffc107');

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
</script>
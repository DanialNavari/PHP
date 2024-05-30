<?php require_once('public_css.php');
include_once('func.php');
error_reporting(1);
?>
<div class="full_screen">
    <img src="" alt="" id="img_full">
</div>

<br />
<br />
<br />
<button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
<h5>موجودی ضد عفونی کننده</h5>
<?php get_prod_kasriii(); ?>

<?php
$back = 1;
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

<style>
    .kasri_title {
        padding: 0.5rem;
        background: #FF9800;
    }

    h5 {
        text-align: center;
        padding-top: 1rem;
        color: #fff;
    }
</style>
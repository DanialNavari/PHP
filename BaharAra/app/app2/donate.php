<?php require_once('public_css.php');
include_once('func.php');
?>

<div class=" items">
    <fieldset>
        <legend>درخواست مساعده</legend>
        <table>
            <tr>
                <td>
                    مبلغ مساعده (ریال) :
                    <input type="number" class="form-control" id="donate_fee" value="" onkeypress="seprat()" />
                    <br />
                    <span id="numsep">0</span> تومان
                </td>
            </tr>
        </table>
    </fieldset>
    <fieldset id="opr">
        <button class="btn btn-success" id="save" onclick="save()">ذخیره</button>
        <button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>
    </fieldset>
</div>

<?php
$back = 1;
require_once('slider.php'); ?>
<input type=" hidden" id="uid" value="<?php echo $_COOKIE['uid']; ?>" />

<script src="./js/index.js"></script>
<script>
    function save() {
        let donate_fee = $('#donate_fee').val();
        let mission_name = 'مساعده';
        if (donate_fee == '' || donate_fee <= 0) {
            alert('لطفا مبلغ مساعده را وارد کنید');
        } else {
            $.ajax({
                data: 'donate=' + mission_name + '&fee=' + donate_fee,
                url: 'server.php',
                type: 'GET',
                success: function(result) {
                    if (result == 1) {
                        alert('برگه مساعده شما با موفقیت ثبت شد');
                        window.location.reload();
                    }
                }
            });
        }
    }

    function seprat() {
        let donate_fee = $('#donate_fee').val();
        const numbers = new Intl.NumberFormat('en-US', {
            style: "decimal"
        }).format(donate_fee);
        $('#numsep').text(numbers);
    }
</script>

<style>
    #masir_field,
    #opr {
        margin-top: 0.6rem;
    }

    #opr {
        display: flex;
        flex-direction: column;
        align-items: stretch;
        gap: 0.5rem;
    }

    .month-grid-box .header {
        display: none;
    }

    fieldset {
        height: max-content;
    }

    .v3 svg {
        color: #fff;
    }

    .v3 {
        width: 100%;
        height: 2rem;
        margin-bottom: 0.5rem;
        background: #024f59;
        color: #fff;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
        align-items: stretch;
        gap: 0.2rem;
    }

    .show_date {
        display: block;
    }

    .range-from-example,
    .range-to-example {
        display: none;
        margin-bottom: 0.3rem;
    }

    select {
        width: 90% !important;
        font-size: 0.9rem;
    }

    #route {
        font-size: 0.7rem;
        width: 90%;
        padding: 0.3rem;
        display: flex;
        align-items: center;
        flex-wrap: nowrap;
        flex-direction: row;
        gap: 0.4rem;
        overflow: scroll;
    }

    fieldset {
        display: flex;
        flex-direction: column;
    }

    .gt {
        color: #fd1f1f;
        padding: 0.1rem;
        font-weight: bold;
        margin-left: 0.1rem;
    }

    .items {
        margin-bottom: -4rem;
        margin-top: 3rem;
    }

    table {
        width: 90%;
    }

    td {
        text-align: center;
        padding: 0.2rem;
        font-size: 0.9rem;
    }

    select {
        font-size: 0.9rem;
    }

    #start_from_en,
    #end_to_en,
    #start_unix,
    #end_unix {
        display: none;
    }

    #mission_name {
        width: 90%;
    }

    .pelak {
        display: flex;
        flex-direction: row-reverse;
        align-items: stretch;
        gap: 0.4rem;
        flex-wrap: nowrap;
    }

    .pelak input,
    .pelak select {
        text-align: center;
    }

    h5,
    .h5 {
        font-size: 0.9rem;
    }

    button#addCity {
        width: 19.2rem;
        border-radius: 0.2rem;
        margin-top: -0.3rem;
        margin-bottom: 0.5rem;
    }

    .route_box {
        background: #E0E0E0;
        width: fit-content;
        height: 2.6rem;
        padding: 0.3rem;
        border-radius: 0.2rem;
        color: #024f59;
        font-weight: bold;
        display: flex;
        align-items: center;
    }

    .btn-close {
        background: transparent url("img/close.png") center/1em auto no-repeat;
        width: 0.7rem;
        height: 0.7rem;
        outline: none;
        border: none;
        cursor: pointer;
        float: right;
        padding: 0.5rem;
        margin-left: 0.2rem;
    }

    a.btn.btn-info.btn-return.v3.toggle_from {
        border-radius: 0.3rem;
    }
</style>
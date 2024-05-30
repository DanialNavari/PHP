<?php
include_once('func.php');
$x = getInfo1($_COOKIE['uid']);
if ($x['manager'] == 1) {
    $nama = '<button class="btn btn-warning" id="nama_">
    <svg width="32" height="32" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-raised-hand" viewBox="0 0 16 16">
  <path d="M6 6.207v9.043a.75.75 0 0 0 1.5 0V10.5a.5.5 0 0 1 1 0v4.75a.75.75 0 0 0 1.5 0v-8.5a.25.25 0 1 1 .5 0v2.5a.75.75 0 0 0 1.5 0V6.5a3 3 0 0 0-3-3H6.236a1 1 0 0 1-.447-.106l-.33-.165A.83.83 0 0 1 5 2.488V.75a.75.75 0 0 0-1.5 0v2.083c0 .715.404 1.37 1.044 1.689L5.5 5c.32.32.5.754.5 1.207"/>
  <path d="M8 3a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
</svg>
    نماینده شرکت</button>';
} else {
    $nama = '';
}


?>
<style>
    .result_pos {
        display: none;
    }

    div#buy_pos {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 1rem;
        margin: 2rem;
    }

    legend {
        font-size: 1rem;
    }
</style>
<fieldset class='hor' style="height: inherit;" id="cdb_form">
    <legend>ثبت ویزیت</legend>

    <div id="buy_pos">
        <button class="btn btn-warning" id="new_">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-plus-fill" viewBox="0 0 16 16">
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                <path fill-rule="evenodd" d="M13.5 5a.5.5 0 0 1 .5.5V7h1.5a.5.5 0 0 1 0 1H14v1.5a.5.5 0 0 1-1 0V8h-1.5a.5.5 0 0 1 0-1H13V5.5a.5.5 0 0 1 .5-.5" />
            </svg>
            مشتری جدید</button>
        <button class="btn btn-warning" id="old_">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-person-check-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15.854 5.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L12.5 7.793l2.646-2.647a.5.5 0 0 1 .708 0z" />
                <path d="M1 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
            </svg>
            مشتری قدیم</button>
        <?php echo $nama; ?>

    </div>
</fieldset>
<button class="btn btn-info" id="return" onclick="open_page('enter')">بازگشت</button>


<script>
    $('#new_').click(function() {
        open_page('visit', 'c', 'ok', 1, true);
    });

    $('#old_').click(function() {
        open_page('visit', 'int', 'ok', 1, true);
    });

    $('#nama_').click(function() {
        open_page('visit', 'nama', 'ok', 1, true);
        $('#nama_pos').val(1);
    });
</script>
<?php require_once('public_css.php'); ?>

<div class="items">
    <fieldset class='hor'>
        <legend>تیر 1402</legend>
        <div class="progress" style="width: 90%;flex-direction: row-reverse;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-success" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100" style="width: 10%">10%</div>
        </div>
        <br>
        <h6>تارگت:
            <span id="target">190/000/000</span> تومان
        </h6>
        <h6>محقق شده:
            <span id="resid">19/000/000</span> تومان
        </h6>
    </fieldset>
</div>



<?php
$page_title = 'تارگت ماهانه';
$back = 1;
require_once('slider.php'); ?>
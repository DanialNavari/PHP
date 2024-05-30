<div class=" row" style="width: max-content; margin: 0 auto;">
    <form method="get" action="acc_cbd.php" class="print">
        <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
        <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
        <button type="submit" class="btn btn-warning">نمایش</button>
        <button>
            <a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a>
        </button>
        <button>
            <a href="" class="btn btn-info">روز قبل</a>
        </button>
        <button>
            <a href="" class="btn btn-info">روز بعد</a>
        </button>
    </form>
</div>
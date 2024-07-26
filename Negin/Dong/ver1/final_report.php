<div class="mt-3-r">
<?php
    require_once("symbol.php");
    require_once("main_top.php");
    require_once("func.php");

    if (isset($_GET['id'])) {
        $x = final_report1($_GET['id']);
    }

    ?>

    <table class="table w-100">
        <tr>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">ردیف</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">نام</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">خرج</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">سهم</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">واریزی</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">دریافتی</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">مانده</td>
            <td class="td_title_ font-weight-bold text-center text-prime d-rtl va_middle">وضعیت</td>
        </tr>

        <?php echo $x;?>
    </table>
</div>


<style>
    td {
        font-size: 0.8rem;
    }

    .banner_move {
        width: 97%;
        text-align: center;
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: center;
        align-items: center;
        height: inherit;
    }

    .mt-3-r {
        margin-top: 3rem;
        padding: 1rem;
    }

    .bl {
        border-left: 1px solid #dee2e6;
        border-right: 1px solid #dee2e6;
    }

    .bt {
        border-top: 1px solid #dee2e6;
    }

    #my_local_name::before {
        content: "(";
    }

    #my_local_name::after {
        content: ")";
    }

    h6 {
        margin-right: 0.2rem;
    }

    td{
        border: none;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<textarea id="file_html" class="force_hide"></textarea>

<script>
    $("document").ready(function() {
        $("#my_local_name").removeClass("d_inline");
        $("#my_local_name").text("گزارش جامع پایان دوره");
        $(".click1").remove();
        $(".headers div").addClass("banner_move");
        body = $("html").html();
        $("#file_html").val(body);
    });
</script>


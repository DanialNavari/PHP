<?php
error_reporting(0);
require_once '../func.php';
usage('jdf');
usage('plugin/vars');
usage('plugin/days');
usage('plugin/nums');
usage('plugin/permission');
usage('plugin/functions');

order_info($zaman);

usage('plugin/convert_date');
usage('plugin/header');
?>

<body class="login-area">
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">لیست فاکتور های بازاریاب ها
                                </h3>
                                <div class="zaman">
                                    <h3 class="font-24 mb-1">روز :
                                        <?php echo $day_name[$m] ?>
                                    </h3>
                                    <h3 class="font-24 mb-1">تاریخ :
                                        <?php echo $jalali_date; ?>
                                    </h3>
                                    <div class="qr">
                                        <img src="https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=barjio.com/visitors.php">
                                    </div>
                                    <div class="logo">
                                        <img src="../img/bgh.png">
                                    </div>
                                    <p class="mb-30"></p>

                                    <table style="margin: 0 auto;">
                                        <tr id="first_row">
                                            <td>
                                                <button class="btn btn-info" id="all_report">همه گزارشات</button>
                                                <button class="btn btn-success" id="plus_report">ویزیت مثبت</button>
                                                <button class="btn btn-warning" id="noprint_report">صادر نشده</button>
                                                <button class="btn btn-danger" id="reject_report">رد شده</button>
                                            </td>
                                        </tr>
                                    </table>
                                    <br />

                                    <table style="margin: 0 auto;">
                                        <tr id="first_row">
                                            <td>ردیف</td>
                                            <td>بازاریاب</td>
                                            <td>نام فروشگاه</td>
                                            <td>نام مسئول</td>
                                            <td>نام شهر</td>
                                            <td>نوع مشتری</td>
                                            <td>ورود</td>
                                            <td>وضعیت</td>
                                            <td>فاکتور</td>
                                            <td>امضای مشتری</td>
                                            <td>تایید سرپرست</td>
                                            <td>تایید مدیر فروش</td>
                                            <td>صدور فاکتور</td>
                                            <td>تایید انباردار</td>
                                            <td>تایید موزع</td>
                                        </tr>
                                        <tr>

                                        </tr>
                                    </table>
                                    <br>

                                    <table style="text-align: center;display:inline;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">
                                        <tr>
                                            <th colspan="5">اطلاعات ویزیت</th>
                                        </tr>
                                        <tr>
                                            <td>تعداد کل ویزیت</td>
                                            <td>ویزیت موفق</td>
                                            <td>ویزیت ناموفق</td>
                                            <td>مشتری قدیم</td>
                                            <td>مشتری جدید</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <?php echo ($visit_plus + $visit_neg); ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_plus; ?>
                                            </td>
                                            <td>
                                                <?php echo $visit_neg; ?>
                                            </td>
                                            <td>
                                                <?php echo $old_customer_count; ?>
                                            </td>
                                            <td>
                                                <?php echo $new_customer_count; ?>
                                            </td>
                                        </tr>
                                    </table>

                                </div>

                                <?php usage('plugin/search'); ?>

                                <input type="hidden" id="uid" value="<?php echo $_GET['uid']; ?> name=" uid" />
                            </div>
                        </div>
                        <div class="text-center">
                            <span class="">©</span>
                            <label class="font-12">
                                تمامی حقوق سایت، متعلق به شرکت بهار آرا خراسان می باشد.
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php usage('plugin/footer'); ?>
</body>

</html>
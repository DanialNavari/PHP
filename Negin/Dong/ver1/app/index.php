<?php require_once('../func.php'); ?>
<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link href="https://getbootstrap.com/docs/5.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="https://getbootstrap.com/docs/5.1/assets/css/docs.css" rel="stylesheet">

    <link rel="stylesheet" href="../css/main.css?v=<?php echo mt_rand(111111111, 999999999); ?>" />
    <link rel="apple-touch-icon" sizes="180x180" href="../image/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../image/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../image/favicon-16x16.png">

    <title><?php echo $app_name; ?></title>
    <style>
        h6 {
            font-size: 0.7rem;
            padding: 0 !important;
        }

        .group_name h6 {
            padding: 0.3rem !important;
        }

        a:link,
        a:visited,
        a:active,
        a:hover {
            color: #03A9F4;
        }
    </style>
</head>

<body id="app_body">
    <div class="container-fluid">
        <div class="nav_drawer"><?php require_once('_nav.php'); ?></div>
        <div class="gray_layer"></div>
        <div class="headers text-right pr-3">
            <div>
                <i id="h_menu" class="force_hide"><?php echo $hamburger_menu; ?></i>
                <img src="image/logo_white.png" alt="logo" class="rounded w-2" />
                <h1 class="pt-3 pb-3 pr-3 d-inline-block "><?php echo $app_name; ?></h1>
                <h6 class="d-inline-block ">(شرایط استفاده از خدمات و حریم خصوصی)</h6>
            </div>

        </div>
        <div class="px-3 mt_3_rem privacy_text">
            <h5 class="text-center text-primary">به دونگتو خوش آمدید</h5>

            <div class="cat">
                <div class="group_name">
                    <h6 class="font-weight-bold">درباره برنامه</h6>
                </div>
            </div>

            <span class="text-dark">
                <b>دونگتو اولین سامانه آنلاین محاسبه دونگ افراد در مسافرت ها و دورهمی هاست.</b><br />
            </span>
            <span class="text-dark">
                <b>دونگتو</b> یک وب اپلیکیشن است که در قالب اپلیکیشن موبایل خروجی گرفته شده و در واقع یک سایت است و هیچ گونه دسترسی به اطلاعات گوشی شما نداره، پس خیالتون از بابت امنیت گوشیتون راحت
            </span>

            <div class="cat">
                <div class="group_name">
                    <h6 class="font-weight-bold">شرایط استفاده از خدمات</h6>
                </div>
            </div>

            <span class="text-dark">
                <b>دونگتو</b> ثبت نام ندارد و برای استفاده از خدمات آن بایسیتی با شماره تلفن همراه خود وارد شوید ، سپس یک کد 4 رقمی احراز هویت برای شما ارسال می شود که با تایید آن می توانید از همه خدمات برنامه به صورت <b>رایگان</b> استفاده کنید
            </span>

            <div class="cat">
                <div class="group_name">
                    <h6 class="font-weight-bold">حریم خصوصی</h6>
                </div>
            </div>

            <span>
                <b>دونگتو</b> چه اطلاعاتی را ذخیره می کند؟؟ <br />
                <span class="text-dark">
                    بجز شماره موبایل شما که در بدو ورود وارد می کنید ، این برنامه هیچ گونه دسترسی به سایر اطلاعات گوشی همراه شما ندارد و هیچ گونه اطلاعاتی در مورد نوع و مدل گوشی ، آی پی و سایر اطلاعات حساس کاربران در پایگاه داده سایت ذخیره نمی شود.
                </span>
                <span class="text-dark">
                    <b>دونگتو</b> اطلاعات شما را در اختیار هیچ فرد ، گروه ، اداره و سازمانی قرار نمی دهد و کلیه اطلاعات کاربران به صورت رمزنگاری شده در پایگاه داده ذخیره می شود.
                </span>
                <span>
                    قسمت مخاطبین داخل برنامه برای ثبت شماره موبایل افرادی است که تمایل دارید به دوره های شما اضافه شوند. نام و شماره این افراد فقط به فقط توسط کاربر ایجاد کننده قابل مشاهده است و سایر کاربران هیچ گونه دسترسی به این اطلاعات ندارند.
                </span>
            </span>

            <div class="cat">
                <div class="group_name">
                    <h6 class="font-weight-bold">پشتیبانی</h6>
                </div>
            </div>

            <span class="text-dark">
                واحد پشتیبانی این برنامه در تلگرام همه روزه از ساعت 7 الی 22 فعال می باشد.
            </span>

            <span class="text-dark">
                لطفا هر گونه نظرات ، پیشنهادات ، انتقادات و یا باگ در عملکرد برنامه را به یکی از روش های زیر برای ما ارسال فرمایید<br />
            </span>
            <span class="text-center">
                <a href="mailto:info@dongeto.com" target="_blank">ایمیل : Info@Dongeto.com</a><br />
                <a href="tg://resolve?domain=dongeto" target="_blank">تلگرام : @Dongeto</a>
            </span>
        </div>
    </div>
</body>

</html>
<body class="login-area">
    <input type="hidden" value="<?php echo $GLOBALS['line']; ?>" id="users_lines" />
    <!-- Preloader -->
    <!-- ======================================
    ======================================= -->
    <div class="main-content- h-100vh">
        <div class="container-fluid h-100">
            <!--             <div class="ba-logo" style="text-align: center;">
                <img src="../img/logo-ba.png" title="logo" id="logo"
                    style="max-width: 100px; height: auto; background: #01815f; border-radius: 50%; box-shadow: 0px 0px 6px #01815f4f; padding: 1rem;" />
            </div> -->
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-md-12 col-lg-12" style="width: inherit;">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card">
                            <div class="card-body p-4">
                                <h3 class="font-24 mb-1">لیست فرم های اداری پرسنل
                                </h3>
                                <h5>کاربر سامانه : <?php echo $head; ?> </h5>
                                <div class="doc">
                                    <table>
                                        <tr>
                                            <td><button id="all" class="btn btn-success">همه فرم ها</button></td>
                                            <td><button id="super" class="btn btn-warning" onclick="show_super('<?php echo $GLOBALS['line']; ?>')">عدم تایید سرپرست</button></td>
                                            <td><button id="manager" class="btn btn-primary">عدم تایید مدیر فروش</button></td>
                                            <td><button id="both" class="btn btn-danger">عدم تایید مدیریت</button></td>
                                            <td><button id="acc" class="btn btn-hesabdari" onclick="show_acc()">عدم تایید حسابداری</button></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="zaman">
                                    <p class="mb-30"></p>

                                    <?php include_once('mission_table.php'); ?>
                                    <br />
                                    <?php include_once('rest_table.php'); ?>
                                    <br />
                                    <?php include_once('donate_table.php'); ?>

                                    <input type="hidden" id="m_count" value="<?php echo $c_m; ?>" />
                                    <input type="hidden" id="r_count" value="<?php echo $c_m_; ?>" />
                                    <input type="hidden" id="d_count" value="<?php echo $c_m__; ?>" />
                                    <table style="text-align: center;display:none;float: right;border: 1px solid #000;margin-bottom:0.5rem;margin-top:0.5rem">

                                    </table>

                                </div>

                                <div class=" row" style="width: max-content; margin: 0 auto;">
                                    <form method="get" action="forms.php" class="print">
                                        <label>تاریخ مورد نظر را وارد کنید: <input type="date" name="date" id="day" class="form-control"> </label>
                                        <input type="hidden" name="g" value="<?php echo $_GET['g']; ?>" />
                                        <button type="submit" class="btn btn-warning">نمایش</button>
                                        <button>
                                            <a href="javascript:if(window.print)window.print()" class="btn btn-primary">چاپ</a>
                                        </button>
                                    </form>
                                </div>

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

        <input type="hidden" id="tarikh" value="<?php echo $_GET['date']; ?>">
        <input type="hidden" id="g" value="<?php echo $_GET['g']; ?>">

        <!-- ======================================
    ======================================= -->
        <!-- Must needed plugins to the run this Template -->


        <script>
            $('#mission_count').text($('#m_count').val());
            $('#rest_count').text($('#r_count').val());
            $('#donate_count').text($('#d_count').val());

            let g = $('#g').val();
            let tarikh = $('#tarikh').val();
            let masir = 'https://perfumeara.com/webapp/app_new/panel/forms.php?date=' + tarikh + '&g=' + g;
            let pos = '';

            $('#all').click(function() {
                pos = '&t=all';
                window.location.assign(masir + pos);
            });

            $('#manager').click(function() {
                pos = '&t=manager';
                $('tr.super_ok').show();
                $('tr.super_no').hide();
                $('tr.manager_ok').hide();
                //window.location.assign(masir + pos);
            });

            $('#both').click(function() {
                pos = '&t=both';
                $('tr.manager_ok').show();
                $('tr.manager_no').hide();
                $('tr.both_ok').hide();
                //window.location.assign(masir + pos);
            });

            $('#acc').click(function() {
                pos = '&t=acc';
                //window.location.assign(masir + pos);
            });

            function show_factor(x) {
                $("tr[class*='l']").hide();

                if (x == '*') {
                    let line = '';
                    $('tr').show();
                } else {
                    let line = x;
                    $('tr.l' + x).show();
                }
                pos = '&t=factor';

                $('tr.nofactor').hide();
                $('tr.d1').hide();
                //window.location.assign(masir + pos);
            }

            function show_acc() {
                $('tr').show();
                $("tr.acc_no").show();
                $('tr.nofactor').hide();
                $('tr.acc_ok').hide();
                $('tr.both_no').hide();
                $('tr.d1').hide();
            }

            function show_super(x) {
                show_factor('<?php echo $GLOBALS['line']; ?>');
                $('tr.nofactor').hide();
                $('tr.super_ok').hide();
                $('tr.d1').hide();
            }
        </script>

        <input type="hidden" id="parent_" value="<?php echo $GLOBALS['line']; ?>" />
        <script>
            $(document).ready(function() {
                let parent = $('#parent_').val();
                if (parent == '*') {
                    $('.data').show();
                } else {
                    $('.data').hide();
                    $('.l' + parent).show();
                }

                $('tr.d1').hide();

                let al_cbd = $('*').find('.data').length / 2;
                let al_fac = $('*').find('.factor').length / 2;
                let al_insta = $('*').find('.l5').length / 2;
                let no_super = $('*').find('.super_no').length / 2;
                let no_manager = $('*').find('.manager_no').length / 2;
                let no_acc = $('*').find('.acc_no').length / 2;


            });

            var users_lines = $('#users_lines').val();
            if (users_lines == '*') {
                $('tr').show();
            } else {
                $('tr.mission').hide();
                $('tr.l' + users_lines).show();
            }

            function toggle(id) {
                $('tr.' + id).slideToggle('slow');
            }
        </script>

        <style>
            .desc {
                text-align: right;
                font-weight: bold;
                color: #00695C;
                font-size: 0.8rem;
            }

            .doc {
                position: relative;
            }

            .doc table {
                position: absolute;
                top: -5rem;
                right: -1.4rem;
                border: none;
            }

            .doc table td:nth-child(1) {
                width: 8.5rem;
            }

            .doc table td:nth-child(2) {
                width: 10rem;
            }

            .doc table td:nth-child(3) {
                width: 10.4rem;
            }

            .doc table td:nth-child(4) {
                width: 11.3rem;
            }

            .doc table td:nth-child(5) {
                width: 10.2rem;
            }

            .doc table td:nth-child(6) {
                width: 10.8rem;
            }

            .doc td,
            .doc tr,
            .doc table {
                border: none;
            }

            .doc button {
                width: 140px;
                height: 60px;
            }
        </style>

        <?php
        if ($_GET['g'] == 'b8e0f272c78fbcb1944a56f5e37158a2') {
            echo '<script>
            $(document).ready(function() {
                $("*").find(".l100").hide();
            });</script>';
        }

        ?>
        <script src="../js/popper.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src="../js/bundle.js"></script>
        <script src="../js/user_login.js"></script>
        <!-- Active JS -->
        <script src="./js/default-assets/active.js"></script>
</body>
<?php require_once('style.php'); ?>
<link href="nouislider/dist/nouislider.css?v=1570" rel="stylesheet" />


<style>
    .example {
        margin: 5rem auto;
        font-family: iransans;
        width: 80vw;
    }

    .noUi-horizontal .noUi-tooltip {
        -webkit-transform: translate(-50%, 0);
        transform: translate(-50%, 0);
        left: 50%;
        bottom: 120%;
        padding: 0.7rem 0;
        border-radius: 50%;
        height: 3rem;
        width: 3rem;
        text-align: center;
    }

    .start {
        position: relative;
    }
</style>

<div class="pixel"></div>
<div class="main">
    <div class="start">
        <div class="pic-bg">
            <img src="img/Title.png" id="title_" />
            <img src="img/BOTTLES.png" id="bottle_" />
            <img src="img/ID.png" id="id_" />
        </div>
        <button class="btn btn-start font-bold" id="start" onclick="set_start_btn()">شروع</button>
    </div>

    <div class="toolbar-quiz">
        <div class="process-bar-quiz">
            <div class="bar-gray">
                <div id="pishraft" datatooltip="0%" class="bar-percen" style="width: 0%;"></div>
            </div>
            <div class="list-image">
                <div class="step">
                    <div class="number n0"></div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n1">1</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n2">2</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n3">3</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n4">4</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n5">5</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n6">6</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n7">7</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n8">8</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n9">9</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n10">10</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n11">11</div>
                    <div class="text"></div>
                </div>
                <div class="step">
                    <div class="number n12">12</div>
                    <div class="text"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="lvl-1">
        <label for="customRange1" class="form-label">1-چند سالته؟</label>

        <!-- start slider range code -->
        <div id="age_frame">

            <div class="example">

                <div class="slider noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr" id="slider">
                </div>

            </div>

        </div>
        <!-- end slider range code -->

        <div class="buttons">
            <button class="btn btn-start1" onclick="nextcell(1)">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                    <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
                </svg> بعدی
            </button>
        </div>
    </div>

    <div class="lvl-2">
        <label class="form-label">2-جنسیتت رو مشخص کن</label>
        <img src="./img/Male.png" title="Male" onclick="sex_type('male')" id="male" /> <span>آقا</span>
        <img src="./img/Female.png" title="Female" onclick="sex_type('female')" id="female" /><span>خانم</span>
        <button class="btn btn-start1" onclick="nextcell(2)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-3">
        <label class="form-label" style="margin: 0 auto;">3-کدوم سبک زندگی رو ترجیح میدی؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="regular" id="defaultCheck2" name="lifestyle">
                <label class="form-check-label" for="defaultCheck2" data-value="regular">
                    منظم با برنامه مشخص
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="flexible" id="defaultCheck1" name="lifestyle">
                <label class="form-check-label" for="defaultCheck1" data-value="flexible">
                    منعطف، غیر قابل پیش‌بینی و هیجان‌انگیز
                </label>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(3)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-4">
        <label class="form-label">4-خودت رو 5 سال دیگه کجا میبینی؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="1" id="defaultCheck6" name="5year">
                <label class="form-check-label" for="defaultCheck6" data-value="1">
                    در حال مدیریت بیزنس شخصی خودت
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="2" id="defaultCheck5" name="5year">
                <label class="form-check-label" for="defaultCheck5" data-value="2">
                    مدیر یک بخش توی یک شرکت بزرگ
                </label>
            </div>
        </div>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="3" id="defaultCheck3" name="5year">
                <label class="form-check-label" for="defaultCheck3" data-value="3">
                    یک کارمند موفق
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="4" id="defaultCheck4" name="5year">
                <label class="form-check-label" for="defaultCheck4" data-value="4">
                    تا حالا بهش فکر نکردم
                </label>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(4)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-5">
        <label class="form-label">5-اگه میتونستی همین الان یه جا رو برای زندگی کردن انتخاب کنی، کدوم به انتخابت نزدیک‌تره؟</label>
        <div class="vasat">
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="beach" id="defaultCheck7" name="5year">
                <img src="img/1.jpg" class="defaultCheck7" onclick="pic_select('defaultCheck7')" />
                <span>یه خونه ساحلی نزدیک دریای مدیترانه</span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="apartment" id="defaultCheck8" name="5year">
                <img src="img/2.jpg" class="defaultCheck8" onclick="pic_select('defaultCheck8')" />
                <span>یه آپارتمان معمولی توی نیویورک</span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="dubai" id="defaultCheck10" name="5year">
                <img src="img/3.jpg" class="defaultCheck10" onclick="pic_select('defaultCheck10')" />
                <span>یه پنت‌ هاوس لوکس توی دبی</span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="jungle" id="defaultCheck9" name="5year">
                <img src="img/4.jpg" class="defaultCheck9" onclick="pic_select('defaultCheck9')" />
                <span>یه کلبه جنگلی توی سوئیس</span>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(5)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-6">
        <label class="form-label">6-بهترین تعریفی که یه نفر میتونه از عطرت بکنه چیه؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="1" id="defaultCheck11" name="5year">
                <label class="form-check-label" for="defaultCheck11" data-value="1">
                    چه عطر خوش‌ بویی زدی
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="2" id="defaultCheck12" name="5year">
                <label class="form-check-label" for="defaultCheck12" data-value="2">
                    عطرت چیه؟؟؟ بوش داره دیوونم می‌کنه
                </label>
            </div>
        </div>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="3" id="defaultCheck13" name="5year">
                <label class="form-check-label" for="defaultCheck13" data-value="3">
                    بوی عطرت خیلی آرامش‌ بخشه
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="4" id="defaultCheck14" name="5year">
                <label class="form-check-label" for="defaultCheck14" data-value="4">
                    اسم عطرت چیه؟ اولین باره به مشامم میخوره
                </label>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(6)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-7">
        <label class="form-label">7- معمولا چه استایلی لباس می پوشی؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="1" id="defaultCheck25" name="5year">
                <label class="form-check-label" for="defaultCheck25" data-value="1">
                    اسپرت و کژوال
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="2" id="defaultCheck26" name="5year">
                <label class="form-check-label" for="defaultCheck26" data-value="2">
                    رسمی و کلاسیک
                </label>
            </div>
        </div>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="3" id="defaultCheck15" name="5year">
                <label class="form-check-label" for="defaultCheck15" data-value="3">
                    هر دو رو به یه اندازه می پوشم
                </label>
            </div>

        </div>
        <button class="btn btn-start1" onclick="nextcell(7)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-8">
        <label class="form-label">8- کدوم بو رو بیشتر دوست داری؟</label>
        <br>
        <div class="vasat">
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="wood" id="defaultCheck17" name="5year">
                <img src="img/5.jpg" class="defaultCheck17" onclick="pic_select('defaultCheck17')" />
                <span>بوی چوب</span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="grass" id="defaultCheck18" name="5year">
                <img src="img/7.jpg" class="defaultCheck18" onclick="pic_select('defaultCheck18')" />
                <span>مشک و عود </span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="flower" id="defaultCheck19" name="5year">
                <img src="img/8.jpg" class="defaultCheck19" onclick="pic_select('defaultCheck19')" />
                <span>بوی گل</span>
            </div>
            <div class="form-check">
                <input class="form-check-input hide" type="radio" data-value="lemon" id="defaultCheck20" name="5year">
                <img src="img/6.jpg" class="defaultCheck20" onclick="pic_select('defaultCheck20')" />
                <span>بوی لیمو</span>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(8)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-9">
        <label class="form-label">9- ترجیح میدی اگر کسی باهات کار داره ...</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="ring" id="defaultCheck21" name="5year">
                <label class="form-check-label" for="defaultCheck21" data-value="ring">
                    زنگ بزنه
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="sms" id="defaultCheck22" name="5year">
                <label class="form-check-label" for="defaultCheck22" data-value="sms">
                    پیام بده
                </label>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(9)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-10">
        <label class="form-label">10- معمولا وقتی میری کافه چی سفارش میدی؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="hot" id="defaultCheck23" name="5year">
                <label class="form-check-label" for="defaultCheck23" data-value="hot">
                    یه قهوه گرم و دلچسب
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" data-value="cold" id="defaultCheck24" name="5year">
                <label class="form-check-label" for="defaultCheck24" data-value="cold">
                    یه نوشیدنی سرد و خنک
                </label>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(10)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-11">
        <label class="form-label">11- اگه دوستای نزدیکت بخوان توی یک جمله توصیفت کنن، اون جمله چیه؟</label>
        <br>
        <div class="q_r1">
            <div class="form-check" style="width: 100%;">
                <textarea class="form-control" rows="10" cols="20" style="width: inherit;" id="about"></textarea>
            </div>
        </div>
        <button class="btn btn-start1" onclick="nextcell(11)">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> بعدی
        </button>
    </div>

    <div class="lvl-12">
        <label class="form-label">استایل بویاییت رو پیدا کردیم! <br />برای نمایش نتیجه مشخصاتت رو وارد کن</label>
        <br>
        <div class="q_r1">
            <div id="esm">
                اسم :<input type="text" id="esmi" class="form-control" /><br>
                شماره همراه :<input type="tel" id="teli" class="form-control" /><br>
            </div>
        </div>
        <button class="btn btn-start1" onclick="show_result()">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-forward-fill" viewBox="0 0 16 16">
                <path d="m9.77 12.11 4.012-2.953a.647.647 0 0 0 0-1.114L9.771 5.09a.644.644 0 0 0-.971.557V6.65H2v3.9h6.8v1.003c0 .505.545.808.97.557z" />
            </svg> نمایش نتیجه
        </button>
    </div>



    <div id="answer"></div>
    <div id="uids"></div>
    <script src=" js/jquery-3.4.1.min.js"></script>
    <script src="js/index.js"></script>
    <script src="nouislider/dist/nouislider.js?v=1570"></script>
    <script src="https://refreshless.com/nouislider/documentation/assets/wNumb.js"></script>
    <script>
        var slider = document.getElementById('slider');

        noUiSlider.create(slider, {
            start: 25,
            range: {
                'min': 0,
                'max': 100
            },
            tooltips: true,
            pips: {
                mode: 'steps',
            },
            format: wNumb({
                decimals: 0
            }),

            connect: true,
        });

        $('.noUi-handle-lower').css('left', 'initial');

        $('.noUi-connect').css('transform', 'scale(0.25, 1)');
        $('.noUi-origin').css('transform', 'translate(-75%, 0px)');
        $('.noUi-tooltip').text(25);
    </script>
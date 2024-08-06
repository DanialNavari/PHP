<link rel="stylesheet" href="static/css/lib/persian-datepicker.min.css" />
<link rel="stylesheet" href="static/css/main.css" />
<?php
if (isset($_GET['id'])) {
    $app_members = 0;

    $res = SELECT_course_id($_GET['id']);
    $course_name = $res['course_name'];
    $course_members = count(explode(',', $res['course_member'])) - 1;
    $course_member = explode(',', $res['course_member']);

    for ($i = 0; $i < $course_members; $i++) {
        $member_id = $course_member[$i];
        $rs = SELECT_user_by_tel($member_id);
        $tel = $rs['contact_tel'];
        $result = Query("SELECT * FROM `users` WHERE `users_tel` = '$tel'");
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $app_members += 1;
        }
    }
} else {
}
?>

<div class="row empty">ویرایش افراد دوره</div>

<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title va_middle w-6">نام دوره</td>
                <td class="font-weight-bold text-center" id="courseName" colspan="2"><?php echo $course_name; ?></td>
            </tr>
            <tr>
                <td class="td_title w-7">افراد حاضر در دوره</td>
                <td class="font-weight-bold text-center" id="course_count" colspan="2"><?php echo $course_members; ?></td>
            </tr>
            <!-- <tr>
                <td class="td_title w-7">افراد عضو سامانه</td>
                <td class="font-weight-bold text-center" id="course_count" colspan="2"><?php echo $app_members; ?></td>
            </tr> -->
        </table>
        <div class="mb-5"></div>
        <div class="pay_btn pay_btn2" onclick="editNewCourse(<?php echo $_GET['id'];?>)">
            <div class="pay_btn_icon">
                <?php echo $check; ?>
            </div>
        </div>
    </div>
</div>

<div class="h-1"></div>
<div class="h-1"></div>

<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">اضافه کردن مخاطب جدید</h6>
    </div>
</div>

<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td class="td_title_ font-weight-bold text-white">
                    <div class="form-row">
                        <div class="col">
                            <input type="tel" id="newContactTel" class="input_group_height text-right form-control sum" placeholder="شماره مخاطب" aria-label="Username" aria-describedby="addon-wrapping" tabindex="2">
                        </div>
                        <div class="col">
                            <input type="text" id="newContactName" class="input_group_height text-right form-control sum" placeholder="نام مخاطب" aria-label="Username" aria-describedby="addon-wrapping" tabindex="1">
                        </div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="td_title_ font-weight-bold text-white">
                    <button class="btn btn-success w-100 sum" id="btn_add_new_contact" onclick="addNewContact()">اضافه کردن مخاطب</button>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">لیست مخاطبین</h6>
    </div>
</div>

<div class="cat">
    <div class="card my_card border_none">
        <table class="table">
            <tr class="white">
                <td class="td_title_ font-weight-bold text-white">
                    <div class="input-group">
                        <input type="text" class="input_group_height text-right form-control sum search_box" placeholder="نام مخاطب یا شماره موبایل را جستجو کنید" aria-label="Username" aria-describedby="addon-wrapping" onkeyup="searchContact()">
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<!-- selected users -->
<div class="cat mb-1">
    <div class="card my_card border_none selected_user">
        <?php $contact_maker = $_COOKIE['uid'];
        echo give_contacts_list1($contact_maker, $_GET['id'], 'incomplete'); ?>
    </div>
</div>

<!-- users box -->
<div class="users_box">
    <?php $contact_maker = $_COOKIE['uid'];
    echo give_contacts_list1($contact_maker, $_GET['id'], 'complete'); ?>
</div>


<div class="cat mb-1 h-1"></div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
<script src="static/js/lib/persian-date.min.js"></script>
<script src="static/js/lib/persian-datepicker.min.js"></script>

<script>
    var to, from;
    from = $(".range-from-example").persianDatepicker({
        inline: true,
        altField: '.range-from-example-alt',
        altFormat: 'LLLL',
        initialValue: false,
        onSelect: function(unix) {
            $('#start_unix').text(unix);
            const d = new Date(unix);
            var year = d.getFullYear();
            var month = ("0" + (d.getMonth() + 1)).slice(-2);
            var rooz = ("0" + d.getDate()).slice(-2);

            from.touched = true;
            if (to && to.options && to.options.minDate != unix) {
                var cachedValue = to.getState().selected.unixDate;
                to.options = {
                    minDate: unix
                };
                if (to.touched) {
                    to.setDate(cachedValue);
                }
            }
        }
    });
</script>
<div class="row empty">مخاطبین</div>
<div class="cat">
    <div class="card my_card">
        <table class="table">
            <tr class="">
                <td class="td_title_ va_middle w-4">نام کاربر</td>
                <td class="font-weight-bold text-white">
                    <input type="text" class="form-control rounded-2 text-center text-primary" tabindex="1" id="newContactName">
                </td>
                <td class="font-weight-bold"></td>
            </tr>
            <tr class="">
                <td class="td_title_ va_middle w-4">موبایل</td>
                <td class="font-weight-bold text-white">
                    <input type="tel" class="form-control rounded-2 text-center text-primary" pattern="[0-9]{11}" tabindex="2" id="newContactTel">
                </td>
                <td class="font-weight-bold"></td>
            </tr>
        </table>
        <table class="table">
            <tr>
                <td colspan="1">
                    <div class="btn btn-primary w-100 add_user" onclick="openContactPicker()">
                        <div class="pay_btn_icon">
                            <?php echo $user_add; ?>
                        </div>
                    </div>
                </td>
                <td colspan="1">
                    <div class="btn btn-success w-100 contact_btn" onclick="add()">
                        <div class="pay_btn_icon">
                            <?php echo $check; ?>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>

<br />
<div class="cat mb-1">
    <div class="group_name">
        <h6 class="font-weight-bold">مخاطبین</h6>
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

<div class="users_box">
    <?php echo contact_list($_COOKIE['uid']); ?>
</div>

<div class="empty_space mb-4"></div>


<script>
    function openContactPicker() {
        const supported = "contacts" in navigator && "ContactsManager" in window;

        if (supported) {
            getContacts();
        } else {
            alert(
                "این قابلیت فقط روی گوشی های اندرویدی و با مرورگر گوگل کروم ورژن 80 به بالا قابل استفاده است."
            );
        }
    }
    async function getContacts() {
        const props = ["name", "tel"];
        const opts = {
            multiple: true
        };

        try {
            const contacts = await navigator.contacts.select(props, opts);
            //alert(JSON.stringify(contacts));
            let tedad_contact = Object.keys(contacts).length;
            for (i = 0; i < tedad_contact; i++) {
                let contact_name = contacts[i].name;
                let contact_tel = contacts[i].tel;
                $.ajax({
                    data: 'add_contact=ok&contact_name=' + contact_name + '&contact_tel=' + contact_tel,
                    type: 'POST',
                    url: 'server.php',
                    success: function(response) {

                    }
                });
            }
            alert('مخاطبین با موفقیت اضافه شدند.');
            window.location.reload();
        } catch (err) {
            alert(err);
        }
    }
</script>
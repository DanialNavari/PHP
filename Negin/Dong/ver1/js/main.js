let cd;
let course_code;

function page(type, route, name = null, id = null) {
  if (type == "r") {
    window.location.assign("./?route=" + route + "&h=" + name + "&id=" + id);
  } else if (type == "d") {
    window.location.assign(route + "/?h=" + name);
  }
}

var nav_drawer = 0;

$("#h_menu").click(function () {
  if (nav_drawer == 0) {
    $(".gray_layer").show();
    $(".nav_drawer").fadeIn();
    nav_drawer = 1;
  } else if (nav_drawer == 1) {
    $(".gray_layer").click();
    nav_drawer = 0;
  }
});

$(".gray_layer").click(function () {
  $(".nav_drawer").fadeOut();
  $(".gray_layer").fadeOut();
  $(".add_payments").fadeOut();
  $(".add_course").fadeOut();
  $(".add_fee").fadeOut();
  $(".tarikh_table").fadeOut();
  nav_drawer = 0;
});

let path_name = $("#path_name").val();

switch (path_name) {
  case "home":
    $("#home").addClass("bg_hover");
    $("#home .item_title").show();
    break;
  case "wallet":
    $("#wallet").addClass("bg_hover");
    $("#wallet .item_title").show();
    break;
  case "contact":
    $("#contact").addClass("bg_hover");
    $("#contact .item_title").show();
    break;
  case "course":
    $("#newCourse").addClass("bg_hover");
    $("#newCourse .item_title").show();
    break;
  case "transaction":
    $("#transaction").addClass("bg_hover");
    $("#transaction .item_title").show();
    break;
}

function changeCourseName() {
  let esm = prompt("نام جدید دوره را وارد کنید");
  if (esm.length > 2) {
    $("#courseName").text(esm);
  }
}

function addUserToCourse() {
  window.location.assign("./?route=_newCourse&h=course&course_id=1");
}

// function moneyLimit() {
//   let fee = prompt("مبلغ محدودیت مالی را وارد کنید");
//   if (parseInt(fee) > 0) {
//     $("#moneyLimit").text(fee);
//   }
// }

function setDate() {
  $("#set_tarikh").show("slow");
  $(".range-from-example").show("slow");
  $(".month-grid-box .header").hide();
  $(".header").css("display", "inline-block");
  $(".w-100").show();
}

function setDates(id) {
  $(".gray_layer").show();
  $(".tarikh_table").show();
  $("#set_tarikh").show("slow");
  $(".range-from-example").show("slow");
  $(".month-grid-box .header").hide();
  $(".header").css("display", "inline-block");
  $(".w-100").show();
  course_code = id;
}

$("#savedate").click(function () {
  shamsi = $("td.selected").attr("data-date");
  if (shamsi.length > 0) {
    $("#start_from_fa").text(shamsi);
  } else {
    shamsi = $("td.today").attr("data-date");
  }

  shamsi_split = shamsi.split(",");
  let saal, maah, rooz;

  if (shamsi_split[1] < 10) {
    maah = "0" + shamsi_split[1];
  } else {
    maah = shamsi_split[1];
  }

  if (shamsi_split[2] < 10) {
    rooz = "0" + shamsi_split[2];
  } else {
    rooz = shamsi_split[2];
  }

  $("#start_from_fa").text(shamsi_split[0] + "/" + maah + "/" + rooz);

  $(".month-grid-box .header").hide();
  $("#set_tarikh").hide("slow");
  $(".range-from-example").hide("slow");
  $(".end_course .w-100").show();
  $("#btn_add_new_contact").show();
  $(".savedate_tr").hide();
  $("#savedate").hide();
  $("#calendar_").hide();
  $(".gray_layer").hide();
  $(".after_hide").hide();
});

function remove_from_course(id) {
  let user_id = "user-" + id;
  let user_esm = user_id + "-name";
  let user_tel = user_id + "-tel";
  let user_box = user_id + "-box";
  let course_count = parseInt($("#course_count").text()) - 1;

  $("." + user_esm).removeClass("bg_green");
  $("." + user_id).removeClass("bg_green");
  $("." + user_box).removeClass("bg_green_dark");
  $("." + user_box).addClass("bg_blue");
  $("." + user_tel).removeClass("bg_green_dark");
  $("." + user_id).remove();
  $("#course_count").text(course_count);
  $("#add-" + id).show();
  $("#del-" + id).hide();
  $("#" + user_id).val(0);
}

function add_user_to_course(id) {
  let user_id = "user-" + id;
  let user_esm = user_id + "-name";
  let user_box = user_id + "-box";
  let pos = $("." + user_box).hasClass("bg_green_dark");
  if (pos == false) {
    let course_count = parseInt($("#course_count").text()) + 1;

    $("." + user_esm).addClass("bg_green");
    $("." + user_box).removeClass("bg_blue");
    $("." + user_box).addClass("bg_green_dark");
    let user_name = $(
      "." + user_esm + " .user_info .star span.karbar_name"
    ).text();
    added_btn =
      '<div class="user_info bg_dark_blue text-white ' +
      user_id +
      '" data="' +
      id +
      '" onclick="remove_from_course(' +
      id +
      ')"><div class="user_name td_title_ px_02 mx-auto">' +
      user_name +
      "</span></div></div>";
    $(".selected_user").append(added_btn);
    $("#course_count").text(course_count);
  }
}

$(".floatingActionButton").click(function () {
  $(".gray_layer").show();
  $(".add_payments").fadeIn();
});

function payment(pay_id = 0) {
  window.location.assign("./?route=_editTransaction&h=null&id=" + pay_id);
}

function moneyLimit() {
  $(".gray_layer").show();
  $(".add_fee").fadeIn();
  $("#saveCourseFee").fadeIn();
}

function moneyLimits(id) {
  $(".gray_layer").show();
  $(".add_fee").fadeIn();
  $("#saveCourseFee").fadeIn();
  $("#fee_code").val(id);
}

function course() {
  $(".gray_layer").show();
  $(".add_course").fadeIn();
  $("#saveCourseName").show();
}

function courses(id) {
  $(".gray_layer").show();
  $(".add_course").fadeIn();
  $("#saveCourseName").show();
  $("#course_code").val(id);
}

/* Start programming */
function navigate(page) {
  window.location.assign(page);
}

function Toast(error_id) {
  message = {
    e101: "پاسخی از سرور دریافت نشد",
    e102: "کد وارد شده نادرست می باشد",
    e103: "مخاطب جدید ثبت نشد",
    e104: "نام و شماره مخاطب را وارد کنید",
    e105: "مخاطب تکراری است",
    e106: "شماره تلفن را به صورت صحیح وارد کنید",
    e107: "محدودیت مالی نباید کمتر از هزینه کل باشد",
    e108: "جمع سهم افراد با مبلغ تراکنش برابر نمی باشد",
    e109: "نام دوره را وارد کنید",
    e110: "دسترسی شما به برنامه مسدود شده است",
  };

  switch (error_id) {
    case 101:
      err = "خطای " + error_id + ": " + message.e101;
      break;
    case 102:
      err = "خطای " + error_id + ": " + message.e102;
      break;
    case 103:
      err = "خطای " + error_id + ": " + message.e103;
      break;
    case 104:
      err = "خطای " + error_id + ": " + message.e104;
      break;
    case 105:
      err = "خطای " + error_id + ": " + message.e105;
      break;
    case 106:
      err = "خطای " + error_id + ": " + message.e106;
      break;
    case 107:
      err = "خطای " + error_id + ": " + message.e107;
      break;
    case 108:
      err = "خطای " + error_id + ": " + message.e108;
      break;
    case 109:
      err = "خطای " + error_id + ": " + message.e109;
      break;
    case 110:
      err = "خطای " + error_id + ": " + message.e110;
      break;
  }

  $(".alertBox .alert span").text(err);
  $(".alertBox").fadeIn(300);
  $(".rapid_access div").hide();
  hide_After_time(10000);
}

function login() {
  let tel = $("#tel").val();
  const zaman = new Date();
  if (tel.length == 11) {
    $.ajax({
      type: "POST",
      url: "server.php",
      data: "tel=" + tel + "&login=" + zaman.getTime(),
      success: function (response) {
        if (response == true) {
          navigate("sms.php");
        } else if (response == false) {
          Toast(110);
        }
      },
    });
  } else {
    Toast(106);
  }
}

$(".btn-close").click(function () {
  $(".alertBox").fadeOut("slow");
  hide_After_time(1);
});

function hide_After_time(time) {
  const hide_After_time = setTimeout(function () {
    $(".alertBox").fadeOut("slow");
    $(".rapid_access div").fadeIn("slow");
    $("input").css("border", "1px solid #ced4da");
  }, time);
}

function check_code() {
  var c1 = $("#c1").val();
  var c2 = $("#c2").val();
  var c3 = $("#c3").val();
  var c4 = $("#c4").val();
  var c5 = $("#c5").val();
  var c6 = $("#c6").val();

  let user_code = c6 + "" + c5 + "" + c4 + "" + c3 + "" + c2 + "" + c1;

  $.ajax({
    type: "POST",
    url: "server.php",
    data: "verify=" + user_code,
    success: function (response) {
      if (response == 1) {
        $.ajax({
          data: "checkExist=ok",
          url: "server.php",
          type: "POST",
          success: function (response) {
            clearInterval(cd);
            navigate(".");
          },
        });
      } else if (response == 0) {
        Toast(102);
        $("#c1").val("");
        $("#c2").val("");
        $("#c3").val("");
        $("#c4").val("");
        $("#c5").val("");
        $("#c6").val("");
      }
    },
  });
}

function countLess() {
  let value = parseInt($("#remain_time").text()) - 1;
  if (value < 0) {
    clearInterval(cd);
    navigate("login.php");
  } else {
    $("#remain_time").text(value);
  }
}

function countDown() {
  $("#remain_time").text("60");
  cd = setInterval(countLess, 1000);
}

function next_place(event, id) {
  let value = event.key;
  if (value == "Backspace") {
    if (id == 6) {
      $("#c" + id).val("");
    } else {
      let number_box = $("#c" + id).val();
      if (number_box > 0) {
        $("#c" + id).val("");
      } else {
        $("#c" + (id + 1)).focus();
        $("#c" + id).val("");
        $("#c" + (id + 1)).val("");
      }
    }
  } else {
    $("#c" + (id - 1)).focus();
  }
}

function change_value(input_id, text_id) {
  var newData = $("#" + input_id).val();
  if (newData.length > 0) {
    if (text_id == "moneyLimit") {
      fee = $("#feeLimit").val();
      hazine = $("#sum_of_all_cost").text();
      if (hazine > fee) {
        Toast(107);
        $("#feeLimit").val("");
      } else {
        $.ajax({
          data: "sep=" + fee,
          url: "server.php",
          type: "POST",
          success: function (response) {
            $("#moneyLimit1").text(fee);
            $("#moneyLimit").text(response);
          },
        });
      }
    } else {
      $("#" + text_id).text(newData);
    }
    $(".gray_layer").click();
    $("#newCourseName").val("");
  } else {
    $(".gray_layer").click();
  }
}

class Contact {
  constructor(type) {
    switch (type) {
      case "add":
        this.add();
        break;
      case "add_new_contact_with_star":
        this.add_new_contact_with_star();
        break;
    }
  }

  add() {
    var contact_name = $("#newContactName").val();
    var contact_tel = $("#newContactTel").val();
    if (contact_name.length > 0 && contact_tel.length > 0) {
      $.ajax({
        data:
          "add_contact=ok&contact_name=" +
          contact_name +
          "&contact_tel=" +
          contact_tel,
        url: "server.php",
        type: "POST",
        success: function (response) {
          if (response > 1) {
            $.ajax({
              data:
                "Object_contact=1&contact_tel=" +
                contact_tel +
                "&contact_name=" +
                contact_name,
              url: "server.php",
              type: "POST",
              success: function (response) {
                $(".users_box").append(response);
                $("#newContactTel").val("");
                $("#newContactName").val("");
              },
            });
          } else if (response == 1) {
            Toast(105);
            alert_border("newContactTel");
            alert_border("newContactName");
          } else if (response == 0) {
            Toast(103);
            alert_border("newContactTel");
            alert_border("newContactName");
          }
        },
      });
    } else {
      Toast(104);
      alert_border("newContactName");
      alert_border("newContactTel");
    }
  }

  add_new_contact_with_star() {
    var contact_name = $("#newContactName").val();
    var contact_tel = $("#newContactTel").val();
    if (contact_name.length > 0) {
      $.ajax({
        data:
          "add_contact=ok&contact_name=" +
          contact_name +
          "&contact_tel=" +
          contact_tel,
        url: "server.php",
        type: "POST",
        success: function (response) {
          if (response > 1) {
            $.ajax({
              data: "Object_contact_2=ok",
              url: "server.php",
              type: "POST",
              success: function (response) {
                $(".users_box").fadeOut("slow");
                setTimeout(function () {
                  $(".users_box").empty();
                  $(".users_box").append(response);
                  $("#newContactTel").val("");
                  $("#newContactName").val("");
                  $(".users_box").fadeIn("slow");
                }, 400);
              },
            });
          } else if (response == 1) {
            Toast(105);
            alert_border("newContactTel");
            alert_border("newContactName");
          } else if (response == 0) {
            Toast(103);
            alert_border("newContactTel");
            alert_border("newContactName");
          }
        },
      });
    } else {
      Toast(104);
      alert_border("newContactName");
    }
  }
}

function alert_border(element_id) {
  $("#" + element_id).css("border", "1px solid #E91E63");
}

function bormal_border(element_id) {
  $("#" + element_id).css("border", "1px solid #ced4da;");
}

function searchContact() {
  var search = $(".search_box").val();
  if (search == "") {
    $(".contactBox").show();
  } else {
    $(".contactBox").hide();
    $(".contactBox")
      .filter("[data*='" + search + "']")
      .show();
  }
}

function addNewContact() {
  cont = new Contact("add");
  window.location.reload();
}

function saveNewCourse() {
  $("#savedate").click();
  var course_name = $("#courseName").text();
  var course_start = $("#start_from_fa").text();
  var money_limit = $("#moneyLimit1").text();
  var member_list = "";
  var members = $(".selected_user div").length / 2;
  for (i = 0; i < members; i++) {
    j = i + 1;
    member_list +=
      $(".selected_user div:nth-child(" + j + ")").attr("data") + ",";
  }
  $.ajax({
    data:
      "new_course=1&course_name=" +
      course_name +
      "&course_start=" +
      course_start +
      "&money_limit=" +
      money_limit +
      "&members=" +
      member_list,
    type: "POST",
    url: "server.php",
    success: function (response) {
      if (response > 0) {
        alert("دوره جدید با موفقیت ایجاد شد");
        window.location.assign("./?route=_activeCourse&h=null");
      }
    },
  });
}

function editNewCourse(id) {
  $("#savedate").click();
  var member_list = "";
  var members = $(".selected_user div").length / 2;
  for (i = 0; i < members; i++) {
    j = i + 1;
    member_list +=
      $(".selected_user div:nth-child(" + j + ")").attr("data") + ",";
  }
  $.ajax({
    data: "edit_course=" + id + "&members=" + member_list,
    type: "POST",
    url: "server.php",
    success: function (response) {
      if (response > 0) {
        alert("دوره جدید با موفقیت ویرایش شد");
        window.location.assign("./?route=_activeCourse&h=null");
      }
    },
  });
}

function update_course(course_id, key, value) {
  $.ajax({
    url: "server.php",
    data: "update_course=" + course_id + "&key=" + key + "&value=" + value,
    type: "POST",
    success: function (response) {
      return 1;
    },
  });
}

function chageSwitch(switch_name, course_id) {
  items = switch_name.split(course_id)[0];
  s_name = $("#" + switch_name + course_id).attr("data-type");
  if (s_name == "checked") {
    switch (items) {
      case "defaultCourse":
        update_course(course_id, "course_default", "NULL");
        break;
      case "disabledCourse":
        $(".tpr").removeClass("force_hide");
        update_course(course_id, "course_disabled", "NULL");
        break;
    }
    $("#" + switch_name + course_id).attr("data-type", "NULL");
    $("#" + switch_name + course_id).removeAttr("checked");
  } else {
    switch (items) {
      case "defaultCourse":
        update_course(course_id, "course_default", "checked");
        break;
      case "disabledCourse":
        $(".tpr").addClass(".force_hide");
        update_course(course_id, "course_disabled", "checked");
        break;
    }
    $("#" + switch_name + course_id).attr("data-type", "checked");
    $("#" + switch_name + course_id).attr("checked", "checked");
  }
  setTimeout(function () {
    window.location.reload();
  }, 1000);
}

function finishCourse(course_id, user_tel, type) {
  if (type == "finish") {
    ans = confirm("آیا می خواهید این دوره را به اتمام برسانید؟");
  } else if (type == "del") {
    ans = confirm("آیا می خواهید این دوره را حذف کنید؟");
  }

  if (ans == true) {
    user_tel = "0" + user_tel;
    z = new Date();
    y = String(z).split(" ")[0];

    mah = z.getMonth();
    rooz = z.getDate();
    saat = z.getHours();
    dagh = z.getMinutes();
    saniye = z.getSeconds();

    if (mah < 10) {
      mah = "0" + mah;
    }
    if (rooz < 10) {
      rooz = "0" + rooz;
    }
    if (saat < 10) {
      saat = "0" + saat;
    }
    if (dagh < 10) {
      dagh = "0" + dagh;
    }
    if (saniye < 10) {
      saniye = "0" + saniye;
    }

    my_time =
      z.getFullYear() +
      "/" +
      mah +
      "/" +
      rooz +
      " " +
      saat +
      ":" +
      dagh +
      ":" +
      saniye +
      " " +
      y;

    if (type == "finish") {
      update_course(course_id, "course_finish", "1");
      update_course(course_id, "course_finish_date", my_time);
      update_course(course_id, "course_finish_maker", user_tel);
    } else if (type == "del") {
      update_course(course_id, "course_del_course", "1");
      update_course(course_id, "course_del_date", my_time);
      update_course(course_id, "course_del_maker", user_tel);
      update_course(course_id, "course_default", "NULL");
    }

    window.location.reload();
  }
}

function editTrans() {
  let trans_id = $("#trans_id").val();
  let start_from_fa = $("#start_from_fa").text();
  let moneyLimit = $("#moneyLimit").text();
  let buyer_code = $("#buyer").val();
  let trans_desc = $("#trans_desc").val();
  let type = "";
  let karbar = "";

  let user_list = $("#karbaran").val().split(",");
  let user_list_count = user_list.length - 1;

  let trans_person = "";
  let trans_person_co = "";

  let radio_1 = $("#inlineRadio1").attr("checked");
  let radio_2 = $("#inlineRadio2").attr("checked");

  for (i = 0; i < user_list_count; i++) {
    // coefficient unit
    karbar = user_list[i];
    field_value = $("#user-" + karbar).val();
    second_value = $("#user_second_unit_" + karbar).text();

    if (radio_1 == "checked") {
      trans_person += karbar + ":" + second_value + "-";
      trans_person_co += karbar + ":" + field_value + ",";
      type = "coefficient";
    } else if (radio_2 == "checked") {
      trans_person_co += karbar + ":" + second_value + ",";
      trans_person += karbar + ":" + field_value + "-";
      type = "amount";

      //   $.ajax({
      //     data: "pure_num=" + field_value,
      //     type: "POST",
      //     url: "server.php",
      //     success: function (response) {
      //       sahm = Math.round((parseInt(response) * 100) / parseInt(pure_money));
      //       $("#user_second_unit_" + karbar).text(sahm);
      //       trans_person_co += karbar + ":" + sahm + ",";
      //       trans_person += karbar + ":" + response + ",";
      //
      //     },
      //   });
    }
  }

  k = confirm("آیا می خواهید تغییرات ذخیره شود؟");
  if (k == true) {
    $.ajax({
      data:
        "edit_trans=ok&trans_id=" +
        trans_id +
        "&start_from_fa=" +
        start_from_fa +
        "&moneyLimit=" +
        moneyLimit +
        "&trans_desc=" +
        trans_desc +
        "&trans_person=" +
        trans_person +
        "&trans_person_co=" +
        trans_person_co +
        "&type=" +
        type +
        "&buyer=" +
        buyer_code,
      url: "server.php",
      type: "POST",
      success: function (response) {
        if (response == 1) {
          alert("تراکنش با موفقیت ویرایش شد");
          //window.location.reload();
          history.back();
        } else {
          Toast(108);
        }
      },
    });
  }
}

function checkValue(id) {
  value = $("#user-" + id).val();
  if (value == 0) {
    $("#user-" + id).val("");
  }
}

function checkValue1(id) {
  value = $("#user-" + id).val();
  if (value == "") {
    $("#user-" + id).val(0);
  } else {
    sep("user-" + id);
  }
}

function buyer() {
  $(".gray_layer").show();
  $(".add_payments").show();
}

function del_contacts(tel) {
  let del_opt = confirm("آیا می خواهید مخاطب را حذف کنید؟");
  if (del_opt == true) {
    $.ajax({
      data: "del_contact=ok&tel=" + tel,
      url: "server.php",
      type: "POST",
      success: function (response) {
        if (response == 1) {
          // phone = $('#t-' + tel).text();
          // $(".contactBox")
          //   .filter("[data*='" + phone + "']")
          //   .hide('slow');
          // $(".contactBox")
          //   .filter("[data*='" + phone + "']")
          //   .remove();
          $(".users_box").empty();
          $.ajax({
            data: "Object_contact_2=ok",
            url: "server.php",
            type: "POST",
            success: function (response) {
              $(".users_box").html(response);
            },
          });
        }
      },
    });
  }
}

function add() {
  mokhatab = new Contact("add_new_contact_with_star");
}

function change_values(input_id, text_id) {
  var newData = $("#" + input_id).val();
  if (newData.length > 0) {
    // money limit
    if (text_id == "moneyLimit") {
      var course_id = $("#fee_code").val();
      fee = $("#feeLimit").val();
      hazine = $("#sum_of_all_cost" + course_id).text();
      if (hazine > fee) {
        Toast(107);
        $("#feeLimit").val("");
      } else {
        $.ajax({
          data:
            "update_course=" +
            course_id +
            "&key=course_money_limit&value=" +
            fee,
          url: "server.php",
          type: "POST",
          success: function (response) {
            $.ajax({
              data: "sep=" + fee,
              url: "server.php",
              type: "POST",
              success: function (response) {
                $("#moneyLimit" + course_id).text(response);
              },
            });
          },
        });
      }
    } else if (text_id == "courseName") {
      var course_id = $("#course_code").val();
      course_new_name = $("#newCourseName").val();
      if (course_new_name == "") {
        Toast(109);
        $("#newCourseName").val("");
      } else {
        $.ajax({
          data:
            "update_course=" +
            course_id +
            "&key=course_name&value=" +
            course_new_name,
          url: "server.php",
          type: "POST",
          success: function (response) {
            $("#courseName" + course_id).text(course_new_name);
          },
        });
      }
    } else {
      $("#" + text_id).text(newData);
    }
    $(".gray_layer").click();
    $("#newCourseName").val("");
  } else {
    $(".gray_layer").click();
  }
}

function saveDates() {
  shamsi = $("td.selected").attr("data-date");
  if (shamsi.length > 0) {
    $("#start_from_fa" + course_code).text(shamsi);
  } else {
    shamsi = $("td.today").attr("data-date");
  }

  shamsi_split = shamsi.split(",");
  let saal, maah, rooz;

  if (shamsi_split[1] < 10) {
    maah = "0" + shamsi_split[1];
  } else {
    maah = shamsi_split[1];
  }

  if (shamsi_split[2] < 10) {
    rooz = "0" + shamsi_split[2];
  } else {
    rooz = shamsi_split[2];
  }

  tarikh = shamsi_split[0] + "/" + maah + "/" + rooz;

  $("#start_from_fa" + course_code).text(tarikh);

  $(".month-grid-box .header").hide();
  $("#set_tarikh").hide("slow");
  $(".range-from-example").hide("slow");
  $(".end_course .w-100").show();
  $("#btn_add_new_contact").show();
  $(".savedate_tr").hide();
  $("#savedate").hide();
  $("#calendar_").hide();
  $(".gray_layer").hide();

  $.ajax({
    data:
      "update_course=" + course_code + "&key=course_start_date&value=" + tarikh,
    url: "server.php",
    type: "POST",
    success: function (response) {},
  });
}

function edit_contacts(id) {
  esm = $("#c-" + id).text();
  tel = $("#t-" + id).text();

  $("#newContactName").val(esm);
  $("#newContactTel").val(tel);
}

function select_course() {
  $(".gray_layer").show();
  $(".add_course").show();
}

$("#setCourse").click(function () {
  let course_value_id = $("#course_name").val();
  let course_value_text = $("#course_name option:selected").text();
  $("#course_name_show").text(course_value_text);
  $(".add_course").hide();
  $(".gray_layer").click();
  $("td.click").addClass("dore");
  $("#consumer_name").text("****");
  $(".contacts").empty();

  $.ajax({
    data: "getContactList=" + course_value_id,
    url: "server.php",
    type: "POST",
    success: function (response) {
      $("#zarib").show();
      $("label").filter("[for='zarib']").show();
      $("#mablagh").show();
      $("label").filter("[for='mablagh']").show();
      $("#karbaran").remove();
      $("#mablagh").click();
    },
  });
});

function addTrans() {
  let sahm_mablagh = "";
  let sahm_co = "";
  let final_pos = false;
  let share_type = "amount";

  trans_date = $("#start_from_fa").text();

  money_limit = $("#moneyLimit").text();
  y = money_limit.split(",");
  sum_ml = 0;
  for (m = 0; m < y.length; m++) {
    sum_ml += y[m] + "";
  }

  money_limit = parseInt(sum_ml);

  trans_desc = $("#trans_desc").val();
  let karbaran = $("#karbaran").val().split(",");

  let radio_btn = $("input[type='radio']:checked").val();

  sum_karbar = 0;
  for (i = 0; i < karbaran.length - 1; i++) {
    karbar_value = $("#user-" + karbaran[i]).val();
    x = karbar_value.split(",");
    sum_kar = 0;
    for (k = 0; k < x.length; k++) {
      sum_kar += x[k] + "";
    }

    sum_karbar += parseInt(sum_kar);
    sum_kar = parseInt(sum_kar);

    if (radio_btn == "zarib") {
      share_type = "coefficient";
      sahm_co += karbaran[i] + ":" + sum_kar + ",";
      sahm_mablagh += karbaran[i] + ":" + "0,";
    } else if (radio_btn == "mablagh") {
      share_type = "amount";
      sahm_mablagh += karbaran[i] + ":" + sum_kar + ",";
      sahm_co += karbaran[i] + ":" + "0,";
    }
  }

  if (radio_btn == "mablagh") {
    if (money_limit == sum_karbar) {
      final_pos = true;
    } else {
      alert("مجموع سهم افراد با مبلغ تراکنش برابر نمی باشد");
      final_pos = false;
    }
  } else {
    final_pos = true;
  }

  if (final_pos == true) {
    let ans = confirm("آیا می خواهید خرید جدید ثبت کنید؟");
    if (ans == true) {
      $.ajax({
        data:
          "add_trans=ok&trans_date=" +
          trans_date +
          "&money_limit=" +
          money_limit +
          "&karbaran=" +
          sahm_mablagh +
          "&karbaran_co=" +
          sahm_co +
          "&share_type=" +
          share_type +
          "&trans_desc" +
          trans_desc,
        url: "server.php",
        type: "POST",
        success: function (response) {
          if (response == 1) {
            alert("خرید جدید با موفقیت ثبت شد");
            history.back();
          }
        },
      });
    }
  }
}

function del_trans(id) {
  acc = confirm("آیا می خواهید این تراکنش را حذف کنید؟");
  if (acc == true) {
    $.ajax({
      data: "del_trans=" + id,
      type: "POST",
      url: "server.php",
      success: function (response) {
        if (response == 1) {
          alert("تراکنش با موفقیت حذف شد");
          window.location.reload();
        }
      },
    });
  }
}

function course_request_reg(course_id) {
  acc = confirm("آیا از ارسال درخواست مطمئن هستید؟");
  if (acc == true) {
    reg_fname = $("#reg_fname").val();
    reg_lname = $("#reg_lname").val();
    reg_tel = $("#reg_tel").val();
    reg_desc = $("#reg_desc").val();
    if (
      reg_fname.length > 3 &&
      reg_lname.length > 3 &&
      reg_tel.length > 10 &&
      reg_desc.length > 3
    ) {
      $.ajax({
        data:
          "reg_course=" +
          course_id +
          "&reg_fname=" +
          reg_fname +
          "&reg_lname=" +
          reg_lname +
          "&reg_tel=" +
          reg_tel +
          "&reg_desc=" +
          reg_desc,
        url: "server.php",
        type: "POST",
        success: function (response) {
          //if(response == 1){
          alert("درخواست شما با موفقیت ارسال شد");
          window.location.assign("./login.php");
          //}
        },
      });
    }else{
      alert("لطفا همه فیلد ها را تکمیل کنید");
    }
  }
}

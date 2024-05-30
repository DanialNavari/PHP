function get_location(pos) {
  navigator.geolocation.getCurrentPosition(function success(position) {
    let lat = position.coords.latitude;
    let long = position.coords.longitude;
    let acc = position.coords.accuracy;
    let alti = position.coords.altitude;
    let headi = position.coords.heading;
    let speed = position.coords.speed;
    let times = position.coords.timestamp;

    if (pos == 0) {
      $.ajax({
        type: "GET",
        url: "https://perfumeara.com/webapp/app/neshan.php",
        data: {
          lat: lat,
          lon: long,
        },
        success: function (data) {
          const obj = JSON.parse(data);
          $("#my_hood").html(obj.hood);
          hood = obj.hood;
          zone = obj.zone;
          addr = obj.addr;
          city = obj.city;
          var uid = $("#uids").val();
          $.ajax({
            type: "GET",
            url: "https://perfumeara.com/webapp/app/server.php",
            data: {
              uid: uid,
              hood: hood,
              lat: lat,
              lon: long,
              zone: zone,
              addr: addr,
              city: city,
            },
            success: function (data) {
              if (data == 0) {
                $("#my_hood").css("background-color", "#e15361");
              } else {
                $("#my_hood").css("background-color", "#48b461");
              }
              $("#loc_id").val(data);
              return data;
            },
          });
        },
      });
    } else if (pos == 1) {
      /* check neighbouthood */
      var uid = $("#uids").val();
      $.ajax({
        type: "GET",
        url: "https://perfumeara.com/webapp/app/server.php",
        data: {
          uid: uid,
          hood: "-",
          lat: lat,
          lon: long,
          zone: "-",
          addr: "-",
          city: "-",
        },
        success: function (data) {
          return data;
        },
      });
    }
  });
}

function telegram(link) {
  window.location.assign("tg://resolve?domain=" + link);
}

function tel(mtel) {
  window.location.assign("tel://" + mtel);
}

function makan() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function success(position) {
      let lat = position.coords.latitude;
      let long = position.coords.longitude;
    });
  }
}

function open_page(x, y = null, z = null, last_page = null, get_loc = false) {
  if (x == 'visit') {
    xx = get_location(0);
    loc_id = $("#loc_id").val();
    mm = "visit.php?" + y + "=ok&loc=" + loc_id;
    $(".page").load(mm);
  } else {
    if (get_loc == true) {
      xx = get_location(0);
    }

    if (y != null && z != "ok") {
      masir = x + ".php?" + y + "=" + z;
      $(".page").load(masir);

    } else if (z == "ok") {
      loc_id = $("#loc_id").val();
      masir = x + ".php?" + y + "=" + loc_id;
      $(".page").load(masir);

    } else {
      $(".page").load(x + ".php");
    }
    $("#pp").val(last_page);
  }


}

function open_factor(x) {
  masir = "factor.php?cat=" + x;
  $(".page").load(masir);
}

function open_web(x) {
  window.location.assign("https://" + x);
}

function chkLogin() {
  mtel = $("#tel").val();
  pass = $("#pass").val();
  family = $("#family").val();
  uid = $("#uids").val();

  $.ajax({
    url: "server.php",
    data:
      "tel=" +
      mtel +
      "&pass=" +
      pass +
      "&family=" +
      family +
      "&uid=" +
      uid +
      "&type=register",
    type: "POST",
    success: function (result) {
      switch (result) {
        case "0.1":
          alert("نام و نام خانوادگی خود را وارد کنید");
          break;
        case "0.2":
          alert("شماره موبایل را به درستی وارد کنید");
          break;
        case "0.3":
          alert("رمز عبور را وارد کنید");
          break;
        case "0.4":
          alert("کد فعالسازی را وارد کنید");
          break;
        case "1":
          $("mtel").val("");
          $("family").val("");
          $("pass").val("");
          $("uid").val("");
          open_page("success");
          break;
        case "2":
          alert("کاربری با این مشخصات وجود دارد");
          break;
      }
    },
  });
}

function Login() {
  mtel = $("#tel").val();
  pass = $("#pass").val();

  $.ajax({
    url: "server.php",
    data: "tel=" + mtel + "&pass=" + pass + "&type=login",
    type: "POST",
    success: function (result) {
      if (Number(result) > 0) {
        $("#mtel").val("");
        $("#family").val("");
        $("#pass").val("");
        $("#uid").val("");
        open_page("panel", "uid", String(result));
      } else {
        alert("شماره موبایل یا رمز عبور نادرست است");
      }
    },
  });
}

$(".close_bar").click(function () {
  $(".close_bar").hide();
  $(".open_bar").show();
  //$(".final_pay_btn").show();
});

$(".open_bar").click(function () {
  $(".open_bar").hide();
  //$(".final_pay_btn").hide();
  $(".close_bar").show();
});

function order(btn_pos) {
  if (btn_pos == 0) {
    buy_pos = "-";
  } else {
    buy_pos = "+";
  }

  if (
    $("#shop_name").val() == "" ||
    $("#shop_manager").val() == "" ||
    $("#shop_tel").val() == "" ||
    $("#customer_type").val() == ""
  ) {
    alert("لطفا همه فیلد ها را تکمیل کنید");
  } else {
    var loc = $("#loc_id").val();
    if (loc > 0) {
      loc = $("#loc_id").val();
    } else {
      loc = 0;
    }
    $.ajax({
      type: "GET",
      url: "https://perfumeara.com/webapp/app/server.php",
      data: {
        order: "ok",
        shop_name: $("#shop_name").val(),
        shop_manager: $("#shop_manager").val(),
        loc_id: loc,
        login: $("#login_shop").val(),
        shop_tel: $("#shop_tel").val(),
        customer_type: $("#customer_type").val(),
        buy_pos: buy_pos,
        factor_id: $("#factor_id").val(),
        codem: $("#codem").val(),
        addr: $("#shop_addr").val(),
      },
      success: function (data) {
        if (btn_pos == 1) {
          /* $("#factor_1").show();
          $("#cdb_form").hide();
          $("#visit_result").hide(); */
          open_page('visit', 'f', 'ok', '1', false);
        } else {
          $("#digital_sign").show();
          $("#visit_result").hide();
          $("#cdb_form").hide();
          open_page('p_sign');
        }
      },
    });
  }
}

$("#negetive").click(function () {
  order(0);
  $(".return_home").hide();
});

$("#positive").click(function () {
  order(1);
  //$("#pp").val(2);
  $(".return_home").hide();
});

$(".return_home").click(function () {
  $.ajax({
    type: "GET",
    url: "https://perfumeara.com/webapp/app/server.php",
    data: {
      order: "no",
    },
    success: function (data) {
      $("#cdb_form").show();
      $("#visit_result").hide();
      $("#factor_1").hide();
      $(".final_pay_btn").hide();
      $(".page").load("enter.php");
    },
  });
});

$("#img_full").click(function () {
  $("#all_prod").show();
  $(".full_screen").hide();
  $("#img_full").attr("src", "");
  $(".final_pay_btn").show();
  /*   $('#final_pay_btn').hide();
    $('#show_basket').hide(); */
});

$(".img_prod img").click(function () {
  masir = $(this).attr("src");
  $("#all_prod").hide();
  $("#img_full").attr("src", masir);
  $(".full_screen").show();
  /*   $(".final_pay_btn").hide(); */
});

function set_page_addr(x) {
  $("#pt").val(x);
}

function numberWithCommas(x) {
  return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
}

function test(x) {
  const result = numberWithCommas(x);
  const pass = result;
  return pass;
}

function cal_price_with_offer(id) {
  numbers = $("#n" + id).val();
  offers = $("#o" + id).val();
  price = $("#e" + id).text();
  testers = $("#t" + id).val();
  totall =
    (parseInt(numbers) * parseInt(price)) /
    (parseInt(numbers) + parseInt(offers));
  totalm =
    (parseInt(numbers) * parseInt(price)) /
    (parseInt(numbers) + parseInt(offers) + parseInt(testers));
  $("#l" + id).text(parseInt(totall));
  $("#m" + id).text(parseInt(totalm));
}

function customer(x) {
  if (x == 1) {
    $("#customer_type").val("new");
  } else {
    $("#customer_type").val("old");
  }
}

$("#saveResult").click(function () {
  /* var vc = $("iframe").contents().find("a.download").attr("href");
  if (vc) {
    vc = $("iframe").contents().find("a.download").attr("href");
  } else {
    vc = "";
  } */
  $.ajax({
    type: "GET",
    url: "https://perfumeara.com/webapp/app/server.php",
    data: {
      result: $("#visit_text").val(),
    },
    success: function (data) {
      window.location.assign(".");
    },
  });
});

function save_order(x, y) {
  if ($("#o" + x).val() == "") {
    $("#o" + x).val(0);
    cal_price_with_offer(x);
  }
  if ($("#n" + x).val() == "") {
    $("#n" + x).val(0);
    cal_price_with_offer(x);
  }
  if ($("#t" + x).val() == "") {
    $("#t" + x).val(0);
    cal_price_with_offer(x);
  }

  $.ajax({
    type: "GET",
    url: "https://perfumeara.com/webapp/app/server.php",
    data: {
      factor: "ok",
      code: x,
      tedad: $("#n" + x).val(),
      offer: $("#o" + x).val(),
      tester: $("#t" + x).val(),
      base_fee: $("#e" + x).text(),
      final_fee: $("#m" + x).text(),
      cat: y,
    },
    success: function (result) {
      if (result == 1) {
        $(".result_pos").removeClass("bg-danger");
        $(".result_pos").addClass("bg-success");
        $(".result_pos").html("سفارش با موفقیت ثبت شد");
        $(".result_pos").show();
        $(".final_pay_btn").css("display", "flex");
        $("#del_order" + x).css("display", "");
        setTimeout(function () {
          $(".result_pos").hide();
        }, 2000);
      }
    },
  });

}

function del_order(x) {
  let text = "آیا می خواهید سفارشی که ثبت شده را حذف کنید؟";
  if (confirm(text) == true) {
    $.ajax({
      type: "GET",
      url: "https://perfumeara.com/webapp/app/server.php",
      data: {
        basket: "ok",
        code: x,
      },
      success: function (result) {
        $(".result_pos").removeClass("bg-success");
        $(".result_pos").addClass("bg-danger");
        $(".result_pos").html("سفارش حذف شد");
        $(".result_pos").show();
        setTimeout(function () {
          $(".result_pos").hide();
        }, 2000);
        if (result >= 0) {
          $("#del_order" + x).css("display", "none");
        }

        $('#n' + x).val('');
        $('#o' + x).val('');
        $('#t' + x).val('');

      },
    });
  }
}

$("#show_basket").click(function () {
  $(".show_factor").html("");
  $(".show_factor").load("basket.php");
  $(".show_factor").show();
  $(".final_pay_btn").hide();
  $("#factor_1").hide();
});

$(".show_factor").click(function () {
  $(this).hide();
  $(".show_factor table").hide();
  $(".show_factor").hide();
  $(".final_pay_btn").show();
  $(".final_pay_btn").css('display', 'flex');
  $("#factor_1").show();
});

function final_pay() {
  $('#final_save').css('display', 'inline;');
  $('#final_pay_btn').css('display', 'none;');

  $.ajax({
    type: "GET",
    url: "https://perfumeara.com/webapp/app/server.php",
    data: {
      final_pay: "ok",
    },
    success: function (result) {
      if (result > 0) {
        open_page('final');
      } else {
        alert('هیچ سفارشی ثبت نشده است');
      }
    }
  });
}

function return_cat() {
  open_page('visit', 'f', 'ok', '1', false);
  $('#return_cat').hide();
  $('#final_save').hide();
  $('#final_pay_btn').css('display', 'inline');
}

function final_save() {
  var factor_id = $('#f_id').val();
  var tasviye = $('#tasviye').val();
  var desc = $('#desc_factor').val();
  $.ajax({
    type: "GET",
    data: {
      factor_id: factor_id,
      tasviye: tasviye,
      desc: desc
    },
    url: 'https://perfumeara.com/webapp/app/server.php',
    success: function (result) {
      if (result == 1) {
        open_page('p_sign');
        $('#uids').hide();
        $('.final_pay_btn').hide();
        $('.hor').css('width', '98vw');
      }
    }
  });
}
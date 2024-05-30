function nerkh() {
  let fee = $("#fee").val();
  let less = $("#less").val();
  let fpay = (fee * less) / 100;
  let totalpay = Math.round(fee - fpay);

  $("#finalpay").val(totalpay);

  let length = totalpay.toString().length;
  let sepCount = Math.floor(length);
  /*   while (i < sepCount) {
    
  } */
  $("#pay").text(totalpay);
  /* jquery send form */
}

$("#sendSMS").click(function () {
    let esm = $("#esm").val();
    let phone = $("#phone").val();
    let zaman = $("#zaman").val();
    let less = $("#less").val();
    let fee = $("#fee").val();
    let matn = $("#matn").text();
    let finalpay = $("#finalpay").val();
          $.ajax({
            url: "panel.php",
            data: "esm=" + esm + "&phone=" + phone + "&zaman=" + zaman +
            "&less=" + less + "&finalpay=" + finalpay+"&fee="+fee+"&matn="+matn,
            type: "POST",
            success: function (result) {
              $('#result').html(result);
            },
          });
        });

$("#nextLevel").click(function () {
    let esm = $("#esm").val();
    $.ajax({
        url: "panel.php",
        data: "lastCode=1",
        type: "POST",
        success: function (result) {
          let lastCode = result;
          let linkpay = "https://baharara.com/pay/?ID="+lastCode.trim();
          $('.login').slideUp("slow");
          $('#matn').text('سلام ' + esm + '\nلطفا برای مشاهده صورتحساب خود روی لینک زیر کلیک کنید.\n' +linkpay+ '\nشرکت بهارآرا خراسان');
          $('.final').show();
        }
    });
});

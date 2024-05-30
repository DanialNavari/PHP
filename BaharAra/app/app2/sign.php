<style>
    #clearBtn,
    #saveBtn {
        margin-right: 1rem;
    }

    div#sign_btn {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        align-items: center;
        width: 70vw;
        margin: 0 10vw;
        justify-content: space-between;
    }
</style>

<script src="./js/jquery-3.4.1.min.js"></script>
<script src="./js/jq-signature.js"></script>

<div class='js-signature'>
</div>
<div id="img"></div>
<div id="sign_btn">
    <button id="clearBtn" class="btn btn-danger" onclick="clearCanvas();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
        </svg> حذف
    </button>
    <button id="saveBtn" class="btn btn-success" onclick="saveSignature();">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </svg> ذخیره
    </button>
</div>
<form method="post" action="result.php" enctype="multipart/form-data" id="form">
    <textarea name="code" id="code" style="display:none"></textarea>
</form>
<script>
    $('.js-signature').jqSignature();

    function clearCanvas() {
        var canvas1 = document.getElementById('jq-signature-canvas-1');
        var context = canvas1.getContext('2d');
        context.fillStyle = "white";
        context.clearRect(0, 0, canvas1.width, canvas1.height);
    }

    function saveSignature() {
        var canvas1 = document.getElementById("jq-signature-canvas-1");
        if (canvas1.getContext) {
            var images = canvas1.toDataURL("image/png").replace("image/png", "image/octet-stream");
            var context = canvas1.getContext('2d');
            context.fillStyle = "white";

            /* download image */
            /*canvas1.toBlob(function(blob) {
            saveAs(blob, "pretty image.png");
            });*/

            let sign = images;
            const sign_str = sign.split(";");

            const d_img = sign_str[0]; //***
            const d_all = sign_str[1];

            const id_img = d_all.split(",");

            const b_img = id_img[0];

            const all_img = id_img[1];

            $('#code').html(images);
            $('#form').submit();
        } else {
            alert('لطفا امضای مشتری را ثبت کنید');
        }
    }

    $('.js-signature').eq(1).on('jq.signature.changed', function() {
        $('#saveBtn').attr('disabled', false);
    });

    $('#jq-signature-canvas-1').css('height', '');
    $('#jq-signature-canvas-1').css('width', '');

    $('#jq-signature-canvas-1').attr('height', '400');
    $('#jq-signature-canvas-1').attr('width', '400');

    var canvas = document.getElementById('jq-signature-canvas-1');
    var context = canvas.getContext('2d');
    context.lineWidth = 7;
    context.strokeStyle = 'blue';
</script>
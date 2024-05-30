<script src="./js/jquery-3.4.1.min.js"></script>
<script src="./js/jq-signature.js"></script>

<style>
    #clearBtn,
    #saveBtn {
        width: 35%;
        margin-right: 1rem;
        margin-bottom: 0.5rem;
    }
</style>
<div class='js-signature'>
</div>
<div id="img"></div>
<button id="clearBtn" class="btn btn-danger" onclick="clearCanvas();">Clear Canvas</button>
<button id="saveBtn" class="btn btn-success" onclick="saveSignature();">Save Signature</button>
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
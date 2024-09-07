<meta charset="UTF8" />
<br />
<br />
<br />
<br />
<br />
<br />
<?php
require_once('func.php');

$name = $_GET['p'];
echo "<label id='alpha_f'>$name</label>";
?>
<style>
    #mors,#alpha_f{
        padding: 1rem;
    }
</style>
<h2 id="mors"></h2>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<script>
    string = $("#alpha_f").text();
    araye = string.split("");
    $.ajax({
        data: "mors=" + araye,
        type: "POST",
        url: 'server.php',
        success: function(response) {
            $("#mors").text(response);
        }
    });
</script>
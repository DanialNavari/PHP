<html>

<head>
    <title> Track Mouse </title>
</head>

<body>

    <form name="Form1">
        POSX: <input type="text" id="posx"><br>
        POSY: <input type="text" id="posy"><br>
    </form>

    <script src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript">
        $("body").mousemove(function(e) {
            $('#posx') = e.pageX;
            $('#posy') = e.pageY;
        })
    </script>
</body>

</html>
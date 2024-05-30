<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/bootstrap-rtl.min.css">
</head>

<body>
    <div class="update">
        <div class="oldver"><?php echo $_GET['old_ver']; ?></div>
        <div class="newver"><?php echo $_GET['new_ver']; ?></div>
        <button class="btn btn-warning">به روز رسانی</button>
    </div>

    <script src="./js/index.js"></script>
    <script src="./js/jquery-3.4.1.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
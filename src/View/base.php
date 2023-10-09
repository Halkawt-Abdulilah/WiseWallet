<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?php
        echo ucfirst(str_replace("View", "", $title));
        ?>
    </title>
    <link rel="stylesheet" href="public/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/assets/css/style.css">
    <script src="public/assets/js/jquery-3.3.1.slim.min.js" defer></script>
    <script src="public/assets/js/popper.min.js" defer></script>
    <script src="public/assets/js/bootstrap.min.js" defer></script>
    <script src="public/assets/js/script.js" defer></script>
</head>

<body>
    <header>
        <nav>
            <?php echo $navbar ?>
        </nav>
    </header>
    <main>
        <?php echo $mainContent ?>
    </main>
    <footer>
        <!-- <?php echo $footerContent ?> -->
    </footer>
</body>

</html>
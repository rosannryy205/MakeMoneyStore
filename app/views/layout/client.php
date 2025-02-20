<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/index.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/login.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/forgot.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Abel&family=Dosis:wght@200..800&display=swap" rel="stylesheet">
</head>

<body>
    <?php
    $this->render('layout/header');

    // Render content
    if (isset($sub_content) && is_array($sub_content)) {
        // Nếu sub_content tồn tại và là mảng, render
        $this->render($content, $sub_content);
    } else {
        // Nếu không có sub_content, render một mảng rỗng hoặc mặc định
        $this->render($content, []);
    }
    // Render footer
    $this->render('layout/footer');
    ?>
    <script src="<?= _WEB_ROOT_ ?>/public/js/detail.js"></script>
</body>
</html>



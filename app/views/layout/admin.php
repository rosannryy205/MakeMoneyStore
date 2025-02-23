<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Converse Store</title>
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/admin.css">
    <link rel="stylesheet" href="<?= _WEB_ROOT_ ?>/public/css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
</head>

<body>
    <?php
    $this->render('layout/header_admin');

    // Render content
    if (isset($sub_content) && is_array($sub_content)) {
        // Nếu sub_content tồn tại và là mảng, render
        $this->render($content, $sub_content);
    } else {
        // Nếu không có sub_content, render một mảng rỗng hoặc mặc định
        $this->render($content, []);
    }
    // Render footer
    ?>
</body>

</html>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>/css/templateSignUp.css">

    <title><?= $title ?></title>
</head>
<body>
<div class="container">
    <div class="signup position-absolute top-50 start-50 translate-middle p-3">
        <h1 class="text-center mb-3"><?= $title ?></h1>
        <div class="form">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</div>
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/templateSignUp.js"></script>
</body>
</html>


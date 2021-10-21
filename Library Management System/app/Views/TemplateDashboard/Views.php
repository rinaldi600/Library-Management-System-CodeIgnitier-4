<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/templateDashboard.css" rel="stylesheet">

    <title>Dashboard <?= $title ?></title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Dashboard <?= $title ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <?= $this->renderSection('logout') ?>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="content-container">
    <?php if (session()->getFlashdata('successAddNewBook')) { ?>
        <div class="alert-success-add-book">
            <div class="alert alert-success message-success-add-book" role="alert">
               <?= session()->getFlashdata('successAddNewBook') ?>, just refresh for close this alert
            </div>
        </div>
    <?php } ?>
    <div class="background"></div>

    <div class="link-feature">
        <div class="images-profile">
            <?= $this->renderSection('link-feature') ?>
        </div>
    </div>

    <div class="menu-home">
        <div class="navbar-menu">
            <div class="hamburger">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </div>
        <div class="content">
            <?= $this->renderSection('content') ?>
        </div>
    </div>

</div>

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/templateDashboard.js"></script>
<script src="<?= base_url() ?>/js/JQuery.js"></script>

<!--FAKE ISBN API-->
<script src="https://unpkg.com/@phuocng/fake-numbers@1.0.0/umd/fake-numbers.min.js"></script>

<script>
    const buttonGenerateISBN = document.querySelector('.generate-random-isbn');
    const isbnInput = document.querySelector('.isbn-input');

    buttonGenerateISBN.addEventListener('click', () => {
        isbnInput.value = FakeNumbers.isbn.fake();
    });
</script>


</body>
</html>

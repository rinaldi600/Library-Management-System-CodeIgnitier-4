<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="<?= base_url() ?>/css/idAdmin.css" rel="stylesheet">

    <title>Generate ID Admin Library</title>
</head>
<body>

    <div class="container">
        <div class="forms-id position-absolute top-50 start-50 translate-middle">
            <h1 class="text-center">Generate ID Admin Library</h1>
            <form>
                <div class="generate d-flex gap-2 flex-wrap align-content-center justify-content-center">
                    <div class="alert alert-light border border-dark result-id d-grid align-content-center position-relative" role="alert">
                        <p class="position-absolute top-50 start-50 translate-middle">Click Button Generate To Get ID Admin</p>
                    </div>
                    <div class="button-generate d-flex gap-2">
                        <button type="button" class="btn btn-primary generate">Generate</button>
                        <button type="button" class="btn btn-success add">Add</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="<?= base_url() ?>/js/idAdmin.js"></script>
<script src="<?= base_url() ?>/js/JQuery.js"></script>
</body>
</html>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="<?= base_url() ?>/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url() ?>/css/selectUsers.css">

    <title>Select Users</title>
</head>
<body>


<div class="container">
    <div class="select-user position-absolute top-50 start-50 translate-middle d-grid justify-content-center align-content-center gap-2">
        <h1>Select Option</h1>
        <div class="admin btn btn-outline-secondary">
            <a class="text-decoration-none text-dark" href="/admin">Admin</a>
        </div>
        <div class="user btn btn-outline-secondary">
            <a class="text-decoration-none text-dark" href="/user">User</a>
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="<?= base_url() ?>/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
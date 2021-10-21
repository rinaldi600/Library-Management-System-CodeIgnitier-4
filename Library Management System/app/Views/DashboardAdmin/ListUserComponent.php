<?= $this->extend('TemplateDashboard/Views') ?>

<?= $this->section('logout') ?>
<form action="/dashboardAdmin/logoutAdmin" method="post">
    <button type="submit" class="text-white btn" name="logoutAdmin">log Out</button>
</form>
<?= $this->endSection() ?>

<?= $this->section('link-feature') ?>
<div class="indentity">
    <img class="mt-2" src="<?= base_url() ?>/profile/<?= $adminData["picture"] ?>" alt="">
    <p class="text-center"><?= $adminData["nama"] ?> ( <?= $adminData["username"] ?> )</p>
</div>
<div class="list-link text-center mt-4">
    <div class="mb-3">
        <div class="number">
            <p><?= $listUser ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardAdmin/listUser">List User</a>
    </div>
    <div class="mb-3">
        <div class="number">
            <p><?= $acceptCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardAdmin/acceptUser">Accept Book</a>
    </div>
    <div class="mb-3">
        <div class="number">
            <p><?= $pendingCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardAdmin/pendingRequest">Pending Book</a>
    </div>
    <div class="mb-3">
        <div class="number">
            <p><?= $declineCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardAdmin/declineRequest">Decline Book</a>
    </div>
    <div class="mb-3">
        <div class="number">
            <p><?= $completeCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardAdmin/completeRead">Complete Read</a>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Seach User" name="keywordSearch">
        <button class="btn btn-primary" type="submit" id="button-addon2">Search User</button>
    </div>
</form>

<?php if (session()->getFlashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php  } ?>
<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">ID User</th>
            <th scope="col">Nama</th>
            <th scope="col">Email</th>
            <th scope="col">Picture</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($users) <= 0) { ?>
            <td colspan="9">
                <div class="alert alert-danger" role="alert">
                    Data Not Found
                </div>
            </td>
        <?php } ?>
        <?php foreach ($users as $user) { ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $user["idUser"] ?></td>
                <td><?= $user["nama"] ?></td>
                <td><?= $user["email"] ?></td>
                <td>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary detail-user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <img class="img-thumbnail cover" src="<?= base_url() ?>/profile/<?= $user["picture"] ?>" alt="">
                        <img class="img-thumbnail full-picture" src="<?= base_url() ?>/profile/<?= $user["picture"] ?>" alt="">
                    </button>
                </td>
                <td class="d-flex gap-3">
                    <form action="/dashboardAdmin/deleteUser" method="post">
                        <input type="hidden" value="<?= $user["idUser"] ?>" name="getIdUser">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Do you sure delete User ?')">Delete</button>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="d-grid justify-content-center">
        <?= $pager->links('rent','custom_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?>

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
        <input type="text" class="form-control" placeholder="Search User or Book" name="keywordSearch">
        <button class="btn btn-primary" type="submit" id="button-addon2">Search</button>
    </div>
</form>

<?php if (session()->getFlashdata('notifications')) { ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('notifications') ?>
    </div>
<?php } ?>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Rent</th>
            <th scope="col">ID User</th>
            <th scope="col">ID Book</th>
            <th scope="col">Status</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        <?php if (count($users) <= 0) { ?>
            <td colspan="9">
                <div class="alert alert-danger" role="alert">
                    Data Not Found <a href="/dashboardAdmin/declineRequest">Back</a>
                </div>
            </td>
        <?php } ?>
        <?php foreach ($users as $rent) { ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $rent["idRent"] ?></td>
                <td>
                    <input type="hidden" value="<?= $rent["idUser"] ?>" name="getIDUser">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary get-id-user" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?= $rent["idUser"] ?>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td>
                    <input class="id-book" type="hidden" value="<?= $rent["idBook"] ?>" name="getIdBook">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary detail-book" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <?= $rent["idBook"] ?>
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Detail</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td><?= $rent["status"] ?></td>
                <td class="d-flex gap-3">
                    <form action="/dashboardAdmin/acceptRequest" method="post">
                        <input type="hidden" value="<?= $rent["idRent"] ?>" name="getIdRent">
                        <button class="btn btn-primary" type="submit" onclick="return confirm('Do you sure cancel accept book ?')">Accept</button>
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

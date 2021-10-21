<?= $this->extend('TemplateDashboard/Views') ?>

<?= $this->section('logout') ?>
<form action="/dashboardUser/logoutUser" method="post">
    <button type="submit" class="text-white btn" name="logoutUser">log Out</button>
</form>
<?= $this->endSection() ?>

<?= $this->section('link-feature') ?>
<div class="indentity">
    <img class="mt-2" src="<?= base_url() ?>/profile/<?= $userData["picture"] ?>" alt="">
    <p class="text-center"><?= $userData["nama"] ?></p>
</div>
<div class="list-link text-center mt-4">
    <div class="mb-3">
        <div class="number">
            <p><?= $acceptCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardUser/acceptBook">Accept Book</a>
    </div>
    <div class="mb-3">
        <?php $countPendingBook = 0 ?>
        <?php foreach ($rentData as $rent) { ?>
            <?php $countPendingBook++ ?>
        <?php } ?>
        <div class="number">
            <p><?= $countPendingBook ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardUser/pendingBook">Pending Book</a>
    </div>
    <div class="mb-3">
        <div class="number">
            <p><?= $declineCount ?></p>
        </div>
        <a class="text-decoration-none text-dark" href="/dashboardUser/declineBook">Decline Book</a>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<form class="mt-4" action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Seach Book" name="keywordSearch">
        <button class="btn btn-primary" type="submit" id="button-addon2">Search Book</button>
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
            <th scope="col">ISBN</th>
            <th scope="col">Title</th>
            <th scope="col">Status</th>
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
        <?php foreach ($users as $rent) { ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $rent["idRent"] ?></td>
                <td>
                    <input type="hidden" name="getIDUser" value="<?= $rent["idUser"] ?>">
                    <button type="button" class="btn btn-outline-secondary rent-id-user" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    <input type="hidden" name="getIDBook" value="<?= $rent["idBook"] ?>">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-outline-secondary rent-id-book" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                                    <h1>KKK</h1>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
                <td><?= $rent["ISBN"] ?></td>
                <td><?= $rent["title"] ?></td>
                <td><?= $rent["status"] ?></td>
                <td>
                    <img class="img-thumbnail cover" src="<?= base_url() ?>/cover/<?= $rent["picture"] ?>" alt="">
                </td>

                <td class="d-flex gap-3">
                    <form action="/dashboardUser/returnBook" method="post">
                        <input type="hidden" value="<?= $rent["idBook"] ?>" name="getIdBook">
                        <button class="btn btn-success" type="submit" onclick="return confirm('Do you sure cancel return this book ?')">Return the book</button>
                    </form>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#readBook">
                        Read Book
                    </button>

                    <div class="modal fade" id="readBook" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Happy reading</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img class="img-fluid" src="<?= base_url() ?>/cover/studio-media-9DaOYUYnOls-unsplash.jpg" alt="">
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
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

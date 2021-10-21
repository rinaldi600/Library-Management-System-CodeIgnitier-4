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
<div class="create-book">
    <a class="btn btn-primary mb-3" href="/dashboardAdmin/addBook">Add Book</a>
</div>
<?php if (session()->getFlashdata('message')) { ?>
    <div class="alert alert-success" role="alert">
        <?= session()->getFlashdata('message') ?>
    </div>
<?php  } ?>
<form action="" method="get">
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Seach Book" name="keywordSearch">
        <button class="btn btn-primary" type="submit" id="button-addon2">Search Book</button>
    </div>
</form>

<div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">No.</th>
            <th scope="col">ID Book</th>
            <th scope="col">ISBN</th>
            <th scope="col">Title</th>
            <th scope="col">Author</th>
            <th scope="col">Publish</th>
            <th scope="col">Picture</th>
            <th scope="col">Stok</th>
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
        <?php foreach ($users as $book) { ?>
            <tr>
                <th scope="row"><?= $number++ ?></th>
                <td><?= $book["idBook"] ?></td>
                <td><?= $book["ISBN"] ?></td>
                <td><?= $book["title"] ?></td>
                <td><?= $book["author"] ?></td>
                <td><?= $book["publish"] ?></td>
                <td>
                    <img class="img-thumbnail cover" src="<?= base_url() ?>/cover/<?= $book["picture"] ?>" alt="">
                </td>
                <td><?= $book["stok"] ?></td>
                <td class="d-flex gap-3">
                    <form action="/dashboardAdmin/deleteBook" method="post">
                        <input type="hidden" value="<?= $book["idBook"] ?>" name="getIdBook">
                        <button class="btn btn-danger" type="submit" onclick="return confirm('Do you sure delete book ?')">Delete</button>
                    </form>
                    <form action="/dashboardAdmin/editBook" method="get">
                        <input type="hidden" value="<?= $book["idBook"] ?>" name="getIdBook">
                        <button class="btn btn-warning" type="submit">Edit</button>
                    </form>
                    <form>
                        <input class="id-book" type="hidden" value="<?= $book["idBook"] ?>" name="getIdBook">

                        <!-- Button trigger modal -->
                        <button class="btn btn-success detail-book" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Detail Book</button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detail Book</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Detail Book -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <div class="d-grid justify-content-center">
        <?= $pager->links('book','custom_pagination') ?>
    </div>
</div>
<?= $this->endSection() ?>



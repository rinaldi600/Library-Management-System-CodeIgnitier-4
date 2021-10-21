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
                    <form action="/dashboardUser/rentBook" method="post">
                        <input type="hidden" value="<?= $book["idBook"] ?>" name="getIdBook">
                        <button class="btn btn-success" type="submit" onclick="return confirm('Do you sure request this book ?')">Request</button>
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




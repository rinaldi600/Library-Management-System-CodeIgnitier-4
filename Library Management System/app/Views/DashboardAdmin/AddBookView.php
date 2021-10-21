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
        <a class="text-decoration-none text-dark" href="#">Decline Book</a>
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
    <a class="btn btn-primary mb-3" href="/dashboardAdmin">Back</a>
</div>
<div class="form-add-book">
    <h1 class="text-center">Add Book</h1>
    <form action="/dashboardAdmin/insertNewBook" method="post" enctype="multipart/form-data">
        <div class="mb-3 position-relative">
            <label for="isbn" class="form-label">ISBN</label>
            <input type="text" class="form-control isbn-input <?= session()->getFlashdata('isbn') ? 'is-invalid' : '' ?>" id="isbn" name="isbn" placeholder="Enter ISBN...." value="<?= old('isbn') ? old('isbn') : '' ?>">
            <button type="button" class="generate-random-isbn btn btn-outline-secondary">Generate Fake ISBN</button>
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('isbn') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control <?= session()->getFlashdata('title') ? 'is-invalid' : '' ?>" id="title" name="title" placeholder="Enter Title...." value="<?= old('title') ? old('title') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('title') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="author" class="form-label">Author</label>
            <input type="text" class="form-control <?= session()->getFlashdata('author') ? 'is-invalid' : '' ?>" id="author" name="author" placeholder="Enter Author...." value="<?= old('author') ? old('author') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('author') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="publisher" class="form-label">Publisher</label>
            <input type="text" class="form-control <?= session()->getFlashdata('publisher') ? 'is-invalid' : '' ?>" id="publisher" name="publisher" placeholder="Enter Publisher...." value="<?= old('publisher') ? old('publisher') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('publisher') ?>
            </div>
        </div>
        <div class="mb-3">
            <img src="<?= base_url() ?>/cover/daria-nepriakhina-xY55bL5mZAM-unsplash.jpg" class="img-fluid preview-cover-book" alt="Cover Book">
            <label for="formFile" class="form-label mt-1">Choose Cover Book</label>
            <input class="form-control cover-book-input mt-2 <?= session()->getFlashdata('picture') ? 'is-invalid' : '' ?>" type="file" id="formFile" name="picture">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('picture') ?>
            </div>
        </div>
        <div class="mb-3">
            <label for="stok" class="form-label">Stok</label>
            <input type="text" class="form-control  <?= session()->getFlashdata('stok') ? 'is-invalid' : '' ?>" id="stok" name="stok" placeholder="Enter Stok...." value="<?= old('stok') ? old('stok') : '' ?>">
            <div id="validationServer03Feedback" class="invalid-feedback">
                <?= session()->getFlashdata('stok') ?>
            </div>
        </div>
        <div class="d-grid justify-content-center">
            <button type="submit" class="btn btn-primary">Add Book</button>
        </div>
    </form>
</div>
<?= $this->endSection() ?>




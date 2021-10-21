<?= $this->extend('TemplateSignUp/Views') ?>

<?= $this->section('content') ?>
<form action="/user/getDataSignUp" method="post" enctype="multipart/form-data">
    <?php if (session()->getFlashdata('successSignUpUser')) { ?>
        <div class="alert alert-success position-absolute top-50 start-50 translate-middle text-center" role="alert">
            <?= session()->getFlashdata('successSignUpUser') ?> Klik <a class="text-decoration-none" href="/user">Login</a>
        </div>
    <?php } ?>
    <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control <?= session()->getFlashdata('nama') ? 'is-invalid' : '' ?>" id="nama" name="nama" placeholder="Enter Nama....." value="<?= old('nama') ? old('nama') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('nama') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control <?= session()->getFlashdata('email') ? 'is-invalid' : '' ?>" id="email" name="email" placeholder="Enter Email....." value="<?= old('email') ? old('email') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('email') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control <?= session()->getFlashdata('username') ? 'is-invalid' : '' ?>" id="username" name="username" placeholder="Enter Username....." value="<?= old('username') ? old('username') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('username') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter Password Here......">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('password') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="confirmPassword" class="form-label">Confirm Password</label>
        <input type="password" class="form-control <?= session()->getFlashdata('confirmPassword') ? 'is-invalid' : '' ?>" id="confirmPassword" name="confirmPassword" placeholder="Enter Confirm Password Here......">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('confirmPassword') ?>
        </div>
    </div>
    <div class="mb-3">
        <img src="<?= base_url() ?>/profile/photo-1579830341173-519fb8c07ca2.jpg" class="mb-2 img-thumbnail img-fluid picture-profile" alt="Image Profile">
        <label for="formFile" class="form-label">Choose File</label>
        <input class="form-control select-file <?= session()->getFlashdata('pictureProfile') ? 'is-invalid' : '' ?>" type="file" id="formFile" name="pictureProfile">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('pictureProfile') ?>
        </div>
    </div>
    <div class="mb-3 d-flex gap-3">
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </div>
</form>
<?= $this->endSection() ?>


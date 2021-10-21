<?= $this->extend('TemplateLogin/Views') ?>

<?= $this->section('content') ?>
<form action="/admin/getDataForm" method="post">
    <div class="mb-3">
        <label for="usernameOrEmail" class="form-label">Username or Email</label>
        <input type="text" class="form-control <?= session()->getFlashdata('usernameOrEmail') ? 'is-invalid' : '' ?>" id="usernameOrEmail" name="usernameOrEmail" placeholder="Enter Username or Email....." value="<?= old('usernameOrEmail') ? old('usernameOrEmail') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('usernameOrEmail') ?>
        </div>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control <?= session()->getFlashdata('password') ? 'is-invalid' : '' ?>" id="password" name="password" placeholder="Enter Password Here......" value="<?= old('password') ? old('password') : '' ?>">
        <div id="validationServer03Feedback" class="invalid-feedback">
            <?= session()->getFlashdata('password') ?>
        </div>
    </div>
    <div class="mb-3 d-flex gap-3">
        <button type="submit" class="btn btn-primary">Login</button>
        <a href="/admin/signup" class="btn btn-success">Sign Up</a>
    </div>
    <div class="mb-3">
        <a class="text-decoration-none" href="#">Forgot Password</a>
    </div>
</form>
<?= $this->endSection() ?>

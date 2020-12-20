<?= $this->extend('layout/template3'); ?>

<?= $this->section('content'); ?>

<div class="container shadow p-4" style="margin-top: 80px;">
    <div class="row">
        <div class="col" style="padding: 0 25% 0 25%;">
            <h1>Login</h1>
            <br>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('pesan') ?></div>
            <?php endif; ?>
            <form action="/pages/auth" method="post">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                    <br>
                    <p>belum punya akun? <a href="/pages/createPerusahaan">Daftar</a></p>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection(); ?>
<?= $this->extend('layout/template2'); ?>

<?= $this->section('content'); ?>

<div class="container shadow p-4" style="margin-top: 80px;">
    <div class="row">
        <div class="col" style="padding: 0 25% 0 25%;">
            <h1>Registrasi Perusahaan</h1>
            <br>
            <form action="/pages/savePerusahaan/" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password2">Ulangi Password</label>
                    <input type="password" class="form-control <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2" placeholder="Password">
                </div>
                <hr>
                <h2>Data Perusahaan</h2>
                <br>
                <div class="form-group">
                    <input type="text" class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan Nama Perusahaan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password2'); ?>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_perusahaan'); ?>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="lokasi" name="lokasi" placeholder="Kota">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control" id="industri" name="industri" placeholder="Industri Perusahaan">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="thBerdiri">Tahun berdiri </label><br>
                        <input name="thBerdiri" type="date">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-8">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input <?= ($validation->hasError('img_perusahaan')) ? 'is-invalid' : ''; ?>" id="img_perusahaan" name="img_perusahaan" onchange="previewImg()">
                            <div class="invalid-feedback">
                                <?= $validation->getError('img_perusahaan'); ?>
                            </div>
                            <label class="custom-file-label" for="img_perusahaan">Pilih gambar..</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/default.jpg" class="img-thumbnail img-preview">
                    </div>
                </div>
                <br><br>
                <button type="submit" class="btn btn-primary mb-5">Submit</button>
            </form>
        </div>
    </div>
    <!-- nangkap notif flash data disini -->
    <?php if (session()->getFlashData('pesan')) : ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashData('pesan'); ?>
        </div>
    <?php endif; ?>
</div>

<?= $this->endSection(); ?>
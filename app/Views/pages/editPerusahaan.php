<?= $this->extend('layout/template2'); ?>

<?= $this->section('content'); ?>


<div class="container shadow p-4" style="margin-top: 80px;">
    <div class="row">
        <div class="col" style="padding: 0 25% 0 25%;">
            <br>
            <form action="/pages/updatePerusahaan/<?= $job['id_perusahaan']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <input type="hidden" name="fotoLama" value="<?= $job['img_perusahaan']; ?>">
                <input type="hidden" name="email_lama" value="<?= $job['email_perusahaan']; ?>">
                <h2>Data Perusahaan</h2>
                <br>
                <div class="form-group">
                    <label for="nama_perusahaan">Nama Perusahaan: </label>
                    <input type="text" class="form-control <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" id="nama_perusahaan" name="nama_perusahaan" value="<?= (old('nama_perusahaan')) ? old('nama_perusahaan') : $job['nama_perusahaan']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password2'); ?>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_perusahaan'); ?>
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="alamat">Alamat: </label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="<?= (old('alamat')) ? old('alamat') : $job['alamat']; ?>">
                    </div>
                    <div class="form-group col-md-4">
                        <label for="lokasi">Kota: </label>
                        <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= (old('lokasi')) ? old('lokasi') : $job['lokasi']; ?>">
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <label for="nama_perusahaan">Industri: </label>
                            <input type="text" class="form-control" id="industri" name="industri" value="<?= (old('industri')) ? old('industri') : $job['industri']; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="thBerdiri">Tahun berdiri </label><br>
                        <input name="thBerdiri" type="date" value="<?= (old('tahun_berdiri')) ? old('tahun_berdiri') : $job['tahun_berdiri']; ?>">
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
                            <label class="custom-file-label" for="img_perusahaan">Unggah foto perusahaan</label>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <img src="/img/<?= $job['img_perusahaan']; ?>" class="img-thumbnail img-preview">
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
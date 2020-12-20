<?= $this->extend('layout/template2'); ?>

<?= $this->section('content'); ?>

<div class="container shadow p-4" style="margin-top: 80px;">
    <div class="row">
        <div class="col" style="padding: 0 25% 0 25%;">
            <h2>Unggah Lowongan</h2>
            <br>
            <form action="/pages/saveJobs/<?= $job['id_perusahaan']; ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="form-group">
                    <label for="posisi">Posisi</label>
                    <input type="text" class="form-control" id="posisi" name="posisi">
                </div>
                <div class="row">
                    <div class="form-group col-md-8">
                        <label for="gaji">Gaji </label>
                        <input type="text" class="form-control" id="gaji" name="gaji">
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-floating">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control" name="deskripsi" style="height: 100px"></textarea>
                        </div>
                    </div>
                </div>
                <br>
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
<script>
    let footerfixed = document.querySelector("#footerfix");

    footerfixed.classList.add("fixed-bottom");
</script>
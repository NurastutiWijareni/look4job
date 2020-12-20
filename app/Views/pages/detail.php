<?= $this->extend('layout/template2'); ?>

<?= $this->section('content'); ?>

<div class="container" style="margin-top: 130px; height: 800px;">
    <div class="row shadow">
        <div class="col">
            <div class="px-4 py-4">
                <h2><?= $job[0]['posisi']; ?></h2>
                <h4><?= $job[0]['nama_perusahaan']; ?></h4>
                <p><?= $job[0]['alamat']; ?></p>
            </div>
        </div>
        <div class="col-md-3 py-4">
            <img src="/img/<?= $job[0]['img_perusahaan']; ?>" width="150">
        </div>
    </div>
    <div class="row shadow">
        <div class="col">
            <div class="desc py-4">
                <hr>
                <p>
                    <h3 class="px-3">Deskripsi Pekerjaan</h3>
                </p>
                <ul class="list-group px-5">
                    <li>
                        <p><?= $job[0]['deskripsi']; ?></p>
                    </li>
                    <li>
                        <b>Kisaran gaji: </b><?= "Rp." . $job[0]['gaji']; ?>
                    </li>
                    <li>
                        <b>Lokasi: </b><?= $job[0]['lokasi']; ?>
                    </li>
                    <li>
                        <b>Industri: </b><?= $job[0]['industri']; ?>
                    </li>
                </ul>
                <div class="col" style="margin-top: 50px; margin-left: 20px;">
                    <a href="" class="btn btn-success">lamar Sekarang</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
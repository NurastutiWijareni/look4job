<?= $this->extend('layout/template2'); ?>

<?= $this->section('content'); ?>

<div class="container rounded" style="margin-top: 70px;">
    <div id="test" class="row rounded shadow">
    </div>
    <div class="row shadow mr-auto">
        <div class="col m-5">
            <img src="/img/<?= $job['img_perusahaan']; ?>" width="200px" class="position-absolute shadow" id="fprofil">
        </div>
        <div class="col-md-5 mt-5">
            <h2><?= $job['nama_perusahaan']; ?></h2>
            <p><?= $job['alamat']; ?></p>
        </div>
        <div class="container my-5" style="width: 75%; border: 1px solid grey;">
            <table class="table table-borderless">
                <tbody>
                    <tr>
                        <th>Email Perusahaan: </th>
                        <td><?= $job['email_perusahaan']; ?></td>
                    </tr>
                    <tr>
                        <th>Lokasi: </th>
                        <td><?= $job['lokasi']; ?></td>
                    </tr>
                    <tr>
                        <th>Industri: </th>
                        <td><?= $job['industri']; ?></td>
                    </tr>
                    <tr>
                        <th>Tahun Berdiri: </th>
                        <td><?= $job['tahun_berdiri']; ?></td>
                    </tr>
                </tbody>
            </table>
            <div class="col">
                <a href="/pages/editPerusahaan/<?= $job['id_perusahaan']; ?>" class="btn btn-success my-5">Edit Profil</a>
                <a href="/pages/createJobs/<?= $job['id_perusahaan']; ?>" class="btn btn-danger ml-4">Unggah Lowongan</a>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="container">
            <div class="row">
                <div class="col">
                    <table class="table table-hover">
                        <tbody>
                            <?php foreach ($job2 as $j) : ?>
                                <tr style="border: 1px solid #99a;">
                                    <td>
                                        <img src="/img/<?php echo $j['img_perusahaan']; ?>" width="180">
                                    </td>
                                    <td>
                                        <h2><?php echo $j['posisi']; ?></h2>
                                        <p><b><?php echo $j['nama_perusahaan']; ?></b></p>
                                        <p><?php echo $j['alamat'] ?></p>
                                    </td>
                                    <td style="border-left: 1px solid #99a;">
                                        <p>Diunggah pada <?php echo $j['created_at']; ?></p>
                                        <a href="/pages/editJobs/<?= $j['id_jobs']; ?>" class="btn btn-primary">Edit</a>
                                        <form action="/pages/<?= $j['id_jobs']; ?>" method="post" class="d-inline">
                                            <?= csrf_field(); ?>
                                            <input type="hidden" name="id_perusahaan" value="<?= $job['id_perusahaan']; ?>">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus lowongan?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- nangkap notif flash data disini -->
        <?php if (session()->getFlashData('pesan')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashData('pesan'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<style>
    #test {
        background-image: url("/img/sampul1.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
        height: 400px;
        margin-right: auto;
    }

    #fprofil {
        top: -120px;
    }
</style>
<?= $this->endSection(); ?>
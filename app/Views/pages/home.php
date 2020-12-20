<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<!-- Jumbotron -->

<div class="jumbotron jumbotron-fluid">
    <div class="main-cont container text-center text-light">
        <div class="row">
            <div class="col">
                <h1>Look 4 Job</h1>
                <label for="search">
                    <h3>Website Job Portal Indonesia</h3>
                    <p>Temukan pekerjaan anda sekarang</p>
                </label>
            </div>
        </div>
        <form action="/pages" method="post">
            <div class="row">
                <div class="col-2">
                </div>
                <div class="col-8">
                    <div class="form-group">
                        <input id="keyword" type="text" class="form-control" name="keyword" placeholder="Cari pekerjaan berdasarkan posisi, lokasi tau lainnya" autocomplete="off">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <button type="submit" class="btn btn-primary" name="submit" style="width: 100px;">Cari</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- result jobs -->
<div class="container">

    <h4 class="mb-3">Job Tersedia : </h4>

    <div class="row">
        <div class="col">
            <table class="table table-hover">
                <tbody>
                    <?php foreach ($job as $j) : ?>
                        <?php
                        $i = 0;
                        foreach ($perusahaan as $p) {
                            if (array_search(strval($j['id_perusahaan']), $p)) {
                                $index = $i;
                            }
                            $i++;
                        }
                        ?>
                        <tr style="border: 1px solid #99a;">
                            <td>
                                <img src="/img/<?php echo $perusahaan[$index]['img_perusahaan']; ?>" width="180">
                            </td>
                            <td>
                                <h2><?php echo $j['posisi']; ?></h2>
                                <p><b><?php echo $perusahaan[$index]['nama_perusahaan']; ?></b></p>
                                <p><?php echo $perusahaan[$index]['alamat'] ?></p>
                            </td>
                            <td style="border-left: 1px solid #99a;">
                                <p>Diunggah pada <?php echo $j['created_at']; ?></p>
                                <a href="/pages/<?= $j['id_jobs']; ?>" class="btn btn-primary">Lihat Detail</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <?php if (!isset($_POST['keyword'])) : ?>
                <?= $pager->links('jobs', 'my_pagination'); ?>
            <?php endif; ?>
        </div>
    </div>
</div>

<?= $this->endSection(); ?>
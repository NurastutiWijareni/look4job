<?= $this->extend('layout/template4'); ?>

<?= $this->section('content'); ?>

    <link rel="stylesheet" href="/css/style2.css"/>
    <div class="container1">
      <div class="forms-container">
        <div class="signin-signup">
          <form action="/pages/auth" class="sign-in-form">
            <?= csrf_field(); ?>
            <h2 class="logo" >Look4Job</h2>
            <h2 class="title">Sign in</h2>
            <?php if (session()->getFlashdata('pesan')) : ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('pesan') ?></div>
            <?php endif; ?>
            <div class="input-field">
              <i class="fas fa-user"></i>
              <input type="text" placeholder="Email" id="email" name="email"/>
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" placeholder="Password" id="password" name="password"/>
            </div>
            <input type="submit" class="btn solid" />
          </form>


          <form action="/pages/savePerusahaan/" method="post" class="sign-up-form" enctype="multipart/form-data">
            <h2 class="logo" >Look4Job</h2>
            <?php if (session()->getFlashData('pesan')) : ?>
                <div class="alert alert-success" role="alert">
                    <?= session()->getFlashData('pesan'); ?>
                </div>
            <?php endif; ?>
            <h2 class="title">Registrasi Perusahaan</h2>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="" id="email" name="email" placeholder="Enter email">
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="password" class=" <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?>" id="password" name="password" placeholder="Password">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password'); ?>
                    </div>
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="password" class=" <?= ($validation->hasError('password2')) ? 'is-invalid' : ''; ?>" id="password2" name="password2" placeholder="Password">
                </div>
                <hr>
                <h2>Data Perusahaan</h2>
                <br>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class=" <?= ($validation->hasError('nama_perusahaan')) ? 'is-invalid' : ''; ?>" id="nama_perusahaan" name="nama_perusahaan" placeholder="Masukkan Nama Perusahaan">
                    <div class="invalid-feedback">
                        <?= $validation->getError('password2'); ?>
                    </div>
                </div>
                <div class="invalid-feedback">
                    <?= $validation->getError('nama_perusahaan'); ?>
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="" id="alamat" name="alamat" placeholder="Alamat">
                </div>
                <div class="input-field">
                    <i class="fas fa-user"></i>
                    <input type="text" class="" id="lokasi" name="lokasi" placeholder="Kota">
                </div>
                <div class="input-field">
                <i class="fas fa-user"></i>
                    <input type="text" class="" id="industri" name="industri" placeholder="Industri Perusahaan">
                </div>
                <label for="thBerdiri">Tahun berdiri </label>
                <input name="thBerdiri" type="date">
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

      <div class="panels-container">
        <div class="panel left-panel">
          <div class="content">
            <h3>New here ?</h3>
            <p>
              Please click button below and find your ideal job with our website!
            </p>
            <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
          </div>
          <img src="/log.svg" class="image" alt="" />
        </div>
        <div class="panel right-panel">
          <div class="content">
            <h3>One of us ?</h3>
            <p>
                Please click button below to entry our website!
            </p>
            <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
          </div>
          <img src="/register.svg" class="image" alt="" />
        </div>
      </div>
    </div>

    <script src="/app.js"></script>

<?= $this->endSection(); ?>
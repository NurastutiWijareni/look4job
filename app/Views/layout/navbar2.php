<!-- navbar -->
<?php
$muncul = true;
$hilang = true;
// $_SESSION['id_perusahaan'] = 0;
if (!isset($_SESSION['id_perusahaan'])) {
    $muncul = false;
} else {
    $hilang = false;
}


?>

<nav class="navbar2 navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="/pages">Look4Job</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link active" href="/pages">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link active" href="#">Contact us</a>
                <?php if ($muncul) : ?>
                    <a class="nav-item nav-link active" href="/pages/profil/<?= $_SESSION['id_perusahaan']; ?>">Profil</a>
                    <a href="/pages/logout" class="btn btn-light" onclick="return confirm('Yakin ingin keluar?')">Logout</a>
                <?php endif; ?>
                <?php if ($hilang) : ?>
                    <a href="/pages/createPerusahaan" class="btn btn-secondary ml-2">Daftar</a>
                    <a href="/pages/login" class="btn btn-light ml-2">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>
<?php require_once "header.php"; ?>

<body class="h-100 bg-success">
    <main class="container d-flex align-items-center justify-content-center text-white  h-100">
        <div class="row text-center justify-content-center">
            <div class="col-12 mb-3">
                <img src="assets/img/logo.png" width="200">
            </div>
            <div class="col-12 mb-3 text-center">
                <h1>BUKU TAMU</h1>
                <h1>PERPUSTAKAAN BPTP KALSEL</h1>
            </div>
            <div class="col-12 col-md-8 col-xl-6">
                <div class="d-flex gap-3 mb-3">
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>guest_history.php" style="flex: 1;" class="btn btn-lg btn-light border-success text-success">Riwayat Kunjungan</a>
                    <a href="<?= IS_DEVELOPMENT ? DEVELOPMENT_BASE_URL : PRODUCTION_BASE_URL ?>guest_form.php" style="flex: 1;" class="btn btn-lg btn-light border-success text-success">Buku Tamu</a>
                </div>
                <h4>Pilih Buku Tamu untuk berkunjung ke perpustakaan</h4>
            </div>
        </div>
    </main>
</body>

</html>
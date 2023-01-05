<?php require_once "header.php"; ?>

<body class="bg-success text-white">
    <main class="container py-5">
        <div class="header">
            <h3>
                <a class="btn-back text-white text-decoration-none" href="index.php">
                    <i class="fas fa-arrow-left me-3"></i> Identitas Pengunjung
                </a>
            </h3>
        </div>
        <hr>
        <form>
            <div class="row g-5">
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-sm-12">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name" autocomplete="off" required autofocus>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="visit_time">Jam</label>
                            <input type="text" class="form-control" id="visit_time" name="visit_time" value="<?= date("H:i"); ?>" disabled>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="visit_date">Tanggal</label>
                            <input type="date" class="form-control" id="visit_date" name="visit_date" value="<?= date("Y-m-d"); ?>" disabled>
                        </div>
                        <div class="col-12" id="profession-field">
                            <label for="profession" class="form-label">Pekerjaan/Profesi</label>
                            <select class="form-select" id="profession" name="profession" required>
                                <option value="" selected disabled>Pilih Pekerjaan/Profesi</option>
                                <option value="1">Umum</option>
                                <option value="2">Mahasiswa</option>
                                <option value="3">Pegawai BPTP</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row g-3">
                        <div class="col-12">
                            <label for="topic_id" class="form-label">Topik yang dicari</label>
                            <select class="form-select" name="topic_id" id="topic_id" required>
                                <option value="" disabled selected>Pilih Topik</option>
                            </select>
                        </div>

                        <div class="col-12">
                            <label for="visit_reason" class="form-label">Tujuan Kunjungan</label>
                            <textarea id="visit_reason" name="visit_reason" autocomplete="off" cols="30" rows="5" required class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 d-flex justify-content-end">
                        <button type="submit" class="btn border-success text-success bg-light">Kunjungi Perpustakaan</button>
                    </div>
                </div>
            </div>
        </form>
    </main>
    <script src="scripts/plugins/jquery.js"></script>
    <script src="scripts/plugins/sweetalert2.js"></script>
    <script src="scripts/plugins/moment.min.js"></script>
    <script src="scripts/templates.js"></script>
    <script src="scripts/ajax.js"></script>
    <script src="scripts/guest_form.js"></script>
</body>

</html>
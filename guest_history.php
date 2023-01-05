<?php require_once "header.php"; ?>

<body class="bg-success">
    <main class="container p-5">
        <div class="py-3">
            <div class="d-flex justify-content-between">
                <h3>
                    <a class="btn-back text-white text-decoration-none" href="index.php">
                        <i class="fas fa-arrow-left me-3"></i> Riwayat Kunjungan
                    </a>
                </h3>
            </div>
            <hr>
        </div>
        <div style="min-height: 520px;">
            <table id="guest-history" class="table text-white table-borderless m-0">
                <thead>
                    <tr>
                        <td scope="col" class="text-center">No</td>
                        <td scope="col">Nama Pengunjung</td>
                        <td scope="col">Waktu Kunjungan</td>
                        <td scope="col">Pekerjaan/Profesi</td>
                        <td scope="col">Topik</td>
                    </tr>
                    <tr>
                        <th scope="col" class="text-center" style="vertical-align: middle;">
                            <i class="fas fa-search"></i>
                        <td scope="col">
                            <input name="name" type="text" class="form-control" autofocus>
                        </td>
                        <td scope="col">
                            <input name="visit_date" type="text" class="form-control" value="Semua">
                        </td>
                        <td scope="col">
                            <select class="form-select" name="profession" required>
                                <option value="" selected>Semua</option>
                                <option value="Umum">Umum</option>
                                <option value="Mahasiswa">Mahasiswa</option>
                                <option value="Pegawai BPTP">Pegawai BPTP</option>
                            </select>
                        </td>
                        <td scope="col">
                            <select class="form-select" name="topic_id" required>
                                <option value="" selected>Semua</option>
                            </select>
                        </td>
                    </tr>
                </thead>
                <tbody>
                    <tr id="loader">
                        <td colspan="5">
                            <div class="text-center p-5 w-100">
                                <div class="spinner-border text-light" role="status">
                                    <span class="visually-hidden">Loading...</span>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div id="pagination-demo1" class="d-flex justify-content-between">
            <div>
                <button id="export" class="btn btn-light text-success btn-sm"><i class="far fa-file-excel"></i> Download</button>
                <label id="last-export" class="text-white"></label>
            </div>
        </div>
    </main>
    <!-- Detail Guest Modal -->
    <div class="modal fade" id="detailGuestModal" tabindex="-1" aria-labelledby="detailGuestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="detailGuestModalLabel">Detail Pengunjung</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body"></div>
            </div>
        </div>
    </div>
    <script src="scripts/plugins/jquery.js"></script>
    <script src="scripts/plugins/bootstrap.js"></script>
    <script src="scripts/ajax.js"></script>
    <script src="scripts/plugins/moment.min.js"></script>
    <script src="scripts/plugins/daterangepicker.js"></script>
    <script src="scripts/plugins/pagination.js"></script>
    <script src="https://unpkg.com/write-excel-file@1.x/bundle/write-excel-file.min.js"></script>
    <script src="scripts/guest_history.js"></script>
</body>

</html>
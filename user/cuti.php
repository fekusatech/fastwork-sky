<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Manajemen Cuti
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Beranda</a></li>
                    <li class="active">Manajemen Cuti</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">
                <?php
                if (isset($_SESSION['error'])) {
                    echo "
                        <div class='alert alert-danger alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-warning'></i> Error!</h4>
                        " . $_SESSION['error'] . "
                        </div>
                    ";
                    unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                    echo "
                        <div class='alert alert-success alert-dismissible'>
                        <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                        <h4><i class='icon fa fa-check'></i> Success!</h4>
                        " . $_SESSION['success'] . "
                        </div>
                    ";
                    unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <!-- Tombol untuk membuka modal pengajuan cuti -->
                        <!-- Tabel daftar cuti Anda di sini -->
                        <div class="box">
                            <div class="box-header with-border">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#addnewleave"><i class="fa fa-plus"></i> Ajukan Cuti</button>
                            </div>
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nama Karyawan</th>
                                            <th>Tanggal Mulai</th>
                                            <th>Tanggal Selesai</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT leave_requests.*, employees.firstname, employees.lastname
                                                FROM leave_requests
                                                JOIN employees ON leave_requests.user_id = employees.id WHERE leave_requests.user_id = '{$_SESSION['data']['id']}'
                                                ORDER BY leave_requests.start_date DESC";
                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_assoc()) {
                                            if ($row['status'] == "pending") {
                                                $status = "<span class='label label-primary badge-pill'>" . ucwords($row['status']) . "</span>";
                                            } else if ($row['status'] == "rejected") {
                                                $status = "<span class='label label-danger badge-pill'>" . ucwords($row['status']) . "</span>";
                                            } else {
                                                $status = "<span class='label label-success badge-pill'>" . ucwords($row['status']) . "</span>";
                                            }
                                            echo "
                                                <tr>
                                                <td>" . $row['firstname'] . " " . $row['lastname'] . "</td>
                                                <td>" . date('M d, Y', strtotime($row['start_date'])) . "</td>
                                                <td>" . date('M d, Y', strtotime($row['end_date'])) . "</td>
                                                <td>" . $status . "</td>
                                                </tr>
                                            ";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <?php include 'includes/footer.php'; ?>

        <!-- Modal untuk pengajuan cuti -->
        <div class="modal fade" id="addnewleave" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Pengajuan Cuti</h4>
                    </div>
                    <div class="modal-body">
                        <!-- Form untuk pengajuan cuti -->
                        <form action="cuti_proses.php" method="post">
                            <input class="form-control" value="<?= $_SESSION['data']['id'] ?>" id="employee_id" name="employee_id" type="hidden" required>
                            <input class="form-control" value="pending" id="status" name="status" type="hidden" required>
                            <div class="form-group">
                                <label for="tanggal_mulai">Tanggal Mulai:</label>
                                <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_selesai">Tanggal Selesai:</label>
                                <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" required>
                            </div>
                            <div class="form-group">
                                <label for="alasan">Alasan Cuti:</label>
                                <textarea class="form-control" id="alasan" name="alasan" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajukan Cuti</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



    </div>
    <?php include 'includes/scripts.php'; ?>
    <script>
        function confirmAction(action) {
            var confirmationMessage = "Apakah Anda yakin ingin " + (action === "approve" ? "menyetujui" : "menolak") + " permintaan cuti ini?";
            return confirm(confirmationMessage);
        }
    </script>
</body>

</html>
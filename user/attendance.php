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
          Attendance
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Attendance</li>
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
        <!-- Filter Form -->
        <div class="row">
          <div class="col-md-12">
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Filter Tanggal</h3>
              </div>
              <div class="box-body">
                <form method="get" action="">
                  <div class="form-group">
                    <label for="tanggal_mulai">Tanggal Mulai:</label>
                    <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : date('Y-m-d') ?>">
                  </div>
                  <div class="form-group">
                    <label for="tanggal_selesai">Tanggal Selesai:</label>
                    <input type="date" class="form-control" id="tanggal_selesai" name="tanggal_selesai" value="<?= isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : date('Y-m-d') ?>">
                  </div>
                  <div class="form-group">
                    <button type="submit" class="btn btn-primary">Filter</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <!-- <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a> -->
              </div>
              <div class="box-body table-responsive">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>ID Karyawan</th>
                    <th>Nama</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance INNER JOIN employees ON employees.id=attendance.employee_id WHERE employees.employee_id = '{$user['employee_id']}'";
                    // Filter Tanggal
                    if (isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_selesai'])) {
                      $tanggal_mulai = $_GET['tanggal_mulai'];
                      $tanggal_selesai = $_GET['tanggal_selesai'];
                      $sql .= " AND attendance.date BETWEEN '$tanggal_mulai' AND '$tanggal_selesai'";
                    }
                    $sql .= " ORDER BY attendance.id DESC";
                    $query = $conn->query($sql);
                    $no = 1;
                    while ($row = $query->fetch_assoc()) {
                      $nonya = $no++;
                      $disabled = "disabled";
                      if ($nonya == 1) {
                        $disabled = NULL;
                      }
                      $status = ($row['status']) ? '<span class="label label-warning pull-right">ontime</span>' : '<span class="label label-danger pull-right">late</span>';
                      $keterangan = $row['status_in'] === "in" ? '<span class="label label-success pull-right">Masuk</span>' : '<span class="label label-primary pull-right">' . ucwords($row['status_in']) . '</span>';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>" . $nonya . "</td>
                          <td>" . date('M d, Y', strtotime($row['date'])) . "</td>
                          <td>" . $row['empid'] . "</td>
                          <td>" . $row['firstname'] . ' ' . $row['lastname'] . "</td>
                          <td>" . date('h:i A', strtotime($row['time_in'])) . $status . "</td>
                          <td>" . date('h:i A', strtotime($row['time_out'])) . "</td>
                          <td>" . ucwords($row['status_in']) . "</td>
                          <td>
                            <button class='btn btn-danger btn-sm btn-flat delete' data-id='" . $row['attid'] . "' $disabled><i class='fa fa-trash'></i> Delete</button>
                          </td>
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
    <?php include 'includes/attendance_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(function() {
      $('.edit').click(function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $('.delete').click(function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'attendance_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#datepicker_edit').val(response.date);
          $('#attendance_date').html(response.date);
          $('#edit_time_in').val(response.time_in);
          $('#edit_time_out').val(response.time_out);
          $('#attid').val(response.attid);
          $('#employee_name').html(response.firstname + ' ' + response.lastname);
          $('#del_attid').val(response.attid);
          $('#del_employee_name').html(response.firstname + ' ' + response.lastname + ' : ' + response.date);
        }
      });
    }
  </script>
</body>

</html>
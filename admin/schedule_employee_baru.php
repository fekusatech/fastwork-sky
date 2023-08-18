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
          Jadwal Kerja
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li>Karyawan</li>
          <li class="active">Jadwal Kerja</li>
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
            <div class="box">
              <div class="box-header with-border">
                <a href="schedule_print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>ID Karyawan</th>
                    <th>Nama</th>
                    <th>Tanggal</th>
                    <th>Jadwal Kerja</th>
                    <th>Tools</th>
                  </thead>
                  <tbody>
                    <?php
                    $today = new DateTime(); // Tanggal sekarang
                    $weekdays = array(1, 2, 3, 4, 5); // 1 = Senin, 2 = Selasa, dst.

                    $dateList = array();

                    // Cari hari Senin pertama dalam minggu ini
                    $monday = clone $today;
                    $monday->modify('last monday');

                    // Buat daftar tanggal dari Senin hingga Jumat dalam minggu ini
                    for ($i = 0; $i < 5; $i++) {
                      $currentDate = clone $monday;
                      $currentDate->add(new DateInterval('P' . $i . 'D')); // Tambahkan offset hari

                      // Jika hari saat ini adalah hari kerja, tambahkan ke daftar
                      if (in_array($currentDate->format('N'), $weekdays)) {
                        $dateList[] = $currentDate->format('Y-m-d');
                      }
                    }
                    $sql = "SELECT *, employees.id AS empid FROM employees LEFT JOIN schedules ON schedules.id=employees.schedule_id";
                    $query = $conn->query($sql);
                    $no = 0;
                    $datakaryawan = [];
                    while ($row = $query->fetch_assoc()) {
                      $datakaryawan[] = $row;
                    }

                    foreach ($datakaryawan as $employee) {
                      foreach ($dateList as $date) {
                        $newEmployee = $employee;
                        $newEmployee["time_in"] = $date . " " . $employee["time_in"];
                        $newEmployee["time_out"] = $date . " " . $employee["time_out"];
                        $newEmployeeData[] = $newEmployee;
                      }
                    }

                    // Tampilkan hasil
                    echo "<pre>";
                    print_r($newEmployeeData);
                    echo "</pre>";
                    exit;
                    foreach ($data as $rows) {
                      echo "
                        <tr>
                          <td>" . $rows['employee_id'] . json_encode($rows) . "</td>
                          <td>" . $rows['firstname'] . ' ' . $rows['lastname'] . "</td>
                          <td>" . date('d M Y', strtotime($rows['time_in'])) . "</td>
                          <td>" . date('h:i A', strtotime($rows['time_in'])) . ' - ' . date('h:i A', strtotime($rows['time_out'])) . "</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $rows['empid'] . "'><i class='fa fa-edit'></i> Edit</button>
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
    <?php include 'includes/employee_schedule_modal.php'; ?>
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
    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'schedule_employee_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('.employee_name').html(response.firstname + ' ' + response.lastname);
          $('#schedule_val').val(response.schedule_id);
          $('#schedule_val').html(response.time_in + ' ' + response.time_out);
          $('#empid').val(response.empid);
        }
      });
    }
  </script>
</body>

</html>
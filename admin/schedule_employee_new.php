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
              </div>
              <div class="box-body">
                <div class="box box-primary">
                  <div class="box-body no-padding">
                    <div id="calendarshow"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/schedule_modal.php'; ?>
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
        url: 'schedule_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('#timeid').val(response.id);
          $('#edit_time_in').val(response.time_in);
          $('#edit_time_out').val(response.time_out);
          $('#del_timeid').val(response.id);
          $('#del_schedule').html(response.time_in + ' - ' + response.time_out);
        }
      });
    }
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

    ?>
    var data = <?= json_encode($newEmployeeData); ?>

    var weekdays = [1, 2, 3, 4, 5]; // 1 = Senin, 2 = Selasa, dst.

    var events = [];
    data.forEach(function(item) {
      var startDate = new Date(item.time_in);
      var endDate = new Date(item.time_out);
      var dayOfWeek = startDate.getDay();
      var startHour = parseInt(item.time_in.split(':')[0]);
      var startMinute = parseInt(item.time_in.split(':')[1]);
      var endHour = parseInt(item.time_out.split(':')[0]);
      var endMinute = parseInt(item.time_out.split(':')[1]);

      events.push({
        title: item.firstname + ' ' + item.lastname + ' - ' + item.employee_id,
        start: startDate,
        end: endDate,
        allDay: false,
        backgroundColor: '#00c0ef',
        borderColor: '#00c0ef'
      });
    });
    var currentDate = moment(); // Tanggal saat ini
    var endOfWeek = moment().endOf('week'); // Akhir minggu


    var date = new Date()
    var d = date.getDate(),
      m = date.getMonth(),
      y = date.getFullYear()
    $('#calendarshow').fullCalendar({
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'today',
        month: 'month',
        week: 'week',
        day: 'day'
      },
      //Random default events
      events:events,
      // events: [{
      //     title: 'All Day Event',
      //     start: new Date(y, m, 1),
      //     backgroundColor: '#f56954', //red
      //     borderColor: '#f56954' //red
      //   },
      //   {
      //     title: 'Long Event',
      //     start: new Date(y, m, d - 5),
      //     end: new Date(y, m, d - 2),
      //     backgroundColor: '#f39c12', //yellow
      //     borderColor: '#f39c12' //yellow
      //   },
      //   {
      //     title: 'Meeting',
      //     start: new Date(y, m, d, 10, 30),
      //     allDay: false,
      //     backgroundColor: '#0073b7', //Blue
      //     borderColor: '#0073b7' //Blue
      //   },
      //   {
      //     title: 'Lunch',
      //     start: new Date(y, m, d, 12, 0),
      //     end: new Date(y, m, d, 14, 0),
      //     allDay: false,
      //     backgroundColor: '#00c0ef', //Info (aqua)
      //     borderColor: '#00c0ef' //Info (aqua)
      //   },
      //   {
      //     title: 'Birthday Party',
      //     start: new Date(y, m, d + 1, 19, 0),
      //     end: new Date(y, m, d + 1, 22, 30),
      //     allDay: false,
      //     backgroundColor: '#00a65a', //Success (green)
      //     borderColor: '#00a65a' //Success (green)
      //   },
      //   {
      //     title: 'Click for Google',
      //     start: new Date(y, m, 28),
      //     end: new Date(y, m, 29),
      //     url: 'http://google.com/',
      //     backgroundColor: '#3c8dbc', //Primary (light-blue)
      //     borderColor: '#3c8dbc' //Primary (light-blue)
      //   }
      // ],
      editable: false,
      droppable: false, // this allows things to be dropped onto the calendar !!!
    });
  </script>
</body>

</html>
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
          Absensi
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Absensi</li>
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
                <h4 class="login-box-msg">Masukkan ID Karyawan</h4>
              </div>
              <div class="box-body">
                <form id="attendance">
                  <div class="form-group">
                    <select class="form-control" name="status">
                      <option value="in">Time In</option>
                      <option value="out">Time Out</option>
                    </select>
                  </div>
                  <div class="form-group has-feedback">
                    <input type="text" class="form-control input-lg" id="employee" name="employee" required readonly value="<?= $user['employee_id'] ?>">
                    <i class="fa fa-user-plus form-control-feedback"></i>
                  </div>
                  <div class="row">
                    <div class="col-xs-4">
                      <button type="submit" class="btn btn-primary btn-block btn-flat" name="signin"><i class="fa fa-sign-in"></i> Absensi</button>
                    </div>
                  </div>
                </form>
                <div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
                </div>
                <div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                  <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
                </div>
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
          $('#del_employee_name').html(response.firstname + ' ' + response.lastname);
        }
      });
    }
  </script>
  <script type="text/javascript">
    $(function() {
      var interval = setInterval(function() {
        var momentNow = moment();
        $('#date').html(momentNow.format('dddd').substring(0, 3).toUpperCase() + ' - ' + momentNow.format('MMMM DD, YYYY'));
        $('#time').html(momentNow.format('hh:mm:ss A'));
      }, 100);

      $('#attendance').submit(function(e) {
        e.preventDefault();
        var attendance = $(this).serialize();
        $.ajax({
          type: 'POST',
          url: 'attendance_proses.php',
          data: attendance,
          dataType: 'json',
          success: function(response) {
            if (response.error) {
              $('.alert').hide();
              $('.alert-danger').show();
              $('.message').html(response.message);
            } else {
              $('.alert').hide();
              $('.alert-success').show();
              $('.message').html(response.message);
              // $('#employee').val('');
            }
          }
        });
      });

    });
  </script>
</body>

</html>
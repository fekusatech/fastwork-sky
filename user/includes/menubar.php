<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo (!empty($user['photo'])) ? '../images/' . $user['photo'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $_SESSION['data']['firstname'] . ' ' . $_SESSION['data']['lastname']; ?></p>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">REPORTS</li>
      <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
      <li class="header">MANAGE</li>

      <li><a href="attendance-hadir.php"><i class="fa fa-user-plus"></i> <span>Absesensi</span></a></li>
      <li><a href="attendance.php"><i class="fa fa-calendar"></i> <span>Daftar Attendance</span></a></li>
      <li><a href="employee.php"><i class="fa fa-clock-o"></i> <span>Jadwal Kerja</span></a></li>
      <li><a href="payroll.php"><i class="fa fa-usd"></i> <span>Daftar Gaji</span></a></li>
      <!-- <li class="treeview">
        <a href="#">
          <i class="fa fa-users"></i>
          <span>Employees</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="employee.php"><i class="fa fa-circle-o"></i> List Karyawan</a></li>
          <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Lembur</a></li>
          <li><a href="cashadvance.php"><i class="fa fa-circle-o"></i> Cash Advance</a></li>
          <li><a href="schedule.php"><i class="fa fa-circle-o"></i> Jadwal Kerja</a></li>
        </ul>
      </li>
      <li><a href="deduction.php"><i class="fa fa-file-text"></i> Deductions</a></li>
      <li><a href="position.php"><i class="fa fa-suitcase"></i> Posisi</a></li>
      <li class="header">PRINTABLES</li>
      <li><a href="payroll.php"><i class="fa fa-files-o"></i> <span>Daftar gaji</span></a></li>
      <li><a href="schedule_employee.php"><i class="fa fa-clock-o"></i> <span>Jadwal Karja</span></a></li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
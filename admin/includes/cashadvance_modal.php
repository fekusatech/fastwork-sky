<!-- Add -->
<div class="modal fade" id="addnew">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b>Add Pinjaman</b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="cashadvance_add.php">
					<div class="form-group">
						<label for="employee" class="col-sm-3 control-label">Pilih Karyawan:</label>
						<div class="col-sm-9">
							<select class="form-control" id="employee" name="employee" required>
								<?php
								$sql = "SELECT e.* from employees e";
								$query = $conn->query($sql);
								while ($row = $query->fetch_assoc()) {
									echo "<option value='" . $row['employee_id'] . "'>" . $row['employee_id'] . " - " . $row['firstname'] . " " . $row['lastname'] . " (Max Pinjaman: Rp ".number_format($row['max_payment']).")</option>";
								}
								?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label for="amount" class="col-sm-3 control-label">Jumlah</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="amount" name="amount" required>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b><span class="date"></span> - <span class="employee_name"></span></b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="cashadvance_edit.php">
					<input type="hidden" class="caid" name="id">
					<div class="form-group">
						<label for="edit_amount" class="col-sm-3 control-label">Jumlah</label>

						<div class="col-sm-9">
							<input type="text" class="form-control" id="edit_amount" name="amount" required>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><b><span class="date"></span></b></h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" method="POST" action="cashadvance_delete.php">
					<input type="hidden" class="caid" name="id">
					<div class="text-center">
						<p>DELETE Pinjaman</p>
						<h2 class="employee_name bold"></h2>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
				<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
				</form>
			</div>
		</div>
	</div>
</div>
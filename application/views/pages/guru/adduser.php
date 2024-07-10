<?php foreach ($guru as $Guru) { ?>
	<!-- add modal -->
	<div class="modal fade adduser<?php echo $Guru->guru_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title mt-0">Edit Guru</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form action="<?php echo base_url('user/simpan'); ?>" method="post">
						<!-- Input hidden untuk menyimpan ID Guru -->
						<input type="hidden" name="guru_id" value="<?php echo $Guru->guru_id; ?>">
						<!-- Input Nama Guru -->
						<div class="form-group">
							<input type="hidden" class="form-control" id="nama" name="guru_id" placeholder="Nama Guru" value="<?php echo $Guru->guru_id; ?>">
						</div>
						<!-- Input NIY Guru -->
						<div class="form-group">
							<label for="niy" class="control-label">Username</label>
							<input type="text" readonly class="form-control" id="niy" name="username" placeholder="NIY Guru" value="<?php echo $Guru->niy_guru; ?>">
						</div>
						<!-- Input Alamat -->
						<div class="form-group">
							<label for="password" class="control-label">password</label>
							<input type="text" class="form-control" id="password" name="password" placeholder="John" value="<?php echo $Guru->niy_guru ?>">
						</div>
						<div class="form-group">
							<label for="role" class="control-label">Role</label>
							<select class="form-control" id="role" name="role">
								<option value="">Pilih</option>
								<option value="admin">Admin</option>
								<option value="bendahara">Bendahara</option>
								<option value="kepsek">Kepsek</option>
								<option value="yayasan">Yayasan</option>
							</select>
						</div>
						<!-- Tombol untuk menyimpan data -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm w-md">Save Changes</button>
						</div>
					</form>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php } ?>
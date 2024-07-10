<div id="addguru" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Tambah</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body p-4">
				<div>
					<form action="<?php echo site_url('guru/simpan'); ?>" method="post">
						<!-- Input Nama Guru -->
						<div class="form-group">
							<label for="nama" class="control-label">Nama</label>
							<input type="text" class="form-control" id="nama" name="nama_guru" placeholder="Nama Guru">
						</div>
						<!-- Input NIY Guru -->
						<div class="form-group">
							<label for="niy" class="control-label">NIY</label>
							<input type="text" class="form-control" id="niy" name="niy_guru" placeholder="NIY Guru">
						</div>
						<!-- Input Jenis Kelamin -->
						<div class="form-group">
							<label for="jenisKelamin" class="control-label">Jenis Kelamin</label>
							<select class="form-control" id="jenisKelamin" name="jenis_kelamin">
								<option value="">Pilih</option>
								<option value="Perempuan">Perempuan</option>
								<option value="Laki-laki">Laki-laki</option>
							</select>
						</div>
						<!-- Input Tanggal Lahir -->
						<div class="form-group">
							<label for="tanggalLahir" class="control-label">Tanggal Lahir</label>
							<input type="date" class="form-control" id="tanggalLahir" name="tanggal_lahir">
						</div>
						<!-- Input Alamat -->
						<div class="form-group">
							<label for="alamat" class="control-label">Alamat</label>
							<input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat Guru">
						</div>
						<!-- Input Jenjang Pendidikan -->
						<label for="jenjangPendidikan" class="control-label">Jenjang Pendidikan</label>
						<select class="form-control" id="jenjangPendidikan" name="jenjang_pendidikan_id">
							<option value="">Pilih</option>
							<?php foreach ($jenjang_pendidikan as $jenjang) : ?>
								<option value="<?php echo $jenjang->jenjang_pendidikan_id; ?>"><?php echo $jenjang->nama_jenjang_pendidikan; ?></option>
							<?php endforeach; ?>
						</select>
						<!-- Input Jabatan -->
						<div class="form-group">
							<label for="jabatan" class="control-label">Jabatan</label>
							<input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Jabatan Guru">
						</div>
						<div class="form-group">
							<label class="control-label">Status</label>
							<select class="form-control" name="status">
								<option value="aktif">Aktif</option>
								<option value="non-aktif">Non Aktif</option>
							</select>
						</div>
						<!-- Tombol untuk menyimpan data -->
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary btn-sm  w-md">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div><!-- /.modal -->
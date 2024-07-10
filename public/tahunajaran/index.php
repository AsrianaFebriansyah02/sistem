<?php if ($this->session->flashdata('alert')): ?>
    <div id="alert">
        <?php echo $this->session->flashdata('alert'); ?>
    </div>
    <script>
        setTimeout(function() {
            document.getElementById("alert").remove();
        }, <?php echo $this->session->flashdata('alert_timeout'); ?>);
    </script>
<?php endif; ?>

<div class="row">
    <div class="col-xl-4">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-right">
                        <div class="input-group input-group-sm">
                            <?php if ($semester): ?>
                                <button type="button" class="btn btn-secondary btn-sm  waves-light" onclick="hapussemester('<?php echo $semester->semester_id; ?>')">
                                    <i class="bx bx-loader bx-spin font-size-16 align-middle"></i>
                                </button>
                            <?php else: ?>
                                <button type="button" class="btn btn-secondary btn-sm  waves-light">
                                    <i class="bx bx-loader bx-spin font-size-16 align-middle"></i>
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                    <h4 class="card-title mb-4"><?php echo $title ?></h4>
                    <hr>
                </div>
                <script>
                    function hapussemester(semester_id) {
                        if (confirm('Anda yakin ingin menghapus tahun ajaran ini?')) {
                            window.location.href = '<?= site_url('admin/semester/delete/'); ?>' + semester_id;
                        }
                    }
                </script>

                <div class="alert alert-primary" role="alert" align="justify">
                    <i class="mdi mdi-bullseye-arrow"></i>
                    <b>Perhatian !</b> Halaman ini digunakan untuk menentukan Sanah Dirasah dan semester default pada
                    halaman aplikasi <b>E-Raport</b>. Silahkan aktifkan Sanah Dirasah dan semester sesuai dengan yang
                    berjalan di madrasah anda.
                    <?php if ($semester): ?>
                        <span class="badge badge-pill badge-info font-size-8"><?php echo $semester->nama_tahun; ?></span>
                        <span class="badge badge-pill badge-primary font-size-8"><?php echo $semester->semester; ?></span>
                    <?php else: ?>
                        <span class="badge badge-pill badge-danger font-size-8">tidak ada semester aktif</span>
                    <?php endif; ?>
                </div>

                <div class="table-responsive">
                    <?php if ($semester): ?>
                        <form action="<?php echo site_url('admin/semester/update'); ?>" method="post">
                    <?php else: ?>
                        <form action="<?php echo site_url('admin/semester/simpan'); ?>" method="post">
                    <?php endif; ?>
                        <div class="form-group">
                            <label class="control-label">Sanah Dirasah</label>
                            <?php if ($semester): ?>
                                <input type="hidden" class="form-control" value="<?php echo $semester->semester_id; ?>" name="semester_id" id="semester_id">
                            <?php endif; ?>
                            <select class="form-control form-control-sm" name="tahun_ajaran_id">
                                <?php usort($tahun_ajaran, function($a, $b) { return strcmp($b->tahun_ajaran_id, $a->tahun_ajaran_id); });
                                foreach ($tahun_ajaran as $tahun): ?>
                                    <option value="<?php echo $tahun->tahun_ajaran_id; ?>"><?php echo $tahun->nama_tahun; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="control-label">Semester</label>
                            <select class="form-control form-control-sm" name="semester">
                                <option value="Ganjil" <?php echo ($semester && $semester->semester == 'Ganjil') ? 'selected' : ''; ?>>Ganjil</option>
                                <option value="Genap" <?php echo ($semester && $semester->semester == 'Genap') ? 'selected' : ''; ?>>Genap</option>
                            </select>
                        </div>
                        <hr>
                        <div align="right">
                            <button type="submit" class="btn btn-primary btn-sm w-md">Submit</button>
                        </div>
                    </form>     
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-right">
                        <div class="input-group input-group-sm">
                            <button type="button" class="btn btn-primary btn-sm waves-effect btn-label waves-light"
                                data-toggle="modal" data-target=".tahunajaran"><i
                                    class="bx bx-plus label-icon"></i> Add
                            </button>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Data Sanah Dirasah</h4>
                    <hr>
                </div>

                <div class="table-responsive">
                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th width="10px">No</th>
                                <th>Kode Tahun</th>
                                <th>Sanah Dirasah</th>
                                <th>Status</th>
                                <th width="100px">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php if ($tahun_ajaran): $no = 1; usort($tahun_ajaran, function($a, $b) { return strcmp($b->tahun_ajaran_id, $a->tahun_ajaran_id); });
                                foreach ($tahun_ajaran as $tahun): ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $tahun->kode_tahun; ?></td>
                                        <td><?php echo $tahun->nama_tahun; ?></td>
                                        <td align="center">
                                            <span class="badge badge-pill badge-<?php echo ($tahun->status == 'aktif') ? 'success' : 'danger'; ?> font-size-8"><?php echo $tahun->status; ?></span>
                                        </td>
                                        <td align="center">
                                            <button type="button" class="btn btn-warning btn-sm waves-effect waves-light" data-toggle="modal" data-target=".tahunajaran<?php echo $tahun->tahun_ajaran_id; ?>">
                                                <i class="mdi mdi-pencil"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deletetahunajaran<?php echo $tahun->tahun_ajaran_id; ?>">
                                                <i class="mdi mdi-trash-can"></i>
                                            </button>
                                        </td>
                                    </tr>
                                <?php endforeach; else: ?>
                                    <tr>
                                        <td colspan="5" align="center">Tidak ada data tahun ajaran.</td>
                                    </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->

<?php $this->load->view('admin/tahunajaran/edit');?>
<?php $this->load->view('admin/tahunajaran/add');?>
<?php $this->load->view('admin/tahunajaran/delete');?>

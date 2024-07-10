<?php if ($this->session->flashdata('alert')) : ?>
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
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div align="right">
                    <button type="button" class="btn btn-sm btn-rounded btn-purple waves-effect waves-light" data-toggle="modal" data-target="#addjenjang"><i class="fas fa-plus"></i> Data Jenjang Pendidikan</button>
                </div>
                <hr>
                <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">

                    <thead align="center">
                        <tr>
                            <th>No</th>
                            <th>Jenjang Pendidikan</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>

                    <tbody align="center">
                        <?php if ($jenjang_pendidikan) : $no = 1;
                            usort($jenjang_pendidikan, function ($a, $b) {
                                return strcmp($b->jenjang_pendidikan_id, $a->jenjang_pendidikan_id);
                            });
                            foreach ($jenjang_pendidikan as $pendidikan) : ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $pendidikan->nama_jenjang_pendidikan; ?></td>
                                    <td align="center">
                                        <button type="button" class="btn btn-warning btn-sm btn-rounded waves-effect waves-light" data-toggle="modal" data-target="#modalFadeJenjangPendidikan<?php echo $pendidikan->jenjang_pendidikan_id; ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-rounded waves-effect waves-light btn-sm" data-toggle="modal" data-target=".deleteJenjangPendidikan<?php echo $pendidikan->jenjang_pendidikan_id; ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>

                                    </td>
                                </tr>
                            <?php endforeach;
                        else : ?>
                            <tr>
                                <td colspan="5" align="center">Tidak ada data Jenjang Pendidikan.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div> <!-- end card body-->
    </div> <!-- end card -->
</div><!-- end col-->
</div>
<?php $this->load->view('pages/jenjang/add'); ?>
<?php $this->load->view('pages/jenjang/edit'); ?>
<?php $this->load->view('pages/jenjang/delete'); ?>
</div> <!-- container -->
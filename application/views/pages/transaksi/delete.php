<?php foreach ($transaksi as $Transaksi) { ?>
    <div class="modal fade deletetransaksi<?php echo $Transaksi->transaksi_id; ?>" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0">Delete Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-warning" role="alert" align="center">
                        <b>Yakin </b>ingin menghapus data <span class="badge badge-pill badge-primary font-size-8"><?php echo $Transaksi->uraian; ?></span> ? <br>
                        <b>Perhatian!</b> Penghapusan data akan secara otomatis menghapus data lain yang memiliki hubungan pada <b>administrasi</b>.
                    </div>
                    <form action="<?php echo site_url('transaksi/delete'); ?>" method="post">
                        <input type="hidden" class="form-control" value="<?php echo $Transaksi->transaksi_id; ?>" name="transaksi_id" id="transaksi_id">
                        <!-- Tombol untuk menyimpan data -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger btn-sm  w-md">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->
    </div>
<?php } ?>
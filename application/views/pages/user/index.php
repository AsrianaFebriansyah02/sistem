  <?php if ($this->session->flashdata('alert')) : ?>
      <!-- Menampilkan pemberitahuan -->
      <div id="alert">
          <?php echo $this->session->flashdata('alert'); ?>
      </div>
      <!-- Script untuk menghapus pemberitahuan setelah beberapa detik -->
      <script>
          setTimeout(function() {
              document.getElementById("alert").remove();
          }, <?php echo $this->session->flashdata('alert_timeout'); ?>);
      </script>
  <?php endif; ?>
  <!-- isi konten -->
  <!-- isi konten -->
  <div class="row">
      <div class="col-12">
          <div class="card">
              <div class="card-body">

                  <table id="scroll-horizontal-datatable" class="table table-striped dt-responsive w-100 nowrap">

                      <thead align="center">
                          <tr>
                              <th>No</th>
                              <th>Nama Guru</th>
                              <th>Username</th>
                              <th>Password</th>
                              <th>Role</th>
                              <th>Aksi</th>
                          </tr>
                      </thead>
                      <tbody align="center">
                          <?php if ($user) : $no = 1;
                                usort($user, function ($a, $b) {
                                    return strcmp($b->user_id, $a->user_id);
                                });
                                foreach ($user as $User) : ?>
                                  <tr>
                                      <td><?php echo $no++; ?></td>
                                      <td><?php echo $User->nama_guru; ?></td>
                                      <td><?php echo $User->username; ?></td>
                                      <td><?php echo $User->niy_guru; ?></td>
                                      <td><?php echo $User->role; ?></td>
                                      <td align="center">
                                          <button type="button" class="btn btn-warning btn-sm btn-rounded  waves-effect waves-light" data-toggle="modal" data-target=".edituser<?php echo $User->user_id; ?>">
                                              <i class="fas fa-edit"></i>
                                          </button>
                                      </td>
                                  </tr>
                              <?php endforeach;
                            else : ?>
                              <tr>
                                  <td colspan="6" align="center">Tidak ada data Jenjang Pendidikan.</td>
                              </tr>
                          <?php endif; ?>
                      </tbody>
                  </table>
              </div>
          </div> <!-- end card body-->
      </div> <!-- end card -->
  </div><!-- end col-->
  </div>
  <!-- end row-->
  <!-- and isi konten -->


  <!-- Memuat view edit -->
  <?php $this->load->view('pages/user/edit'); ?>

  </div> <!-- container -->

  </div> <!-- container -->
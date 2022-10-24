 <!-- MAIN -->
      <div class="col">
        <div class="container">

            <!-- Alert -->
            <?php
              if (!empty($this->session->flashdata('errorPassword'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorPassword'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

             <?php
              if (!empty($this->session->flashdata('errorUsername'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorUsername'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('errorValidasi'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorValidasi'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successEdit'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successEdit'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successRegister'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successRegister'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successReset'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successReset'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successHapus'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successHapus'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <center>
                <h1 style="margin-top: 3%;">Pengelolaan User</h1>
            </center>
            <br>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col"><center>ID User</center></th>
                  <th scope="col"><center>Username</center></th>
                  <th scope="col"><center>Level</center></th>
                  <th scope="col"><center>Action</center></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($user as $mn): ?>
                <tr>
                  <th scope="row"><center><?php echo $mn->id_user; ?></center></th>
                  <td><center><?php echo $mn->username; ?></center></td>
                  <td><center><?php echo $mn->level; ?></center></td>
                  <td>
                    <center>
                      <a href="#" class="fa fa-edit fa-fw" style="color: grey; text-decoration: none;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal<?php echo $mn->id_user; ?>">Edit</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalDelete<?php echo $mn->id_user; ?>">Hapus</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalReset<?php echo $mn->id_user; ?>">Reset Password</a>
                      </div>
                    </center>
                  </td>
                </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="modalDelete<?php echo $mn->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                          </div>
                          <div class="modal-body"> Anda yakin ingin menghapusnya? </div>
                          <div class="modal-footer">
                            <a href="<?= base_url().'User_controller/hapusUser/'.$mn->id_user; ?>" id="delete" class="btn btn-primary">Yes</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Reset Password-->
                    <div class="modal fade" id="modalReset<?php echo $mn->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Reset Password - <?php echo $mn->username; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form class="form-edit" method="POST" action="<?php echo base_url().'User_controller/resetPassword'?>" enctype="multipart/form-data">
                          <div class="modal-body">
                              <div class="form-group">
                                <input type="hidden" name="id_user" value="<?php echo $mn->id_user; ?>">

                                <label class="col-form-label">
                                    Masukkan Password Baru
                                </label>
                                <br>
                                <input type="password" id="password" class="form-control" name="password" required="" oninvalid="this.setCustomValidity('Password Harus Diisi!')" oninput="this.setCustomValidity('')">

                                <label class="col-form-label">
                                    Re-Type Password Baru
                                </label>
                                <br>
                                <input type="password" id="retype" name="retype" class="form-control" required="" oninvalid="this.setCustomValidity('Re-Type Password Harus Diisi!')" oninput="this.setCustomValidity('')">
                              </div> 
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Edit Menu-->
                    <div class="modal fade" id="modal<?php echo $mn->id_user; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit User - <?php echo $mn->username; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form class="form-edit" method="POST" action="<?php echo base_url().'User_controller/editUser'?>" enctype="multipart/form-data">
                          <div class="modal-body">
                              <div class="form-group">
                                <input type="hidden" name="id_user" value="<?php echo $mn->id_user; ?>">
                                <label class="col-form-label">
                                    Username
                                </label>
                                <br>
                                <input id="username" type="text" class="form-control" name="username" value="<?php echo $mn->username; ?>" readonly>

                                <label class="col-form-label">
                                    Level
                                </label>
                                <br>
                                <select id="level" class="form-control" name="level" required="" oninvalid="this.setCustomValidity('Pilih Salah Satu Level!')" oninput="this.setCustomValidity('')">
                                  <option value="<?php echo $mn->level; ?>">-- Pilih --</option>
                                  <option value="admin">Admin</option>
                                  <option value="user">User</option>
                                </select>
                              </div> 
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                          </form>
                        </div>
                      </div>
                    </div>
                    <!-- End Modal -->
                <?php endforeach ?>
              </tbody>
              <thead>
              <tr>
                <th colspan="3"><center>&nbsp;</center></th>
                <td>
                  <center>
                    <a href="#" data-toggle="modal" data-target="#modalTambahUser">
                        <!-- <span class="fa fa-plus-square fa-1x"></span> -->
                        <button type="button" class="btn btn-primary">Add User</button>
                    </a> 
                  </center>
                </td>
              </tr>  
              </thead>
            </table>
            <br>
        </div>
    </div>

    <!-- Modal Tambah Menu-->
    <div class="modal fade" id="modalTambahUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah User</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-tambah" method="POST" action="<?php echo base_url().'User_controller/tambahUser'?>" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="form-group">
                <label class="col-form-label">
                    Username
                </label>
                <br>
                <input id="username" type="text" class="form-control" name="username" required="" oninvalid="this.setCustomValidity('Username Harus Diisi!')" oninput="this.setCustomValidity('')">


                <label class="col-form-label">
                    Level
                </label>
                <br>
                <select id="level" class="form-control" name="level" required="" oninvalid="this.setCustomValidity('Pilih Salah Satu Level!')" oninput="this.setCustomValidity('')">
                  <option value="">-- Pilih --</option>
                  <option value="admin">Admin</option>
                  <option value="user">User</option>
                </select>

                <label class="col-form-label">
                    Password
                </label>
                <br>
                <input type="password" id="password" class="form-control" name="password" required="" oninvalid="this.setCustomValidity('Password Harus Diisi!')" oninput="this.setCustomValidity('')">

                <label class="col-form-label">
                    Re-Type Password
                </label>
                <br>
                <input type="password" id="retype" class="form-control" name="retype" required="" oninvalid="this.setCustomValidity('Re-Type Password Harus Diisi!')" oninput="this.setCustomValidity('')">
              </div> 
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    <!-- End Modal -->
    
    <!-- JAVASCRIPT Query -->
    <script type="text/javascript">
      // Validasi numeric
      function numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
        return true;
      }

      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 3000);

      $(document).ready(function() {
          $('#datatable').DataTable();
      });
    </script>
    <!-- END MAIN -->

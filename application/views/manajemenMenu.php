 <!-- MAIN -->
      <div class="col">
        <div class="container">

            <!-- Alert -->
            <?php
              if (!empty($this->session->flashdata('errorUploadEdit'))) {
            ?>
                  <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorUploadEdit'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successUploadEdit'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successUploadEdit'); ?>
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
                <h1 style="margin-top: 3%;">Pengelolaan Menu</h1>
            </center>
            <br>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col"><center>Kode Menu</center></th>
                  <th scope="col"><center>Menu</center></th>
                  <th scope="col"><center>Type</center></th>
                  <th scope="col"><center>Harga Satuan</center></th>
                  <th scope="col"><center>Stok</center></th>
                  <th scope="col"><center>Action</center></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach($menu as $mn): ?>
                <tr>
                  <th scope="row"><center><?php echo $mn->kd_menu; ?></center></th>
                  <td><center><?php echo $mn->nama_menu; ?></center></td>
                  <td><center><?php echo $mn->type; ?></center></td>
                  <td><center>Rp.<?php echo number_format($mn->harga_satuan, 0, '','.'); ?></center></td>
                  <td><center><?php echo $mn->stok; ?></center></td>
                  <td>
                    <center>
                      <a href="#" class="fa fa-edit fa-fw" style="color: grey; text-decoration: none;" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></a>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal<?php echo $mn->kd_menu; ?>">Edit</a>
                          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalDelete<?php echo $mn->kd_menu; ?>">Hapus</a>
                      </div>
                    </center>
                  </td>
                </tr>
                    <!-- Modal Delete -->
                    <div class="modal fade" id="modalDelete<?php echo $mn->kd_menu; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Confirm</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                          </div>
                          <div class="modal-body"> Anda yakin ingin menghapusnya? </div>
                          <div class="modal-footer">
                            <a href="<?= base_url().'Menu_controller/hapusMenu/'.$mn->kd_menu; ?>" id="delete" class="btn btn-primary">Yes</a>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button> 
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- Modal Edit Menu-->
                    <div class="modal fade" id="modal<?php echo $mn->kd_menu; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Menu - <?php echo $mn->nama_menu; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form class="form-edit" method="POST" action="<?php echo base_url().'Menu_controller/editMenu'?>" enctype="multipart/form-data">
                          <div class="modal-body">
                              <div class="form-group">
                                <input type="hidden" name="kd_menu" value="<?php echo $mn->kd_menu; ?>">
                                <label class="col-form-label">
                                    Nama Menu
                                </label>
                                <br>
                                <input id="nama_menu" type="text" class="form-control" name="nama_menu" value="<?php echo $mn->nama_menu; ?>" readonly>

                                <label class="col-form-label">
                                    Type Menu
                                </label>
                                <br>
                                <select id="type" class="form-control" name="type" readonly>
                                  <option><?php echo $mn->type; ?></option>
                                </select>

                                <label class="col-form-label">
                                    Harga Satuan
                                </label>
                                <br>
                                <input type="text" id="harga_satuan" class="form-control" name="harga_satuan" value="<?php echo $mn->harga_satuan; ?>" onkeypress="return numeric(event)" required="" oninvalid="this.setCustomValidity('Harga Harus Diisi!')" oninput="this.setCustomValidity('')">

                                <label class="col-form-label">
                                    Stok
                                </label>
                                <br>
                                <input type="text" id="stok" class="form-control" onkeypress="return numeric(event)" name="stok" value="<?php echo $mn->stok; ?>" required="" oninvalid="this.setCustomValidity('Stok Harus Diisi!')" oninput="this.setCustomValidity('')">

                                <label class="col-form-label">
                                    Upload Gambar
                                </label>
                                <br>
                                <input type="file" name="upload" id="upload">
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
                <th colspan="5"><center>&nbsp;</center></th>
                <td>
                  <center>
                    <a href="#" data-toggle="modal" data-target="#modalTambahMenu">
                        <!-- <span class="fa fa-plus-square fa-1x"></span> -->
                        <button type="button" class="btn btn-primary">Add Menu</button>
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
    <div class="modal fade" id="modalTambahMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Menu</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form class="form-tambah" method="POST" action="<?php echo base_url().'Menu_controller/tambahMenu'?>" enctype="multipart/form-data">
          <div class="modal-body">
              <div class="form-group">
                <label class="col-form-label">
                    Nama Menu
                </label>
                <br>
                <input id="nama_menu" type="text" class="form-control" name="nama_menu" required="" oninvalid="this.setCustomValidity('Nama Menu Harus Diisi!')" oninput="this.setCustomValidity('')">

                <label class="col-form-label">
                    Type Menu
                </label>
                <br>
                <select id="type" class="form-control" name="type" required="" oninvalid="this.setCustomValidity('Pilih Salah Satu Type!')" oninput="this.setCustomValidity('')">
                  <option value="">-- Pilih --</option>
                  <option value="makanan">Food</option>
                  <option value="minuman">Beverages</option>
                  <option value="snack">Snack</option>
                </select>

                <label class="col-form-label">
                    Harga Satuan
                </label>
                <br>
                <input type="text" id="harga_satuan" class="form-control" name="harga_satuan" onkeypress="return numeric(event)" required="" oninvalid="this.setCustomValidity('Harga Harus Diisi!')" oninput="this.setCustomValidity('')">

                <label class="col-form-label">
                    Stok
                </label>
                <br>
                <input type="text" id="stok" class="form-control" name="stok" onkeypress="return numeric(event)" required="" oninvalid="this.setCustomValidity('Stok Harus Diisi!')" oninput="this.setCustomValidity('')">

                <label class="col-form-label">
                    Upload Gambar
                </label>
                <br>
                <input type="file" name="upload" id="upload">
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

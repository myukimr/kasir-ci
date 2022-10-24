 <!-- MAIN -->
    <div class="col">
        <div class="container">

            <!-- Alert -->
            <?php
              if (!empty($this->session->flashdata('errorUploadAdd'))) {
            ?>
                  <div class="alert alert-info alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorUploadAdd'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('successUploadAdd'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successUploadAdd'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

             <?php
              if (!empty($this->session->flashdata('successLogin'))) {
            ?>
                  <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('successLogin'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <div class="row mt-4">
              <div class="col">
                <center>
                  <h1>New Menu</h1>
                </center>
                <br>
              </div>
            </div>
                
                <div class="row mt-3">
                    <?php foreach($menuTerbaru as $lt): ?>
                    <div class="col-md-4">
                        <a href="<?= base_url().'Cart_controller/addCart/'.$lt->kd_menu ?>" style="text-decoration: none; color: black;" class="card mb-3">
                            <img src="upload/menu/<?php echo $lt->img; ?>" class="card-img-top" alt="...">
                            <div class="card-body">
                            <center>
                                <h4 class="card-title"><?php echo $lt->nama_menu; ?></h4>
                            </center>
                            </div>
                        </a>
                    </div>
                    <?php endforeach ?>
                </div>
        </div>
    </div>
    <!-- END MAIN -->

    <script type="text/javascript">
      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 3000);
    </script>
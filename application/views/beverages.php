 <!-- MAIN -->
    <div class="col">
        <div class="container">
            <div class="row mt-4">
              <div class="col">
                <center>
                  <h1>Beverages Menu</h1>  
                </center>
                <br>
              </div>
            </div>
                
                <div class="row mt-3">
                    <?php foreach($Beverages as $lt): ?>
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
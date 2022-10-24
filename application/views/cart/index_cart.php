    <div class="sidebar-expanded d-none d-md-block bg-light" style="margin-right: 0%; width: 22%;">
        <br>
        <center><h2>CART</h2></center>
        <hr>
        <div id="detail_cart">
            <?php foreach ($content as $item) { ?>
            <a href="#" style="text-decoration: none; color: black;" data-toggle="modal" data-target="#modalDetail<?php echo $item['rowid'] ?>">
                <div class="media">
                    <i class="fa fa-angle-double-right" style="margin-left: 3%; margin-top: 2%;"></i>
                    <div class="media-body" style="margin-left: 3%;">
                        <h5 class="mt-0"><?php echo $item['name'] ?></h5>
                        Quantity : <?php echo $item['qty'] ?> x Rp.<?php echo number_format($item['price'], 0, '','.'); ?>
                        <br>
                        Catatan &nbsp;: <?php echo $item['catatan'] ?>
                        <br>
                        <?php 
                            if ($item['qty'] > $item['stok']) {
                            ?>
                            <img src="https://image.flaticon.com/icons/svg/564/564619.svg" style="width: 4%;">
                            <font color="red" size="2">Only <?php echo $item['stok'] ?> product avalaible</font>
                            <?php
                        } ?> 
                    </div>
                </div>    
            </a>
            <hr>
            <form method="GET" action="<?php echo base_url().'Cart_controller/editCart';?>">
                <?php echo $this->session->flashdata('msg'); ?>
            <!-- modal -->
                <div class="modal fade" id="modalDetail<?php echo $item['rowid'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Detail Keranjang</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                          <div class="form-group">
                            <input type="hidden" name="rowid" value="<?php echo $item['rowid'] ?>">
                            <label class="col-form-label">Nama Menu :</label>
                            <label class="form-control"><?php echo $item['name'] ?></label>
                            <label class="col-form-label">Harga Satuan :</label>
                            <label class="form-control">Rp.<?php echo number_format($item['price'], 0, '','.'); ?></label>
                            <label class="col-form-label">Qty :</label>
                            <input type="text" name="qty" class="form-control" value="<?php echo $item['qty'] ?>" onkeypress="return numeric(event)">
                            <label class="col-form-label">Catatan :</label>
                            <textarea class="form-control" name="catatan"><?php echo $item['catatan'] ?></textarea>
                          </div>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">
                            &nbsp; Batal &nbsp;
                        </button>
                        <a href="<?= base_url().'Cart_controller/removeCart/'.$item['rowid'] ?>">
                            <button type="button" class="btn btn-danger">Delete</button>
                        </a>
                        <button type="submit" class="btn btn-primary">
                            &nbsp;&nbsp; Edit &nbsp;&nbsp;
                        </button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
            <?php 
                } 
                $check = count($content);
                if ($check < 3) {
            ?>
            <div style="bottom: 0%; position: fixed; width: 22%;">
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col" style="margin-left: 5%;">
                            <b>Subtotal</b>
                            <br>
                            <b>Diskon</b>
                            <br>
                            <b>PPN(10%)</b>
                            <br>
                            <b>Total Transaksi</b>
                        </div>
                        <?php  
                            $subtotal =  $this->cart->total();
                            $diskon = 0;
                            if ($subtotal>1000000) {
                                $diskon = 50000;  
                            }
                            $ppn = 10 * $subtotal / 100;
                            $total = $subtotal + $ppn - $diskon;
                        ?>
                        <div class="col" style="text-align: right;">
                            Rp. <?php echo number_format($subtotal, 0, '','.'); ?>
                            <br>
                            Rp. <?php echo number_format($diskon, 0, '','.'); ?>
                            <br>
                            Rp. <?php echo number_format($ppn, 0, '','.'); ?>
                            <br>
                            <b> Rp. <?php echo number_format($total, 0, '','.'); ?> </b>
                        </div>
                    </div>
                    <br>
                    <center>
                        <a href="<?php echo base_url().'Cart_controller/destroyCart'?>" class="btn btn-secondary">Batal</a>    
                        <a href="<?php echo base_url().'Transaksi_controller'?>" class="btn btn-primary">Bayar</a>    
                    </center>
                    <br> 
                </div>
            </div>

            <?php        
                }
                else{
            ?>
            <div>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col" style="margin-left: 5%;">
                            <b>Subtotal</b>
                            <br>
                            <b>Diskon</b>
                            <br>
                            <b>PPN(10%)</b>
                            <br>
                            <b>Total Transaksi</b>
                        </div>
                        <?php  
                            $subtotal =  $this->cart->total();
                            $diskon = 0;
                            if ($subtotal>1000000) {
                                $diskon = 50000;  
                            }
                            $ppn = 10 * $subtotal / 100;
                            $total = $subtotal + $ppn - $diskon;
                        ?>
                        <div class="col" style="text-align: right;">
                            Rp. <?php echo number_format($subtotal, 0, '','.'); ?>
                            <br>
                            Rp. <?php echo number_format($diskon, 0, '','.'); ?>
                            <br>
                            Rp. <?php echo number_format($ppn, 0, '','.'); ?>
                            <br>
                            <b> Rp. <?php echo number_format($total, 0, '','.'); ?> </b>
                        </div>
                    </div>
                    <br>
                    <center>
                        <a href="<?php echo base_url().'Cart_controller/destroyCart'?>" class="btn btn-secondary">Batal</a>    
                        <a href="<?php echo base_url().'Transaksi_controller'?>" class="btn btn-primary">Bayar</a>    
                    </center>
                    <br> 
                </div>
            </div>
            <?php
                }
            ?> 
        </div>
    </div>
    <!-- End Sidebar -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript"> 
        function numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
        return true;
    </script>
    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script
    src="https://code.jquery.com/jquery-3.3.1.min.js"
    integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
    crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function() {
    $('#example').DataTable();
    } );
  </script>
  </body>
</html>
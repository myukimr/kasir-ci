 <!-- MAIN -->
    <div class="col">
        <div class="container">
            <!-- alert -->
            <?php
              if (!empty($this->session->flashdata('errorCart'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorCart'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('errorStok'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorStok'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>

            <?php
              if (!empty($this->session->flashdata('errorMoney'))) {
            ?>
                  <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-top: 2%;">
                    <?php echo $this->session->flashdata('errorMoney'); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
            <?php
               } 
             ?>
            <center>
                <h1 style="margin-top: 3%;">Transaksi Pembayaran</h1>
            </center>
            <br>
            <table id="datatable" class="table table-striped table-bordered">
              <thead>
                <tr>
                  <th scope="col"><center>Kode Menu</center></th>
                  <th scope="col"><center>Menu</center></th>
                  <th scope="col"><center>Harga Satuan</center></th>
                  <th scope="col"><center>Quantity</center></th>
                  <th scope="col"><center>Catatan</center></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($content as $item) { ?>
                <tr>
                  <th scope="row"><center><?php echo $item['id'] ?></center></th>
                  <td><center><?php echo $item['name'] ?></center></td>
                  <td><center>Rp.<?php echo number_format($item['price'], 0, '','.'); ?></center></td>
                  <td><center><?php echo $item['qty'] ?></center></td>
                  <td><center><?php echo $item['catatan'] ?></center></td>
                </tr>
                <?php } ?>
              </tbody>
            </table>
            <br>
            <div class="card" style="width: 70%; margin: 0% 15% 0% 15%;">
              <div class="card-header bg-primary text-white"><center><b>Form Transaksi</b></center></div>
                <div class="card-body">
                <center>
                    <h3 style="color: grey; margin-bottom: 5%;">Total Pembayaran</h3>
                </center>
                <?php  
                    $subtotal =  $this->cart->total();
                    $diskon = 0;
                    if ($subtotal>1000000) {
                        $diskon = 50000;  
                    }
                    $ppn = 10 * $subtotal / 100;
                    $total = $subtotal + $ppn - $diskon;
                ?>
                <div class="row">
                    <div class="col-sm" style="margin-left: 10%; margin-right: 10%;">
                        <center>
                            <label style="height: 100%; background-color: #ebebeb; font-size: 120%;" class="form-control">
                                <b>
                                    Rp. <?php echo number_format($total, 0, '','.'); ?>
                                </b>
                            </label>
                        </center>
                    </div>
                </div>
                <center>
                    <button style="width: 20%; margin-top: 2%;" type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal">Bayar</button>
                </center>
                </div>
            </div>
        </div>
    </div>
  

    <!-- Modal -->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Form Pembayaran</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>  
          <div class="modal-body">
            <form method="POST" class="form-index" action="<?php echo base_url().'Transaksi_controller/inputPembayaran'?>">
              <div class="form-group">
                <label for="recipient-name" class="col-form-label">
                    Type Pembayaran
                </label>
                <br>
                <select id="type" class="btn btn-default" style="height: 100%;  background-color: #ebebeb; width: 25%;" name="type" onclick="return cekPembayaran()" required="" oninvalid="this.setCustomValidity('Pilih Type Pembayaran!')" oninput="this.setCustomValidity('')">
                    <option value="">-- Pilih --</option>
                    <option value="tunai">Tunai</option>
                    <option value="ovo">OVO</option>
                    <option value="linkaja">Linkaja</option>
                </select>
                <br>
                <label for="recipient-name" class="col-form-label" style="margin-top: 2%;">
                    Customer
                </label>
                <br>
                <input type="text" class="form-control" id="customer" name="customer" required="" oninvalid="this.setCustomValidity('Customer Harus Diisi!')" oninput="this.setCustomValidity('')">
<!--                 <span class="transaksi-customer" style="display: none; font-size: 12px; color: red;"><img src="https://image.flaticon.com/icons/svg/564/564619.svg" style="width: 2.5%;"> Customer Wajib Diisi ! <br></span> -->

                <label for="recipient-name" class="col-form-label">
                    No. Meja 
                </label>
                <br>
                <input type="text" class="form-control" id="no_meja" name="no_meja" required="" oninvalid="this.setCustomValidity('Nomor Meja Harus Diisi!')" oninput="this.setCustomValidity('')">
<!--                 <span class="transaksi-nomeja" style="display: none; font-size: 12px; color: red;"><img src="https://image.flaticon.com/icons/svg/564/564619.svg" style="width: 2.5%;"> Nomor Meja Wajib Diisi ! <br></span> -->

                <label id="label-uang" for="recipient-name" class="col-form-label" style="display: none;">
                    Jumlah Uang
                </label>
                <textarea class="form-control" name="uang" id="uang" maxlength="10" style="display: none;" onkeypress="return numeric(event)"></textarea>
<!--                 <span class="transaksi-uang" style="display: none; font-size: 12px; color: red;"><img src="https://image.flaticon.com/icons/svg/564/564619.svg" style="width: 2.5%;"> Jumlah Uang Wajib Diisi ! <br></span> -->

                <label id="label-linkaja" for="recipient-name" class="col-form-label" style="display: none;">
                    Scan Barcode Linkaja
                </label>
                <center>
                <img src="upload/pembayaran/Linkaja.jpg" id="linkaja" class="card-img-top" alt="..." style="width: 50%; display: none;">
                </center>

                <label id="label-ovo" for="recipient-name" class="col-form-label" style="display: none;">
                    Scan Barcode OVO
                </label>
                <center>
                <img src="upload/pembayaran/OVO.jpg" id="ovo" class="card-img-top" alt="..." style="width: 50%; display: none;">
                </center>
              </div> 
          </div>
          <?php date_default_timezone_set('Asia/Jakarta');
              $waktu = date('Y/m/d H:i:s'); 
          ?>
          <!-- <input type="hidden" id="cekStok" name="cekStok" value="<?php echo $cekStok; ?>"> -->
          <input type="hidden" id="id_user" name="id_user" value="<?php echo $this->session->userdata('id_user'); ?>">
          <input type="hidden" id="id_transaksi" name="id_transaksi" value="">
          <input type="hidden" id="waktu" name="waktu" value="<?php echo $waktu; ?>">
          <input type="hidden" id="total_harga" name="total_harga" value="<?php echo $total; ?>">
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
          </form>
        </div>
      </div>
    </div>
    


    <!-- JAVASCRIPT Query -->
    <script type="text/javascript">
      // Validasi numeric
      function numeric(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
          return false;
        return true;
      }

      function cekPembayaran() {
        var type = $('#type').val();
        if (type == 'tunai') {
          $("#label-uang").css('display','block');
          $("#uang").css('display','block');
          $("#label-linkaja").css('display','none');
          $("#linkaja").css('display','none');
          $("#label-ovo").css('display','none');
          $("#ovo").css('display','none');
          return true;
        }
        else if (type == 'linkaja') {
          $("#label-linkaja").css('display','block');
          $("#linkaja").css('display','block');
          $("#label-uang").css('display','none');
          $("#uang").css('display','none');
          $("#label-ovo").css('display','none');
          $("#ovo").css('display','none');
          return true;
        }
        else if (type == 'ovo') {
          $("#label-ovo").css('display','block');
          $("#ovo").css('display','block');
          $("#label-linkaja").css('display','none');
          $("#linkaja").css('display','none');
          $("#label-uang").css('display','none');
          $("#uang").css('display','none');
          return true;
        }
      }

      window.setTimeout(function() {
        $(".alert").fadeTo(500, 0).slideUp(500, function(){
          $(this).remove(); 
        });
      }, 3000);

      // proses submit
      $(document).ready(function() {
        $('#datatable').DataTable();

        // $('.form-index').submit(function() {
        //     var total_harga = $('#total_harga').val();
        //     var uang = $('#uang').val();
        //     var id_user = $('#id_user').val();
        //     var id_transaksi = $('#id_transaksi').val();
        //     var waktu = $('#waktu').val();
        //     var customer = $('#customer').val();     
        //     var no_meja = $('#no_meja').val();
        //     if (customer == '') {        
        //         $(".transaksi-customer").css('display','block');
        //         return false;
        //     }
        //     else {
        //         $(".transaksi-customer").css('display','none');
        //     }
        //     if (no_meja == '') {        
        //       $(".transaksi-nomeja").css('display','block');
        //       return false;
        //     }
        //     else {
        //         $(".transaksi-nomeja").css('display','none');
        //     }
        //     if (uang == '') {        
        //       $(".transaksi-uang").css('display','block');
        //       return false;
        //     }
        //     else {
        //         $(".transaksi-uang").css('display','none');
        //     }
            // if (cekStok == 'true') {        
            //     $("#alertStok").css('display','block');
            //     return false;
            // }
            // $.ajax({
            //   url      : '<?php echo base_url().'Transaksi_controller/inputPembayaran'?>',
            //   type     : 'POST',
            //   dataType : 'json',
            //   data     : {"id_user" : id_user, "id_transaksi" : id_transaksi, "waktu" : waktu, "total_harga" : total_harga, "customer" : customer, "no_meja" : no_meja, "uang" : uang},
            // });
        // });
      });
    </script>
    <!-- END MAIN -->

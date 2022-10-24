 <!-- MAIN -->
    <div class="col">
        <div class="container">
            <center>
                <h1 style="margin-top: 3%;">Laporan Product</h1>
            </center>
            <form action="<?php echo base_url().'Laporantransaksi_controller'?>" method="POST">
            <br>
            <select name="filter" class="form-control" onchange="this.form.submit();" style="width: 15%;">
              <option value="-">--Pilih--</option>
              <option value="harian">Harian</option>
              <option value="bulanan">Bulanan</option> 
              <option value="tahunan">Tahunan</option>
              <option value="-">Semua</option>                   
            </select>
            <br>
            <table id="datatable" class="table table-striped table-bordered" style="width:100%">
              <thead>
                <tr>
                  <th scope="col"><center>Kode Menu</center></th>
                  <th scope="col"><center>Menu</center></th>
                  <th scope="col"><center>Quantity</center></th>
                  <th scope="col"><center>Type</center></th>
                  <th scope="col"><center>Harga Satuan</center></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($LaporanTransaksi as $lt):
                  $totalppn = ($lt->harga_satuan*$lt->quantity)+($lt->harga_satuan*$lt->quantity*10/100);
                ?>
                <tr>
                  <th scope="row"><center><?= $lt->kd_menu ?></center></th>
                  <td><center><?php echo $lt->nama_menu; ?></center></td>
                  <td><center><?php echo $lt->quantity; ?></center></td>
                  <td><center><?php echo $lt->type; ?></center></td>
                  <td><center>Rp. <?php echo number_format($lt->harga_satuan, 0, '','.'); ?></center></td>
                </tr>
              <?php endforeach ?>
              </tbody>
            </table>
            <br>
            <a href="<?php echo base_url().'Laporantransaksi_controller/pdf'.$Request?>">
              <button style="width: 20%;" type="button" class="btn btn-primary">Print</button>
            </a>
            </form>
    </div>
  </div>
    <!-- END MAIN -->

  <script type="text/javascript">
    $(document).ready(function() {
          $('#datatable').DataTable();
      });
  </script>

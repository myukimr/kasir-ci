 <!-- MAIN -->
    <div class="col">
        <div class="container">
            <center>
                <h1 style="margin-top: 3%;">Riwayat Transaksi</h1>
            </center>
            <form action="<?php echo base_url().'Riwayattransaksi_controller'?>" method="POST">
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
                  <th scope="col"><center>ID User</center></th>
                  <th scope="col"><center>Customer</center></th>
                  <th scope="col"><center>Total Harga</center></th>
                  <th scope="col"><center>Waktu</center></th>
                  <th scope="col"><center>Nomor Meja</center></th>
                </tr>
              </thead>
              <tbody>
                <?php 
                  foreach($Transaksi as $lt):
                ?>
                <tr>
                  <th scope="row"><center><?= $lt->id_user ?></center></th>
                  <td><center><?php echo $lt->nama_customer; ?></center></td>
                  <td><center>Rp. <?php echo number_format($lt->total_harga, 0, '','.'); ?></center></td>
                  <td><center><?php echo $lt->waktu; ?></center></td>
                  <td><center><?php echo $lt->no_meja; ?></center></td>
                </tr>
              <?php endforeach ?>
              </tbody>
            </table>
            <br>
            <a href="<?php echo base_url().'Riwayattransaksi_controller/pdf'.$Request?>">
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

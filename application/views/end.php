 <!-- MAIN -->
    <div class="col">
        <div class="container">
            <br>
            <!-- alert -->
<!--             <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong>Holy guacamole!</strong> You should check in on some of those fields below.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div> -->
            <div class="row mt-4">
              <div class="col">
                <center>
                	<div style="margin-top: 20%;">
                		<font size="50%"><b>Transaksi Anda Berhasil</b></font>
                		<br>
                		<font>Terima kasih telah melakukan transaksi. Uang kembalian anda sebesar Rp. <?php echo number_format($cashback, 0, '','.'); ?> - (Via <?php echo $via; ?>)</font>
                		<br>
                		<br>
                		<a href="<?php echo base_url().'End_controller/downloadStruk/'.$via; ?>">
                			<button type="button" class="btn btn-info"> Cetak Struk</button>
                		</a>
                	</div>
                </center>
                <br>
              </div>
            </div>
        </div>
    </div>
    <!-- END MAIN -->
<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h3 style="font-size:3rem;text-align:center;margin:0;padding:0">Riwayat Transaksi</h3>
        <p style="text-align:center;margin:0;padding:0">Kasir.com</p>
        <!-- <p style="text-align:center;margin:0;padding:0">telp : (0341) 341618(0341) &nbsp;&nbsp; FAX : 44556634</p> -->
        <hr>
        <hr>
        <br>
        <div>
            <table class="table table-striped table-bordered" border="1" style="width: 100%;">
                <tr>
                    <th>ID User</th>
                    <th>Customer</th>
                    <th>Total Harga</th>
                    <th>Waktu</th>
                    <th>Nomor Meja</th>
                </tr>

                <?php
                    foreach ($Transaksi as $lt) :
                ?>
                    <tr>
                        <td><center><?php echo $lt->id_user; ?></center></td>
                        <td><center><?php echo $lt->nama_customer; ?></center></td>
                        <td><center><?php echo number_format($lt->total_harga, 0, '','.'); ?></center></td>
                        <td><center><?php echo $lt->waktu; ?></center></td>
                        <td><center><?php echo $lt->no_meja; ?></center></td>
                    </tr>
                <?php endforeach ?>
            </table>
            <br>
            <p>
                <span style="">Keterangan : <?php echo $Waktu; ?></span>
              
            </p>
        </div>
    </body>
</html>
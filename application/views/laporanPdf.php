<!DOCTYPE html>
<html>
    <head>
        <title></title>
    </head>
    <body>
        <h3 style="font-size:3rem;text-align:center;margin:0;padding:0">Laporan Product</h3>
        <p style="text-align:center;margin:0;padding:0">Kasir.com</p>
        <!-- <p style="text-align:center;margin:0;padding:0">telp : (0341) 341618(0341) &nbsp;&nbsp; FAX : 44556634</p> -->
        <hr>
        <hr>
        <br>
        <div>
            <table class="table table-striped table-bordered" border="1" style="width: 100%;">
                <tr>
                    <th>Kode Menu</th>
                    <th>Nama Menu</th>
                    <th>Harga Satuan</th>
                    <th>Jumlah</th>
                    <th>Type Menu</th>
                    <th>Total Harga</th>
                    <th>Total PPN</th>
                </tr>

                <?php
                    foreach ($LaporanTransaksi as $lt) : 
                    $total = $lt->harga_satuan*$lt->quantity;
                    $ppn = ($lt->harga_satuan*10/100)*$lt->quantity;
                ?>
                    <tr>
                        <td><center><?php echo $lt->kd_menu; ?></center></td>
                        <td><center><?php echo $lt->nama_menu; ?></center></td>
                        <td><center><?php echo $lt->harga_satuan; ?></center></td>
                        <td><center><?php echo $lt->quantity; ?></center></td>
                        <td><center><?php echo $lt->type; ?></center></td>
                        <td><center><?php echo number_format($total, 0, '','.'); ?></center></td>
                        <td><center><?php echo number_format($ppn, 0, '','.'); ?></center></td>
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
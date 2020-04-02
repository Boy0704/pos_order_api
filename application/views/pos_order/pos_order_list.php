
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('pos_order/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('pos_order/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('pos_order'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <div class="table-responsive">
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Invoice</th>
		<th>Tanggal Order</th>
		<th>Produk</th>
		<th>Sku</th>
		<th>Varian</th>
		<th>Sales</th>
		<th>Qty</th>
		<th>Total Order</th>
		<th>Customer</th>
		<th>No Telp</th>
		<th>Alamat Customer</th>
		<th>Kategori Customer</th>
		<th>Kurir</th>
		<th>Biaya Kirim</th>
		<th>Status Kirim</th>
		<th>Status Bayar</th>
		<th>Date Create</th>
		<th>Action</th>
            </tr><?php
            foreach ($pos_order_data as $pos_order)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $pos_order->invoice ?></td>
			<td><?php echo $pos_order->tanggal_order ?></td>
			<td><?php echo $pos_order->produk ?></td>
			<td><?php echo $pos_order->sku ?></td>
			<td><?php echo $pos_order->varian ?></td>
			<td><?php echo $pos_order->sales ?></td>
			<td><?php echo $pos_order->qty ?></td>
			<td><?php echo $pos_order->total_order ?></td>
			<td><?php echo $pos_order->customer ?></td>
			<td><?php echo $pos_order->no_telp ?></td>
			<td><?php echo $pos_order->alamat_customer ?></td>
			<td><?php echo $pos_order->kategori_customer ?></td>
			<td><?php echo $pos_order->kurir ?></td>
			<td><?php echo $pos_order->biaya_kirim ?></td>
			<td><?php echo $pos_order->status_kirim ?></td>
			<td><?php echo $pos_order->status_bayar ?></td>
			<td><?php echo $pos_order->date_create ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('pos_order/update/'.$pos_order->id),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('pos_order/delete/'.$pos_order->id),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        </div>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    
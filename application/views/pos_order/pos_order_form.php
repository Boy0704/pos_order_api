
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Invoice <?php echo form_error('invoice') ?></label>
            <input type="text" class="form-control" name="invoice" id="invoice" placeholder="Invoice" value="<?php echo $invoice; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Tanggal Order <?php echo form_error('tanggal_order') ?></label>
            <input type="date" class="form-control" name="tanggal_order" id="tanggal_order" placeholder="Tanggal Order" value="<?php echo $tanggal_order; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Produk <?php echo form_error('produk') ?></label>
            <input type="text" class="form-control" name="produk" id="produk" placeholder="Produk" value="<?php echo $produk; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sku <?php echo form_error('sku') ?></label>
            <input type="text" class="form-control" name="sku" id="sku" placeholder="Sku" value="<?php echo $sku; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Varian <?php echo form_error('varian') ?></label>
            <input type="text" class="form-control" name="varian" id="varian" placeholder="Varian" value="<?php echo $varian; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Sales <?php echo form_error('sales') ?></label>
            <input type="text" class="form-control" name="sales" id="sales" placeholder="Sales" value="<?php echo $sales; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Qty <?php echo form_error('qty') ?></label>
            <input type="text" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Total Order <?php echo form_error('total_order') ?></label>
            <input type="text" class="form-control" name="total_order" id="total_order" placeholder="Total Order" value="<?php echo $total_order; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Customer <?php echo form_error('customer') ?></label>
            <input type="text" class="form-control" name="customer" id="customer" placeholder="Customer" value="<?php echo $customer; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_customer">Alamat Customer <?php echo form_error('alamat_customer') ?></label>
            <textarea class="form-control" rows="3" name="alamat_customer" id="alamat_customer" placeholder="Alamat Customer"><?php echo $alamat_customer; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Kategori Customer <?php echo form_error('kategori_customer') ?></label>
            <input type="text" class="form-control" name="kategori_customer" id="kategori_customer" placeholder="Kategori Customer" value="<?php echo $kategori_customer; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kurir <?php echo form_error('kurir') ?></label>
            <input type="text" class="form-control" name="kurir" id="kurir" placeholder="Kurir" value="<?php echo $kurir; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Biaya Kirim <?php echo form_error('biaya_kirim') ?></label>
            <input type="text" class="form-control" name="biaya_kirim" id="biaya_kirim" placeholder="Biaya Kirim" value="<?php echo $biaya_kirim; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status Kirim <?php echo form_error('status_kirim') ?></label>
            <input type="text" class="form-control" name="status_kirim" id="status_kirim" placeholder="Status Kirim" value="<?php echo $status_kirim; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Status Bayar <?php echo form_error('status_bayar') ?></label>
            <!-- <input type="text" class="form-control" name="status_bayar" id="status_bayar" placeholder="Status Bayar" value="<?php echo $status_bayar; ?>" /> -->
            <select name="status_bayar" class="form-control">
                <option value="<?php echo $status_bayar ?>"><?php echo $status_bayar ?></option>
                <option value="Paid">Paid</option>
                <option value="Unpaid">Unpaid</option>
            </select>
        </div>
	    <div class="form-group" style="display: none;">
            <label for="datetime">Date Create <?php echo form_error('date_create') ?></label>
            <input type="text" class="form-control" name="date_create" id="date_create" placeholder="Date Create" value="<?php echo get_waktu(); ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pos_order') ?>" class="btn btn-default">Cancel</a>
	</form>
   
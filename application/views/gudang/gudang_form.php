
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Gudang <?php echo form_error('nama_gudang') ?></label>
            <input type="text" class="form-control" name="nama_gudang" id="nama_gudang" placeholder="Nama Gudang" value="<?php echo $nama_gudang; ?>" />
        </div>
	    <input type="hidden" name="id_gudang" value="<?php echo $id_gudang; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('gudang') ?>" class="btn btn-default">Cancel</a>
	</form>
   
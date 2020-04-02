
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kabupaten <?php echo form_error('kabupaten') ?></label>
            <input type="text" class="form-control" name="kabupaten" id="kabupaten" placeholder="Kabupaten" value="<?php echo $kabupaten; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Provinsi <?php echo form_error('id_provinsi') ?></label>
            <input type="text" class="form-control" name="id_provinsi" id="id_provinsi" placeholder="Id Provinsi" value="<?php echo $id_provinsi; ?>" />
        </div>
	    <input type="hidden" name="id_kabupaten" value="<?php echo $id_kabupaten; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kabupaten') ?>" class="btn btn-default">Cancel</a>
	</form>
   
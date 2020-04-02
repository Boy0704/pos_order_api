
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Provinsi <?php echo form_error('provinsi') ?></label>
            <input type="text" class="form-control" name="provinsi" id="provinsi" placeholder="Provinsi" value="<?php echo $provinsi; ?>" />
        </div>
	    <input type="hidden" name="id_provinsi" value="<?php echo $id_provinsi; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('provinsi') ?>" class="btn btn-default">Cancel</a>
	</form>
   
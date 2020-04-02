<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
		  <div class="panel-heading">Pilih Provinsi</div>
		  <div class="panel-body">
		  	<form action="">
		  	<select name="provinsi" class="form-control select2">
		  		<option value=""><?php echo $retVal = ($_GET) ? get_data('provinsi','id_provinsi',$_GET['provinsi'],'provinsi') : '--Pilih Provinsi--' ; ?></option>
		  		<?php 
		  		foreach ($this->db->get('provinsi')->result() as $rw) {
		  		 ?>
		  		<option value="<?php echo $rw->id_provinsi ?>"><?php echo $rw->provinsi ?></option>

		  		<?php } ?>
		  	</select>
		  	<br><br>
		  	<button type="submit" class="btn btn-success">Pilih</button>

		  	</form>
		  </div>
		</div>

		<?php
		$cheked = '';
		 if (isset($_GET['provinsi'])): ?>
			<div class="panel panel-info">
			  <div class="panel-heading">Pilih Kabupaten / Kota (<b><?php echo get_data('provinsi','id_provinsi',$_GET['provinsi'],'provinsi') ?></b>)</div>
			  <div class="panel-body">
			  	<?php 
			  	foreach ($kab->result() as $row) {
			  		$status = $this->db->get_where('wilayah', array('id_kabupaten'=>$row->id_kabupaten,'id_gudang'=>$this->uri->segment(3)))->row()->aktif;
			  		if ($status == 'ya') {
			  			$cheked = 'checked';
			  		} else {
			  			$cheked = '';
			  		}
			  	 ?>
			  	<div class="col-md-4">
			  		<input type="checkbox" name="kabupaten" id="kab_<?php echo $row->id_kabupaten ?>" onclick="update_wilayah('<?php echo $row->id_kabupaten ?>',<?php echo $this->uri->segment(3) ?>,'<?php echo $status ?>')" value="<?php echo $row->id_kabupaten ?>" <?php echo $cheked ?>> <?php echo $row->kabupaten ?>
			  	</div>
			  	<?php } ?>
			  </div>
			</div>
		<?php endif ?>


	</div>
</div>

<script type="text/javascript">
	function update_wilayah(id_kab,id_gudang,status) {
		$.ajax({
			url: 'app/update_wilayah/'+id_kab+'/'+id_gudang+'/'+status,
			type: 'GET',
			dataType: 'JSON',
			beforeSend: function() {
					swal({ title: "Mohon tunggu!", text: "", type: "info", showConfirmButton: false, allowEscapeKey: false });
				},
		})
		.done(function(a) {
			console.log("success");
			swal.close();
			window.location.reload();
			
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>
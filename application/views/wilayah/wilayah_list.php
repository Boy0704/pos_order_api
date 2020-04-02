<div class="row">
	<div class="col-md-12">
		<!-- <a href="app/add_wilayah" class="btn btn-primary">Add Wilayah</a> -->
	</div>

	<div class="col-md-12">
		<table class="table table-bordered" id="example1">
			<thead>
				<tr>
					<th width="30">No.</th>
					<th>Gudang</th>
					<th width="100">Option</th>
				</tr>
			</thead>
			<tbody>
				<?php 
				$no=1;
				foreach ($this->db->get('gudang')->result() as $rw) {
				 ?>
				 <tr>
				 	<td><?php echo $no; ?></td>
				 	<td><?php echo $rw->nama_gudang ?></td>
				 	<td>
				 		<a href="app/add_wilayah/<?php echo $rw->id_gudang ?>" class="label label-info">Add Wilayah</a>

				 	</td>
				 </tr>

				<?php $no++; } ?>
			</tbody>
		</table>
	</div>
</div>
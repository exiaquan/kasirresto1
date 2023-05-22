<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="col-md-12">
					<a class="btn btn-default" href="<?php echo base_url();?>main/masterdata/satuan/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_satuan">
							<thead>
								<tr>
									<th class="text-uppercase text-center">Kode</th>
									<th class="text-uppercase text-center">Satuan</th>
									<th class="text-uppercase text-center" style="width:50px;">#</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($satuan as $s):?>
									<tr>
										<td class="text-center"><?php echo $s->kode;?></td>
										<td class="text-center">
											<?php echo $s->nama;?>
										</td>
										<td class="text-center">
											<a class="btn btn-danger" href="./satuan/hapusData?id=<?php echo $s->id;?>"><i class="fa fa-trash"></i></a>
										</td>
									</tr>
								<?php endforeach;?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(function(){
	$('#tbl_satuan').DataTable({
		'ordering':false
	});
});
</script>
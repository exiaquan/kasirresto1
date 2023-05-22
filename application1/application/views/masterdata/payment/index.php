<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				<div class="col-md-12">
					<a class="btn btn-default" href="<?php echo base_url();?>main/masterdata/payment/tambah">Tambah</a>
				</div>
				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<table class="table table-bordered" id="tbl_payment">
							<thead>
								<tr>
									<th class="text-uppercase text-center">Nomor</th>
									<th class="text-uppercase text-center">Method</th>
									<th class="text-uppercase text-center">Gambar</th>
									<th class="text-center">#</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($payment as $p):?>
								<tr>
									<td class="text-center"><?php echo $p->nomor;?></td>
									<td class="text-center"><?php echo $p->method;?></td>
									<td>
										<div class="text-center">
											<?php if($p->gambar != null):?>
											<img class="thumbnail" src="<?php echo base_url();?>assets/payment/<?php echo $p->gambar;?>" style="width:30%;" />
											<?php endif;?>
										</div>
									</td>
									<td><button class="btn btn-danger btn-sm" onclick="preHapus(<?php echo $p->id;?>);"><i class="fa fa-trash"></i></button></td>
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
	$('#tbl_payment').DataTable({
		'ordering':false
	});
});

function preHapus(id){
	var conf = confirm("Apakah anda yakin ingin menghapus ini ?");

	if(conf == true){
		var d = {id:id};
		$.ajax({
			url:'./payment/hapusdata',
			type:'POST',
			data:d,
			success:function(){
				location.reload(1);
			},error:function(xhr){
				console.log(xhr.responseText);
			}
		});
	}
}
</script>
<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<div class="col-md-12">
					<a href="<?php echo base_url();?>main/invoice/tambah" class="btn btn-default"><i class="fa fa-plus"></i> Buat</a>
				</div>

				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">				
						<table class="table table-bordered" id="tbl_invoice">
							<thead>
								<tr>
									<th class="text-center text-uppercase">Nomor Invoice</th>
									<th class="text-center text-uppercase">Tgl Invoice</th>
									<th class="text-center text-uppercase">No. Meja</th>
									<th class="text-center text-uppercase">Nama Customer</th>
									<th class="text-center text-uppercase">Total Amount</th>
									<th class="text-center text-uppercase">Status Payment</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach($invoice as $inv):?>
								<tr>
									<td class="text-center"><a href="<?php echo base_url();?>main/invoice/detailData?id=<?php echo $inv->id;?>"><?php echo $inv->nomor;?></a></td>
									<td class="text-center"><?php echo $inv->tgl_invoice;?></td>
									<td class="text-center"><?php echo $inv->no_meja;?></td>
									<td class="text-center"><?php echo $inv->nama_customer;?></td>
									<td class="text-right"><?php echo 'Rp. '.number_format($inv->total_amount,2);?></td>
									<td class="text-center">
										<?php if($inv->payment_status == 0){
											echo '<label class="label label-danger"><i class="fa fa-exclamation"></i> Belum Lunas</label>';
										}else{
											echo '<label class="label label-success"><i class="fa fa-check"></i>  Lunas</label>';
										}?>
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
$(document).ready(function(){
	$('#tbl_invoice').DataTable({
		order:[],
		ordering:false
	});
});
</script>
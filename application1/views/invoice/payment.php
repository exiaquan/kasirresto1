<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<form id="form-invoice">
					<input type="hidden" name="id_user" value="<?php echo $this->session->userdata('id_user');?>">
					<input type="hidden" name="id_invoice" value="<?php echo $invoice['id'];?>">
					<!--MEJA-->
					<div class="row">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">No. Meja</label>
							</div>
							<div class="col-md-9">
								<p><?php echo $invoice['no_meja'];?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Nm. Customer</label>
							</div>
							<div class="col-md-9">
								<p><?php echo $invoice['nama_customer'];?></p>
							</div>
						</div>
					</div>
					<!--MEJA-->
					<!--Pelayanan-->
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Nm. Pelayan</label>
							</div>
							<div class="col-md-9">
								<p><?php echo $invoice['nama_pelayan'];?></p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Catatan</label>
							</div>
							<div class="col-md-9">
								<p><?php echo nl2br($invoice['catatan']);?></p>
							</div>
						</div>
					</div>
					<!--Pelayanan-->
					<!--ITEM-->
					<div class="row" style="margin-top:10px;">
						<div class="col-md-12"> TGL INVOICE: <?php if($invoice['tgl_invoice'] != NULL){echo date('d-m-Y H:i:s',strtotime($invoice['tgl_invoice']));}?></div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-12">
							<div class="table-responsive">
								<table class="table table-bordered" id="tbl_listproduk">
									<thead>
										<tr>
											<th class="text-center text-uppercase">NO</th>
											<th class="text-center text-uppercase">Kode Produk</th>
											<th class="text-center text-uppercase">Nama Produk</th>
											<th class="text-center text-uppercase">Jumlah</th>
											<th class="text-center text-uppercase">Satuan</th>
											<th class="text-center text-uppercase">Harga</th>
											<th class="text-center text-uppercase" >Sub total</th>
										</tr>
									</thead>
									<tbody>
										<?php $no=1;foreach($d_invoice as $d):?>
										<tr>
											<td class="text-center">
												<p><?php echo $no;?></p>
											</td>
											<td class="text-center text-uppercase"><?php echo $d->kode_produk;?></td>
											<td class="text-center text-uppercase">
												<?php echo $d->nama_produk;?>
											</td>
											<td class="text-center text-uppercase">
												<div class="text-right">
													<?php echo $d->jumlah;?>
												</div>
											</td>
											<td class="text-center text-uppercase"><?php echo $d->satuan_produk;?></td>
											<td class="text-center text-uppercase">
												<div class="text-right">
													Rp. <?php echo number_format($d->harga,2);?>
												</div>
											</td>
											<td class="text-center text-uppercase">
												<div class="text-right">
													Rp.<?php echo number_format($d->subtotal_amount,2);?>
												</div>
											</td>
										</tr>
										<?php $no++;endforeach;?>
										<tr>
											<th colspan="6">
												<div class="pull-right">
													<label class="text-uppercase">Sub total</label>
												</div>
											</th>
											<td class="text-center text-uppercase">
												<div class="text-right">
													Rp. <?php echo number_format($invoice['sub_total'],2);?>
												</div>
											</td>
										</tr>
										<tr>
											<th colspan="6">
												<div class="pull-right">
													<label class="text-uppercase">Diskon (<?php echo $invoice['diskon_persen'];?>%)</label>
												</div>
											</th>
											<td class="text-center text-uppercase">
												<div class="text-right">
													Rp. <?php echo number_format($invoice['diskon_amount'],2);?>
												</div>
											</td>
										</tr>
										<tr>
											<th colspan="6">
												<div class="pull-right">
													<label class="text-uppercase">Grand total</label>
												</div>
											</th>
											<td class="text-center text-uppercase">
												<div class="text-right">
													Rp. <?php echo number_format($invoice['total_amount'],2);?>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<!--ITEM-->

					<div class="row" style="margin-top:10px;">
						<div class="col-md-12">
							<hr>
						</div>
					</div>

					<!--PAYMENT-->
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Payment</label>
							</div>
							<div class="col-md-9">
								<select class="form-control select2-container" name="payment_id" onchange="paymentMethod();">
									<?php
									$p_id = ''; 
									if($invoice['payment_id'] != null){
										$p_id = $invoice['payment_id'];
										echo '<option value="'.$invoice['payment_id'].'">'.$invoice['payment_id'].' | '.$invoice['payment_no'].' | '.$invoice['payment_method'].'</option>';
									}
									?>
									<?php foreach($payment as $p):?>
										<?php if($p->id != $p_id):?>
											<option value="<?php echo $p->id;?>"><?php echo $p->id;?> | <?php echo $p->nomor;?> | <?php echo $p->method;?></option>
										<?php endif;?>
									<?php endforeach;?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Method</label>
							</div>
							<div class="col-md-9" id="payment_method">
								<?php echo $invoice['payment_method'];?>
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Total Amount</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="amount" value="<?php echo $invoice['total_amount'];?>" readonly>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Pay Amount</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="payment_amount" value="<?php echo $invoice['payment_amount'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" onchange="hitKembalian();">
							</div>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Pay Status</label>
							</div>
							<div class="col-md-9">
								<select class="form-control select2-container" name="payment_status">
									<?php if($invoice['payment_status'] == 0){
										echo '<option value="0">Belum Lunas</option>';
										echo '<option value="1">Lunas</option>';
									}else{
										echo '<option value="1">Lunas</option>';
										echo '<option value="0">Belum Lunas</option>';
									}?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Kembalian</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="kembalian" value="<?php echo $invoice['payment_kembalian'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" readonly>
							</div>
						</div>
					</div>
					<!--PAYMENT-->

					<div class="row" style="margin-top:20px;">
						<div class="col-md-12">
							<div class="text-center">
								<button type="button" class="btn btn-default" onclick="history.go(-1);">Kembali</button>
								<button class="btn btn-success" type="submit" <?php if($invoice['payment_status'] == 1){echo 'disabled';}?>><span id="icon_save"></span> Payment</button>
								<?php if($invoice['payment_status'] == 1):?>
								<!-- <button type="button" class="btn btn-default" onclick="printInv(<?php echo $invoice['id'];?>);"><i class="fa fa-print"></i> Print</button> -->
								<a href="<?php echo base_url();?>main/invoice/printinvoice?id=<?php echo $invoice['id'];?>" class="btn btn-default" target="_blank"><i class="fa fa-print"></i> Print</a>
								<?php endif;?>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function paymentMethod(){
	var d = {id:$('select[name="payment_id"]').val()};
	$.ajax({
		url:'./paymentMethod',
		type:'POST',
		data:d,
		success:function(data){
			$('#payment_method').html(data);
		},error:function(xhr){
			$('#payment_method').html(xhr.responseText);
		}
	});
}

function hitKembalian(){
	var amount = parseFloat($('input[name="amount"]').val());
	var pay_amount = parseFloat($('input[name="payment_amount"]').val());
	var kembalian = pay_amount-amount;
	$('input[name="kembalian"]').val(kembalian);
}

function submitForm(){
	$.ajax({
		url:'./paymentInvoicePay',
		type:'POST',
		data:$('#form-invoice').serialize(),
		// contentType: false,
  //       processData: false,
		dataType:'JSON',
		beforeSend:function(){
			$('#icon_save').html('<i class="fa fa-spinner fa-spin"></i>');
		},
		success:function(result){
			//console.log(result);
			if(result.code == 0){
				$('#icon_save').html('<i class="fa fa-check"></i>');
				setTimeout(function(){
					location.reload(1);
				},3000);
			}else{
				$('#icon_save').html('<i class="fa fa-exclamation"></i>');
				alert(result.message);
			}
		},
		error:function(xhr){
			$('#icon_save').html('<i class="fa fa-exclamation"></i>');
			alert(xhr.responseText);
			console.log(xhr.responseText);
		}
	});
}

$('#form-invoice').submit(function(e){
	e.preventDefault();
	var conf = confirm('Apakah anda yakin ingin menyimpan payment invoice ini ?');
	if(conf == true){
		submitForm();
	}
});

$(document).ready(function(){
	$('#icon_save').html('<i class="fa fa-money"></i>');
});
</script>
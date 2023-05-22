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
								<input type="text" class="form-control" name="no_meja" value="<?php echo $invoice['no_meja'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Nm. Customer</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nama_customer" value="<?php echo $invoice['nama_customer'];?>">
							</div>
						</div>
					</div>
					<!--MEJA-->
					<!--ITEM-->
					<div class="row" style="margin-top:10px;">
						<div class="col-md-12"> TGL INVOICE: <?php if($invoice['tgl_invoice'] != NULL){echo date('d-m-Y H:i:s',strtotime($invoice['tgl_invoice']));}?></div>
						<div class="col-md-12">
							<hr>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-12">
							<div class="table-responsive" id="list_produk"></div>
						</div>
					</div>
					<!--ITEM-->

					<!--Pelayanan-->
					<div class="row" style="margin-top:10px;">
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase">Nm. Pelayan</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="form-control" name="nama_pelayan" value="<?php echo $invoice['nama_pelayan'];?>">
							</div>
						</div>
						<div class="col-md-6">
							<div class="col-md-3">
								<label class="text-uppercase text-center">Catatan</label>
							</div>
							<div class="col-md-9">
								<textarea class="form-control" name="catatan" style="height:150px;resize:none;"><?php echo $invoice['catatan'];?></textarea>
							</div>
						</div>
					</div>
					<!--Pelayanan-->

					<div class="row" style="margin-top:10px;">
						<div class="col-md-12">
							<div class="text-center">
								<button type="button" class="btn btn-default" onclick="history.go(-1);">Kembali</button>
								<button class="btn btn-primary" type="submit"><span id="icon_save"></span> Simpan</button>
								<a class="btn btn-success" href="<?php echo base_url();?>main/invoice/paymentinvoice?id=<?php echo $invoice['id'];?>">Payment</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function listProduk(){
	var d = {
		id_invoice:$('input[name="id_invoice"]').val()
	};

	$.ajax({
		url:'./listProdukDetail',
		type:'POST',
		data:d,
		beforeSend:function(){
			$('#list_produk').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Sedang memuat...</div>');
		},success:function(data){
			$('#list_produk').html(data);
		},error:function(xhr){
			$('#list_produk').html(xhr.responseText);
		}
	});
}

function submitForm(){
	var formdata = new FormData($('#form-invoice')[0]);

	// Produk
	var tmp = [];
	var a = 0;
	$('.cb_produk').each(function(index){
		if($('.cb_produk').is(':checked')){
			//console.log('Index : '+index);
			if($('.qty_produk').eq(index).val() > 0){
				tmp[a] = {
					id_produk:$('.cb_produk').eq(index).val(),
					qty_produk:$('.qty_produk').eq(index).val(),
					harga_produk:$('.harga_produk').eq(index).val(),
					subtotal_produk:$('.subtotal_produk').eq(index).val()
				};
				a++;
			}
		}
	});
	//console.log(tmp);

	// Form data
	formdata.append('no_meja',$('input[name="no_meja"]').val());
	formdata.append('nm_customer',$('input[name="nama_customer"]').val());
	formdata.append('list_produk',JSON.stringify(tmp));
	formdata.append('sub_total',$('input[name="subttl_produk"]').val());
	formdata.append('diskon_persen',$('input[name="diskon_persen"]').val());
	formdata.append('diskon_amount',$('input[name="diskon_amount"]').val());
	formdata.append('grand_total',$('input[name="grandtotal_produk"]').val());
	formdata.append('nm_pelayan',$('input[name="nama_pelayan"]').val());
	formdata.append('catatan',$('textarea[name="catatan"]').val());
	formdata.append('id_user',$('input[name="id_user"]').val());
	formdata.append('id_invoice',$('input[name="id_invoice"]').val());
	
	$.ajax({
		url:'./saveDataDetail',
		type:'POST',
		data:formdata,
		contentType: false,
        processData: false,
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
	var conf = confirm('Apakah anda yakin ingin menyimpan invoice ini ?');
	if(conf == true){
		submitForm();
	}
});

$(document).ready(function(){

	listProduk();
	$('#icon_save').html('<i class="fa fa-save"></i>');

});
</script>
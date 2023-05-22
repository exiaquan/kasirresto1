<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header">
				<h4 class="box-title"></h4>
			</div>
			<div class="box-body">
				<div class="row">
					<div class="col-md-12">
						<div id="alert-produk"></div>
					</div>
				</div>
				<form id="form-produk" method="POST" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-2">
							<label class="text-uppercase">Foto Produk</label>
						</div>
						<div class="col-md-10">
							<input type="file" class="form-control" name="foto_produk">
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Kode Produk</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" name="kode_produk" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Nama Produk</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nama_produk" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Jumlah dan Satuan</label>
						</div>
						<div class="col-xs-5">
							<input type="text" class="form-control" name="jumlah" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" required>
						</div>
						<div class="col-xs-3">
							<select class="form-control" name="satuan_produk">
								<?php foreach($satuan as $s):?>
									<option><?php echo $s->nama;?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Harga</label>
						</div>
						<div class="col-xs-3">
							<input type="text" class="form-control" name="mata_uang" value="Rp" readonly>
						</div>
						<div class="col-xs-5">
							<input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="harga" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Kategori Produk</label>
						</div>
						<div class="col-md-5">
							<select class="form-control" name="kategori_produk" required>
								<option value="">(Pilih Kategori)</option>
								<?php foreach($kategori as $k):?>
									<option><?php echo $k->nama;?></option>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:20px;">
						<div class="col-md-12">
							<div class="text-center">
								<a class="btn btn-default" href="<?php echo base_url();?>main/product">Kembali</a>
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$("form#form-produk").submit(function(e) {
    e.preventDefault();    

    var conf = confirm("Apakah anda yakin ingin menyimpan ini ?");

    if(conf == true){
    	var formData = new FormData(this);

	    $.ajax({
	        url: './savedata',
	        type: 'POST',
	        data: formData,
	        cache: false,
	        contentType: false,
	        processData: false,
	        beforeSend:function(){
	        	$('#alert-produk').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Menyimpan data...</div>');
	        },
	        success: function (data) {

	          	$('#alert-produk').html(data);
	          	 
	        },
	        error:function(xhr){
	        	$('#alert-produk').html(xhr.responseText);
	        }
	    });
    }
});
</script>
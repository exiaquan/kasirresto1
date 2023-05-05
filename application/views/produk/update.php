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
					<input type="hidden" name="id_produk" value="<?php echo $produk['id'];?>">
					<div class="row">
						<div class="col-md-2">
							<label class="text-uppercase">Foto Produk</label>
						</div>
						<div class="col-md-10">
							<?php if($produk['foto_produk'] != null):?>
								<img src="<?php echo base_url();?>assets/foto_produk/<?php echo $produk['foto_produk'];?>" style="width:50%;">
							<?php endif;?>
							<input type="file" class="form-control" name="foto_produk">
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Kode Produk</label>
						</div>
						<div class="col-md-3">
							<input type="text" class="form-control" name="kode_produk" value="<?php echo $produk['kode'];?>" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Nama Produk</label>
						</div>
						<div class="col-md-10">
							<input type="text" class="form-control" name="nama_produk" value="<?php echo $produk['nama'];?>" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Jumlah dan Satuan</label>
						</div>
						<div class="col-xs-5">
							<input type="text" class="form-control" name="jumlah" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" value="<?php echo $produk['jumlah']?>" required>
						</div>
						<div class="col-xs-3">
							<select class="form-control" name="satuan_produk">
								<option><?php echo $produk['satuan'];?></option>
								<?php foreach($satuan as $s):?>
									<?php if($s->nama != $produk['satuan']):?>
										<option><?php echo $s->nama;?></option>
									<?php endif;?>
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
							<input type="text" class="form-control" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" name="harga" value="<?php echo $produk['harga'];?>" required>
						</div>
					</div>
					<div class="row" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Kategori Produk</label>
						</div>
						<div class="col-md-5">
							<select class="form-control" name="kategori_produk" required>
								<option><?php echo $produk['katagori'];?></option>
								<?php foreach($kategori as $k):?>
									<?php if($k->katagori != $produk['katagori']):?>
										<option><?php echo $k->nama;?></option>
									<?php endif;?>
								<?php endforeach;?>
							</select>
						</div>
					</div>
					<div class="row" style="margin-top:20px;">
						<div class="col-md-12">
							<div class="text-center">
								<a class="btn btn-default" href="<?php echo base_url();?>main/product">Kembali</a>
								<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
								<button type="button" class="btn btn-danger" onclick="hapusData();"><i class="fa fa-trash"></i> Hapus</button>
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
	        url: './updatedata',
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
	          	// setTimeout(function(){
	          	// 	location.reload(1);
	          	// },3000); 
	        },
	        error:function(xhr){
	        	$('#alert-produk').html(xhr.responseText);
	        }
	    });
    }
});

function hapusData(){
	var conf = confirm("Apakah anda yakin ingin menghapus ini ?");

	if(conf == true){
		var d = {id_produk:$('input[name="id_produk"]').val()};

		$.ajax({
			url:'./hapusdata',
			type:'POST',
			data:d,
			beforeSend:function(){
	        	$('#alert-produk').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Menghapus data...</div>');
	        },
	        success: function (data) {
	          	$('#alert-produk').html(data);
	          	setTimeout(function(){
	          		location.href="<?php echo base_url();?>main/product";
	          	},3000); 
	        },
	        error:function(xhr){
	        	$('#alert-produk').html(xhr.responseText);
	        }
		});
	}
}
</script>
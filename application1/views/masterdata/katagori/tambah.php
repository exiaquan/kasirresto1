<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-body">
				<form action="./savedata" method="POST">
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Kode</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" name="kode" value="<?php echo $kode;?>" required>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Nama</label>
						</div>
						<div class="col-md-6">
							<input type="text" class="form-control" name="nama" required>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
						</div>	
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
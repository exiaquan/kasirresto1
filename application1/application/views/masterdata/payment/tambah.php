<div class="row">
	<div class="col-md-12">
		<div class="box box-primary">
			<div class="box-header"></div>
			<div class="box-body">
				
				<div class="col-md-12">
					<div id="alert-payment"></div>
				</div>

				<form id="form-payment">
					<div class="col-md-12">
						<div class="col-md-2">
							<label class="text-uppercase">Method</label>
						</div>
						<div class="col-md-8">
							<input type="text" class="form-control" name="method">
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Notes</label>
						</div>
						<div class="col-md-8">
							<textarea class="form-control" name="notes" style="height:200px;resize:none;"></textarea>
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="col-md-2">
							<label class="text-uppercase">Gambar (QR Code)</label>
						</div>
						<div class="col-md-8">
							<input type="file" class="form-control" name="gambar">
						</div>
					</div>
					<div class="col-md-12" style="margin-top:10px;">
						<div class="text-center">
							<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Simpan</button>
						</div>
					</div>
				</form>
			
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$('form#form-payment').submit(function(e){
	e.preventDefault();
	var formData = new FormData(this);

	$.ajax({
        url: './savedata',
        type: 'POST',
        data: formData,
        beforeSend:function(){
        	$('#alert-payment').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Saving data</div>');
        },
        success:function(data) {
            // alert(data)
            $('#alert-payment').html(data);
        },
        error:function(xhr){
        	$('#alert-payment').html(xhr.responseText);
        },
        cache: false,
        contentType: false,
        processData: false
    });
});
</script>
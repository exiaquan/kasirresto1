<div class="row">
	<div class="col-md-12">
		
		<div class="box box-primary">
			<div class="box-body">
				
				<div class="col-md-12">
					<div class="col-md-1">
						<label class="text-uppercase">Tanggal</label>
					</div>
					<div class="col-md-3">
						<!-- <select class="form-control" id="tahun">
						<?php foreach($thnInv as $thn):?>
							<option><?php echo $thn->thn;?></option>
						<?php endforeach;?>
						</select> -->

						<input type="text" class="form-control datepicker" id="tahun">
						
					</div>
					<div class="col-md-3">
						<input type="text" class="form-control datepicker" id="tahun1">
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-primary" onclick="loadTemp();"><i class="fa fa-search"></i> Proses</button>
						<button type="button" class="btn btn-default" onclick="printData('temp');"><i class="fa fa-print"></i> Print</button>
					</div>
				</div>

				<div class="col-md-12" style="margin-top:10px;">
					<hr>
				</div>

				<div class="col-md-12" style="margin-top:10px;">
					<div class="table-responsive">
						<div id="temp"></div>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	loadTemp();
});

function loadTemp(){
	var d = {
		tahun:$('#tahun').val(),
		tahun1:$('#tahun1').val()
	};

	$.ajax({
		url:'../report/reportinvtemp',
		type:'POST',
		data:d,
		beforeSend:function(){
			$('#temp').html('<div class="text-primary"><i class="fa fa-spinner fa-spin"></i> Memuat data...</div>');
		},success:function(data){
			$('#temp').html(data);
		},error:function(xhr){
			$('#temp').html(xhr.responseText);
		}
	});
}

function printData(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;

	 location.reload(1);
}
</script>
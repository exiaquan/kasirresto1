<table class="table table-bordered" id="tbl_listproduk">
	<thead>
		<tr>
			<th class="text-center text-uppercase">#</th>
			<th class="text-center text-uppercase">Kode Produk</th>
			<th class="text-center text-uppercase">Nama Produk</th>
			<th class="text-center text-uppercase">Jumlah</th>
			<th class="text-center text-uppercase">Satuan</th>
			<th class="text-center text-uppercase">Harga</th>
			<th class="text-center text-uppercase" >Sub total</th>
		</tr>
	</thead>
	<?php
		$invoice = $crud->getDataWhere('invoice',array('id'=>$id_invoice))->row_array();

		$sql_list = '
			SELECT *
			FROM produk a
			WHERE a.jumlah > 0
			ORDER BY a.katagori ASC
		';

		$q_list = $crud->getDataQuery($sql_list)->result();
	?>
	<tbody>
	<?php $c=0;foreach($listkatagori as $lk):?>
		<tr>
			<th colspan="7" class="text-uppercase"><?php echo $lk->kategoriproduk;?></th>
		</tr>
		<?php 
			$sql_produk = '
				SELECT *
				FROM produk a
				WHERE a.katagori = "'.$lk->kategoriproduk.'"
				ORDER BY a.nama ASC
			';
			$q_produk = $crud->getDataQuery($sql_produk)->result();
		?>
		<?php foreach($q_produk as $qp):
		// Cek Invoice
		$cek_d_invoice = $crud->getDataWhere('d_invoice',array('id_invoice'=>$id_invoice,'id_produk'=>$qp->id));
		?>

		<?php if($cek_d_invoice->num_rows() > 0):
			$d_invoice = $cek_d_invoice->row_array();
		?>
			<tr>
				<td class="text-center">
					<input type="checkbox" class="cb_produk" value="<?php echo $qp->id;?>" onchange="cbProduk(<?php echo $c;?>);" checked>
				</td>
				<td class="text-center text-uppercase"><?php echo $qp->kode;?></td>
				<td class="text-center text-uppercase">
					<?php echo $qp->nama;?>
					<input type="hidden" class="nama_produk" value="<?php echo $qp->nama;?>">
				</td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control qty_produk" name="qty_produk" placeholder="Max : <?php echo $qp->jumlah+$d_invoice['jumlah'].' '.$qp->satuan;?>" max="<?php echo $qp->jumlah+$d_invoice['jumlah'];?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="width:120px;" onchange="checkQty(<?php echo $c;?>);" value="<?php echo $d_invoice['jumlah'];?>">
						<small class="label_max_qty"></small>
					</center>
				</td>
				<td class="text-center text-uppercase"><?php echo $qp->satuan;?></td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control harga_produk" value="<?php echo $qp->harga;?>" style="width:120px;text-align: right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" onchange="hitSubtot(<?php echo $c;?>);" value="<?php echo $d_invoice['harga'];?>">
					</center>
				</td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control subtotal_produk" style="width:120px;text-align: right;" value="<?php echo $d_invoice['subtotal_amount'];?>" readonly>
					</center>
				</td>
			</tr>
		<?php else:?>
			<tr>
				<td class="text-center">
					<input type="checkbox" class="cb_produk" value="<?php echo $qp->id;?>" onchange="cbProduk(<?php echo $c;?>);">
				</td>
				<td class="text-center text-uppercase"><?php echo $qp->kode;?></td>
				<td class="text-center text-uppercase">
					<?php echo $qp->nama;?>
					<input type="hidden" class="nama_produk" value="<?php echo $qp->nama;?>">
				</td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control qty_produk" name="qty_produk" placeholder="Max : <?php echo $qp->jumlah.' '.$qp->satuan;?>" max="<?php echo $qp->jumlah;?>" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" style="width:120px;" onchange="checkQty(<?php echo $c;?>);" readonly>
						<small class="label_max_qty"></small>
					</center>
				</td>
				<td class="text-center text-uppercase"><?php echo $qp->satuan;?></td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control harga_produk" value="<?php echo $qp->harga;?>" style="width:120px;text-align: right;" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1');" onchange="hitSubtot(<?php echo $c;?>);" readonly>
					</center>
				</td>
				<td class="text-center text-uppercase">
					<center>
						<input type="text" class="form-control subtotal_produk" value="0" style="width:120px;text-align: right;" readonly>
					</center>
				</td>
			</tr>
		<?php endif;?>

		<?php $c++;endforeach;?>
	<?php endforeach;?>
	<tr>
		<th colspan="6">
			<div class="pull-right">
				<label class="text-uppercase">Sub total</label>
			</div>
		</th>
		<td class="text-center text-uppercase">
			<center>
				<input type="text" class="form-control" name="subttl_produk" value="<?php echo $invoice['sub_total'];?>" style="width:120px;text-align: right;" readonly>
			</center>
		</td>
	</tr>
	<tr>
		<th colspan="5">
			<div class="pull-right">
				<label class="text-uppercase">Diskon (%)</label>
			</div>
		</th>
		<td class="text-uppercase">
			<input type="number" class="form-control" name="diskon_persen" value="<?php echo $invoice['diskon_persen'];?>" min="0" max="100" style="text-align: right;" onchange="hitDiskon();">
		</td>
		<td class="text-center text-uppercase">
			<center>
				<input type="text" class="form-control" name="diskon_amount" value="<?php echo $invoice['diskon_amount'];?>" style="width:120px;text-align: right;" readonly>
			</center>
		</td>
	</tr>
	<tr>
		<th colspan="6">
			<div class="pull-right">
				<label class="text-uppercase">Grand total</label>
			</div>
		</th>
		<td class="text-center text-uppercase">
			<center>
				<input type="text" class="form-control" name="grandtotal_produk" value="<?php echo $invoice['total_amount'];?>" style="width:120px;text-align: right;" readonly>
			</center>
		</td>
	</tr>
	</tbody>
</table>

<script type="text/javascript">
function cbProduk(c){
	var cb = $('.cb_produk').eq(c);
	if(cb.is(':checked')){
		$('.qty_produk').eq(c).prop('readonly',false);
		$('.harga_produk').eq(c).prop('readonly',false);
		$('.label_max_qty').eq(c).html('');
	}else{
		$('.qty_produk').eq(c).prop('readonly',true);
		$('.harga_produk').eq(c).prop('readonly',true);
		$('.qty_produk').eq(c).val('');
		$('.subtotal_produk').eq(c).val(0);
		$('.label_max_qty').eq(c).html('');
	}
	hitGrandtot();
}

function checkQty(c){
	var qty = parseFloat($('.qty_produk').eq(c).val());
	var max_qty = parseFloat($('.qty_produk').eq(c).attr('max'));

	if(qty > max_qty){
		$('.qty_produk').eq(c).val('');
		$('.label_max_qty').eq(c).html('<div class="text-danger">Qty max '+max_qty+'</div>');
		$('.subtotal_produk').eq(c).val(0);
	}else{
		$('.label_max_qty').eq(c).html('');
		hitSubtot(c);
	}
}

function hitSubtot(c){
	var qty = parseFloat($('.qty_produk').eq(c).val());
	var harga = parseFloat($('.harga_produk').eq(c).val());
	var subtot = qty*harga;
	$('.subtotal_produk').eq(c).val(subtot);
	hitSubtotTotal();
}

function hitSubtotTotal(){
	var subtot = 0;
	$('.subtotal_produk').each(function(){
		subtot += parseFloat($(this).val());
	});
	$('input[name="subttl_produk"]').val(subtot.toFixed(2));
	hitDiskon();
}

function hitDiskon(){
	var diskon = parseFloat($('input[name="diskon_persen"]').val());
	var subtotal = parseFloat($('input[name="subttl_produk"]').val());
	var hitung = subtotal * (diskon/100);
	$('input[name="diskon_amount"]').val(hitung.toFixed(2));

	hitGrandtot();
}

function hitGrandtot(){
	var subtot = parseFloat($('input[name="subttl_produk"]').val());
	var diskon = parseFloat($('input[name="diskon_amount"]').val());
	var hitung = subtot-diskon;
	// $('.subtotal_produk').each(function(){
	// 	subtot += parseFloat($(this).val());
	// });
	$('input[name="grandtotal_produk"]').val(hitung.toFixed(2));
}
</script>
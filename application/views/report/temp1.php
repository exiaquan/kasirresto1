<table class="table table-bordered" style="font-size:12px;">
	<tr>
		<th colspan="7" class="text-uppercase text-center">REPORT INVOICE</th>
	</tr>
	<?php for($c=1;$c<=12;$c++):?>
	<tr>
		<th colspan="7" class="text-uppercase"><?php echo $crud->namaBulan($c);?></th>
	</tr>
	<?php
		$inv = $crud->reportInv($yr,$c)->result();
	?>
	<tr>
		<th class="text-uppercase">No.</th>
		<th class="text-uppercase">Kode Barang</th>
		<th class="text-uppercase">Nama Barang</th>
		<th class="text-uppercase">Qty</th>
		<th class="text-uppercase">Harga</th>
		<th class="text-uppercase">Diskon (%)</th>
		<th class="text-uppercase">Total</th>
	</tr>
	<?php 
	$no = 1;
	$total_amount = 0;
	foreach($inv as $i):?>
	<tr>
		<td><?php echo $no;?></td>
		<td class="text-uppercase"><?php echo $i->kode_produk;?></td>
		<td class="text-uppercase"><?php echo $i->nama_produk;?></td>
		<td class="text-uppercase text-right"><?php echo $i->jumlah.' '.$i->satuan_produk;?></td>
		<td class="text-uppercase text-right"><?php echo 'RP '.$i->harga;?></td>
		<td class="text-uppercase text-right"><?php echo $i->diskon;?>%</td>
		<?php
			$total = ($i->jumlah*$i->harga);
			$diskon = (($i->diskon/100)*($total));
			$subtotal = $total-$diskon;
			$total_amount += $subtotal;
		?>
		<td class="text-uppercase text-right"><?php echo 'RP '.$subtotal;?></td>
	</tr>
	<?php 
	$no++;
	endforeach;?>
	<tr>
		<th colspan="6" class="text-uppercase"></th>
		<th class="text-right text-uppercase"><?php echo 'RP '.$total_amount;?></th>
	</tr>
	<?php endfor;?>
</table>
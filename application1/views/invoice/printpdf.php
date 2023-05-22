<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title;?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-globe"></i> Invoice
          <small class="pull-right">
            <?php
              if($invoice['tgl_invoice'] != null){
                echo 'Date: '.date('d/m/Y H:i:s',strtotime($invoice['tgl_invoice']));
              }
            ?>
          </small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
        From
        <address>
          <strong><?php echo $invoice['nama_pelayan'];?></strong><br>
          Pelayan<br>
          <!-- 795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (804) 123-5432<br>
          Email: info@almasaeedstudio.com -->
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        To
        <address>
          <strong><?php echo $invoice['nama_customer'];?></strong><br>
          Meja : <?php echo $invoice['no_meja'];?><br>
          <!-- 795 Folsom Ave, Suite 600<br>
          San Francisco, CA 94107<br>
          Phone: (555) 539-1037<br>
          Email: john.doe@example.com -->
        </address>
      </div>
      <!-- /.col -->
      <div class="col-sm-4 invoice-col">
        <b>Invoice #<?php echo $invoice['nomor'];?></b><br>
        <br>
        <!-- <b>Order ID:</b> 4F3S8J<br>
        <b>Payment Due:</b> 2/22/2014<br>
        <b>Account:</b> 968-34567 -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <table class="table table-striped">
          <thead>
          <tr>
            <th class="text-uppercase text-center">No</th>
            <th class="text-uppercase text-center">Kode Produk</th>
            <th class="text-uppercase text-center">Nama Produk</th>
            <th class="text-uppercase text-center">Jumlah</th>
            <th class="text-uppercase text-center">Satuan</th>
            <th class="text-uppercase text-center">Harga<br>(Rp.)</th>
            <th class="text-uppercase text-center">Sub total<br>(Rp.)</th>
          </tr>
          </thead>
          <tbody>
          <?php $no=1;foreach($d_invoice as $d):?>
          <tr>
            <td class="text-uppercase text-center"><?php echo $no;?></td>
            <td class="text-uppercase text-center"><?php echo $d->kode_produk;?></td>
            <td class="text-uppercase text-center"><?php echo $d->nama_produk;?></td>
            <td class="text-uppercase text-right"><?php echo $d->jumlah;?></td>
            <td class="text-uppercase text-center"><?php echo $d->satuan_produk;?></td>
            <td class="text-uppercase text-right"><?php echo number_format($d->harga,2);?></td>
            <td class="text-uppercase text-right"><?php echo number_format($d->subtotal_amount,2);?></td>
          </tr>
          <?php $no++;endforeach;?>
          </tbody>
        </table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-6">
        <p class="lead">Payment Methods:</p>
        <p><?php echo $invoice['payment_method'];?></p>
        <p>
          <?php
            $payment = $crud->getDataWhere('payment',array('id'=>$invoice['payment_id']))->row_array();
          ?>
          <!-- <?php if($payment['gambar'] != null):?>
            <img src="<?php echo base_url();?>assets/payment/<?php echo $payment['gambar'];?>" style="width:25%;" alt="Visa">
          <?php endif;?> -->
        </p>
        <!-- <img src="../../dist/img/credit/visa.png" alt="Visa">
        <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
        <img src="../../dist/img/credit/american-express.png" alt="American Express">
        <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> -->

        <!-- <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
          Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr
          jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
        </p> -->
      </div>
      <!-- /.col -->
      <div class="col-xs-6">
        <!-- <p class="lead">Amount Due 2/22/2014</p> -->

        <div class="table-responsive">
          <table class="table">
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Sub Total (Rp.):</th>
              <td class="text-right"><?php echo number_format($invoice['sub_total'],2);?></td>
            </tr>
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Diskon (<?php echo $invoice['diskon_persen'];?>%):</th>
              <td class="text-right"><?php echo number_format($invoice['diskon_amount'],2);?></td>
            </tr>
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Grand Total (Rp.):</th>
              <td class="text-right"><?php echo number_format($invoice['total_amount'],2);?></td>
            </tr>
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Pembayaran (Rp.):</th>
              <td class="text-right"><?php echo number_format($invoice['payment_amount'],2);?></td>
            </tr>
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Kembalian (Rp.):</th>
              <td class="text-right"><?php echo number_format($invoice['payment_kembalian'],2);?></td>
            </tr>
            <tr>
              <th class="text-uppercase text-right" style="width:50%">Payment Notes:</th>
              <td class="text-uppercase text-right"><?php echo $invoice['payment_notes'];?></td>
            </tr>
            <tr>
              <th class="text-right text-uppercase">Status Pembayaran :</th>
              <td class="text-right text-uppercase">
                <?php
                if($invoice['payment_status'] == 1){
                  echo '<p class="text-success">LUNAS</p>';
                }else{
                  echo '<p class="">BELUM LUNAS</p>';
                }
                ?>    
              </td>
            </tr>
            <!-- <tr>
              <th>Shipping:</th>
              <td>$5.80</td>
            </tr>
            <tr>
              <th>Total:</th>
              <td>$265.24</td>
            </tr> -->
          </table>
        </div>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>

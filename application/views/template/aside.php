<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">

    <!-- Sidebar user panel (optional) -->
    <!-- <div class="user-panel">
      <div class="pull-left image">
        <img src="<?php echo base_url();?>dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Alexander Pierce</p> -->
        <!-- Status -->
        <!-- <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div> -->

    <!-- search form (Optional) -->
    <!-- <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Search...">
        <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
      </div>
    </form> -->
    <!-- /.search form -->

    <!-- Sidebar Menu -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MENU</li>
      <!-- Optionally, you can add icons to the links -->
      <li><a href="<?php echo base_url();?>main/profile"><i class="glyphicon glyphicon-user"></i> <span>Profile</span></a></li>
      <?php
      /*
        LIST HAK AKSES:
        - 01 = admin
        - 02 = user
      */
      ?>
      <?php if($this->session->userdata('hak_akses') == 01):?>
      <li class="treeview">
        <a href="#"><i class="fa fa-folder-open"></i> <span>Master Data</span>
          <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="<?php echo base_url();?>main/masterdata/satuan"><i class="fa fa-circle"></i> <span>Satuan</span></a></li>
          <li><a href="<?php echo base_url();?>main/masterdata/katagoribarang"><i class="fa fa-circle"></i> <span>Kategori</span></a></li>
          <li><a href="<?php echo base_url();?>main/masterdata/payment"><i class="fa fa-circle"></i> <span>Payment</span></a></li>
        </ul>
      </li>
      <li><a href="<?php echo base_url();?>main/product"><i class="fa fa-truck"></i> <span>Product</span></a></li>
      <?php endif;?>

      <?php if(
        $this->session->userdata('hak_akses') == 01 ||
        $this->session->userdata('hak_akses') == 02
      ):?>
      <li><a href="<?php echo base_url();?>main/invoice"><i class="fa fa-newspaper-o"></i> <span>Invoice</span></a></li>
      <?php endif;?>

      <?php if($this->session->userdata('hak_akses') == 01):?>
      <li><a href="<?php echo base_url();?>main/report/reportinv"><i class="fa fa-newspaper-o"></i> <span>Report</span></a></li>  
      <?php endif;?>
    </ul>
  <!-- /.sidebar -->
</aside>
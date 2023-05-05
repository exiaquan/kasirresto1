<?php 
$user = $crud->getDataWhere('users',array('id'=>$this->session->userdata('id_user')))->row_array();
?>
<div class="box box-primary">
	<div class="box-header">
		<h4 class="box-title">Profile Form</h4>
	</div>
	<div class="box-body">
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-12">
				<div id="alert-profile"></div>
			</div>
		</div>
		<form id="form-profile">
			<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
			<div class="row">
				<div class="col-md-2">
					<label class="text-uppercase">Nama</label>
				</div>
				<div class="col-md-8">
					<input type="text" class="form-control" name="nama" value="<?php echo $user['nama'];?>">
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-2">
					<label class="text-uppercase">Gender</label>
				</div>
				<div class="col-md-8">
					<label class="radio-inline"><input type="radio" name="gender" value="pria" <?php if($user['gender'] == 'pria'){echo 'checked';}?>>Pria</label>
					<label class="radio-inline"><input type="radio" name="gender" value="wanita" <?php if($user['gender'] == 'wanita'){echo 'checked';}?>>Wanita</label>
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-md-2">
					<label class="text-uppercase">Tanggal Lahir</label>
				</div>
				<div class="col-md-3">
					<input type="text" class="form-control datepicker" name="tgllahir" value="<?php if($user['tgllahir']!=null){echo date('d-m-Y',strtotime($user['tgllahir']));}?>" autocomplete="off">
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-md-2">
					<label class="text-uppercase">Alamat</label>
				</div>
				<div class="col-md-8">
					<textarea class="form-control" name="alamat" style="height:100px;resize:none;"><?php echo $user['alamat'];?></textarea>
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-md-2">
					<label class="text-uppercase">E-Mail</label>
				</div>
				<div class="col-md-8">
					<input type="email" class="form-control" name="email" value="<?php echo $user['email'];?>">
				</div>
			</div>
			<div class="row" style="margin-top:15px;">
				<div class="col-md-2">
					<label class="text-uppercase">No. HP / No. Telp</label>
				</div>
				<div class="col-md-5">
					<input type="text" class="form-control" name="nohp" value="<?php echo $user['nohp'];?>">
				</div>
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<div class="text-center">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Simpan</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="box box-primary">
	<div class="box-header">
		<h4 class="box-title">Ubah Password</h4>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div id="alert-password"></div>
			</div>
		</div>
		<form id="form-password">
			<input type="hidden" name="id_user" value="<?php echo $user['id'];?>">
			<div class="row">
				<div class="col-md-2">
					<label class="text-uppercase">Password Baru</label>
				</div>
				<div class="col-md-8">
					<input type="password" class="form-control" name="password">
				</div>
			</div>
			<div class="row" style="margin-top:10px;">
				<div class="col-md-2">
					<label class="text-uppercase">Konfirm Password</label>
				</div>
				<div class="col-md-8">
					<input type="password" class="form-control" name="cpassword">
				</div>
			</div>
			<div class="row" style="margin-top:20px;">
				<div class="col-md-12">
					<div class="text-center">
						<button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Ubah</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
$('#form-profile').submit(function(e){
  e.preventDefault();

  var form = $('#form-profile');
  $.ajax({
    url:'./profile/updateprofile',
    type:'POST',
    data:form.serialize(),
    beforeSend:function(){
      $('#alert-profile').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Updating data ...</div>');
    },success:function(data){
      $('#alert-profile').html(data);
    },error:function(xhr){
      $('#alert-profile').html('<div class="alert alert-danger">'+xhr.responseText+'</div>');
    }
  });
});

$('#form-password').submit(function(e){
  e.preventDefault();

  var form = $('#form-password');
  $.ajax({
    url:'./profile/updatepassword',
    type:'POST',
    data:form.serialize(),
    beforeSend:function(){
      $('#alert-password').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Updating data ...</div>');
    },success:function(data){
    	if(data == '<div class="alert alert-success">Update password berhasil</div>'){
    		$('#alert-password').html(data);
    		setTimeout(function(){
    			location.href='<?php echo base_url();?>login';
    		},3000);
    	}else{
    		$('#alert-password').html(data);
    	}
    },error:function(xhr){
      $('#alert-password').html('<div class="alert alert-danger">'+xhr.responseText+'</div>');
    }
  });
});
</script>
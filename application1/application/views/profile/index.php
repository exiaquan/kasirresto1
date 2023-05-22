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

<?php if($this->session->userdata('hak_akses') == 01):?>
<div class="box box-primary">
	<div class="box-header">
		<h1 class="box-title">User Manager</h1>
	</div>
	<div class="box-body">
		<div class="row">
			<div class="col-md-12">
				<div id="alert-user"></div>
			</div>
		</div>
		<div class="col-md-12" style="margin-top:10px;">
			<form id="form-user">
				<div class="form-group">
					<label class="text-uppercase">Email</label>
					<select class="form-control select2-container" name="user">
						<?php foreach($users as $us):?>
						<option value="<?php echo $us->id;?>"><?php echo $us->email;?> | <?php echo $us->kode;?> | <?php echo $us->nama;?></option>
						<?php endforeach;?>
					</select>
				</div>
				<div class="form-group">
					<label class="text-uppercase">Hak Akses</label>
					<select class="form-control select2-container" name="hak_akses">
						<option value="01">Admin</option>
						<option value="02">User</option>
					</select>
				</div>
				<div class="form-group">
					<label class="text-uppercase">Status</label>
					<select class="form-control select2-container" name="status">
						<option value="1">Aktif</option>
						<option value="0">Tidak Aktif</option>
					</select>
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary btn-block">Simpan</button>
				</div>
			</form>
		</div>
		<div class="col-md-12" style="margin-top:10px;">
			<div class="table-responsive">
				<table class="table table-bordered" id="tbl_user" style="font-size:12px;">
					<thead>
						<tr>
							<th class="text-uppercase text-center">Kode</th>
							<th class="text-uppercase text-center">Nama</th>
							<th class="text-uppercase text-center">Gender</th>
							<th class="text-uppercase text-center">Tgl Lahir</th>
							<th class="text-uppercase text-center">Alamat</th>
							<th class="text-uppercase text-center">E-Mail</th>
							<th class="text-uppercase text-center">no. HP</th>
							<th class="text-uppercase text-center">Pass</th>
							<th class="text-uppercase text-center">Hak Akses</th>
							<th class="text-uppercase text-center">Status</th>
							<th class="text-uppercase text-center">Tgl Buat</th>
							<th class="text-uppercase text-center">Last Login</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($users as $u):?>
						<tr>
							<td class="text-uppercase"><?php echo $u->kode;?></td>
							<td class="text-uppercase"><?php echo $u->nama;?></td>
							<td class="text-uppercase"><?php echo $u->gender;?></td>
							<td class="text-uppercase"><?php echo $u->tgllahir;?></td>
							<td class="text-uppercase"><?php echo $u->alamat;?></td>
							<td class="text-uppercase"><?php echo $u->email;?></td>
							<td class="text-uppercase"><?php echo $u->nohp;?></td>
							<td class="text-uppercase"><?php echo $this->sec_key->decrypt($u->pass);?></td>
							<td class="text-uppercase"><?php if($u->hak_akses == 01){echo '<label class="label label-primary">Admin</label>';}else{echo '<label class="label label-info">User</label>';}?></td>
							<td class="text-uppercase"><?php if($u->sts_aktif == 1){echo '<label class="label label-success">Aktif</label>';}else{echo '<label class="label label-default">Tdk Aktif</label>';}?></td>
							<td class="text-uppercase"><?php echo $u->tglbuat;?></td>
							<td class="text-uppercase"><?php echo $u->lastlogin;?></td>
						</tr>
						<?php endforeach;?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<?php endif;?>

<script type="text/javascript">
$(document).ready(function(){
	$('#tbl_user').DataTable();
});

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

$('#form-user').submit(function(e){
  e.preventDefault();

  var form = $('#form-user');
  $.ajax({
    url:'./profile/updatehakakses',
    type:'POST',
    data:form.serialize(),
    beforeSend:function(){
      $('#alert-user').html('<div class="alert alert-warning"><i class="fa fa-spinner fa-spin"></i> Updating data ...</div>');
    },success:function(data){
    	//if(data == '<div class="alert alert-success">Update hak akses berhasil</div>'){
  		$('#alert-user').html(data);
  		setTimeout(function(){
  			location.reload(1);
  		},3000);
    	// }else{
    	// 	$('#alert-user').html(data);
    	// }
    },error:function(xhr){
      $('#alert-user').html('<div class="alert alert-danger">'+xhr.responseText+'</div>');
    }
  });
});
</script>
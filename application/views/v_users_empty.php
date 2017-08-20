<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo link_tag('ci-icon.ico', 'shortcut icon', 'image/x-icon'); ?>
	<meta charset="utf-8">
	<title>TERAVIN TECHNOVATIONS</title>	
</head>
<body>
<div id="container">
	<h1>
		USER MANAGEMENT SYSTEM
	</h1>

	<div id="body" align="center">	
		<?php 
			date_default_timezone_set('Asia/Jakarta');
			$timezone = date_default_timezone_get();
			echo "The current server timezone is : " . $timezone;
			echo "<br/>";
			echo date("l jS \of F Y H:i:s", time()); 
		?>
		<br/><br/><br/>
		<h3 style="color:red;">
		THERE'S CURRENTLY NO DATA EXISTS
		<br/>
		PLEASE CREATE by CLICKING THE CREATE USER BUTTON BELOW
		</h3>
		<br/>
		<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-add" plain="true" onclick="CreateUser()">CREATE USER</a>	
		
		<div id="dlg-create" class="easyui-dialog" style="width:250px;height:300px;padding:10px 20px" closed="true" buttons="#dlg-buttons-create" modal="true">
			<form id="frm-create" method="post" novalidate>
				<div id="div-name" class="fitem">
					<label>Name : </label>
					<br />
					<input name="fullname" class="easyui-textbox" data-options="required:true, validType:['length[0,50]']" />
				</div>    
				<div id="div-phone" class="fitem">
					<label>Phone : </label>
					<br />
					<input name="phone" class="easyui-numberbox" data-options="required:true, validType:['length[10,50]']" />
				</div>  
				<div id="div-email" class="fitem">
					<label>Email : </label>
					<br />
					<input name="email" class="easyui-textbox" data-options="required:true, validType:['email']" />
				</div>  	
				<div id="div-addr-grp" class="fitem">
					<label>Address : </label>
					<br />
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="AddAddressField()"></a>
					<a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="RemoveAddressField()"></a>
					<br />
					<div id="div-addr1">
						<input id="address1" name="address[]" class="easyui-textbox" data-options="required:true" />
					</div>
				</div>  	
			</form>
		</div>			
		<div id="dlg-buttons-create">
			<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="SaveNewUser()" style="width:90px">Save</a>
			<a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-cancel" onclick="javascript:$('#dlg-create').dialog('close')" style="width:90px">Cancel</a>
		</div>
		
	</div>
	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds.</p>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/css/default.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/js/easyui/themes/default/easyui.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/js/easyui/themes/icon.css'); ?>"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('public/js/easyui/themes/color.css'); ?>"/>

<script type="text/javascript">
	var COUNTER_ADDRESS = 2;
	var BASE_URL = '<?php echo base_url(); ?>';
</script>
<script type="text/javascript" src="<?php echo base_url('public/js/jquery-1.11.3.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/easyui/jquery.easyui.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo base_url('public/js/v_users.js'); ?>"></script>

</body>
</html>
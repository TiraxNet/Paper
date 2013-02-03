<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css" />
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<title>Paper! installer</title>
<link rel="stylesheet" href="publics/css/default.css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body> 


<div class="well" style="margin:50px auto; width:700px">
	<legend>Paper! Installer</legend>
	<?php if ($Rnd->MSG!=null): ?> 
	<div class="alert alert-error"><?php echo $Rnd->MSG;?></div>
	<?php endif; ?>
	<div class="row"><div class="span5">
	<form id="InstallForm" class="form-horizontal" method="post">
		<div class="control-group">
			<label class="control-label" for="WebsiteName">Website Name:</label>
			<div class="controls">
				<input type="text" id="WebsiteName" placeholder="Website Name" name="IForm[WebsiteName]">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="SQLHost">SQL Host:</label>
			<div class="controls">
				<input type="text" id="SQLHost" placeholder="SQL Host" name="IForm[SQLHost]">
				<p class="help-block">In most cases 'localhost'.</p>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="SQLUsername">SQL Username:</label>
			<div class="controls">
				<input type="text" id="SQLUsername" placeholder="SQL Username" name="IForm[SQLUsername]">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="SQLPassword">SQL Password:</label>
			<div class="controls">
				<input type="text" id="SQLPassword" placeholder="SQL Password" name="IForm[SQLPassword]">
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="SQLName">SQL Name:</label>
			<div class="controls">
				<input type="text" id="SQLName" placeholder="SQL Database Name" name="IForm[SQLName]">
			</div>
		</div>
		<div class="form-actions">
			<button name="Submit" type="submit" class="btn btn-primary">Submit</button>
			<button name="Reset" type="reset" class="btn">Reset</button>
		</div>	
		
	</form>
	</div>
	<div class="span4" style="text-align:center;">
		<img src="assets/Logo.png" style="width:150px;"/>
	</div>
	</div>
</div>

</body>
</html>




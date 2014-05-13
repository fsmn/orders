<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<? $this->load->view("page/head"); ?>
<body>
	<div id="page">
		<? if($this->ion_auth->logged_in()): ?>
		
		<div id="header">
				<? $this->load->view('page/menu'); ?>
			</div>
		<? endif; ?>
		<div id='content'>
			<? $this->load->view($target); ?>
		</div>
	</div>
	<div id="footer">
		<?=CI_VERSION;?>
	</div>
</body>
</html>
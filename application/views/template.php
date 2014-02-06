<?php ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?=$title; ?></title>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta http-equiv="cache-control" content="no-store" />
<meta http-equiv="pragma" content="no-cache" />
<meta http-equiv="expires" content="-1" />
<meta name="viewport"
	content="initial-scale=1; maximum-scale=2; minimum-scale=1; user-scalable=1;" />

<link href="<?=base_url(); ?>css/basic.css" type="text/css"
	rel="stylesheet" media="all" />
<link href="<?=base_url(); ?>css/color.css" type="text/css"
	rel="stylesheet" media="screen" />
<link href="<?=base_url(); ?>css/ui.theme.css" type="text/css"
	rel="stylesheet" media="screen" />
<link href="<?=base_url(); ?>css/print.css" type="text/css"
	rel="stylesheet" media="print" />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.min.js"></script>
<script type="text/javascript">
var baseUrl = '<?=base_url()."index.php/";?>';
    </script>
<script type="text/javascript" src="<?=base_url();?>js/main.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/order.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/item.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/popup.js"></script>
<script type="text/javascript" src="<?=base_url();?>js/vendor.js"></script>
</head>
<body>
	<div id="page">
		<? $this->load->view('template/menu'); ?>
		<div id='content'>
			<? $this->load->view($target); ?>
		</div>
	</div>
	<div id="footer">
		<?=CI_VERSION;?>
	</div>
</body>
</html>

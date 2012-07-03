<!DOCTYPE html>
<html>
<head>
    <title>retroTrack - <?php echo $title_for_layout; ?></title>
    <?php echo $this->Html->css('retrotrack'); ?>
    <?php echo $this->Html->css('bootstrap.min.css'); ?>
    <?php echo $this->Html->script('jquery-1.7.2.min'); ?>
    <!--[if !IE 7]>
		<style type="text/css">
			#wrap {display:table;height:100%}
		</style>
	<![endif]-->
</head>
<body>
	<div id="wrap">
		<div id="content_container">
			<?php echo $this->Session->flash(); ?>
			<?php echo $this->fetch('content'); ?>
		</div>
	</div>
	<div id="footer">
		<div id="footer_left">
			<?php echo $this->Html->image('mxl_logo.png'); ?>
		</div>
		<div id="footer_middle">
			Copyright &copy; 2012 James W. Cutler<br />
			Developed by <a href="http://exploration.engin.umich.edu/" target="_blank">MXL</a>
		</div>
		<div id="footer_right">
			<span style="color: red;">Note: This application is in an Alpha state and may occasionally not behave as expected.</span>
		</div>
	</div>
</body>
</html>
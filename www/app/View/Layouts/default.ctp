<!DOCTYPE html>
<html lang="en">
<head>
  <title>retroTrack - <?php echo $title_for_layout; ?></title>
  <link rel="shortcut icon" href="favicon.ico" />
  <?php echo $this->Html->css('retrotrack'); ?>
  <?php echo $this->Html->css('bootstrap.min.css'); ?>
  <?php echo $this->Html->css('jquery-ui-1.9.1.custom.min.css'); ?>
  <?php echo $this->Html->script('jquery-1.7.2.min'); ?>
  <?php echo $this->Html->script('bootstrap.min.js'); ?>
  <?php echo $this->Html->script('jquery.validate.min.js'); ?>
  <?php echo $this->Html->script('additional-methods.min.js'); ?>
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
      <a href="http://exploration.engin.umich.edu/" target="_blank" ><?php echo $this->Html->image('mxl_logo.png'); ?></a>
    </div>
    <div id="footer_middle">
      Copyright &copy; The University of Michigan<br />
      Visit <a href="https://github.com/jwcutler/retroTrack" target="_blank" ><?php echo Configure::read('Website.name'); ?> on github</a>
    </div>
    <div id="footer_right">
      <span style="font-size: 10px;">Note: This application is being actively developed and occasionally may not behave as expected. If you encounter a bug, please report it on <a href="https://github.com/jwcutler/retroTrack/issues?state=open" target="blank" >Github</a>.</span>
    </div>
  </div>
</body>
</html>

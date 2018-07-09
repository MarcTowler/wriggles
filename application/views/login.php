<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xml:lang="en-us" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>
		Wrigglemania Stream Store :: Login Deck Head
	</title>
	<link href="<?php echo base_url();?>assets/css/core.css" media="screen" rel="stylesheet" type="text/css" />
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery-1.3.2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/core.js"></script>
</head>
<body>
<div id="wrap">
	<a href="https://id.twitch.tv/oauth2/authorize?client_id=<?php echo $client;?>&redirect_uri=<?php echo $redirect;?>&response_type=code&scope=bits:read user:edit clips:edit channel_check_subscription channel_subscriptions">
        Login with Twitch
    </a>
</div>
</body>
</html>
<h1>Welcome <?php echo $_COOKIE['dhu']; ?></h1>
<ul id='adminmenu'>
	<li><a href="<?php echo base_url(); ?>admin/index">Admin Index</a></li>
	<li><a href="<?php echo base_url(); ?>admin/listDecks">Manage Decks</a></li>
	<li><a href='<?php echo base_url(); ?>admin/listCards'>Manage Cards</a></li>
	<li><a href='<?php echo base_url(); ?>admin/manageShop'>Manage Shop</a>
	<li><a href='<?php echo base_url(); ?>admin/config'>Config</a></li>
	<li><a href='<?php echo base_url(); ?>admin/users'>Users</a></li>
	<li><a href=''>Logout</a></li>
</ul>
<div class='clear'></div>
<hr />
<ul class="products">
<?php foreach($products as $p): ?>
	<li>
		<h3><?php echo $p['name'];?></h3>
		<img src="<?php echo base_url(); ?>assets/img/products/<?php echo $p['image'];?>" />
		<small><?php echo $p['price']; ?> caps</small>
		<p><?php echo $p['description']; ?></p>
		<?php echo form_open('shop/purchase'); ?>
		<fieldset>
			<?php
				echo form_hidden('product_id', $p['id']);
				echo form_submit('add', 'Redeem');
			?>
		</fieldset>
		<?php echo form_close();?>
	</li>
<?php endforeach;?>
</ul>

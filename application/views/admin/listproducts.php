<p><a href='<?php echo base_url();?>admin/addProduct'>Add Shop Item</a></p>
<table>
	<tr>
		<td>
			Product Name:
		</td>
		<td>
			Price:
		</td>
		<td>
			Image:
		</td>
		<td>
			Description:
		</td>
		<td>
			Deck:
		</td>
		<td>
			Game:
		</td>
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<?php foreach($products as $p): ?>
		<tr>
			<td><?php echo $p['name']; ?></td>
			<td><?php echo $p['price']; ?></td>
			<td><img src="<?php echo base_url(); ?>assets/img/products/<?php echo $p['image'];?>" /></td>
			<td><?php echo $p['description'];?></td>
			<td><?php echo $p['deck']; ?></td>
			<td><?php echo $p['game']; ?></td>
			<td>
				<a href="<?php base_url();?>editproduct/<?php echo $p['id'];?>">[EDIT]</a>
			</td>
			<td>
				<a href="<?php base_url();?>deleteproduct/<?php echo $p['id'];?>">[DELETE]</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
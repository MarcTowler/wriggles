<p><a href='<?php echo base_url();?>admin/addCard'>Add Card</a></p>
<table>
    <tr>
        <td>
            Card Name:
        </td>
        <td>
            Deck:
        </td>
        <td>
            Image:
        </td>
        <td>
            Rarity:
        </td>
        <td>
            &nbsp;
        </td>
        <td>
            &nbsp;
        </td>
    </tr>
	<?php foreach($cards as $c): ?>
	<tr>
		<td><?php echo $c['name']; ?></td>
        <td><?php echo $c['deck']; ?></td>
		<td><img src="<?php echo base_url(); ?>assets/img/products/<?php echo $c['image_url'];?>" /></td>
        <td><?php echo $c['rarity'];?></td>
		<td>
			<a href="<?php base_url();?>editcard/<?php echo $c['id'];?>">[EDIT]</a>
		</td>
		<td>
			<a href="<?php base_url();?>deletecard/<?php echo $c['id'];?>">[DELETE]</a>
		</td>
	</tr>
	<?php endforeach; ?>
</table>
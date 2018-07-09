<p><a href='<?php echo base_url();?>admin/addDeck'>Add Deck</a></p>
<table>
	<tr>
		<td>
			Deck Name:
		</td>
		<td>
			Game:
		</td>
		<td>
			Description:
		</td>
		<td>
			&nbsp;
		</td>
		<td>
			&nbsp;
		</td>
	</tr>
	<?php foreach($decks as $c): ?>
		<tr>
			<td><?php echo $c['name']; ?></td>
			<td><?php echo $c['game']; ?></td>
			<td><?php echo $c['description'];?></td>
			<td>
				<a href="<?php base_url();?>editdeck/<?php echo $c['id'];?>">[EDIT]</a>
			</td>
			<td>
				<a href="<?php base_url();?>deletedeck/<?php echo $c['id'];?>">[DELETE]</a>
			</td>
		</tr>
	<?php endforeach; ?>
</table>
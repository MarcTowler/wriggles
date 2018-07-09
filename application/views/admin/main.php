<h2>
	Community Stats
</h2>
<table>
	<tr>
		<td>
			Stream Status:
		</td>
		<td>
			<?php echo "The stream is " . $stats['status']; ?>
		</td>
	</tr>
	<tr>
		<td>Current Game:</td>
		<td><?php echo $stats['game'];?></td>
	</tr>
	<tr>
		<td>
			Total Users in the database:
		</td>
		<td>
			<?php echo $stats['users']; ?>
		</td>
	</tr>
	<tr>
		<td>Total Caps:</td>
		<td><?php echo $stats['caps']; ?></td>
	</tr>
	<tr>
		<td>
			Number of "Products" available:
		</td>
		<td>
			<?php echo $stats['products'];?>
		</td>
	</tr>
</table>

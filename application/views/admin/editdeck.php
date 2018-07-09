<h2>Editing the <?php echo $game[0]['name']; ?> deck</h2>

<form action='' method='post'>
	<input type='hidden' name='ID' value='<?php echo $game[0]['id'];?>'>

	<p><label>Deck Name</label><br />
		<input type='text' name='name' value='<?php echo $game[0]['name'];?>'></p>

	<p>
		<label>
			Game
		</label>
		<br />
		<select name="game">
			<?php foreach($game as $d) : ?>
				<option value="<?php echo $d['id']; ?>"><?php echo $d['name'];?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<p><label>Deck Description</label><br />
		<textarea name="description"><?php echo $game[0]['description'];?></textarea>

	<p><input type='submit' name='submit' value="Update <?php echo $game[0]['name'];?>"></p>

</form>
<h2>Creating a new Deck!</h2>

<form action='' method='post'>
	<p><label>Deck Name</label><br />
		<input type='text' name='name' /></p>

	<p><select name="game">
			<?php foreach($game as $d) : ?>
				<option value="<?php echo $d['id']; ?>"><?php echo $d['name'];?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label>
			Description
		</label><br />
		<textarea name="description"></textarea>
	</p>
	<p><input type='submit' name='submit' value="Create Deck"></p>

</form>
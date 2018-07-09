<h2>Creating a new Shop Item!</h2>

<form action='' method='post'>
	<p><label>Item Name</label><br />
		<input type='text' name='name' /></p>

	<p><label>Price</label><br />
		<input type="text" name="price" />
	</p>
	<p>
		<label>
			Description
		</label>
		<br />
		<textarea name="description"></textarea>
	</p>
	<p>
		<label>
			Deck
		</label>
		<br />
		<select name="deck">
			<?php foreach($decks as $d) : ?>
				<option value="<?php echo $d['id']; ?>"><?php echo $d['name'];?></option>
			<?php endforeach; ?>
		</select>
	</p>
	<p>
		<label>
			Game
		</label>
		<br />
		<select name="game">
			<?php foreach($games as $g) : ?>
				<option value="<?php echo $g['id']; ?>"><?php echo $g['name'];?></option>
			<?php endforeach; ?>
		</select>
	</p>

	<p><label>Product Image:</label><br />
	<p><input type="file" name="userfile" size="20"/></p>

	<p><input type='submit' name='submit' value="Create Product"></p>

</form>
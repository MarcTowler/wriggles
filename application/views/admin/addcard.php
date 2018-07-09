<h2>Creating a new Card!</h2>

<form action='' method='post'>
	<p><label>Card Name</label><br />
		<input type='text' name='name' /></p>

	<p><label>Card Rarity</label><br />
		<select name="rarity">
			<option value="common">
				Common
			</option>
			<option value="uncommon">
				Uncommon
			</option>
			<option value="rare">
				Rare
			</option>
			<option value="ultra-rare">
				Ultra Rare
			</option>
		</select>
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

	<p><label>Card Image:</label><br />
	<p><input type="file" name="userfile" size="20"/></p>

	<p><input type='submit' name='submit' value="Create Card"></p>

</form>
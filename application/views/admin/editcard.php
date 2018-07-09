<h2>Editing the <?php echo $details['name']; ?> card</h2>

<form action='' method='post'>
	<input type='hidden' name='ID' value='<?php echo $details['id'];?>'>

	<p><label>Card Name</label><br />
		<input type='text' name='name' value='<?php echo $details['name'];?>'></p>

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

	<p><label>Current Card Image:</label><br />
		<img src="<?php echo base_url();?>assets/img/products/<?php echo $details['image_url'];?>" /></p>
	<p><input type="file" name="userfile" size="20"/></p>

	<p><input type='submit' name='submit' value="Update <?php echo $details['name'];?>"></p>

</form>
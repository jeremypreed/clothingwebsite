<div id="shop-panel">
	<?php
	$cat = count($i->categories);
	for ($x=0; $x<$cat; $x++){ 
	# Display Category ?>
	<h2 class="panel-title">
		 <?php echo '<a href="'.$_["SITE_URL"].'shop/'.$i->categories[$x].'">'.$i->categories[$x].'</a>'; ?>
	</h2>
		<ul class="fa-ul">
		<?php
		$sc = count($i->subcategories);
		for ($y=0; $y<$sc; $y++){
			$result = $i->query($dbc, $x, $y, -1, 'id', 1, true);
			while ($row = mysqli_fetch_row($result)){
				$i->columns($row);
				if ($i->id){
					# Display Subcategory Links ?>
					<li>
						<span class="product-count">
							<?php echo $i->countRows($dbc,$i->category,$i->subcategory); ?>
						</span> &nbsp; 
						<a href="<?php echo $_['SITE_URL'].'shop/'.$i->category.'/'.$i->subcategory; ?>">
							<?php echo $i->subcategory; ?>
						</a>
					</li><?php
				}
			}
		} ?>	
		</ul><?php	
	}?>
</div>
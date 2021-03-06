<!-- Shopping Cart -->
<div id="content">
	<section class="content-wrapper-3 container-fluid">	
		<div class="row">
			<div class="col-md-3 column panel-content">
				<?php include_once('layout/account-panel.php'); ?>
			</div>
			<div class="col-md-9 main-content">	
				<div class="container-fluid">
					<h2>Shopping Cart</h2>

<?php
if ($_SESSION['id']) { ?>					
<div ng-controller="CartController as cart" ng-show="cart.products[0]" class="cart">
		This computer has {{ cart.quantity }} item(s) saved, but not associated with any account.
		<ul>
			<li ng-repeat="product in cart.products track by $index" class="local-cart-item">
				<a ng-href="{{ '<?php $_['SITE_URL']; ?>shop/' + product.category + '/' + product.subcategory + '/' + product.id }}">
					<img ng-src="{{ '<?php $_['SITE_URL']; ?>' + product.image}}" width="75px" height="auto">
				</a>
				{{ product.name }}<strong> &times; {{ product.quantity }}</strong>
			</li>
		</ul>
		
		<div class="sync">
			<form method="POST" action="#">
			Would you like to sync the previous item(s) to your account?
			<span class="options">
				<input type="hidden" name="localcart" ng-value="cart.json" />
				<button type="submit" name="sync">Yes. Sync with my account.</button>
				<button onClick="localStorage.clear();" >No. Remove from my computer.</button>
			</span>
			</form>
		</div>
</div>
<?php
}
$result = $c->query($dbc);
if ($result) {
	if ($c->total_quantity){?>
	
					<div class="row cart no-padding">
						<div class="col-md-8"></div>
						<div class="col-md-2 cart-head text-center">Quantity</div>
						<div class="col-md-2 cart-head text-right">Price</div>
					</div>
<?php
	}
	while ($row = mysqli_fetch_row($result)){
		$c->columns($row);
		$product_result = $i->query($dbc,-1, -1, $c->product_id); // Query DB for row
		$i->columns(mysqli_fetch_row($product_result)); // Fetch Column
# Display Cart Item ?>
<div class="row cart alt">
	<div class="col-md-2 col-xs-4 cart-img text-center">
		<a href="<?php echo $_['SITE_URL'].'shop/'.$i->category.'/'.$i->subcategory.'/'.$i->id; ?>">
			<img src="<?php echo $_['SITE_URL'].$i->image; ?>">
		</a>
	</div>
	<div class="col-md-6 col-xs-8 cart-desc">
		<h4><?php echo $i->name; ?></h4>
		<p><?php echo $i->size.', '.$i->color.'<br>'.substr($i->description, 0, 50).'...'; ?></p>
	</div>
	<div class="col-md-2 col-xs-4 cart-items text-center">
		<form method="post" action="#">
			<input type="hidden" name="cart_id" value="<?php echo $c->id; ?>" />
			<input type="number" name="quantity" value="<?php echo $c->quantity; ?>" min="1" max="99" class="update-field" />
			<button type="submit" name="update" value="Update" class="update">Update</button><br>
			<button type="submit" name="remove" value="Remove" class="btn btn-link remove" /><i class="fa fa-remove fw"></i> Remove</button>
		</form>
	</div>
	<div class="col-md-2 col-xs-8 cart-price text-right">
<?php
	if ($c->quantity>1){
		echo '<span class="small">$'.cash($i->discount_price).' &times '.$c->quantity.'</span><br>'; }
	if ($i->discount>0){
		echo '<span class="discount" title="'.$i->percent_off.' off">$'.cash($i->price*$c->quantity).'</span><span class="price-red">$'.cash($i->discount_price*$c->quantity).'</span><br>';
		echo '<span class="small">'.$i->percent_off.' Off<br> You save $'.cash($i->amount_off*$c->quantity).'</span>';
	} else {
		echo '<span class="price">$'.($i->price*$c->quantity).'</span>';			
	}
?>
	</div>
</div>
<?php	} 
	if ($c->total_quantity) {
$c->summary($dbc);
# total / checkout ?>
	<div class="row cart no-padding">
		<div class="col-md-8"></div>
		<div class="col-md-4 cart-head text-right">Subtotal</div>
	</div>
	
	<div class="row cart text-right">
		<div class="col-md-7"></div>
		<div class="col-md-5 subtotal">
			<?php 
			echo '$'.cash($c->discount_subtotal).'<br>';
			echo '<span class="small">You save $'.cash($c->savings).' on '.$c->total_quantity.' item(s)</span>'; ?>
		</div>
	</div>
	
	<div class="row cart text-center no-padding">
		<div class="col-md-9"></div>
		<div class="col-md-3 cart-checkout">
			<form method="POST" action="<?php echo $_['SITE_URL'].'checkout'; ?>">
				<button type="submit" value="Checkout">Checkout</button>
			</form>
		</div>
	</div>
</div> <?php
	} else {
		echo $MSG['CART_EMPTY'];
	}
} else {
	include_once('localcart.php');
}?>
			</div>
		</div>
	</section>
</div>
<?php
include_once('layout/recommended.php');
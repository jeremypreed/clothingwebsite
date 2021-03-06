<?php 
if ($_SESSION['id']){ // Logged In: Show Panel?>
<ul>
	<li class="name"><?php echo $_SESSION['first_name']." ".$_SESSION['last_name']; ?></li>
	<li><strong><?php echo $_SESSION['reward_points']; ?></strong> Reward Points</li>
</ul>
<hr>
<h3>My Account</h3>
<ul class="fa-ul">
<?php 
if ($p[1]=="profile") {
	// Profile Current Page
	echo '<li class="current-page"><i class="fa-li fa fa-angle-right"></i>Profile</li>'; } else {
	// Profile link
	echo '<li><i class="fa-li fa fa-angle-right"></i><a href="'.$_['SITE_URL'].'account/profile">Profile</a></li>'; }
if ($p[0]=="cart") {
	// Cart Current Page
	echo '<li class="current-page"><i class="fa-li fa fa-angle-right"></i>Shopping Cart</li>'; } else {
	// Cart link
	echo '<li><i class="fa-li fa fa-angle-right"></i><a href="'.$_['SITE_URL'].'cart">Shopping Cart</a></li>'; }
if ($p[1]=="orders") {
	// Order History Current Page
	echo '<li class="current-page"><i class="fa-li fa fa-angle-right"></i>Order History</li>'; } else {
	// Order History link
	echo '<li><i class="fa-li fa fa-angle-right"></i><a href="'.$_['SITE_URL'].'account/orders">Order History</a></li>'; }
if ($p[1]=="track") {
	// Track Package Current Page
	echo '<li class="current-page"><i class="fa-li fa fa-angle-right"></i>Track Package</li>'; } else {
	// Track Package link
	echo '<li><i class="fa-li fa fa-angle-right"></i><a href="'.$_['SITE_URL'].'account/track">Track Package</a></li>'; }
if ($p[1]=="wishlist") {
	// Wishlists Current Page
	echo '<li class="current-page"><i class="fa-li fa fa-angle-right"></i>Manage Wishlist</li>'; } else {
	// Wishlists link
	echo '<li><i class="fa-li fa fa-angle-right"></i><a href="'.$_['SITE_URL'].'account/wishlist">Manage Wishlist</a></li>'; } ?>
	<li><i class="fa-li fa fa-angle-right"></i><a href="<?php echo $_['SITE_URL']; ?>logout">Log out</a></li>
</ul><?php
	} else { // Not Logged In: Show login/register links
	echo '<h3>Account</h3><hr>'.$MSG['REGISTER_LOGIN'];
}
<header id="header" class="w-100 top">
	<nav class="navbar justify-content-center w-100">
		<div class="navbar-nav align-items-center justify-content-start flex-grow-1">
			<button class="nav-item" onclick="location.href='index.php'"><img src="https://via.placeholder.com/160x40?text=Company+Name+Logo"></button>
		</div>
		<div class="navbar-nav align-items-center justify-content-center flex-grow-2">
			<form class="searchform" action="products.php" method="get">
				<input class="searchbar w-100" type="text" name="search" placeholder="Search.." value="<?php echo isset($_GET['search']) ? $_GET['search'] : '' ?>">
				<select class="selectbar" name="category">
					<option <?php if(isset($_GET['category']) and $_GET['category'] == 'All') { echo "selected = 'selected'"; } ?>>All</option>
					<option <?php if(isset($_GET['category']) and $_GET['category'] == 'Tech') { echo "selected = 'selected'"; } ?>>Tech</option>
					<option <?php if(isset($_GET['category']) and $_GET['category'] == 'Makeup') { echo "selected = 'selected'"; } ?>>Makeup</option>
				</select>
				<input class="searchbutton" type="submit">
			</form>
		</div>
		<div class="navbar-nav align-items-center justify-content-end flex-grow-1">
		 <button class="nav-item" onclick="location.href=&#39;cart.php&#39;">Cart</button>
			<?php 
			if(isset($_SESSION['signedin']) && $_SESSION['signedin']) {
				echo 
				'
				<div class="dropdown">
					<button class="nav-item" onclick="location.href=&#39;signup.php&#39;"><img src="https://via.placeholder.com/40">&nbsp;<p>Profile</p></button>
					<div class="dropdown-content">
						<button class="nav-item" onclick="location.href=&#39;signup.php&#39;">Orders</button>
						<button class="nav-item" onclick="location.href=&#39;signup.php&#39;">Account</button>
						<button class="nav-item" onclick="location.href=&#39;signout.php&#39;">Sign Out</button>
					</div>
				</div>
				';
			}
			else {
				echo 
				'
				<button class="nav-item" onclick="location.href=&#39;signin.php&#39;">Sign In</button>
				<button class="nav-item" onclick="location.href=&#39;signup.php&#39;">Sign Up</button>
				';
			}
			?>
		</div>
	</nav>
</header>
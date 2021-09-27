<header id="header" class="w-100 top">
	<nav class="navbar justify-content-center w-100">
		<div class="navbar-nav w-100 align-items-center justify-content-start flex-grow-1">
			<button class="nav-item" onclick="location.href='admin.php'"><img src="https://via.placeholder.com/160x40?text=Company+Name+Logo"></button>
		</div>
		<div class="navbar-nav w-100 align-items-center justify-content-center flex-grow-2">
			<button class="nav-item" onclick="location.href='products.php'">Products</button>
			<button class="nav-item" onclick="location.href='howItWorks.php.php'">How It Works</button>
			<button class="nav-item" onclick="location.href='recommend.php'">Recommend A Product</button>
			<button class="nav-item" onclick="location.href='contact.php'">Contact Us</button>
		</div>
		<div class="navbar-nav w-100 align-items-center justify-content-end flex-grow-1">
			<?php 
			if(isset($_SESSION['signedin']) && $_SESSION['signedin']) {
				echo 
				'
				<div class="dropdown">
					<button class="nav-item" onclick="location.href=&#39;signup.php&#39;"><img src="https://via.placeholder.com/40">&nbsp;<p>Profile</p></button>
					<div class="dropdown-content">
						<button class="nav-item" onclick="location.href=&#39;signup.php&#39;">Settings</button>
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
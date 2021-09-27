<footer id="footer" class="w-100 bottom">
	<nav class="navbar justify-content-center w-100">
		<div class="navbar-nav w-10 align-items-center justify-content-center">
			<button class="nav-item" onclick="location.href='admin.php'">Company Name © 2021</button>
			<button class="nav-item" onclick="location.href='admin.php'">Privacy Policy</button>
			<button class="nav-item" onclick="location.href='admin.php'">Newsletter</a></button>
			<button class="nav-item" onclick="location.href='admin.php'">News</button>
			<button class="nav-item" onclick="location.href='admin.php'">Contact Us</button> 
			<button class="nav-item" onclick="location.href=<?php echo (isset($_SESSION['signedin']) && $_SESSION['signedin'] === true) ? '&#39;account.php&#39;' : '&#39;signin.php&#39;'; ?>">Account</button> <!-- if not signed in direct to login page, if signed in direct to account page -->
		</div>
	</nav>
</footer>
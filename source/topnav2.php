<header>
	<nav>
		<ul class="mobile-navbar"> <!-- Topbar for mobile -->
			<li class="nav-section">
				<ul class="justify-left">
					<li class="nav-item"><button class="nav-link" onclick="navbar_dropdown()">&#8801;</butt></li>
				</ul>
			</li>
			<li class="nav-section">
				<ul class="justify-center">
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Logo</a></li>
				</ul>
			</li>
			<li class="nav-section">
				<ul class="justify-right">
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Sign In</a></li>
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Sign Out</a></li>
				</ul>
			</li>
		</ul> 
		<ul id="mobile-dropdown" class="mobile-dropdown"> <!-- Topbar for desktop -->
			<li class="left-nav nav-section">
				<ul class="justify-left">
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Logo</a></li>
				</ul>
			</li>
			<li class="center-nav nav-section">
				<ul class="justify-center">
					<li class="nav-dropdown">
						<ul>
							<li class="nav-item"><button class="nav-link" onclick="link_dropdown(this)">Link 1</button></li> <!-- Dropdown Header -->
							<li class="nav-dropdown-content">
								<ul>
									<li class="nav-item"><button class="nav-link">Link 1:1 - ABCDEF</button></li>
									<li class="nav-item"><button class="nav-link">Link 1:2 - Hello</button></li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Link2</a></li>
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Link3</a></li>
					<li class="nav-item"><a class="nav-link" href="https://apple.com">Link4</a></li>
				</ul>
			</li>
			<li class="right-nav nav-section">
				<ul class="justify-right">
					<?php 
					if(isset($_SESSION['signedin']) && $_SESSION['signedin']) {
						echo 
						'
						<li class="nav-dropdown">
							<ul>
								<li class="nav-item"><button class="nav-link" onclick="link_dropdown(this)">Profile Pic - Account</button></li>
								<li class="nav-dropdown-content">
									<ul>
										<li class="nav-item"><a class="nav-link" href="settings.php">Test Settings</a></li>
										<li class="nav-item"><a class="nav-link" href="account.php">Account</a></li>
										<li class="nav-item"><a class="nav-link" href="signout.php">Sign Out</a></li>
									</ul>
								</li>
							</ul>
						</li>
						';
					}
					else {
						echo 
						'
						<li class="nav-item"><a class="nav-link" href="signin.php">Sign In</a></li>
						<li class="nav-item"><a class="nav-link" href="signup.php">Sign Up</a></li>
						';
					}
					?>
				</ul>
			</li>
		</ul>
	</nav>
</header>

<?php

/* if(isset($_SESSION['signedin']) && $_SESSION['signedin']) {
	echo
	'
	<li class="nav-item"><a class="nav-link">Account</a></li>
	';
}
else {
	echo
	'
	<li class="nav-item"><a class="nav-link">Sign In</a></li>
	<li class="nav-item"><a class="nav-link">Sign Out</a></li>
	';
}
 */
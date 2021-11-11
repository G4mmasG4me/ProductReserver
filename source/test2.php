<?php 
?>

<!DOCTYPE html>
<html>
  <head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="styles/test2.css">
    <script type="text/javascript" src="scripts/test2.js"></script>
	</head>

	<body>
    <div class="container">
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
                <li class="nav-item"><a class="nav-link" href="https://apple.com">Sign In</a></li>
                <li class="nav-item"><a class="nav-link" href="https://apple.com">Sign Up</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </header>
      <div class="content">
      </div>
      <footer>
        <nav>
          <ul class="footer-navigation">
            <li>
              <ul>
                <li class="nav-item"><a class="nav-link nav-icon" href=""><img class="social-icon" src="https://via.placeholder.com/64x64"></a></li>
                <li class="nav-item"><a class="nav-link nav-icon" href=""><img class="social-icon" src="../images/static_images/social_media_logos/"></a></li>
              </ul>
            </li>
            <li>
              <ul>
                <li class="nav-item"><a class="nav-link" href="">Link 1</a></li>
                <li class="nav-item"><a class="nav-link" href="">Link 2</a></li>
                <li class="nav-item"><a class="nav-link" href="">Link 3</a></li>
                <li class="nav-item"><a class="nav-link" href="">Link 4</a></li>
              </ul>
            </li>
          </ul>
        </nav>
      </footer>
      
    </div>
	</body>

</html>
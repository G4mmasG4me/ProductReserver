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
      <nav>
        <ul class="mobile-navbar"> <!-- Topbar for mobile -->
          <li class="nav-section">
            <ul class="justify-left">
              <li class="nav-item"><button class="nav-link" onclick="dropdown()">Dropdown Toggle</butt></li>
            </ul>
          </li>
          <li class="nav-section">
            <ul class="justify-center">
              <li class="nav-item"><a class="nav-link">Logo</a></li>
            </ul>
          </li>
          <li class="nav-section">
            <ul class="justify-right">
              <li class="nav-item"><a class="nav-link">Sign In</a></li>
              <li class="nav-item"><a class="nav-link">Sign Out</a></li>
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
              <li class="nav-item"><a class="nav-link">Link1</a></li>
              <li class="nav-item"><a class="nav-link">Link2</a></li>
            </ul>
          </li>
          <li class="right-nav nav-section">
            <ul class="justify-right">
              <li class="nav-item"><a class="nav-link">Sign In</a></li>
              <li class="nav-item"><a class="nav-link">Sign Up</a></li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
	</body>

</html>
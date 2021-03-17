<!DOCTYPE html>
<html>
    <head>
        <title>Website | Home</title>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="styles/slider.css">
        
        <script type="text/javascript" src="scripts/slider.js"></script>
    </head>

    <body>
      <div id="price-range">
        <p>£</p>
        <input id="leftinput" type="number" oninput="set_left_thumb()">
        <div id="range-slider">
          <div id="track"></div>
          <input id="leftthumb" type="range" min=0 max=100 value=25 step=1 oninput="set_left_input()">
          <input id="rightthumb" type="range" min=0 max=100 value=75 step=1 oninput="set_right_input()">
        </div>
        <p>£</p>
        <input id="rightinput" type="number" oninput="set_right_thumb()">
      </div>
        
    </body>
 
</html>
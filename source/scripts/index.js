updateCounter()
setInterval(function(){
  updateCounter()
}, 5000);

function updateCounter() {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('orderCounter').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', 'orderCounter.php',true);
  xhttp.send();
}
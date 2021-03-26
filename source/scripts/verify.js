function nextfocus1() {
  var value = document.getElementById('codeinp1').value;
  var new_value = value.replace(/[^0-9]/g,'');
  document.getElementById('codeinp1').value = new_value;
  if (new_value) {
    document.getElementById('codeinp2').focus()
  }
}
function nextfocus2() {
  var value = document.getElementById('codeinp2').value;
  var new_value = value.replace(/[^0-9]/g,'');
  document.getElementById('codeinp2').value = new_value;
  if (new_value) {
    document.getElementById('codeinp3').focus()
  }
}
function nextfocus3() {
  var value = document.getElementById('codeinp3').value;
  var new_value = value.replace(/[^0-9]/g,'');
  document.getElementById('codeinp3').value = new_value;
  if (new_value) {
    document.getElementById('codeinp4').focus()
  }
}
function nextfocus4() {
  var value = document.getElementById('codeinp4').value;
  var new_value = value.replace(/[^0-9]/g,'');
  document.getElementById('codeinp4').value = new_value;

}
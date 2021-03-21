function submitDisabled() {
  var namevalue = document.getElementById('nameinput').value;
  var emailvalue = document.getElementById('emailinput').value;
  var addressvalue = document.getElementById('addressinput').value;
  var passwordvalue = document.getElementById('passwordinput').value;
  var confirmvalue = document.getElementById('confirminput').value;

  document.getElementById('submit').disabled = false;
  if (!namevalue || !emailvalue || !addressvalue || !passwordvalue || !confirmvalue) {
    document.getElementById('submit').disabled = true;
    console.log('test');
  }
}

function namecheck() {
  submitDisabled()
  var namevalue = document.getElementById('nameinput').value;
  var words = 0;
  namevalue = namevalue.trim()
  if (namevalue) {
    for (var i = 0; i <= namevalue.length; i++) {
      if (namevalue[i] == ' ') {
        words++;
      }
    }
    console.log(words);
    if (words < 1) {
      document.getElementById('nameerror').innerHTML = 'Must Include First and Last Name';
    }
    else {
      document.getElementById('nameerror').innerHTML = '';
    }
  }
  

}
function emailcheck() {
  submitDisabled()
  var emailvalue = document.getElementById('emailinput').value;
}

function addresscheck() {
  submitDisabled()
  var addressvalue = document.getElementById('addressinput').value;
}

function passwordcheck() {
  submitDisabled()
  var passwordvalue = document.getElementById('passwordinput').value;
  var confirmvalue = document.getElementById('confirminput').value;
  if (confirmvalue) {
    if (confirmvalue != passwordvalue) {
      document.getElementById('confirmerror').innerHTML = 'Passwords Dont Match';
      document.getElementById('submit').disabled = true;
    }
    else {
      document.getElementById('confirmerror').innerHTML = '';
    }
  }
}

function confirmcheck() {
  submitDisabled()
  var confirmvalue = document.getElementById('confirminput').value;
  var passwordvalue = document.getElementById('passwordinput').value;
  if (confirmvalue) {
    if (confirmvalue != passwordvalue) {
      document.getElementById('confirmerror').innerHTML = 'Passwords Dont Match';
      document.getElementById('submit').disabled = true;
    }
    else {
      document.getElementById('confirmerror').innerHTML = '';
    }
  }
}
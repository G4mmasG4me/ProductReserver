function submitDisabled() {
  var namevalue = document.getElementById('nameinput').value;
  var emailvalue = document.getElementById('emailinput').value;
  var passwordvalue = document.getElementById('passwordinput').value;
  var confirmvalue = document.getElementById('confirminput').value;

  document.getElementById('submit').disabled = false;
  if (!namevalue || !emailvalue || !passwordvalue || !confirmvalue) {
    document.getElementById('submit').disabled = true;
  }
}

function namecheck() {
  submitDisabled()
  var namevalue = document.getElementById('nameinput').value;
  var words = 0;
  namevalue = namevalue.trim()
  if (namevalue) {
    if(namevalue.match(/^[a-zA-Z-' ]*$/)) {
      document.getElementById('nameerror').innerHTML = '';
      for (var i = 0; i <= namevalue.length; i++) {
        if (namevalue[i] == ' ') {
          words++;
        }
      }
      console.log(words);
      if (words > 0) {
        document.getElementById('nameerror').innerHTML = '';
      }
      else {
        document.getElementById('nameerror').innerHTML = 'Must Include First and Last Name';
      }
    }
    else {
      document.getElementById('nameerror').innerHTML = 'Must be a valid name';
    }
  }
}

function emailcheck() {
  submitDisabled()
  var emailvalue = document.getElementById('emailinput').value;
  if (emailvalue) {
    if(emailvalue.match(/^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/)) {
      document.getElementById('emailerror').innerHTML = '';
    }
    else {
      document.getElementById('emailerror').innerHTML = 'Must be a valid email';
    }
  }
}

function passwordcheck() {
  submitDisabled()
  var passwordvalue = document.getElementById('passwordinput').value;
  var confirmvalue = document.getElementById('confirminput').value;
  if (passwordvalue) {
    if(passwordvalue.match(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,32}$/)) {
      document.getElementById('passworderror').innerHTML = '';
    }
    else {
      document.getElementById('passworderror').innerHTML = 'Must have at least 8 characters, an upper case and a lower case character as well as a numeric value.';
    }
  }
  else {
    document.getElementById('passworderror').innerHTML = '';
  }
  
  if (confirmvalue) {
    if (confirmvalue == passwordvalue) {
      document.getElementById('confirmerror').innerHTML = '';
    }
    else {
      document.getElementById('confirmerror').innerHTML = 'Passwords Dont Match';
      document.getElementById('submit').disabled = true;
    }
  }
}

function confirmcheck() {
  submitDisabled()
  var confirmvalue = document.getElementById('confirminput').value;
  var passwordvalue = document.getElementById('passwordinput').value;
  if (confirmvalue) {
    if (confirmvalue == passwordvalue) {
      document.getElementById('confirmerror').innerHTML = '';
      
    }
    else {
      document.getElementById('confirmerror').innerHTML = 'Passwords Dont Match';
      document.getElementById('submit').disabled = true;
    }
  }
}
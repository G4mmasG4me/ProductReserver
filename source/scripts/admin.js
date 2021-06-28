sidebar = false

function sidepanel_open_close() {
  if (sidebar == true) {
    sidebar = false
    // close sidebar
    document.getElementById('sidepanel').style.width = '50px';
    document.getElementById('profilebutton').style.width = '0%';
    document.getElementById('profileimg').style.width = '0%';
    document.getElementById('sidepanellinks').style.display = 'none';

    var buttons = document.getElementById('sidepanellinks').children;
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].style.width = '0%';
      buttons[i].style.display = 'none';
    }
  }
  else {
    sidebar = true
    // open sidebar
    document.getElementById('sidepanel').style.width = '20%';
    document.getElementById('profilebutton').style.width = '50px';
    document.getElementById('profileimg').style.width = '100%';
    document.getElementById('sidepanellinks').style.display = 'block';

    var buttons = document.getElementById('sidepanellinks').children;
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].style.width = '100%';
      buttons[i].style.display = 'block';
    }
  }
}

function page(ele) {
  var pages = document.getElementById('maincontent').children;
  for (var i = 0; i < pages.length; i++) {
    pages[i].style.display = 'none';
  }
  document.getElementById(ele.id.slice(0, 5)).style.display = 'flex';
}

function p2AddProductShow() {
  document.getElementById('p2add-content').style.display = "block"
  document.getElementById('p2edit-content').style.display = "none";
  document.getElementById('p2search-content').style.display = "none"
}

function p2EditProductShow() {
  document.getElementById('p2add-content').style.display = "none";
  document.getElementById('p2edit-content').style.display = "block"
  document.getElementById('p2search-content').style.display = "none"
}

function p2SearchProductShow() {
  document.getElementById('p2add-content').style.display = "none";
  document.getElementById('p2edit-content').style.display = "none";
  document.getElementById('p2search-content').style.display = "block"
}

function p3EditProductShow() {
  document.getElementById('p3edit-content').style.display = "block"
  document.getElementById('p3search-content').style.display = "none"
}

function p3SearchProductShow() {
  document.getElementById('p3edit-content').style.display = "none";
  document.getElementById('p3search-content').style.display = "block"
}
function productSearchEdit(id) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('editproductform').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', 'productSearch.php?id='+id,true);
  xhttp.send();
}

function userSearchEdit(id) {
  var xhttp;
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById('editcustomerform').innerHTML = this.responseText;
    }
  };
  xhttp.open('GET', 'userSearch.php?id='+id,true);
  xhttp.send();
}
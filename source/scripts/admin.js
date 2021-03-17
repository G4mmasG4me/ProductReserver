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

function addproductshow() {
  document.getElementById('add-content').style.display = "block"
  document.getElementById('edit-content').style.display = "none";
}

function editproductshow() {
  document.getElementById('edit-content').style.display = "block"
  document.getElementById('add-content').style.display = "none";
}
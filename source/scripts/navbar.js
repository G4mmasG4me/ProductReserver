function navbar_dropdown() {
  document.getElementById("mobile-dropdown").classList.toggle("navbar-dropdown-active")
}

function link_dropdown(ele) {
  ele.parentNode.nextElementSibling.classList.toggle('navlink-dropdown-active')
}
function quantityChange(ele) {
  if (ele.value == "10+") {
    ele.remove()
    var quantityInput = document.createElement('input');
    quantityInput.type = '10';
    quantityInput.className = '';
    document.getElementById("quantitySelector").appendChild(quantityInput);
  }
}
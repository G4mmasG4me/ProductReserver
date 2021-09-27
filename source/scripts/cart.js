function quantityChange(ele) {
  if (ele.value == "10+") {
    var parentEle = ele.parentElement;
    ele.remove()
    var quantityLabel = document.createElement('label');
    quantityLabel.for = 'quantityInput'
    quantityLabel.innerHTML = 'Quantity: '
    var quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.id = 'quantityInput';
    var quantitySubmit = document.createElement('input');
    quantitySubmit.type = 'submit';
    quantitySubmit.id = 'quantitySubmit';

    parentEle.appendChild(quantityLabel);
    parentEle.appendChild(quantityInput);
    parentEle.appendChild(quantitySubmit);
  }
}

function quantityButtonChange(ele, amount) {
  var siblings = ele.parentNode.children;
  for(var i = siblings.length; i--;) {
    if(siblings[i].id == 'quantityInput') {
      var quantity = siblings[i];
      break;
    }
  }
  quantity.value = parseInt(quantity.value, 10) + amount;
}

function quantityChange(ele) {
  console.log('test');
}
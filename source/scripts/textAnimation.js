text_open = true;

function openclose() {
  if (text_open == true) {
    document.getElementById('animationText1').classList.remove('animationTextOpen');
    document.getElementById('animationText1').classList.add('animationTextClose');
    text_open = false
  }
  else if (text_open == false) {
    document.getElementById('animationText1').classList.remove('animationTextClose');
    document.getElementById('animationText1').classList.add('animationTextOpen');
    text_open = true
  }
}

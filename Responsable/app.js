const modalBtn1 = document.getElementById("modal-btn1");
const closeBtn1 = document.getElementById("close-btn1");
const modal1 = document.getElementById("modal-overlay1");

modalBtn1.addEventListener("click", function () {
  modal1.classList.add("open-modal");
});

closeBtn1.addEventListener("click", function () {
  modal1.classList.remove("open-modal");
});

const modalBtn2 = document.getElementById("modal-btn2");
const closeBtn2 = document.getElementById("close-btn2");
const modal2 = document.getElementById("modal-overlay2");

modalBtn2.addEventListener("click", function () {
  modal2.classList.add("open-modal");
});

closeBtn2.addEventListener("click", function () {
  modal2.classList.remove("open-modal");
});

const modalBtn3 = document.getElementById("modal-btn3");
const closeBtn3 = document.getElementById("close-btn3");
const modal3 = document.getElementById("modal-overlay3");

modalBtn3.addEventListener("click", function () {
  modal3.classList.add("open-modal");
});

closeBtn3.addEventListener("click", function () {
  modal3.classList.remove("open-modal");
});

function add() {
  element.removeChild(tag);
  console.log(counter);
}

var counter = 0;
var element = document.getElementById("liste");
var tag;

function createTitle() {
  tag = document.createElement("button");
  tag.textContent = "CLICK";
  tag.addEventListener("click", add);
  element.appendChild(tag);
  setTimeout(function() {
      element.removeChild(element.firstElementChild);
  }, 2000);
}


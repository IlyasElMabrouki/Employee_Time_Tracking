const modalBtn1 = document.getElementById("modal-btn1");
const closeBtn1 = document.getElementById("close-btn1");
const modal1 = document.getElementById("modal-overlay1");

modalBtn1.addEventListener("click", function () {
  modal1.classList.add("open-modal");
});

closeBtn1.addEventListener("click", function () {
  modal1.classList.remove("open-modal");
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




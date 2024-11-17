(function () {
  "use strict";

  const registerButton = document.getElementById("buttom-register");
  const loginButton = document.getElementById("buttom-login");
  const card = document.getElementsByClassName("card")[0];
  console.log(card[0]);
  const registerOpen = function () {
    card.classList.add("register-on");
  };
  const registerClose = function () {
    card.classList.remove("register-on");
  };
  registerButton.addEventListener("click", registerOpen);
  loginButton.addEventListener("click", registerClose);
})();

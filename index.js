document.addEventListener("DOMContentLoaded", function () {
  const checkbox = document.getElementById("led-switch");
  let ledImg = document.getElementById("led-img");
  checkbox.addEventListener("change", function () {
    if (this.checked) {
      ledImg.setAttribute("src", "assets/led_on.png");
      setLedState(1);
    } else {
      setLedState(0);
      ledImg.setAttribute("src", "assets/led_off.png");
    }
  });

  function setLedState(state) {
    const url = `https://esp32.webtimism.de/api.php?key=A1B2C34D&action=set&led=${state}`;
    fetch(url)
      .then((response) => response.text())
      .then((data) => {
        console.log("Response from server:", data);
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  }
});
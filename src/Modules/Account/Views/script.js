const input = document.querySelector("input[ value = 'Конвертация в валюту' ]");
const select = document.querySelector("select");
const inputRub = document.querySelector("#rub");
const inputCur = document.querySelector("#cur");

input.addEventListener("click", (e) => {
  e.preventDefault();
  const valueCur = select.selectedOptions[0].value;
  const valueRub = inputRub.value;
  inputCur.value = (valueRub / valueCur).toFixed(2);
});

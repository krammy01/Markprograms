document.addEventListener('DOMContentLoaded', function () {
  const inputs = document.querySelectorAll('.form-control');
  const progressBar = document.getElementById('formProgress');
  const totalInputs = inputs.length;

  function updateProgressBar() {
    const validInputs = document.querySelectorAll('.is-valid').length;
    const progress = (validInputs / totalInputs) * 100;
    progressBar.style.width = `${progress}%`;
    progressBar.innerHTML = `${progress.toFixed(0)} %`;
  }

  function validateName(input) {
    const nameRegex = /^[A-Z][a-z]+(?: [A-Z][a-z]+)*$/;
    return nameRegex.test(input.value.trim());
  }

  function validateAge(input) {
    const ageValue = parseInt(input.value.trim(), 10);
    return !isNaN(ageValue) && ageValue >= 0;
  }

  function validateEmail(input) {
    const emailRegex = /^[A-Za-z0-9!#$%&'*+\/=?^_`{|}~-]+@[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?(?:\.[A-Za-z0-9](?:[A-Za-z0-9-]{0,61}[A-Za-z0-9])?)+$/;
    return emailRegex.test(input.value.trim());
  }

  function validateInput(input) {
    const inputId = input.id;

    if (inputId === 'FullNameInput') {
      input.classList.toggle('is-valid', validateName(input));
      input.classList.toggle('is-invalid', !validateName(input));
    } else if (inputId === 'ageInput') {
      input.classList.toggle('is-valid', validateAge(input));
      input.classList.toggle('is-invalid', !validateAge(input));
    } else if (inputId === 'emailInput') {
      input.classList.toggle('is-valid', validateEmail(input));
      input.classList.toggle('is-invalid', !validateEmail(input));
    } else {
      input.classList.toggle('is-valid', input.value.trim() !== '');
      input.classList.toggle('is-invalid', input.value.trim() === '');
    }

    updateProgressBar();
  }

  inputs.forEach(input => {
    input.addEventListener('input', function () {
      validateInput(input);
    });
  });
});
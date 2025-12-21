function registerValidation() {
  var name = formRegister.name.value;
  var lastName = formRegister.lastName.value;
  var email = formRegister.email.value;
  var day = formRegister.days.value;
  var month = formRegister.months.value;
  var year = formRegister.years.value;
  var username = formRegister.username.value;
  var password = formRegister.password.value;

  var errors = "";

  if (name == "") {
    errors = 'Enter your name.';
    formRegister.name.focus();
  }

  if (lastName == "") {
    errors = errors + '\nEnter your last name.';
    formRegister.lastName.focus();
  }

  if (day == "") {
    errors = errors + '\nEnter your day.';
    formRegister.days.focus();
  }

  if (month == "") {
    errors = errors + '\nEnter your month.';
    formRegister.months.focus();
  }

  if (year == "") {
    errors = errors + '\nEnter your year.';
    formRegister.years.focus();
  }

  if (email == "") {
    errors = errors + '\nEnter your email.';
    formRegister.email.focus();
  }

  if (username == "") {
    errors = errors + '\nEnter your username.';
    formRegister.username.focus();
  }

  if (password == "") {
    errors = errors + '\nEnter your password.';
    formRegister.password.focus();
  }

  if (errors != "") {
    alert(errors);
    return false;
  }

  return true;
}

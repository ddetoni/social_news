function registerValidation() {
  var name = formRegister.name.value;
  var lastName = formRegister.lastName.value;
  var email = formRegister.email.value;
  var day = formRegister.days.value;
  var month = formRegister.months.value;
  var year = formRegister.years.value;
  var username = formRegister.username.value;
  var password = formRegister.password.value;

  var erros = "";

  if (name == "") {
    erros = 'Put your Name.';
    formRegister.name.focus();
  }

  if (lastName == "") {
    erros = erros + '\nPut your Last Name';
    formRegister.lastName.focus();
  }

  if (day == "") {
    erros = erros + '\nPut your Day';
    formRegister.days.focus();
  }

  if (month == "") {
    erros = erros + '\nPut your Month';
    formRegister.months.focus();
  }

  if (year == "") {
    erros = erros + '\nPut your Year';
    formRegister.years.focus();
  }

  if (email == "") {
    erros = erros + '\nPut your Email';
    formRegister.email.focus();
  }

  if (username == "") {
    erros = erros + '\nPut your Username';
    formRegister.username.focus();
  }

  if (password == "") {
    erros = erros + '\nPut your Password';
    formRegister.password.focus();
  }

  if (erros != "") {
    alert(erros);
    return false;
  }

  return true;
}

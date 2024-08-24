// Client-Side Form Validation
function validateForm() {
  var username = document.forms["loginForm"]["username"].value;
  var password = document.forms["loginForm"]["password"].value;
  var errorMessage = "";

  if (username == "") {
    errorMessage += "Username must be filled out.\n";
  }

  if (password == "") {
    errorMessage += "Password must be filled out.\n";
  } else if (password.length < 6) {
    errorMessage += "Password must be at least 6 characters long.\n";
  }

  if (errorMessage) {
    alert(errorMessage);
    return false;
  }

  return true;
}

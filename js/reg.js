// Client-Side Form Validation
function validateForm() {
  var fullname = document.forms["registrationForm"]["fullname"].value;
  var username = document.forms["registrationForm"]["username"].value;
  var email = document.forms["registrationForm"]["email"].value;
  var password = document.forms["registrationForm"]["password"].value;
  var errorMessage = "";

  // Check if full name contains only letters and spaces
  if (fullname == "") {
    errorMessage += "Full name must be filled out.\n";
  } else if (!/^[a-zA-Z\s]+$/.test(fullname)) {
    errorMessage += "Full name must contain only letters and spaces.\n";
  }

  if (username == "") {
    errorMessage += "Username must be filled out.\n";
  }

  if (email == "") {
    errorMessage += "Email must be filled out.\n";
  } else if (!validateEmail(email)) {
    errorMessage += "Invalid email format.\n";
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

// Email format validation
function validateEmail(email) {
  var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(String(email).toLowerCase());
}

// Client-Side Form Validation
function validateForm() {
  var amount = document.forms[0]["personal_number"].value;
  var mobile = document.forms[0]["number"].value;
  var errorMessage = "";
  var valid_amounts = ["5000", "4000", "3500", "10000", "4500", "7500", "3000"];

  // Validate amount - should be numeric
  if (amount == "") {
    errorMessage += "Amount must be filled out.\n";
  } else if (!/^\d+$/.test(amount)) {
    errorMessage += "Amount must be a number.\n";
  }
  // Validate amount with treatment's amounts
  else if (!valid_amounts.includes(amount)) {
    errorMessage += "Entered amount is wrong. Select your treatment.\n";
  }

  // Validate mobile number - should be numeric and 10 digits
  if (mobile == "") {
    errorMessage += "Mobile number must be filled out.\n";
  } else if (!/^\d{10}$/.test(mobile)) {
    errorMessage += "Mobile number must be 10 digits.\n";
  }

  if (errorMessage) {
    alert(errorMessage);
    return false;
  }

  return true;
}

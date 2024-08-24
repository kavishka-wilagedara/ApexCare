// Client-Side Form Validation
function validateForm() {
  var accountName = document.forms[0]["AccountName"].value;
  var cardNumber = document.forms[0]["CardNumber"].value;
  var cvv = document.forms[0]["Cvv"].value;
  var expiary = document.forms[0]["Expiary"].value;
  var errorMessage = "";

  // Validate Account Name - should not be empty and should contain only letters and spaces
  if (accountName == "") {
    errorMessage += "Account name must be filled out.\n";
  } else if (!/^[a-zA-Z\s]+$/.test(accountName)) {
    errorMessage += "Account name must contain only letters and spaces.\n";
  }

  // Validate Card Number - should be numeric and 16 digits
  if (cardNumber == "") {
    errorMessage += "Card number must be filled out.\n";
  } else if (!/^\d{16}$/.test(cardNumber)) {
    errorMessage += "Card number must be 16 digits.\n";
  }

  // Validate CVV - should be numeric and 3 digits
  if (cvv == "") {
    errorMessage += "CVV must be filled out.\n";
  } else if (!/^\d{3}$/.test(cvv)) {
    errorMessage += "CVV must be 3 digits.\n";
  }

  // Validate Expiry Date - should be in MM/YY format
  if (expiary == "") {
    errorMessage += "Expiry date must be filled out.\n";
  } else if (!/^\d{2}\/\d{2}$/.test(expiary)) {
    errorMessage += "Expiry date must be in MM/YY format.\n";
  }

  if (errorMessage) {
    alert(errorMessage);
    return false;
  }

  return true;
}

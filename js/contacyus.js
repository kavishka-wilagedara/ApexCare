document.querySelector("form").addEventListener("submit", function (event) {
  var fullname = document.querySelector('input[name="fullname"]').value.trim();
  var email = document.querySelector('input[name="email"]').value.trim();
  var address = document.querySelector('input[name="address"]').value.trim();
  var doctor = document.querySelector('select[name="doctor"]').value;
  var appointment_date = document.querySelector(
    'input[name="appointment_date"]'
  ).value;
  var appointment_time = document.querySelector(
    'input[name="appointment_time"]'
  ).value;
  var reason = document.querySelector('textarea[name="reason"]').value.trim();

  if (
    !fullname ||
    !email ||
    !address ||
    !doctor ||
    !appointment_date ||
    !appointment_time ||
    !reason
  ) {
    alert("Please fill in all required fields.");
    event.preventDefault();
  } else if (!validateEmail(email)) {
    alert("Please enter a valid email address.");
    event.preventDefault();
  } else if (!validateFullName(fullname)) {
    alert("Full Name can only contain alphabetic characters and spaces.");
    event.preventDefault();
  }
});

function validateEmail(email) {
  var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return re.test(email);
}

function validateFullName(name) {
  var re = /^[A-Za-z\s]+$/; // Allows alphabetic characters and spaces
  return re.test(name);
}

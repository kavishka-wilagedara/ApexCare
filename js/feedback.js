document
  .getElementById("feedbackForm")
  .addEventListener("submit", function (event) {
    let name = document.getElementById("name").value;
    let email = document.getElementById("email").value;
    let feedback = document.getElementById("feedback").value;

    if (name === "" || email === "" || feedback === "") {
      alert("All fields are required!");
      event.preventDefault(); // Prevent form submission
    }
  });

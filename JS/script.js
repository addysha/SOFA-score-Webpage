//Form nhi and name validation 
function validateForm() {
    // Get the values of the input fields
    var nhi = document.getElementById("nhi").value;
    var surname = document.getElementById("surname").value;
    var firstname = document.getElementById("firstname").value;
    // Regular expression for NHI number validation (AAANNNN)
    var nhiPattern = /^[A-Z]{3}\d{4}$/;
    // Initialize an error message variable
    var errorMessage = "";
    // Check if the NHI number is empty or doesn't match the pattern
    if (nhi.trim() === "" || !nhiPattern.test(nhi)) {
        errorMessage += "<div>Please enter a valid NHI number in the format AAANNNN (A=uppercase letter, N=digit).</div>";
    }
    // Check if the surname is empty
    if (surname.trim() === "") {
        errorMessage += "<div>Please enter a surname.</div>";
    }
    // Check if the firstname is empty
    if (firstname.trim() === "") {
        errorMessage += "<div>Please enter a first name.</div>";
    }
    // Display error messages in the error-message container
    var errorMessageContainer = document.getElementById("error-message");
    errorMessageContainer.innerHTML = errorMessage;
    // Prevent form submission if there are validation errors
    if (errorMessage !== "") {
        return false;
    }
    // Submit the form programmatically
    document.getElementById("form").submit();
}
//===================================================================================================

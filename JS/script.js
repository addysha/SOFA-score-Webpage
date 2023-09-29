//Form nhi and name validation 
function validateForm() {
    // Get the input elements
    var nhiInput = document.getElementById("nhi");
    var surnameInput = document.getElementById("surname");
    var firstnameInput = document.getElementById("firstname");
    
    // Get the values of the input fields
    var nhi = nhiInput.value;
    var surname = surnameInput.value;
    var firstname = firstnameInput.value;
    
    // Regular expression for NHI number validation (AAANNNN)
    var nhiPattern = /^[A-Z]{3}\d{4}$/;
    
    // Initialize an error message variable
    var errorMessage = "";
    
    // Check if the NHI number is empty or doesn't match the pattern
    if (nhi.trim() === "" || !nhiPattern.test(nhi)) {
        errorMessage += "<div>Please enter a valid NHI number in the format AAANNNN (A=uppercase letter, N=digit).</div>";
        nhiInput.style.border = "1px solid red";
    } else {
        nhiInput.style.border = ""; // Reset the border if it's valid
    }
    
    // Check if the surname is empty
    if (surname.trim() === "") {
        errorMessage += "<div>Please enter a surname.</div>";
        surnameInput.style.border = "1px solid red";
    } else {
        surnameInput.style.border = ""; // Reset the border if it's valid
    }
    
    // Check if the firstname is empty
    if (firstname.trim() === "") {
        errorMessage += "<div>Please enter a first name.</div>";
        firstnameInput.style.border = "1px solid red";
    } else {
        firstnameInput.style.border = ""; // Reset the border if it's valid
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

// CardioVascular checking 
//===================================================================================================

function ValidateCardio() {
    // Get the values of the cardiovascular input fields
    var meanAtrialPressure = document.getElementById("mean-atrial-pressure");
    var dopamine = document.getElementById("dopamine");
    var dobutamine = document.getElementById("dobutamine");
    var epinephrine = document.getElementById("epinephrine");
    var norepinephrine = document.getElementById("norepinephrine");
    var coagulation = document.getElementById("platelets");
    // Initialize error message variables
    var errorMessageCardio = "";
    var errorMessageCoagulation = "";

    // Check if all the fields in the Cardiovascular System section are empty
    if (
        meanAtrialPressure.value.trim() === "" &&
        dopamine.value.trim() === "" &&
        dobutamine.value.trim() === "" &&
        epinephrine.value.trim() === "" &&
        norepinephrine.value.trim() === ""
    ) {
        errorMessageCardio += "<div>Please fill at least one of the fields.</div>";
        // Add red border to all input fields in Cardiovascular section
        meanAtrialPressure.style.border = "1px solid red";
        dopamine.style.border = "1px solid red";
        dobutamine.style.border = "1px solid red";
        epinephrine.style.border = "1px solid red";
        norepinephrine.style.border = "1px solid red";
        coagulation.style.border = "";
    } else {
        // Remove red border from all input fields in Cardiovascular section if there are no errors
        meanAtrialPressure.style.border = "";
        dopamine.style.border = "";
        dobutamine.style.border = "";
        epinephrine.style.border = "";
        norepinephrine.style.border = "";
        coagulation.style.border = "";
    }

    // Check if the "Coagulation" field is empty
    if (coagulation.value.trim() === "") {
        errorMessageCoagulation += "<div>Please fill in the Coagulation field.</div>";
        // Add red border to Coagulation field
        coagulation.style.border = "1px solid red";
    } else {
        // Remove red border from Coagulation field if there are no errors
        coagulation.style.border = "";
    }

    // Display error messages in the cardiovascular error-message container
    var cardiovascularErrorMessageContainer = document.getElementById("error-message");
    cardiovascularErrorMessageContainer.innerHTML = errorMessageCardio;

    // Display error messages in the Coagulation error-message container
    var coagulationErrorMessageContainer = document.getElementById("error-message-coagulation");
    coagulationErrorMessageContainer.innerHTML = errorMessageCoagulation;

    // Prevent form submission if there are validation errors in either section
    if (errorMessageCardio !== "" || errorMessageCoagulation !== "") {
        return false;
    }

    return true; // Return true if there are no validation errors
}



<?php
// Function to calculate points based on Glasgow Coma Scale Score
function calculateGlasgowComaScalePoints($score) {
    $points = 0; // Initialize points variable

    // Calculate points based on the Glasgow Coma Scale Score
    if ($score === 15) {
        $points = 0;
    } elseif ($score >= 13 && $score <= 14) {
        $points = 1;
    } elseif ($score >= 10 && $score <= 12) {
        $points = 2;
    } elseif ($score >= 6 && $score <= 9) {
        $points = 3;
    } elseif ($score < 6) {
        $points = 4;
    }

    return $points;
}

function calculateRespiratoryPoints($selectedOption, $isMechanicallyVented) {
    $points = 0; // Initialize points variable

    // Calculate points based on the selected option and mechanical ventilation
    if ($selectedOption === 'option1') {
        $points = 0;
    } elseif ($selectedOption === 'option2') {
        $points = 1;
    } elseif ($selectedOption === 'option3') {
        $points = 2;
    } elseif ($selectedOption === 'option4') {
        // If < 200 (26.7) and mechanically vented, check if mechanically vented
        $points = $isMechanicallyVented ? 3 : 0;
    } elseif ($selectedOption === 'option5') {
        // If < 100 (13.3) and mechanically vented, check if mechanically vented
        $points = $isMechanicallyVented ? 4 : 0;
    }

    return $points;
}

// Function to calculate liver points in PHP
function calculateLiverPoints($selectedOption) {
    $points = 0; // Initialize points variable

    // Calculate points based on the selected option
    switch ($selectedOption) {
        case 'option1':
            $points = 0;
            break;
        case 'option2':
            $points = 1;
            break;
        case 'option3':
            $points = 2;
            break;
        case 'option4':
            $points = 3;
            break;
        case 'option5':
            $points = 4;
            break;
        default:
            // Handle any unexpected or default case here
            break;
    }

    return $points;
}

function calculateRenalPoints($selectedOption) {
    // Initialize points variable
    $points = 0;

    // Assign points based on the selected option
    switch ($selectedOption) {
        case "option1":
            $points = 0;
            break;
        case "option2":
            $points = 1;
            break;
        case "option3":
            $points = 2;
            break;
        case "option4":
            $points = 3;
            break;
        case "option5":
            $points = 4;
            break;
        default:
            // Handle any unexpected or default case here
            break;
    }

    // Return the calculated points
    return $points;
}

function calculateCoagulationPoints($plateletsValue) {
    // Initialize points variable
    $points = 0;

    // Convert the platelets value to a number (float)
    $plateletsValue = floatval($plateletsValue);

    // Assign points based on the platelets value
    if (is_numeric($plateletsValue)) {
        if ($plateletsValue >= 150) {
            $points = 0;
        } else if ($plateletsValue < 150 && $plateletsValue >= 100) {
            $points = 1;
        } else if ($plateletsValue < 100 && $plateletsValue >= 50) {
            $points = 2;
        } else if ($plateletsValue < 50 && $plateletsValue >= 20) {
            $points = 3;
        } else {
            $points = 4;
        }
    }

    // Return the calculated points
    return $points;
}

function calculateCardiovascularPoints($mapInput, $dopamineInput, $dobutamineInput, $epinephrineInput, $norepinephrineInput) {
    // Initialize points variable
    $points = 0;

    // Check Mean Atrial Pressure (MAP)
    if (!is_nan($mapInput) && $mapInput >= 70) {
        $points = 0;
    }

    // Check Dopamine and Dobutamine
    if (!is_nan($dopamineInput) && !is_nan($dobutamineInput)) {
        if ($dopamineInput <= 5 || $dobutamineInput <= 5) {
            $points = 2;
        }
    }

    // Check Dopamine, Epinephrine, and Norepinephrine
    if (!is_nan($dopamineInput) && !is_nan($epinephrineInput) && !is_nan($norepinephrineInput)) {
        if ($dopamineInput > 5 && $epinephrineInput <= 0.1 && $norepinephrineInput <= 0.1) {
            $points = 3;
        }
    }

    // Check Dopamine, Epinephrine, and Norepinephrine for 4 points
    if (!is_nan($dopamineInput) && !is_nan($epinephrineInput) && !is_nan($norepinephrineInput)) {
        if ($dopamineInput > 15 || $epinephrineInput > 0.1 || $norepinephrineInput > 0.1) {
            $points = 4;
        }
    }

    // Return the calculated points
    return $points;
}


function calculateTotalPoints() {
    // Get the Glasgow Coma Scale Score
    $glasgowComaScaleInput = $_POST['glasgow-coma-scale'];
    $score = intval($glasgowComaScaleInput);

    // Calculate points for other systems (Respiratory, Liver, Renal, Coagulation, Cardiovascular)
    $selectedRespiratoryOption = $_POST['respiratory-option']; // Assuming you have a 'respiratory-option' field in your form
    $isMechanicallyVented = isset($_POST['mechanically-vented']) ? true : false; // Assuming you have a 'mechanically-vented' checkbox in your form
    $respiratoryPoints = calculateRespiratoryPoints($selectedRespiratoryOption, $isMechanicallyVented);

    $selectedLiverOption = $_POST['liver-option']; // Assuming you have a 'liver-option' field in your form
    $liverPoints = calculateLiverPoints($selectedLiverOption);

    $selectedRenalOption = $_POST['renal-option']; // Assuming you have a 'renal-option' field in your form
    $renalPoints = calculateRenalPoints($selectedRenalOption);

    $plateletsValue = $_POST['platelets']; // Assuming you have a 'platelets' field in your form
    $coagulationPoints = calculateCoagulationPoints($plateletsValue);

    $mapInput = floatval($_POST['map-input']); // Assuming you have a 'map-input' field in your form
    $dopamineInput = floatval($_POST['dopamine-input']); // Assuming you have a 'dopamine-input' field in your form
    $dobutamineInput = floatval($_POST['dobutamine-input']); // Assuming you have a 'dobutamine-input' field in your form
    $epinephrineInput = floatval($_POST['epinephrine-input']); // Assuming you have an 'epinephrine-input' field in your form
    $norepinephrineInput = floatval($_POST['norepinephrine-input']); // Assuming you have a 'norepinephrine-input' field in your form
    $cardiovascularPoints = calculateCardiovascularPoints($mapInput, $dopamineInput, $dobutamineInput, $epinephrineInput, $norepinephrineInput);

    // Calculate points for Glasgow Coma Scale
    $glasgowComaPoints = calculateGlasgowComaScalePoints($score);

    // Sum up the points from all systems
    $totalPoints = $glasgowComaPoints + $respiratoryPoints + $liverPoints + $renalPoints + $coagulationPoints + $cardiovascularPoints;

    // Display the total points on the results.php page
    echo $totalPoints;
    
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="js/script.js"></script>
</head>
<body>
    <header>
        <h1>SOFA Score Calculator</h1>
        <!-- Display patient details -->
        <!-- Display SOFA score components and final score -->
        <p>Patient Details:</p>
        <p>NHI: <?php echo isset($_COOKIE['patient-nhi']) ? $_COOKIE['patient-nhi'] : ''; ?></p>
        <p>Surname: <?php echo isset($_COOKIE['patient-surname']) ? $_COOKIE['patient-surname'] : ''; ?></p>
        <p>First Name: <?php echo isset($_COOKIE['patient-firstname']) ? $_COOKIE['patient-firstname'] : ''; ?></p>
    </header>
    <section>
        <h2>SOFA Score Components</h2>

        <h2>Respiratory System</h2>
        <p>Respiratory Score: <?php echo $respiratoryPoints; ?></p>

        <h2>Nervous System</h2>
        <p>Nervous System Score:<?php echo $nervousPoints; ?> </p>
        
        <h2>Cardiovascular System</h2>
        <p>Cardiovascular System Score:  <?php echo $cardiovascularPoints; ?></p>
        
        <h2>Liver System</h2>
        <p>Liver System Score:  <?php echo $liverPoints; ?> </p>
        
        <h2>Coagulation</h2>
        <p>Coagulation  Score: <?php echo $coagulationPoints; ?></p>
        
        <h2>Renal System</h2>
        <p>Renal System Score:  <?php echo $renalPoints; ?></p>

        <p> Your SOFA Score was: <?php echo $totalPoints; ?> </p>
    </section>
</body>
</html>

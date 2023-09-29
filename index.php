<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="JS/script.js"></script>
    <title>SOFA Score Calculator</title>
</head>
<body>

<?php
    if (isset($_COOKIE["NHI-Number"]) && isset($_COOKIE["patient-surname"]) && isset($_COOKIE["patient-firstname"])) {
        $fname = $_COOKIE["patient-firstname"];
        $lname = $_COOKIE["patient-surname"];
        $nhi = $_COOKIE["NHI-Number"];
    } else {
        $fname = '';
        $lname = '';
        $nhi = '';
    }

    // Validate and set the cookies when the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nhiRegex = '/^[A-Z0-9]+$/'; // Modify the regex as needed
        if (isset($_POST['nhi']) && preg_match($nhiRegex, $_POST['nhi'])) {
            $nhi = $_POST['nhi'];
            setcookie("NHI-Number", $nhi, time() + (86400 * 30), "/");
        }

        if (isset($_POST['surname'])) {
            $lname = $_POST['surname'];
            setcookie("patient-surname", $lname, time() + (86400 * 30), "/");
        }

        if (isset($_POST['firstname'])) {
            $fname = $_POST['firstname'];
            setcookie("patient-firstname", $fname, time() + (86400 * 30), "/");
        }
    }
?>

<div id ="container">
    <header>
        <h1>SOFA Score Calculator</h1>    
        <p style="text-align: left;">Calculate the Sequential Organ Failure Assessment (SOFA) score for ICU patients.With higher scores indicating more severe organ dysfunction and a worse prognosis, 
            the Sequential Organ Failure Assessment (SOFA) is a medical test used to evaluate the level of organ malfunction in critically ill patients.</p>
    </header>
    <form id="form" action="sofa.php" method="post">
        <div id="log-in" style="background: #95c2ef;">
            <h2> Log-in </h2>
            <b><label for="nhi">NHI Number</label></b>
            <input id="nhi" name="nhi" type="text" value="<?php echo $nhi; ?>" style="padding: 5px; margin-bottom: 10px">
            
            <b><label for="surname">Patient Surname</label></b>
            <input type="text" id="surname" name="surname" value="<?php echo $lname; ?>" style="padding: 5px; margin-bottom: 10px">

            <b><label for="firstname">Patient First Name</label></b>
            <input type="text" id="firstname" name="firstname" value="<?php echo $fname; ?>" style="padding: 5px; margin-bottom: 10px">
            <!-- Error message container -->
            <div class="error-message" id="error-message"></div>

            <button type="button" onclick="validateForm()">Submit</button>
        </div>
    </form>
</div>
</body>
</html>

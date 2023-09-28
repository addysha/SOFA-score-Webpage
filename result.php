
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <script src="JS/script.js"></script>
</head>
<body>
<?php
    $points = 0;
    $respiratoryPoints = 0;
    $nervousPoints = 0;
    $cardiovascularPoints=0;
    $liverPoints=0;
    $coagulationPoints=0;
    $kidneyPoints=0;
    
    

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

    

    // get the information from the sofa.php file
    $respiratory = $_POST["respiratory-option"];
    $radio_respi = $_POST["mechanically-vented"];
    $nervous = $_POST["glasgow-coma-scale"];

    $map = $_POST["mean-atrial-pressure"];
    $dopamine = $_POST["dopamine"];
    $dobutamine = $_POST["dobutamine"];
    $epinephrine = $_POST["epinephrine"];
    $norepinephrine = $_POST["norepinephrine"];

    $liver = $_POST["liver-option"];
    $coagulation = $_POST["platelets"];
    $kidney = $_POST["creatinine"];
    

    // Respritory
    // Define an array to map respiratory options to points
    $respiratoryPointsMap = [
        'option1-res' => 0,
        'option2-res' => 1,
        'option3-res' => 2,
        'option4-res' => 3,
        'option5-res' => 4
    ];
    // Check if the selected option exists in the mapping array, and assign points accordingly
    if (isset($respiratoryPointsMap[$respiratory])) {
        $respiratoryPoints = $respiratoryPointsMap[$respiratory];
    } 

    

    //Nervous system
    if ($nervous == 15) {
        $nervousPoints = 0;
    } else if ($nervous >= 13 && $nervous <= 14) {
        $nervousPoints = 1;
    } else if ($nervous >= 10 && $nervous <= 12) {
        $nervousPoints = 2;
    } else if ($nervous >= 6 && $nervous <= 9) {
        $nervousPoints = 3;
    } else {
        $nervousPoints = 4;
    }
    
   //Cardio Logic
   if ($dopamine > 15 || $epinephrine > 0.1 || $norepinephrine > 0.1){
        $cardiovascularPoints = 4;
    }else if ($dopamine > 5 || ( $epinephrine != "" && $epinephrine <= 0.1) || ($norepinephrine != "" && $norepinephrine <=0.1)){
        $cardiovascularPoints = 3;
    } else if(($dopamine != "" && $dopamine <= 5) || ($dopamine != "" && $dopamine != 0)){
        $cardiovascularPoints = 2;
    } else if ($map < 70){
        $cardiovascularPoints = 1;
    } else if ($map >= 70){
        $cardiovascularPoints = 0;
    }


    //Liver
    // Define an associative array to map the selected option to points
    $liverPointsMap = [
        'option1-liv' => 0,
        'option2-liv' => 1,
        'option3-liv' => 2,
        'option4-liv' => 3,
        'option5-liv' => 4
    ];

    // Check if the selected option exists in the mapping array, and assign points accordingly
    if (isset($liverPointsMap[$liver])) {
        $liverPoints = $liverPointsMap[$liver];
    } 


    //Coagulation points
    if ($coagulation >= 150) {
        $coagulationPoints = 0;
    } else if ($coagulation < 20) {
        $coagulationPoints = 4;
    } else if ($coagulation < 50) {
        $coagulationPoints = 3;
    } else if ($coagulation < 100) {
        $coagulationPoints = 2;
    } else if ($coagulation < 150) {
        $coagulationPoints = 1;
    }
    

    //Kidney
    if ($kidney == "option1 ren") {
        $kidneyPoints = 0;
    } else if ($kidney == "option2 ren") {
        $kidneyPoints = 1;
    } else if ($kidney == "option3 ren") {
        $kidneyPoints = 2;
    } else if ($kidney == "option4 ren") {
        $kidneyPoints = 3;
    } else if ($kidney == "option5 ren") {
        $kidneyPoints = 4;
    }

    $points = $respiratoryPoints + $cardiovascularPoints + $nervousPoints + $liverPoints + $coagulationPoints + $kidneyPoints
?>

<div id="container">
    <header>
        <h1>SOFA Score Results</h1>
        <div id="Patient-info">
            <p style="margin-right: 30px;">Patient Details</p>
            <p style="margin-right: 30px;">NHI: <?php echo strtoupper($nhi)?> </p>
            <p style="margin-right: 30px;">Name: <?php echo ucfirst(strtolower($fname));
                      echo " ";
                      echo ucfirst(strtolower($lname))?></p>
            
        </div>
    </header>
    <section>
        <div class ="Points-container">
            <h2>SOFA Score Components</h2>
            <h3>Total points: <?php echo $points;?>/24 </h3>

            <ul>
                <li>Respritory +<?php echo $respiratoryPoints;?> points</li>
                <li>Cardiovascular System +<?php echo $cardiovascularPoints;?> points</li>
                <li>Nervous System +<?php echo $nervousPoints;?> points</li>
                <li>Liver +<?php echo $liverPoints;?> points</li>
                <li>Kidneys +<?php echo $kidneyPoints;?> points</li>
                <li>Coagulation +<?php echo $coagulationPoints;?> points</li>

            </ul>
            
        </div>
    </section>
    <!-- Add this at the bottom of your HTML body -->
        <div class="link">
             Click on this link to see how your score was calculated: <a href="https://en.wikipedia.org/wiki/SOFA_score" target="_blank">"https://en.wikipedia.org/wiki/SOFA_score"</a>
        </div>
</div>
</body>
</html>

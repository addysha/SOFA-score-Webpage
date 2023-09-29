
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
    <header>
        <h1>SOFA Score Calculator</h1>
        <div class="patient-details" style="display: flex;justify-content: center; background: #1063b696;">
            <!-- Display patient details -->
            <p style="margin-right: 50px;">Patient Details</p>
            <p style="margin-right: 30px;">NHI: <?php echo $_POST['nhi']; ?></p>
            <p style="margin-right: 30px;">Surname: <?php echo $_POST['surname']; ?></p>
            <p style="margin-right: 30px;">First Name: <?php echo $_POST['firstname'];?></p>
        </div>
    </header>
    <form action="result.php" method="post" onsubmit="return ValidateCardio();">
        <!-- Respiratory System -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Respiratory System</h2>
        <div class="respritory-system"><label for="respiratory-dropdown">PaO2/FiO2 [mmHg (kPa)]:</label>
            <select id="respiratory-dropdown" name="respiratory-option" style="margin-bottom: 30px; padding: 5px;">
            <option value="option1-res">≥ 400 (53.3)</option>
            <option value="option2-res">< 400 (53.3) </option>
            <option value="option3-res">< 300 (40) </option> 
            <option value="option4-res">< 200 (26.7) </option>
            <option value="option5-res">< 100 (13.3) </option>
            <!-- Add more options as needed -->
            </select>
                <div class="mechanically-vented" id="mechanically-vented">
                    <label>Is the patient mechanically ventilated?</label>
                    <input type="radio" id="mechanically-vented-yes" name="mechanically-vented" value="yes" checked>
                    <label for="mechanically-vented-yes">Yes</label>
                    <input type="radio" id="mechanically-vented-no" name="mechanically-vented" value="no">
                    <label for="mechanically-vented-no">No</label>
                <div class="mechanically-vented">
        <!-- Nervous System -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Nervous System</h2>
        <div class="Nervous-system">
            <label for="glasgow-coma-scale">Glasgow Coma Scale Score:</label>
            <input type="range" id="glasgow-coma-scale" name="glasgow-coma-scale" min="0" max="15" style="width: 210px;">
            <p id="glasgow-coma-score-label">0</p>
            <?php
            // Embed PHP variables within JavaScript
            echo '<script>';
            echo 'const glasgowComaScaleInput = document.getElementById(\'glasgow-coma-scale\');';
            echo 'const glasgowComaScoreLabel = document.getElementById(\'glasgow-coma-score-label\');';

            echo 'glasgowComaScaleInput.addEventListener(\'input\', function() {';
            echo '    glasgowComaScoreLabel.textContent = this.value;';
            echo '});';
            echo '</script>';
            ?>
        </div>
        <!-- Cardiovascular System -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Cardiovascular System</h2>
        <div class="Cardiovascular-system">

            <div class="input-group">
                <label for="mean-atrial-pressure">Mean Atrial Pressure (mmHg):</label>
                <input type="number" id="mean-atrial-pressure" name="mean-atrial-pressure" style="margin-left: 10px;" min="0">
            </div>
            <div class="input-group">
                <label for="dopamine">Dopamine (mcg/kg/min):</label>
                <input type="number" id="dopamine" name="dopamine" style="margin-left: 51px;" min="0">
            </div>
            <div class="input-group">
                <label for="dobutamine">Dobutamine (mcg/kg/min):</label>
                <input type="number" id="dobutamine" name="dobutamine" style="margin-left: 37.5px;" min="0">
            </div>
            <div class="input-group">
                <label for="epinephrine">Epinephrine (mcg/kg/min):</label>
                <input type="number" id="epinephrine" name="epinephrine" style="margin-left: 38.5px;" min="0">
            </div>
            <div class="input-group">
                <label for="norepinephrine">Norepinephrine (mcg/kg/min):</label>
                <input type="number" id="norepinephrine" name="norepinephrine" style="margin-left: 14.5px;" min="0">
            </div>
            <!-- Error message container for cardiovascular section -->
            <div class="error-message" id="error-message"></div>
        </div>
        <!-- Liver System -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Liver System</h2>
        <div class="Liver-system">
            <label for="bilirubin-dropdown">Bilirubin (mg/dL or μmol/L):</label>
                <select id="bilirubin" name="liver-option" style="padding: 5px;">
                    <option value="option1-liv">< 1.2 [< 20] </option>
                    <option value="option2-liv">1.2– 1.9 [20-32]</option>
                    <option value="option3-liv">2.0–5.9 [33-101]</option>
                    <option value="option4-liv">6.0–11.9 [102-204]</option>
                    <option value="option5-liv"> 12.0 [> 204]</option>
                </select>
        </div>
        <!-- Coagulation -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Coagulation</h2>
        <div class="Coagulation">
            <label for="platelets">Platelets (x103/μl):</label>
            <input type="number" id="platelets" name="platelets" style="padding: 5px;" min="0">
            <div class="error-message-coagulation" id="error-message-coagulation"></div>
        </div>
        <!-- Renal System -->
        <h2 style="background: #95c2efa1;;padding: 10px;">Renal System</h2>
        <div class="renal-system">
            <label for="creatinine">Creatinine (mg/dL or μmol/L) or Urine Output:</label>
            <select id="creatinine" name="creatinine" style="padding: 5px;">
                <option value="option1 ren">< 1.2 [< 110]</option>
                <option value="option2 ren">1.2–1.9 [110-170]</option>
                <option value="option3 ren">2.0–3.4 [171-299]</option>
                <option value="option4 ren">3.5–4.9 [300-440] (or < 500 ml/day)</option>
                <option value="option5 ren">> 5.0 [> 440] (or < 200 ml/day)</option>
            </select>
        </div>
        <!-- Add a submit button -->
        <input type="submit" value="Calculate SOFA Score" onclick="ValidateCardio()" >
    </form>
</body>
</html>

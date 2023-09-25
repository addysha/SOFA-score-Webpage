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
        <div class="patient-details" style="display: flex; flex-direction: row;">
            <!-- Display patient details -->
            <p style="margin-right: 50px;">Patient Details</p>
            <p style="margin-right: 30px;">NHI: <?php echo $_POST['nhi']; ?></p>
            <p style="margin-right: 30px;">Surname: <?php echo $_POST['surname']; ?></p>
            <p>First Name: <?php echo $_POST['firstname']; ?></p>
        </div>
    </header>
    <form action="result.php" method="post">
        
        <!-- Respiratory System -->
        <h2>Respiratory System</h2>
        <div class="respritory-system">

            <label for="respiratory-dropdown">PaO2/FiO2 [mmHg (kPa)]:</label>
            <select id="respiratory-dropdown" name="respiratory-option">
            <option value="option1">≥ 400 (53.3)</option>
            <option value="option2">< 400 (53.3) </option>
            <option value="option3">< 300 (40) </option> 
            <option value="option4">< 200 (26.7) </option>
            <option value="option5">< 100 (13.3) </option>
            <!-- Add more options as needed -->
            </select>
                <div class="mechanically-vented">
                    <label>Is the patient mechanically vented?</label>
                    <input type="radio" id="mechanically-vented-yes" name="mechanically-vented" value="yes">
                    <label for="mechanically-vented-yes">Yes</label>
                    <input type="radio" id="mechanically-vented-no" name="mechanically-vented" value="no">
                     <label for="mechanically-vented-no">No</label>
                <div class="mechanically-vented">

        </div>

        <!-- Nervous System -->
        <h2>Nervous System</h2>
        <div class="Nervous-system">

            <label for="glasgow-coma-scale">Glasgow Coma Scale Score:</label>
            <input type="range" id="glasgow-coma-scale" name="glasgow-coma-scale" min="0" max="15">
            <p id="glasgow-coma-score-label">0</p>

        </div>

        <!-- Cardiovascular System -->
        <h2>Cardiovascular System</h2>
        <div class="Cardiovascular-system">

            <div class="input-group">
                <label for="mean-atrial-pressure">Mean Atrial Pressure (mmHg):</label>
                <input type="text" id="mean-atrial-pressure" name="mean-atrial-pressure">
            </div>
            <div class="input-group">
                <label for="dopamine">Dopamine (mcg/kg/min):</label>
                <input type="text" id="dopamine" name="dopamine">
            </div>
            <div class="input-group">
                <label for="dobutamine">Dobutamine (mcg/kg/min):</label>
                <input type="text" id="dobutamine" name="dobutamine">
            </div>
            <div class="input-group">
                <label for="epinephrine">Epinephrine (mcg/kg/min):</label>
                <input type="text" id="epinephrine" name="epinephrine">
            </div>
            <div class="input-group">
                <label for="norepinephrine">Norepinephrine (mcg/kg/min):</label>
                <input type="text" id="norepinephrine" name="norepinephrine">
            </div>

        </div>



        <!-- Liver System -->
        <h2>Liver System</h2>
        <div class="Liver-system">
            
            <label for="bilirubin-dropdown">Bilirubin (mg/dL or μmol/L):</label>
                <select id="bilirubin" name="bilirubin">
                    <option value="option1">< 1.2 [< 20] </option>
                    <option value="option2">1.2 – 1.9 [20-32]</option>
                    <option value="option3">2.0–5.9 [33-101]</option>
                    <option value="option4">6.0–11.9 [102-204]</option>
                    <option value="option5"> 12.0 [> 204]</option>
                </select>

        </div>



        <!-- Coagulation -->
        <h2>Coagulation</h2>
        <div class="Coagulation">

            <label for="platelets">Platelets (x103/μl):</label>
            <input type="text" id="platelets" name="platelets">

        </div>


        <!-- Renal System -->
        <h2>Renal System</h2>
        <div class="renal-system">

            <label for="creatinine">Creatinine (mg/dL or μmol/L) or Urine Output:</label>
            <input type="text" id="creatinine" name="creatinine">

        </div>


        <!-- Add a submit button -->
        <input type="submit" value="Calculate SOFA Score">


    </form>


    <script> 
     const glasgowComaScaleInput = document.getElementById('glasgow-coma-scale');
     const glasgowComaScoreLabel = document.getElementById('glasgow-coma-score-label');
     glasgowComaScaleInput.addEventListener('input', function() {
     glasgowComaScoreLabel.textContent = this.value;
     });
    </script>
</body>
</html>

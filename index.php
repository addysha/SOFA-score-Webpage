<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="js/script.js"></script>
    <title>SOFA Score Calculator</title>
</head>
<body>
    <header>
        <h1>SOFA Score Calculator</h1>
        <p>Calculate the Sequential Organ Failure Assessment (SOFA) score for ICU patients.</p>
    </header>
    <form id="form" action="sofa.php" method="post">
        <label for="nhi">NHI Number:</label>
        <input id="nhi" name="nhi" type="text">
        
        <label for="surname">Patient Surname:</label>
        <input type="text" id="surname" name="surname">

        <label for="firstname">Patient First Name:</label>
        <input type="text" id="firstname" name="firstname">
        <!-- Error message container -->
        <div class="error-message" id="error-message"></div>

        <button type="button" onclick="validateForm()">Submit</button>
    </form>
    <script>
    
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>SOFA Score Calculator</title>
</head>
<body>
    <header>
        <h1>SOFA Score Calculator</h1>
        <p>Calculate the Sequential Organ Failure Assessment (SOFA) score for ICU patients.</p>
    </header>
    <form action="sofa.php" method="post">
        <label for="nhi">NHI Number:</label>
        <input type="text" id="nhi" name="nhi" required>

        <label for="surname">Patient Surname:</label>
        <input type="text" id="surname" name="surname" required>

        <label for="firstname">Patient First Name:</label>
        <input type="text" id="firstname" name="firstname" required>
        
        <input type="submit" value="Submit">
    </form>
    <script src="js/script.js"></script>
</body>
</html>

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
        <p>NHI: <?php echo $_COOKIE['patient-nhi']; ?></p>
        <p>Surname: <?php echo $_COOKIE['patient-surname']; ?></p>
        <p>First Name: <?php echo $_COOKIE['patient-firstname']; ?></p>
    </header>
    <section>
        <h2>SOFA Score Components</h2>
        <!-- Display SOFA score components and their values here -->
    </section>
</body>
</html>

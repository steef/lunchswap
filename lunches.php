<?php
if($_SERVER["REQUEST_METHOD"] === "POST") {

    // Create connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lunchswap_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form info
    $name = $_POST['name'];
    $type = $_POST['type'];
    $allergy = $_POST['allergy'];

    // Save to database
    $sql = "INSERT INTO lunches (name, type, allergy) VALUES (?,?,?)";
    $stmt= $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $type, $allergy);
    $stmt->execute();
    $conn->close();
}

?>

<html>
    <head>
        <title>LunchSwap 😋</title>
    </head>
    <body>
        <h2>Week 44 - Fill in your lunches 🍽</h2>
        <a href="index.php">Click here to go back</a><br/><br/>
        <form action="lunches.php" method="post">
        <p>
            <label for="name">Name</label>
            <input type="text" name="name" id="name">
        </p>
        <p>
            <label for="allergy">Allergy (optional) :</label>
            <input type="text" name="allergy" id="allergy">
        </p>
        <h3>Monday</h3>
        <p>
            <label for="type">Type:</label>
            <select type="text" name="type" id="type">
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <input type="submit" value="Submit">
        </form>
    </body>
</html>

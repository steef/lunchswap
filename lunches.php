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

    // Get basic info
    $name = $_POST['name'];
    $allergy = $_POST['allergy'];

    // Get lunch info
    $lunches = [
        'monday'    => $_POST['monday'],
        'tuesday'   => $_POST['tuesday'],
        'wednesday' => $_POST['wednesday'],
        'thursday'  => $_POST['thursday'],
        'friday'    => $_POST['friday']
    ];

    // Save to database
    foreach ($lunches as $day => $lunch) {
        if ($lunch !== 'no_lunch') {
            $sql = "INSERT INTO lunches (name, type, allergy, luch_at) VALUES (?,?,?,?)";
            $stmt= $conn->prepare($sql);

            $lunch_at = new DateTimeImmutable($day);
            $result = $lunch_at->format('Y-m-d H:i:s');

            $stmt->bind_param("ssss", $name, $lunch, $allergy, $result);
            $stmt->execute();
        }
    }

    // Close connection
    $conn->close();
}

?>

<html>
    <head>
        <title>LunchSwap 😋</title>
    </head>
    <body>
        <h2>
            <?php
            $nextWeek = new DateTimeImmutable('next week');
            $weekNumber = $nextWeek->format("W");

            echo "Week $weekNumber - Fill in your lunches 🍽"
            ?>
        </h2>
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
        <h3>Lunches</h3>
        <p>
            <label for="monday">Monday:</label>
            <select type="text" name="monday" id="monday">
                <option value="no_lunch">No lunch</option>
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <p>
            <label for="tuesday">Tuesday:</label>
            <select type="text" name="tuesday" id="tuesday">
                <option value="no_lunch">No lunch</option>
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <p>
            <label for="wednesday">Wednesday:</label>
            <select type="text" name="wednesday" id="wednesday">
                <option value="no_lunch">No lunch</option>
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <p>
            <label for="thursday">Thursday:</label>
            <select type="text" name="thursday" id="thursday">
                <option value="no_lunch">No lunch</option>
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <p>
            <label for="friday">Friday:</label>
            <select type="text" name="friday" id="friday">
                <option value="no_lunch">No lunch</option>
                <option value="meat_fish">Meat/Fish</option>
                <option value="vegetarian">Vegetarian</option>
                <option value="vegan">Vegan</option>
            </select>
        </p>
        <input type="submit" value="Submit">
        </form>
    </body>
</html>

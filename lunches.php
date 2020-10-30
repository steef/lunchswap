<?php
//if($_SERVER["REQUEST_METHOD"] === "POST"){
//    $username = $_POST['name']; // @todo parse to string
//    $bool = true;
//
//    $link = mysqli_connect("localhost", "root","") or die(mysqli_error($link)); //Connect to server
//    mysqli_select_db($link, "lunchswap_db") or die("Cannot connect to database"); //Connect to database
//    $query = mysqli_query($link, "Select * from lunches"); //Query the users table
//    while($row = mysqli_fetch_array($query)) //display all rows from query
//    {
//        $table_users = $row['name']; // the first username row is passed on to $table_users, and so on until the query is finished
//        if($username == $table_users) // checks if there are any matching fields
//        {
//            $bool = false; // sets bool to false
//            Print '<script>alert("Username has been taken!");</script>'; //Prompts the user
//            Print '<script>window.location.assign("lunches.php");</script>'; // redirects to register.php
//        }
//    }
//
//    if($bool) // checks if bool is true
//    {
//        mysqli_query($link, "INSERT INTO users (username) VALUES ('$username')"); //Inserts the value to table users
//        Print '<script>alert("Successfully Registered!");</script>'; // Prompts the user
//        Print '<script>window.location.assign("success.php");</script>'; // redirects to register.php
//    }
//
//}

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lunchswap_db";

    $conn = new mysqli($servername, $username, $password, $dbname); // Create connection

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get form info

    $name = $_POST['name'];
    $type = $_POST['type'];
    $allergy = $_POST['allergy'];

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

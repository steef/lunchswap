<?php

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

// Get results
$nextWeek = new DateTimeImmutable('next week');
$dateNextWeek = $nextWeek->format('Y-m-d');
$sql = "SELECT name, type, allergy, luch_at FROM lunches WHERE luch_at >= '{$dateNextWeek}' ORDER BY luch_at";
$result = $conn->query($sql);

$nextWeek = new DateTimeImmutable('next week');
$weekNumber = $nextWeek->format("W");

echo "<html>
<head>
    <title>LunchSwap 😋</title>
</head>
<body>
    <h2>Week $weekNumber - Lunch overview 📝</h2>
    <a href=\"index.php\">Click here to go back</a><br/><br/>";

// Show results in table
echo "<table border='1'>
<tr>
<th>Name</th>
<th>Lunch</th>
<th>Allergy</th>
<th>Day</th>
</tr>";

while($row = mysqli_fetch_array($result))
{
    $name = $row['name'];
    $type = $row['type'];
    $allergy = $row['allergy'] ?: "No";
    $lunchAt = $row['luch_at'];

    $lunchAtDate = new DateTimeImmutable($lunchAt);
    $lunchDay = $lunchAtDate->format('l');

    echo "<tr>";
    echo "<td>{$name}</td>";
    echo "<td>{$type}</td>";
    echo "<td>{$allergy}</td>";
    echo "<td>{$lunchDay}</td>";
    echo "</tr>";
}
echo "</table>";

echo "    </body>
</html>";

// Close connection
$conn->close();

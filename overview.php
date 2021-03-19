<?php

include 'Db.php';
include 'Template.php';

$db       = new Db();
$template = new Template();

$nextWeek     = new DateTimeImmutable('next week');
$dateNextWeek = $nextWeek->format('Y-m-d');
$weekNumber   = $nextWeek->format("W");

$lunchData = [];
$lunchData['Lunches']    = $db->getData('lunches', "luch_at >= '{$dateNextWeek}'", 'luch_at');
$lunchData['weekNumber'] = $weekNumber;
$lunchData['Authors']    = [
    ['Name' => 'Steef'], ['Name' => 'Tiger']
];

echo $template->render('overview', $lunchData);

/*foreach ($lunchData as $row)
{
    $name = $row['name'];
    $type = $row['type'];
    $allergy = $row['allergy'] ?: "No";
    $lunchAt = $row['luch_at'];

    if ($type === "meat_fish") {
        $type = "Meat/Fish";
    }
    $mealType = ucfirst($type);

    $lunchAtDate = new DateTimeImmutable($lunchAt);
    $lunchDay = $lunchAtDate->format('l');

    echo "<tr>";
    echo "<td>{$name}</td>";
    echo "<td>{$mealType}</td>";
    echo "<td>{$allergy}</td>";
    echo "<td>{$lunchDay}</td>";
    echo "</tr>";
}
echo "</table>";

echo "    </body>
</html>";*/

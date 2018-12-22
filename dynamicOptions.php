<?php
// Shows errors instead of a blank white php page
ini_set('display_startup_errors', true);
error_reporting(E_ALL);
ini_set('display_errors', true);

$db = mysqli_connect("localhost", "rivero2r", "rivero28", "rivero2r");
if (!$db)
{
    exit();
}

$selectAssociatedOptions = "SELECT answers.answer, poll.createdDateTime FROM answers INNER JOIN poll ON poll.poll_ID = answers.poll_ID WHERE createdDateTime IN (SELECT MAX(createdDateTime) FROM poll GROUP BY poll_ID) ORDER BY createdDateTime DESC LIMIT 25";

if ($result = mysqli_query($db, $selectAssociatedOptions))
{
    $json = array("options" => array());
    while ($row = mysqli_fetch_assoc($result))
    {
        $json["options"][] = $row;
    }
    print json_encode($json);
    mysqli_free_result($result);
}

mysqli_close($db);
?>
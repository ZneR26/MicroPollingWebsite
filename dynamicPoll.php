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
    
    $selectRecentPolls = "SELECT * FROM poll WHERE createdDateTime IN (SELECT MAX(createdDateTime) FROM poll GROUP BY poll_ID) ORDER BY createdDateTime DESC LIMIT 5";
    
    if ($result = mysqli_query($db, $selectRecentPolls))
    {
        $json = array("polls" => array());
        while ($row = mysqli_fetch_assoc($result))
        {
            $json["polls"][] = $row;
        }
        print json_encode($json);
        mysqli_free_result($result);
    }
    
    mysqli_close($db);
?>

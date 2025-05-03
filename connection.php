<?php
function OpenCon()
{
    $con = mysqli_connect(
        "db5017622025.hosting-data.io",
        "dbu4122094",
        "pm5!u4RCaTGyCfB",
        "dbs14102500",
        "3306"
    );

    if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);
    }

    return $con;
}

function CloseCon($con)
{
    $con->close();
}

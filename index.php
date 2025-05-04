<?php

include 'connection.php';

$con = OpenCon();

$sql = "SELECT *  FROM ESP_COMPONENTS LIMIT 500";
$sqlData = mysqli_query($con, $sql);

CloseCon($con);

?>

<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Bewässerungssystem</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
</head>

<body>
    <main>
        <section class="first-section">
            <h2>Data From ESP31</h2>

            <table>
                <thead>
                    <tr>
                        <th class="th-sm">Id</th>
                        <th class="th-sm">Data</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (!$sqlData) {
                        die("Query to show fields from table failed");
                    }

                    $fields_num = mysqli_num_fields($sqlData);
                    while ($row = mysqli_fetch_row($sqlData)) {
                        echo "<tr>";
                        $ledValue = $row[1];
                        foreach ($row as $cell) {
                            echo "<td>$cell</td>";
                        }

                        echo "</tr>\n";
                    }
                    ?>
                </tbody>
            </table>
        </section>
        <section class="second-section">
            <?php
            if ($ledValue == 1) {
                $switchState = 'checked';
                $imgSrc = 'assets/led_on.png';
            } else {
                $switchState = '';
                $imgSrc = 'assets/led_off.png';
            }
            ?>
            <div class="led-container">
                <img src="<?php echo $imgSrc; ?>" alt="LED Off" class="led-img" id="led-img">
            </div>
            <label class="switch">
                <input type="checkbox" id="led-switch" <?php echo $switchState; ?>>
                <span class="slider round"></span>
            </label> 
 
            <h3>Turn Off and On the LED! New Changes</h3>
        </section>    
        <section class="dht-data"> 
            <div class="table-wrapper">
                <div class="table-key-value-wrapper">
                    <div class="table-key">Humidity:</div>
                    <div class="humidity-percent">50%</div>
                </div>
                <div class="table-key-value-wrapper">
                    <div class="table-key">Temperature:</div>
                    <div class="celcius-degree">30°C</div>
                </div>
            </div>
        </section>
    </main>
    <script src="index.js"></script>
</body>

</html>
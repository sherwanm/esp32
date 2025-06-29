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

                    <?php
                    if (!$sqlData) {
                        die("Query to show fields from table failed");
                    }

                    $fields_num = mysqli_num_fields($sqlData);
                    while ($row = mysqli_fetch_row($sqlData)) {
                       

                        if ($row[0] == 10) {
                            $ledValue = $row[1];
                        }
                        if ($row[0] == 11) {
                            $humidity = $row[1];
                            $humidityUpdate = $row[2];
                        }

                        if ($row[0] == 12) {
                            $tempo = $row[1];
                            $tempoUpdate = $row[2];
                        } 
                    } 
                    ?>
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

            <h3>Turn Off and On the LED! </h3>
        </section>
        <section class="dht-data">
                <h2>DHT Data</h2> 
            <div class="table-wrapper">
                <div class="table-key-value-wrapper row row-1">
                    <div class="table-key column column-1">Type</div>
                    <div class="humidity-percent column column-2">Value </div>
                    <div class="humidity-updated column column-3">Last update </div>
                </div>
                <div class="table-key-value-wrapper row row-2">
                    <div class="table-key column column-1">Humidity:</div>
                    <div class="humidity-percent column column-2"><?php echo  $humidity ?>% </div>
                    <div class="humidity-updated column column-3"><?php echo  $humidityUpdate ?> </div>
                </div>
                <div class="table-key-value-wrapper row row-3">
                    <div class="table-key column column-1">Temperature:</div>
                    <div class="celcius-degree column column-2"><?php echo  $tempo  ?>°C</div>
                    <div class="celcius-degree-updated column column-3"><?php echo  $tempoUpdate ?> </div>
                </div>
            </div>
        </section>
    </main>
    <script src="index.js"></script>
</body>

</html>
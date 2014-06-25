<?php

// Get new instance of PDO object
$dbc = new PDO('mysql:host=127.0.0.1;dbname=todo_db', 'Andrew', 'letmein');

// Tell PDO to throw exceptions on error
$dbc->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

echo $dbc->getAttribute(PDO::ATTR_CONNECTION_STATUS) . "\n";


// Create the query and assign to var

// making table for parks
$query = 'CREATE TABLE todo_list (
    id INT UNSIGNED NOT NULL AUTO_INCREMENT,
    task VARCHAR(100) NOT NULL,
    PRIMARY KEY (id)
)';

// // Run query, if there are errors they will be thrown as PDOExceptions
$dbc->exec($query);

?>

<!-- // $parks = [
//     ['name' => 'Acadia',           'location' => 'Maine',          'date_established' => '1919-02-26', 'area_in_acres' => '47389',  'description' => "Covering most of Mount Desert Island and other coastal islands, Acadia features the tallest mountain on the Atlantic coast of the United States, granite peaks, ocean shoreline, woodlands, and lakes. There are freshwater, estuary, forest, and intertidal habitats."],
//     ['name' => 'American Samoa',   'location' => 'American Samoa', 'date_established' => '1988-10-31', 'area_in_acres' => '9000',   'description' => "The southernmost national park is on three Samoan islands and protects coral reefs, rainforests, volcanic mountains, and white beaches. The area is also home to flying foxes, brown boobies, sea turtles, and 900 species of fish."],
//     ['name' => 'Arches',           'location' => 'Utah',           'date_established' => '1971-11-12', 'area_in_acres' => '76518',  'description' => "This site features more than 2,000 natural sandstone arches, including the famous Delicate Arch. In a desert climate, millions of years of erosion have led to these structures, and the arid ground has life-sustaining soil crust and potholes, which serve as natural water-collecting basins. Other geologic formations are stone columns, spires, fins, and towers."],
//     ['name' => 'Badlands',         'location' => 'South Dakota',   'date_established' => '1978-11-10', 'area_in_acres' => '242755', 'description' => "The Badlands are a collection of buttes, pinnacles, spires, and grass prairies. It has the world's richest fossil beds from the Oligocene epoch, and the wildlife includes bison, bighorn sheep, black-footed ferrets, and swift foxes."],
//     ['name' => 'Big Bend',         'location' => 'Texas',          'date_established' => '1944-06-12', 'area_in_acres' => '801163', 'description' => "Named for the prominent bend in the Rio Grande along the US–Mexico border, this park encompasses a large and remote part of the Chihuahuan Desert. Its main attraction is backcountry recreation in the arid Chisos Mountains and in canyons along the river. A wide variety of Cretaceous and Tertiary fossils as well as cultural artifacts of Native Americans also exist within its borders."],
//     ['name' => 'Biscayne',         'location' => 'Florida',        'date_established' => '1980-06-28', 'area_in_acres' => '172924', 'description' => "Located in Biscayne Bay, this park at the north end of the Florida Keys has four interrelated marine ecosystems: mangrove forest, the Bay, the Keys, and coral reefs. Threatened animals include the West Indian Manatee, American crocodile, various sea turtles, and peregrine falcon."],
//     ['name' => 'Black Canyon of the Gunnison',  'location' => 'Colorado', 'date_established' => '1999-10-21', 'area_in_acres' => '32950', 'description' => "The park protects a quarter of the Gunnison River, which slices sheer canyon walls from dark Precambrian-era rock. The canyon features incredibly steep descents, and is a popular site for river rafting and rock climbing. The deep, narrow canyon, made of gneiss and schist, is often in shadow and therefore appears black."],
//     ['name' => 'Bryce Canyon',     'location' => 'Utah',           'date_established' => '1928-02-28', 'area_in_acres' => '35835',  'description' => "Bryce Canyon is a giant geological amphitheater on the Paunsaugunt Plateau. The unique area has hundreds of tall sandstone hoodoos formed by erosion. The region was originally settled by Native Americans and later by Mormon pioneers."],
//     ['name' => 'Canyonlands',      'location' => 'Utah',           'date_established' => '1964-09-12', 'area_in_acres' => '337597', 'description' => "This landscape was eroded into a maze of canyons, buttes, and mesas by the combined efforts of the Colorado River, Green River, and their tributaries, which divide the park into three districts. There are rock pinnacles and other naturally sculpted rock formations, as well as artifacts from Ancient Pueblo peoples."],
//     ['name' => 'Capitol Reef',     'location' => 'Utah',           'date_established' => '1971-12-18', 'area_in_acres' => '241904', 'description' => "The park's Waterpocket Fold is a 100-mile (160 km) monocline that exhibits the Earth's diverse geologic layers. Other natural features are monoliths, sandstone domes, and cliffs shaped like the United States Capitol."]
    
// ];

// $stmt = $dbc->prepare('INSERT INTO National_Parks (name, location, date_established, area_in_acres, description) VALUES (:name, :location, :date_established, :area_in_acres, :description)');

// foreach ($parks as $park) {
//     $stmt->bindValue(':name',              $park['name'], PDO::PARAM_STR);
//     $stmt->bindValue(':location',          $park['location'],  PDO::PARAM_STR);
//     $stmt->bindValue(':date_established',  $park['date_established'],  PDO::PARAM_STR);
//     $stmt->bindValue(':area_in_acres',     $park['area_in_acres'],  PDO::PARAM_STR);
//     $stmt->bindValue(':description',       $park['description'],  PDO::PARAM_STR);

//     $stmt->execute();

//     echo "Inserted ID: " . $dbc->lastInsertId() . PHP_EOL;

    -->
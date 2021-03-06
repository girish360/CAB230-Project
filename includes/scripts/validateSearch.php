<?php
if (!isset($_POST['search'])) return;
require_once __DIR__.'/../../lib/database.php';
require_once __DIR__.'/../functions.php';

// this file validates the data from the search form before redirecting to the results page,
// providing the parameters in a GET request as a query string

$name = (isset($_POST['name']) ? $_POST['name'] : null);
$suburb = (isset($_POST['suburb']) && $_POST['suburb'] != 'default' ? $_POST['suburb'] : null);
$rating = (isset($_POST['rating']) ? $_POST['rating'] : null);
$distance = (isset($_POST['distance']) ? $_POST['distance'] : null);
$location_lat = (isset($_POST['location-lat']) ? $_POST['location-lat'] : null);
$location_long = (isset($_POST['location-long']) ? $_POST['location-long'] : null);

// Check for errors and add error message to array
$errors = array(
    "nameError" => isValidName($name),
    "suburbError" => isValidSuburb($pdo, $suburb),
    "ratingError" => isValidRating($rating),
    "distanceError" => isValidDistance($distance),
    "location_latError" => isValidLocationLat($location_lat),
    "location_longError" => isValidLocationLong($location_long),
);
foreach ($errors as $error) if ($error) return; // If error is not null, exit

// add variables into array so that they may be turned into a query string easily
$data = array('name' => $name, 'suburb' => $suburb, 'rating' => $rating, 'distance' => $distance, 'location-lat' => $location_lat, 'location-long' => $location_long);
$url = getUrl();
header('Location: '.getUrl().'results.php?'.http_build_query($data));
exit();
?>
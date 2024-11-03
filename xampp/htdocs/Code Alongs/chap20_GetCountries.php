<?php
//*** THE USER WILL NEVER SEE THIS PAGE. WE WILL CALL THIS PAGE WITH A LITTLE
//*** ASYNCHONOUS JAVASCRIPT AND DISPLAY THE RESULT AS THE USER IS TYPING.

// Array with every country in the world (imagine this coming from a database)
$world = ["Afghanistan","Albania","Algeria","Andorra","Angola",
"Antigua and Barbuda","Argentina","Armenia","Australia","Austria",
"Azerbaijan","Bahamas","Bahrain","Bangladesh","Barbados","Belarus","Belgium",
"Belize","Benin","Bhutan","Bolivia","Bosnia and Herzegovina","Botswana",
"Brazil","Brunei","Bulgaria","Burkina Faso","Burundi","Cabo Verde","Cambodia",
"Cameroon","Canada","Central African Republic","Chad","Chile","China",
"Colombia","Comoros","Congo (Congo-Brazzaville)","Costa Rica","Croatia",
"Cuba","Cyprus","Czech Republic (Czechia)","Democratic Republic of the Congo",
"Denmark","Djibouti","Dominica","Dominican Republic","East Timor (Timor-Leste)",
"Ecuador","Egypt","El Salvador","Equatorial Guinea","Eritrea","Estonia","Eswatini",
"Ethiopia","Fiji","Finland","France","Gabon","Gambia","Georgia","Germany","Ghana",
"Greece","Grenada","Guatemala","Guinea","Guinea-Bissau","Guyana","Haiti","Honduras",
"Hungary","Iceland","India","Indonesia","Iran","Iraq","Ireland","Israel","Italy",
"Ivory Coast","Jamaica","Japan","Jordan","Kazakhstan","Kenya","Kiribati",
"Korea (North)","Korea (South)","Kosovo","Kuwait","Kyrgyzstan","Laos","Latvia",
"Lebanon","Lesotho","Liberia","Libya","Liechtenstein","Lithuania","Luxembourg",
"Madagascar","Malawi","Malaysia","Maldives","Mali","Malta","Marshall Islands",
"Mauritania","Mauritius","Mexico","Micronesia","Moldova","Monaco","Mongolia",
"Montenegro","Morocco","Mozambique","Myanmar (Burma)","Namibia","Nauru","Nepal",
"Netherlands","New Zealand","Nicaragua","Niger","Nigeria","North Macedonia","Norway",
"Oman","Pakistan","Palau","Panama","Papua New Guinea","Paraguay","Peru","Philippines",
"Poland","Portugal","Qatar","Romania","Russia","Rwanda","Saint Kitts and Nevis",
"Saint Lucia","Saint Vincent and the Grenadines","Samoa","San Marino",
"Sao Tome and Principe","Saudi Arabia","Senegal","Serbia","Seychelles","Sierra Leone",
"Singapore","Slovakia","Slovenia","Solomon Islands","Somalia","South Africa","South Sudan",
"Spain","Sri Lanka","Sudan","Suriname","Sweden","Switzerland","Syria","Taiwan","Tajikistan",
"Tanzania","Thailand","Togo","Tonga","Trinidad and Tobago","Tunisia","Turkey","Turkmenistan",
"Tuvalu","Uganda","Ukraine","United Arab Emirates","United Kingdom","United States","Uruguay","Uzbekistan",
"Vanuatu","Vatican City","Venezuela","Vietnam","Yemen","Zambia","Zimbabwe"];

header("Content-Type: application/json"); //the data will come back in JSON format
$param = $_GET["q"]; //get the information from the url
//lookup the countries from the array is $param is NOT empty

$suggestionArray = []; //initialize an array

if ($param !== "") {
    $param = strtolower($param);
    $len = strlen($param);
    foreach ($world as $country) { //sort through all the countries in the world
        if (stristr($param, substr($country, 0, $len))){ //search for the 1st occurrence in the database
            $newIndex = count($suggestionArray);
            $suggestionArray[$newIndex] = $country;
        }
    }
}

echo json_encode(count($suggestionArray) === 0 ? ["no suggestions"] : $suggestionArray);
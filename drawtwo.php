<?php session_start(); //Start a session of the game.
require 'vendor/autoload.php'; //get the autoload library
$client = new \GuzzleHttp\Client(); //store the GuzzleHttp function in client.
$response = $client->request('GET', 'https://deckofcardsapi.com/api/deck/new/shuffle/?deck_count=1'); //Make a client request for the deckofcardsapi.com. Store as a $response. 
//$response is the amount of card decks we will use.
$response_data = json_decode($response->getBody(), TRUE); //If we can decode the json, convert the response into an associative array. Store the associative array in response_data.
$response2 = $client->request('GET', 'https://deckofcardsapi.com/api/deck/' . $response_data['deck_id'] . '/draw/?count=2'); //After we get the deck API, create a $response2 for the deck counter.
$response_data2 = json_decode($response2->getBody(), TRUE); //convert the card counter into a json array.

/** */
$card_array = $response_data2['cards']; //We assign the json array into $card_array.
$card_total = calc_card_total($card_array); //We calculate the .
$_SESSION['card_array'] = $card_array; //Stick the card array into an active session.
$_SESSION['deck_id'] = $response_data['deck_id']; //stick the card's id into an active session.

/** Calculate the value of each card. */
function calc_card_total($card_array1)
{
    $card_value1 = ["KING" => 10, "QUEEN" => 10, "JACK" => 10, "ACE" => 1, "2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7, "8" => 8, "9" => 9, "10" => 10];
    $card_value2 = ["KING" => 10, "QUEEN" => 10, "JACK" => 10, "ACE" => 11, "2" => 2, "3" => 3, "4" => 4, "5" => 5, "6" => 6, "7" => 7, "8" => 8, "9" => 9, "10" => 10];
    $card_total1 = 0;
    $card_total2 = 0;
    $card_face = "";
    foreach ($card_array1 as $card) {
        $card_face = $card['value'];
        $card_total1 = $card_total1 + $card_value1[$card_face];
        $card_total2 = $card_total2 + $card_value2[$card_face];
    }
    //Extra logic for the Ace in $card_value2
    if ($card_total2 <= 21) {
        return $card_total2;
    } else {
        return $card_total1;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!--for each card, echo $card. Take an image with the $card call.-->
    <?php foreach ($card_array as $card) : ?>
        <img src="<?php echo $card['image']; ?>">
    <?php endforeach; ?>
    <h1><?php echo "Your card total is $card_total"; ?></h1>
    <?php if ($card_total > 21) : ?>
        Sorry your total is above 21
        <a href="index.php">Play Again</a>
    <?php elseif ($card_total == 21) : ?>
        You win, take a trip to Vegas
        <a href="index.php">Play Again</a>
    <?php else : ?>
        Are you feeling lucky?
        <a href="drawagain.php">Draw again</a>
    <?php endif; ?>

</body>

</html>
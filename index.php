<!--We store data in the session. 
-->
<?php
session_start();//Store game data in a php session. We must "start" the html element.
session_destroy();//We will destroy the data after the form is closed.
?>
<!--Guide: https://docs.google.com/document/d/1l9sp0PzdSD9iuBSdjVJeSg8GaFLEA82CDwEvx4VP0VE/edit-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cards</title>
</head>
<body>
    Draw 2 cards
    <form action="drawtwo.php" method="get"><!--A get is easier to work with than a messy post.-->
       <input type="submit" value="Draw 2 cards">
   </form>

</body>
</html>

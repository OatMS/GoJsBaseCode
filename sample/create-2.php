<!DOCTYPE html>
<?php
    ob_start();
    $_SESSION['name'] = $_GET["name"];
    $attrs = $_GET['Attribute'];

    if(isset($_GET["Attribute"])){
        for($i=0; $i < count($_GET['Attribute']).lenght ; $i++){
            $_SESSION['attr'] .= $_GET['Attribute'][$i];
        }
    }
    $_SESSION['gender'] = $_GET['gender'];
?>
<html>

<head>
    <title>enGeno - Create</title>
    <meta charset="UTF-8">
     <link href="webstyle.css" rel="stylesheet" type="text/css" />
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
     <script src="go.js"></script>
     <script src="enGeno.js"></script>
     
   <!-- you don't need to use this -->
  <script src="goSamples.js"></script>  <!-- this is only for the GoJS Samples framework -->
      <script src="enGeno.js"></script>
  <script src="goSamples.js"></script>  <!-- this is only for the GoJS Samples framework -->
      <script src="formControl.js"></script>
    
</head>

<body id="bodyindex">
    <div id="header">
        <img src="img/logo.png" id="logo">
    </div>
    <form action="editGenogram.php" method="get">
       <input hidden="hidden" name="name" value="<?= $_SESSION['name']?>">
       <input hidden="hidden" name="gender" value="<?= $_SESSION['gender']?>">
       <input hidden="hidden" name="attr" value="<?= $_SESSION['attr']?>">
        
        <input type=submit value="หน้าถัดไป">
    </form>
    <?
        echo $_SESSION['name']."<br>".$_SESSION['gender']."<br>".$_SESSION['attr']."<br>";
    ?>




</body>

</html>


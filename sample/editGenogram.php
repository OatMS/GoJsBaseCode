<!DOCTYPE html>
<?php
   // ob_start();
    
?>
<html>

<head>
    <title>enGeno - edit Genogram</title>
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

<script>
    
   
    
    function setdata(){
        
        var attr ="<? echo $_GET['attr'] ?>";
        attr = attr.split("");
        var userdata =[{n: "<? echo $_GET['name']; ?>",
                        key:1,m:2,f:3,
                        s: "<? echo $_GET['gender'] ?>",
                        a: attr,
                    },
                    //mother
                    {
                        key:2,n:"Mom",s:"F",cou:3
                    },
                    //father
                    {
                        key:3,n:"Dad",s:"M",cou:2
                    }
                        ];
    
        createDi(userdata);
    }
    
    
</script>

<body id="bodyindex" onload="setdata()">
    <div id="header">
        <img src="img/logo.png" id="logo">
    </div>
    
    <div id="elementTools">
            
    </div>
    
    
    
   <div id="myDiagram">
       
   </div>




</body>

</html>



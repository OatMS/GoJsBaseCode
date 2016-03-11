<!DOCTYPE html>
<?php
  $altimg = array(
"ติดการพนัน",
"ติดสารเสพติด",
"ติดแอลกอฮอล์",
"มีการดื่มแอลกอฮอลหรือใช้สารเสพติด",
"มีความผิดปกติทางร่างการและจิต",
"มีปัญหาเรื่อติดแอลกอฮอล์หรือสารเสพติด และอยู่ในระหว่างการรักษาการป่วยทางจิต",
"มีอาการป่วยทางจิต และอยู่ในระหว่างการรักษาการติดแอลกอฮอล์",
"มีอาการป่วยทางร่างกายหรือจิต",
"สงสัยว่ามาการดื่นแอลกอฮอล์และสารเสพติด",
"อยู่ในระหว่างการรักษาอาการติดแอลกอฮอล์ หรือสารเสพติด",
"อยู่ในระหว่างการรักษาอาการทางจิต และรักษาอาการติดแอลกอฮอล์หรือสารเสพติด",
"อยู่ในระหว่างการรักษาอาการป่วยทางจิต",
"โรคความดันโลหิตสูง",
"โรคซึมเศร้า",
"โรคตับอักเสบ",
"โรคติดต่อทางเพศสัมพันธ์",
"โรคมะเร็ง",
"โรคหัวใจ",
"โรคออทิสติก",
"โรคอัลไซเมอร์",
"โรคอ้วน.png",
"โรคเบาหวาน",
"โรคเอดส์ - HIV",
"โรคไขข้อ"
);

    
?>
<html>

<head>
    <title>enGeno - edit Genogram</title>
    <meta charset="UTF-8">
     <link href="webstyle.css" rel="stylesheet" type="text/css" />
     <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    
     <script src="go.js"></script>
     <script src="enGeno.js"></script>
     <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
     
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
    
    
</script><body id="bodyindex" onload="setdata()">
    <div id="header">
        <img src="img/logo.png" id="logo">
    </div>

    <div id="container">

        <div id="elementTools">
            <div id='cssmenu'>
                <ul>
                    <li><a href='#'>Genogram</a></li>
                    <li class='active has-sub'><a href='#'>สัญลักษณ์ต่างๆ</a>
                        <ul>
                           <div >
     <?
               $i=0;         
        for($i=0;$i<24;$i++ ){
      //  echo  "<li id='attrimg'>";
           echo "<img id='attrimg'   src='img/attr/";
        echo    $i+1;
        echo    ".png' ";
  echo    "alt='".$altimg[$i]."' ";
         echo "  />";
     //   echo "</li>";
    }
    
    
    ?>
                        </div>       
                        </ul>
                    </li>
                    <li><a href='#'>About</a></li>
                    <li><a href='#'>Contact</a></li>
                </ul>
            </div>
        </div>



        <div id="myDiagram">

        </div>
        
          
    
    
  
    
    


    </div>

</body>
</html>



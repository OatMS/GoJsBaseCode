<!DOCTYPE html>
<?php
  $altimgattr = array(
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



$altimgline = array(
    "ความสัมพันธ์ที่ดี",
    "รักกัน",
    "รักกันมาก",
    "สนิทกัน",
    "สนิทกันมาก",
    "เข้าข้างกันมาก",
    "ให้ความสนใจเป็นพิเศษ",
    "ความหลงไหล",
    "ความหลงไหลอย่างมาก",
    "ไม่เป็นมิตรกัน",
    "ไม่เป็นมิตรแต่ไม่ค่อยได้เจอ",
    "ไม่เป็นมิตรกันแต่เจอกันบ่อย",
    "ไม่เป็นมิตรกันและอยู่ด้วยกัน",
    "การขัดแย้งกันจนถึงขั้นทำร้ายร่างกายหรือจิตใจ",
    "ขัดแย้งแบบใช้ความรุนแรง-ไม่ค่อยได้เจอ",
    "ขัดแย้งแบบใช้ความรุนแรง-ใช้ชีวิตอยู่ร่วมกัน",
    "ใช้ความรุนแรงจนไม่เหลือความสัมพันธ์ที่ดี",
    "ไม่ไว้ใจกัน",
    "บาดหมาง",
    "เกลียดกัน",
    "เคยอยู่ห่างกัน",
    "ต่างคนต่างอยู่",
    "ไม่ค่อยมีปฏิสัมพันธ์กัน",
    "ไม่แยแส",
    "ถูกทอดทิ้ง",
    "การอิจฉาริษยา",
    "จ้องจับผิด",
    "การโดนจัดการชีวิต",
    "การโดนควบคุมชีวิต",
    "โดนทำร้ายทางจิตใจ",
    "โดนทำร้ายทางร่างกาย",
    "โดนทำร้ายหรือล่วงละเมิด",
    "โดนล่วงละเมิดหรือทารุณกรรมทางเพศ",
    "ไม่ทราบความสัมพันธ์"
);


/*
    echo $_SESSION["importOrCreate"];
if(isset($_GET['data'])){
    //echo $_GET['data'];
    echo "<script> genGramFormFile();</script>";
    
}else{
    echo "data noe set";
}

*/

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


   
   
   
   <body id="bodyindex" onload="genGramFormFile();" >
    <div id="header">
        <img src="img/logo.png" id="logo">
    </div>

    <div id="container">

        <div id="elementTools">
            <div id='cssmenu'>
                <ul>
                
                <li class='active has-sub'><a href='#'>สัญลักษณ์สมาชิก</a>
                        <ul>
                           <div style="text-align:center" >
     <?
               $i=0;         
        for($i=0;$i<4;$i++ ){
       echo    "<a style='display:inline' title='".$altimgattr[$i]."' >";
           echo "<img id='attrimg'   src='img/node/";
        echo    $i+1;
        echo    ".png' /> ";
  
         echo "  </a>";
        }
    
    ?>
                        </div>       
                        </ul>
                    </li>
                 
                    <li class='active has-sub'><a href='#'>สัญลักษณ์</a>
                        <ul>
                           <div style="text-align:center" >
     <?
               $i=0;         
        for($i=0;$i<24;$i++ ){
       echo    "<a style='display:inline' title='".$altimgattr[$i]."' >";
           echo "<img id='attrimg'   src='img/attr/";
        echo    $i+1;
        echo    ".png' /> ";
  
         echo "  </a>";
        }
    
    ?>
                        </div>       
                        </ul>
                    </li>
                    
                    <li class='has-sub'><a href='#'>เส้นความสัมพันธ์</a>
                        <ul>
                           <div style="text-align:center" >
     <?
               $i=0;         
        for($i=0;$i<34;$i++ ){
     
            echo    "<a style='display:inline' title='".$altimgline[$i]."' >";
           echo "<img id='attrimg'   src='img/line/";
        echo    $i+1;
        echo    ".png' /> ";
  
         echo "  </a>";
    }
    
    
    ?>
                        </div>       
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

<!-- Button Openfilt -->
     

        <div id="myDiagram">

        </div>
        
        <div id="infoNode" >
    

     
     
     
     <!------- Info Form --------->
      <div class="form" id="infoForm">
         <!--
        <h2 style="">ข้อมูลสมาชิกครอบครัว</h2>
        
        <form readonly="readonly" >
         <h3>ชื่อ   </h3>
         
         <input readonly="readonly" type="text" id="nameNode">
         
         <h3>โรค</h3>
         
         
        </form>
    -->
     </div>
     
         
    <!-- ----- edit Form ------------------->
     <div class="form" id="editForm">
         
        <h2 style="">ข้อมูลสมาชิกครอบครัว</h2>
        <img src="img/mockup/node.PNG" style="margin-left:50px;">
        
        <form  >
         <h3>ชื่อ   </h3>
         
         <input type="text" id="nameNode">
         
         <h3>โรค</h3>
         
         <div class="col-md-6">
         <input id="A"  type="checkbox" name="Attribute" value="A" >ภาวะซึมเศร้า<br>
        <input id="B" type="checkbox" name="Attribute" value="B"> ภาวะโรคอ้วน<br>
        <input id="C" type="checkbox" name="Attribute" value="C"> มะเร็ง<br>
        <input id="D" type="checkbox" name="Attribute" value="D"> โรคหัวใจ<br>
        <input id="E" type="checkbox" name="Attribute" value="E"> โรคความดันสูง<br>
        <input id="F" type="checkbox" name="Attribute" value="F"> HIV / เอดส์<br9>
        </div>
        
        <div class="col-md-6">
        
        <input id="G" type="checkbox" name="Attribute" value="G">โรคตับอักเสบ<br>
        <input id="H" type="checkbox" name="Attribute" value="H"> โรคเบาหวาน<br>
        <input id="I" type="checkbox" name="Attribute" value="I"> โรคไขข้อ<br>
        <input id="J" type="checkbox" name="Attribute" value="J"> ออทิสติก<br>
        <input id="K" type="checkbox" name="Attribute" value="K">อัลไซเมอร์<br>
        <input id="L" type="checkbox" name="Attribute" value="L"> โรคติดต่อทางเพศสัมพันธ์<br>
        </div>
        
        
        </form>
    
     </div>
      
      
  </div>
  

    </div>
    
    
    
    <menu id="ctxMenu">
    <menu title="File">
        <menu onclick="addSon" title="addSon"></menu>
        <menu title="Save As"></menu>
        <menu title="Open"></menu>
    </menu>
    <menu title="Edit">
        <menu title="Cut"></menu>
        <menu title="Copy"></menu>
        <menu title="Paste"></menu>
    </menu>
</menu>

</body>
</html>




<!-- //****************** JS ****************** -->
<script>
    
   function genGramFormFile(){
       console.log('Gen Gram Form data');
       
       var data = getUrlVars()["data"];
      // var data = $_GET("data");
      // alert(typeof data);
       
       data =  decodeURI(data);
        data =  decodeURIComponent(data);
        data = data.replace("+","");
        data = data.slice(1,-1);
       console.log(data);
       data = JSON.parse(data);
       alert(data);
       console.log(data);
       console.log(1);
        setupForm();
       console.log(2);
        createDi(data);
       console.log(3);
   }
    
    
    function getUrlVars() {
var vars = {};
var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
vars[key] = value;
});
return vars;
}
    
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
    setupForm();
        createDi(userdata);
    }
    
    
    
    
</script>
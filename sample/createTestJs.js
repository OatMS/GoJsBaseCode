function create(){
        
    
    
        /*
        var $= go.GraphObject.make;
        var diagram = $(go.Diagram, "myDiagram",{ });
        
        
         var node = new go.Node(go.Panel.Auto);
        var shape = new go.Shape();
       
        shape.figure = "RoundedRectangle";
        shape.fill = "lightblue";
        node.add(shape);
        var textblock = new go.TextBlock();
        textblock.text = "1!";
        textblock.margin = 5;
        node.add(textblock);
        node.data = {key:1 , name:"Oat"};
        node.key = 1
        node.doubleClick = function (){
            alert(node.location);
        };
        
        
         var node2 = new go.Node(go.Panel.Auto);
        var shape2 = new go.Shape();
       
        shape2.figure = "RoundedRectangle";
        shape2.fill = "lightblue";
         var textblock2 = new go.TextBlock();
        textblock2.text = "2!";
        textblock2.margin = 5;
        node2.add(shape2);
        node2.add(textblock2);
        node2.data={key:2,name:"Eve"};
        diagram.add(node);
        diagram.add(node2);
        
        node2.doubleClick = function (){
            alert(node2.location);
        };
        
        var newNode = diagram.findNodeForKey(1);
        newNode.data = {key:3};
        diagram.add(newNode);
        
        */
        /*
        var $= go.GraphObject.make;
        var diagram = $(go.Diagram, "myDiagram",{ });
        
         diagram.add(
             $(go.Part,
               $(go.Picture, "images/arrow.PNG")
              ));
        */
        
    }


//*********** Read file *****************
//Read file and split by line
/*
function openFile(event) {
    var input = event.target;
    var data=[];
    
    var reader = new FileReader();
    reader.onload = function(){
      var text = reader.result;
      var lines = text.split("\r\n");
       
    for(var line = 0; line < lines.length; line++){
     data.push(readByLine(lines[line]));
    }
        
    
    function readByLine(line){
        var attribute = line.split(',');
        var obj ={};
        for(var item = 0; item < attribute.length; item++){
            var buddle = attribute[item].split(':');
            var key = buddle[0];
            var value = buddle[1]
            obj[key] = value;
        }
        return obj;
    
    }
        
    };
    reader.readAsText(input.files[0]);
    return data;
  };
*/
//------------------------------------------

//*************** Split Line by colone***********




//----------------------------------------------


       //***************************************
     /*  $(function(){

    var canvas=document.getElementById("canvas");
    var ctx=canvas.getContext("2d");

    var startX=50;
    var startY=80;

    // draw an unrotated reference rect
    ctx.beginPath();
    ctx.rect(startX,startY,100,20);
    ctx.fillStyle="blue";
    ctx.fill();

    // draw a rotated rect
    drawRotatedRect(startX,startY,100,20,45);

    function drawRotatedRect(x,y,width,height,degrees){

        // first save the untranslated/unrotated context
        ctx.save();

        ctx.beginPath();
        // move the rotation point to the center of the rect
        ctx.translate( x+width/2, y+height/2 );
        // rotate the rect
        ctx.rotate(degrees*Math.PI/180);

        // draw the rect on the transformed context
        // Note: after transforming [0,0] is visually [x,y]
        //       so the rect needs to be offset accordingly when drawn
        ctx.rect( -width/2, -height/2, width,height);

        ctx.fillStyle="gold";
        ctx.fill();

        // restore the context to its untranslated/unrotated state
        ctx.restore();

    }
    
    

});

*/
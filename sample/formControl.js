var myDiagram;

//------------------------css menu bar--------------------
(function ($) {
    $(document).ready(function () {

        $('#cssmenu li.active').addClass('open').children('ul').show();
        $('#cssmenu li.has-sub>a').on('click', function () {
            $(this).removeAttr('href');
            var element = $(this).parent('li');
            if (element.hasClass('open')) {
                element.removeClass('open');
                element.find('li').removeClass('open');
                element.find('ul').slideUp(200);
            } else {
                element.addClass('open');
                element.children('ul').slideDown(200);
                element.siblings('li').children('ul').slideUp(200);
                element.siblings('li').removeClass('open');
                element.siblings('li').find('li').removeClass('open');
                element.siblings('li').find('ul').slideUp(200);



            }
        });

    });
})(jQuery);


//---------------end css menu bar--------------





var clickCount = 0;
var JsonData = [
    {
        key: 1,
        n: "Eve",
        s: "F",
        m: 2,
        a: "BHS"
    },
    {
        key: 2,
        n: 'Mom',
        s: 'F',
        cou: 3,
        a: "CGK"
    },
    {
        key: 3,
        n: "Dad",
        s: 'M',
        a: "AELS"
    },
    {
        key: 4,
        n: "Ever",
        s: "F",
        m: 2,
        f: 3,
        a: "BH"
    },
    {
        key: 5,
        n: 'Ever',
        s: 'M',
        cou: 4
    }
];
var Form, editForm, infoForm;
var firstClick = true;
/*
function openFile(event) {
    alert(event.target.files[0]);
    var myDiagram = new enGeno(JsonData, "myDiagram");

}
*/
function createDi(usrdata) {
    // alert('on create Di');

    myDiagram = new enGeno(usrdata, "myDiagram");
    myDiagram.init();
    //  myDiagram.addNode();
       setInfoForm();

}

function setupForm() {
    Form = document.getElementById("infoNode");
    editForm = document.getElementById("editForm");
    infoForm = document.getElementById("infoForm");
    // Form.removeChild(editForm);
    Form.removeChild(infoForm);
}


function clickNode(ctrl, node) {

  //  var node = this.myDiagram.getSelectedNode();
   // console.log(node[0].data.key);
    
    
    //this.myDiagram.filter("AB");
    
    //still fail
  //this.myDiagram.addSpouse(node);
    
    //addSon
    //this.myDiagram.addSon(node);
    //***********for open file ********
    setInfoForm();
    
    //this.myDiagram.addDaughter(node);
    
   // var newNode = {key:23 ,m:22,f:21,s:'F',a:'ABC'};
  //  this.myDiagram.addNode(newNode);
 

}



function clickDiagram() {
    setInfoForm();
    this.myDiagram.load();
}


function resetClick() {
    selectedNode = [];
}

function doubleClickNode(e, b) {
    var node = b;
   // var n = prompt("Name : ", node.data.n);
 //  myDiagram.editNodeData(node, {"n": n,a: ["A", "B", "C", "D"] });

    //test addChile and data
    //   var data = {key:10,n:"Hello",a:"ACFH"}
    //   this.myDiagram.addDaughter(node,data);

    //test find and add Node
    //  var nodeFound = myDiagram.findNode(3);
    //  myDiagram.addSon(node,nodeFound);

    //test deleteNode
    // var nodeFound = myDiagram.findNode(5);
    //myDiagram.removeNode(nodeFound);

    //test changNode
    /*
    var nodeFound = myDiagram.findNode(1);
    if (nodeFound != 
    'undefine') {
    myDiagram.changeNodeData(nodeFound, {
            key: 8,
            n: "HELLO",
            s: "F"
        });
    } 
    else {
         console.log("cannot find node");   
    }
    */
    this.myDiagram.addSon(node);
    

}



function editNode(e, b) {
    //var node = b.part.adornedPart;
    var node = b;
    if (!firstClick) {
        Form.removeChild(infoForm);
    }

    Form.appendChild(editForm);


    e = window.event;


    var nameText = document.getElementById("nameNode");
    nameText.value = node.data.n;
    var attribute = document.getElementsByName("Attribute");

    for (var i = 0; i < attribute.length; i++) {
        attribute[i].checked = false;
    }

    for (var i = 0; i <= node.data.a.length; i++) {
        var checkbox = document.getElementById(node.data.a[i]);

        checkbox.checked = true;
    }

    var node = b.part.adornedPart.data;
    var newName = prompt("Name : ", b.part.adornedPart.data.n);


    myDiagram.model.startTransaction("modified Node")
    myDiagram.model.setDataProperty(node, "n", newName);
    myDiagram.model.commitTransaction("modified Node");

}

function getNameAttr(a){
    switch(a){
            case'A':return "ภาวะซึมเศร้า";break;
            case'B':return "ภาวะโรคอ้วน";break;
            case'C':return "โรคหัวใจ" ; break;
            case'D':return "มะเร็ง" ;break;
            case'E':return "โรคความดันสูง" ;break;
            case'F':return "HIV/เอดส์" ;break;
            case'G':return "โรคตับอักเสบ" ;break;
            case'H':return "โรคเบาหวาน" ;break;
            case'I':return "โรคไขข้อ" ;break;
            case'J':return "ออทิสติก" ;break;
            case'K':return "อัลไซเมอร์" ;break;
            case'L':return "โรคติดต่อทางเพศสัมพันธ์" ;break;
            case'S':return "เสียชีวิตแล้ว" ;break;
        default: return "";
    }
}


//********** set info form************
function setInfoForm(){
     var nodeSelect =   this.myDiagram.getSelectedNode();
    var nameText = document.getElementById("nameText");
    var genderText = document.getElementById("genderText");
    var infoForm = document.getElementById("infoForm");
    var diseases = document.getElementById("diseases");
    var attr = document.getElementById("attr");
    

    if(nodeSelect.length > 0){
        nameText.innerHTML = nodeSelect[0].data.n;
        
        if(nodeSelect[0].data.s == 'F'){
            genderText.innerHTML = "หญิง";
        }else{
            genderText.innerHTML = "ชาย";
        }
        attr.innerHTML ="";
        
        if(nodeSelect[0].data.a){
           // alert(JSON.stringify(nodeSelect[0].data));
            diseases.style.visibility='visible';
             var rip = false;
            for(var i =0 ; i<nodeSelect[0].data.a.length;i++){
                var ai = nodeSelect[0].data.a[i].attr;
               
                if(ai == 'S'){
                    rip =true;
                }
                else{
                    attr.innerHTML += '<p>• '+getNameAttr(ai)+'</p></br>';
                    }
            }
            if(rip){
                attr.innerHTML += '<br><p> สถานะ : '+getNameAttr(ai)+'</p></br>';
            }
        }
        else{
            diseases.style.visibility='hidden';
            attr.innerHTML ="";
        }
    }else{
        nameText.innerHTML ="";
        genderText.innerHTML="";
        attr.innerHTML ="";
        
    }
    
}


function setFilter(){
    var attribute = document.getElementsByName("Attribute");
    var str ="";
    for (var i = 0; i < attribute.length; i++) {
        if(attribute[i].checked == true){
            str +=attribute[i].value;
        }
    }
    if(attribute.length ==0){
        this.myDiagram.filter();
    }
    else this.myDiagram.filter(str);
}

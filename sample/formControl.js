
var clickCount=0;
  var JsonData=[
    {key:1,n: "Eve",s:"F",m:2,a:"BHS"},
    {key:2,n:'Mom',s:'F',cou:3,a:"CGK"},
    {key:3,n:"Dad",s:'M',a:"AELS"},
    {key:4,n: "Ever",s:"F",m:2,f:3,a:"BH"},
    {key:5,n: 'Ever',s:'M',cou:4} 
];
var Form,editForm,infoForm;
var firstClick = true;

function openFile(event){
    alert(event.target.files[0]);
    var myDiagram = Genogram(JsonData,"myDiagram");
}

function createDi(usrdata){
    var myDiagram = Genogram(usrdata,"myDiagram");
   // alert('on create Di');
}

function setupForm(){
   Form = document.getElementById("infoNode");
    editForm = document.getElementById("editForm");
    infoForm = document.getElementById("infoForm");
    Form.removeChild(editForm);
    Form.removeChild(infoForm);
}


function clickNode(ctrl,node){
    var node = node.part.adornedPart;
    if(!firstClick){
        Form.removeChild(editForm);
    }
    Form.appendChild(infoForm);
    firstClick=false;
    
     var nameText = document.getElementById("nameNode");
   nameText.value = node.data.n;
    
    
    
    var link = node.findTreeParentLink() ;
    if(link!== null){
     
    }
  if (!ctrl) {
    selectedNode =[];
      
  }
    selectedNode.push(node);
   
}



function clickDiagram(){
    
}


function getSelectedNode(){
    return selectedNode;
}

function resetClick(){
    selectedNode=[];
}	

function doubleClickNode(e,b){
    var node = b.part.adornedPart;
    prompt("Name : ",node.data.n);
}



function editNode(e,b){
    var node = b.part.adornedPart;
    if(!firstClick){
        Form.removeChild(infoForm);
    }
    Form.appendChild(editForm);
    
      e = window.event;
    
    
    var nameText = document.getElementById("nameNode");
   nameText.value = node.data.n;
    var attribute= document.getElementsByName("Attribute");
    
    for(var i =0;i<attribute.length ; i++){
        attribute[i].checked = false;
    }
   
    for(var i =0;i<=node.data.a.length ; i++){
        var checkbox = document.getElementById(node.data.a[i]);
        
        checkbox.checked = true;
    }
    
   var node =  b.part.adornedPart.data;
   var newName = prompt("Name : ",b.part.adornedPart.data.n);
    
    
      myDiagram.model.startTransaction("modified Node")
      myDiagram.model.setDataProperty(node, "n", newName);
      myDiagram.model.commitTransaction("modified Node");
 
    
    
    
}
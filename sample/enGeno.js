//var selectedNode = [];
var $ = go.GraphObject.make;


//---------------Layout----------------------------


// A custom layout that shows the two families related to a person's parents
function GenogramLayout() {
    go.LayeredDigraphLayout.call(this);
    this.initializeOption = go.LayeredDigraphLayout.InitDepthFirstIn;
}
go.Diagram.inherit(GenogramLayout, go.LayeredDigraphLayout);

/** @override */
GenogramLayout.prototype.makeNetwork = function (coll) {
    // generate LayoutEdges for each parent-child Link
    var net = this.createNetwork();
    if (coll instanceof go.Diagram) {
        this.add(net, coll.nodes, true);
        this.add(net, coll.links, true);
    } else if (coll instanceof go.Group) {
        this.add(net, coll.memberParts, false);
    } else if (coll.iterator) {
        this.add(net, coll.iterator, false);
    }
    return net;
};

// internal method for creating LayeredDigraphNetwork where husband/wife pairs are represented
// by a single LayeredDigraphVertex corresponding to the label Node on the marriage Link
GenogramLayout.prototype.add = function (net, coll, nonmemberonly) {
    // consider all Nodes in the given collection
    var it = coll.iterator;
    while (it.next()) {
        var node = it.value;
        if (!(node instanceof go.Node)) continue;
        if (!node.isLayoutPositioned || !node.isVisible()) continue;
        if (nonmemberonly && node.containingGroup !== null) continue;
        // if it's an unmarried Node, or if it's a Link Label Node, create a LayoutVertex for it
        if (node.isLinkLabel) {
            // get marriage Link
            var link = node.labeledLink;
            var spouseA = link.fromNode;
            var spouseB = link.toNode;
            // create vertex representing both husband and wife
            var vertex = net.addNode(node);
            // now define the vertex size to be big enough to hold both spouses
            vertex.width = spouseA.actualBounds.width + 30 + spouseB.actualBounds.width;
            vertex.height = Math.max(spouseA.actualBounds.height, spouseB.actualBounds.height);
            vertex.focus = new go.Point(spouseA.actualBounds.width + 30 / 2, vertex.height / 2);
        } else {
            // don't add a vertex for any married person!
            // instead, code above adds label node for marriage link
            // assume a marriage Link has a label Node
            if (!node.linksConnected.any(function (l) {
                    return l.isLabeledLink;
                })) {
                var vertex = net.addNode(node);
            }
        }
    }
    // now do all Links
    it.reset();
    while (it.next()) {
        var link = it.value;
        if (!(link instanceof go.Link)) continue;
        if (!link.isLayoutPositioned || !link.isVisible()) continue;
        if (nonmemberonly && link.containingGroup !== null) continue;
        // if it's a parent-child link, add a LayoutEdge for it
        if (!link.isLabeledLink) {
            var parent = net.findVertex(link.fromNode); // should be a label node
            var child = net.findVertex(link.toNode);
            if (child !== null) { // an unmarried child
                net.linkVertexes(parent, child, link);
            } else { // a married child
                link.toNode.linksConnected.each(function (l) {
                    if (!l.isLabeledLink) return; // if it has no label node, it's a parent-child link
                    // found the Marriage Link, now get its label Node
                    var mlab = l.labelNodes.first();
                    // parent-child link should connect with the label node,
                    // so the LayoutEdge should connect with the LayoutVertex representing the label node
                    var mlabvert = net.findVertex(mlab);
                    if (mlabvert !== null) {
                        net.linkVertexes(parent, mlabvert, link);
                    }
                });
            }
        }
    }
};

/** @override */
GenogramLayout.prototype.assignLayers = function () {
    go.LayeredDigraphLayout.prototype.assignLayers.call(this);
    var horiz = this.direction == 0.0 || this.direction == 180.0;
    // for every vertex, record the maximum vertex width or height for the vertex's layer
    var maxsizes = [];
    this.network.vertexes.each(function (v) {
        var lay = v.layer;
        var max = maxsizes[lay];
        if (max === undefined) max = 0;
        var sz = (horiz ? v.width : v.height);
        if (sz > max) maxsizes[lay] = sz;
    });
    // now make sure every vertex has the maximum width or height according to which layer it is in,
    // and aligned on the left (if horizontal) or the top (if vertical)
    this.network.vertexes.each(function (v) {
        var lay = v.layer;
        var max = maxsizes[lay];
        if (horiz) {
            v.focus = new go.Point(0, v.height / 2);
            v.width = max;
        } else {
            v.focus = new go.Point(v.width / 2, 0);
            v.height = max;
        }
    });
    // from now on, the LayeredDigraphLayout will think that the Node is bigger than it really is
    // (other than the ones that are the widest or tallest in their respective layer).
};

/** @override */
GenogramLayout.prototype.commitNodes = function () {
    go.LayeredDigraphLayout.prototype.commitNodes.call(this);
    // position regular nodes
    this.network.vertexes.each(function (v) {
        if (v.node !== null && !v.node.isLinkLabel) {
            v.node.position = new go.Point(v.x, v.y);
        }
    });
    // position the spouses of each marriage vertex
    var layout = this;
    this.network.vertexes.each(function (v) {
        if (v.node === null) return;
        if (!v.node.isLinkLabel) return;
        var labnode = v.node;
        var lablink = labnode.labeledLink;
        // In case the spouses are not actually moved, we need to have the marriage link
        // position the label node, because LayoutVertex.commit() was called above on these vertexes.
        // Alternatively we could override LayoutVetex.commit to be a no-op for label node vertexes.
        lablink.invalidateRoute();
        var spouseA = lablink.fromNode;
        var spouseB = lablink.toNode;
        // prefer fathers on the left, mothers on the right
        if (spouseA.data.s === "F") { // sex is female
            var temp = spouseA;
            spouseA = spouseB;
            spouseB = temp;
        }
        // see if the parents are on the desired sides, to avoid a link crossing
        var aParentsNode = layout.findParentsMarriageLabelNode(spouseA);
        var bParentsNode = layout.findParentsMarriageLabelNode(spouseB);
        if (aParentsNode !== null && bParentsNode !== null && aParentsNode.position.x > bParentsNode.position.x) {
            // swap the spouses
            var temp = spouseA;
            spouseA = spouseB;
            spouseB = temp;
        }
        spouseA.position = new go.Point(v.x, v.y);
        spouseB.position = new go.Point(v.x + spouseA.actualBounds.width + 30, v.y);
        if (spouseA.opacity === 0) {
            var pos = new go.Point(v.centerX - spouseA.actualBounds.width / 2, v.y);
            spouseA.position = pos;
            spouseB.position = pos;
        } else if (spouseB.opacity === 0) {
            var pos = new go.Point(v.centerX - spouseB.actualBounds.width / 2, v.y);
            spouseA.position = pos;
            spouseB.position = pos;
        }
    });
};

GenogramLayout.prototype.findParentsMarriageLabelNode = function (node) {
    var it = node.findNodesInto();
    while (it.next()) {
        var n = it.value;
        if (n.isLinkLabel) return n;
    }

    return null;
};



//------------------------------------API----------------------


var enGeno = class {


    constructor(data, div) { 

        var data;
        var diagram;
        var contextNode;
        var nodeOnRightClicked;
        //  this.setContextNode();

        //if (window.goSamples) goSamples();  // init for these samples -- you don't need to call this
       /*
        this.diagram =
            $(go.Diagram, {
                initialAutoScale: go.Diagram.Uniform,
                initialContentAlignment: go.Spot.Center,
                // when a node is selected, draw a big yellow circle behind it
                nodeSelectionAdornmentTemplate:

                    $( go.Adornment, "Auto",  // the predefined layer that is behind everything else
                    $(go.Shape, "Circle", {
                        fill: "yellow",
                        stroke: null
                    }),
                    $(go.Placeholder)

                ),

                layout: // use a custom layout, defined below
                    $(GenogramLayout, {
                    direction: 90,
                    layerSpacing: 30,
                    columnSpacing: 10
                })
            });
        */
        
        this.diagram =
        $(go.Diagram,
          {
            initialAutoScale: go.Diagram.Uniform,
            initialContentAlignment: go.Spot.Center,
            "undoManager.isEnabled": true,
            // when a node is selected, draw a big yellow circle behind it
            nodeSelectionAdornmentTemplate:
              $(go.Adornment, "Auto",
                { layerName: "Grid" },  // the predefined layer that is behind everything else
                $(go.Shape, "Circle", { fill: "yellow", stroke: null }),
                $(go.Placeholder)
              ),
            layout:  // use a custom layout, defined below
              $(GenogramLayout, { direction: 90, layerSpacing: 30, columnSpacing: 10 })
          });

        //click Listener **candelete**
        this.diagram.addDiagramListener("ObjectSingleClicked",
            function (e) {

            });



        this.diagram.allowDrop = true;

        this.diagram.div = document.getElementById("myDiagram");
        
      
    

        // determine the color for each attribute shape
        function attrFill(a) {
            switch (a.attr) {
                case "A":
                    return "#0000FE";
                case "B":
                    return "#FF00FF";
                case "C":
                    return "#FE0000";
                case "D":
                    return "#C00000";
                case "E":
                    return "#C00000";
                case "F":
                    return "#FFC000";
                case "G":
                    return "#01FF00";
                case "H":
                    return "#800080";
                case "I":
                    return "#939FBB";
                case "J":
                    return "#01FFFF";
                case "K":
                    return "#359AFF";
                case "L":
                    return "#FFFF00";
                case "S":
                    return "red";
                default:
                    return "transparent";
            }
        }

        // determine the geometry for each attribute shape in a male;
        // except for the slash these are all squares at each of the four corners of the overall square
        var tlsq = go.Geometry.parse("F M1 1 l19 0 0 19 -19 0z");
        var trsq = go.Geometry.parse("F M20 1 l19 0 0 19 -19 0z");
        var brsq = go.Geometry.parse("F M20 20 l19 0 0 19 -19 0z");
        var blsq = go.Geometry.parse("F M1 20 l19 0 0 19 -19 0z");
        var slash = go.Geometry.parse("F M38 0 L40 0 40 2 2 40 0 40 0 38z");

      
        
        function maleGeometry(a){
         //   console.log("attr : "+a[attr]+" ,index : "+a.index);
            if(a.attr == 'S') return slash;
            if(a.index ==1)return tlsq;
            else if(a.index == 2 ) return trsq;
            else if(a.index == 3 ) return brsq;
            else if(a.index == 4 ) return blsq;
            
            
            
            console.log(JSON.stringify(a));

        }

        // determine the geometry for each attribute shape in a female;
        // except for the slash these are all pie shapes at each of the four quadrants of the overall circle
        var tlarc = go.Geometry.parse("F M20 20 B 180 90 20 20 19 19 z");
        var trarc = go.Geometry.parse("F M20 20 B 270 90 20 20 19 19 z");
        var brarc = go.Geometry.parse("F M20 20 B 0 90 20 20 19 19 z");
        var blarc = go.Geometry.parse("F M20 20 B 90 90 20 20 19 19 z");

       

        
        
        function femaleGeometry(a){
         //   console.log("attr : "+a[attr]+" ,index : "+a.index);
            if(a.attr == 'S') return slash;
            if(a.index ==1)return tlarc;
            else if(a.index == 2 ) return trarc;
            else if(a.index == 3 ) return brarc;
            else if(a.index == 4 ) return blarc;
            
            
            
            console.log(JSON.stringify(a));

        }



        // two different node templates, one for each sex,
        // named by the category value in the node data object
        this.diagram.nodeTemplateMap.add("M", // male
            $(go.Node, "Vertical", {
                    locationSpot: go.Spot.Center,
                    locationObjectName: "ICON"
                }, {
                    doubleClick: function (e, node) {
                        doubleClickNode(e, node);
                    },
                    click: function (e, node) {
                        clickNode(e, node)
                    }
                        //  ,contextMenu: this.setRightClickedNode // define a context menu for each node
                },
                $(go.Panel, {
                        name: "ICON"
                    },
                    $(go.Shape, "Square", {
                        width: 40,
                        height: 40,
                        strokeWidth: 2,
                        fill: "white",
                        portId: ""
                    }),
                    $(go.Panel, { // for each attribute show a Shape at a particular place in the overall square
                            itemTemplate: $(go.Panel,
                                $(go.Shape, {
                                        stroke: null,
                                        strokeWidth: 0
                                    },
                                    new go.Binding("fill", "", attrFill),
                                    new go.Binding("geometry", "", maleGeometry))
                            ),
                            margin: 1
                        },
                        new go.Binding("itemArray", "a")
                    )
                ),
                $(go.TextBlock, {
                        textAlign: "center",
                        maxSize: new go.Size(80, NaN)
                    },
                    new go.Binding("text", "n"))


            ));

        this.diagram.nodeTemplateMap.add("F", // female
            $(go.Node, "Vertical", {
                    locationSpot: go.Spot.Center,
                    locationObjectName: "ICON"
                }, {
                    doubleClick: doubleClickNode,
                    click: function (e, node) {
                        clickNode(e, node)
                    }
                        // ,rightCl: this.setRightClickedNode
                },

                $(go.Panel, {
                        name: "ICON"
                    },
                    $(go.Shape, "Circle", {
                        width: 40,
                        height: 40,
                        strokeWidth: 2,
                        fill: "white",
                        portId: ""
                    }),
                    $(go.Panel, { // for each attribute show a Shape at a particular place in the overall circle
                            itemTemplate: $(go.Panel,
                                $(go.Shape, {
                                        stroke: null,
                                        strokeWidth: 0
                                    },
                                    new go.Binding("fill", "", attrFill),
                                    new go.Binding("geometry", "", femaleGeometry))
                            ),
                            margin: 1
                        },
                        new go.Binding("itemArray", "a")
                    )
                ),
                $(go.TextBlock, {
                        textAlign: "center",
                        maxSize: new go.Size(80, NaN)
                    },
                    new go.Binding("text", "n"))
            ));



        // the representation of each label node -- nothing shows on a Marriage L ink
        this.diagram.nodeTemplateMap.add("LinkLabel",
            $(go.Node, {
                selectable: false,
                width: 1,
                height: 1,
                fromEndSegmentLength: 20
            }));


        this.diagram.linkTemplate = // for parent-child relationships
            $(go.Link, {
                    routing: go.Link.Orthogonal,
                    curviness: 10,
                    layerName: "Background",
                    selectable: false,
                    fromSpot: go.Spot.Bottom,
                    toSpot: go.Spot.Top
                },
                $(go.Shape, {
                    strokeWidth: 2
                })
            );

        this.diagram.linkTemplateMap.add("Marriage", // for marriage relationships
            $(go.Link, {
                    selectable: false
                },
                $(go.Shape, {
                    strokeWidth: 2,
                    stroke: "darkgreen"
                })
            ));

        //  this.init();
        console.log("can initial");

    }




    setupDiagram(focusId) {

        console.log("SetupDiagram");
        //  var array = this.data;
        var array = [
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
        
        //  var newdata = [];
       //var newdata = this.data;
     //  var newdata = array;
        /*
        for (var i=0; i<array.length; i++) {
            if(array[i].a != null){
            for (var j=0; j<array[i].a.length; j++) {
                 console.log("attr : "+array[i].a[j]+" ,index : "+j);
                array[i].a[j] = { attr:array[i].a[j] , index:j };
               
            }
                
               
            }
          
    }
    */
        
        var newdata = array;
        for(var i =0; i<newdata.length;i++){
            if(newdata[i].a != null){
                var str = newdata[i].a;
                newdata[i].a = [];
                for(var j = 0; j< str.length ;j++){
                    if(str[j] =='S'){
                        array[i].a.push({ attr:str[j] , index:17 });
                    }
                    else{
                        console.log("attr : "+array[i].a[j]+" ,index : "+j);    
                    array[i].a.push({ attr:str[j] , index:j+1 });
                    }
                    

                }
            }
        }
            //this.data = newdata;
        console.log("data = "+JSON.stringify(array));
        
        
        
        console.log(array[1].n);
        this.diagram.model =
            go.GraphObject.make(go.GraphLinksModel, { // declare support for link label nodes
                linkLabelKeysProperty: "labelKeys",
                // this property determines which template is used
                nodeCategoryProperty: "s",
                // create all of the nodes for people
                nodeDataArray: array
            });




        var node = this.diagram.findNodeForKey(focusId);
        if (node !== null) {
            this.diagram.select(node);
            node.linksConnected.each(function (l) {
                if (!l.isLabeledLink) return;
                l.opacity = 0;
                var spouse = l.getOtherNode(node);
                spouse.opacity = 0;
                spouse.pickable = false;



            });
        }

        this.setupMarriages();
        this.setupParents();

    };



    findMarriage(a, b) { // A and B are node keys
       // console.log("findMarriage");

        var nodeA = this.diagram.findNodeForKey(a);
        var nodeB = this.diagram.findNodeForKey(b);
        if (nodeA !== null && nodeB !== null) {
            var it = nodeA.findLinksBetween(nodeB); // in either direction
            while (it.next()) {
                var link = it.value;
                // Link.data.category === "Marriage" means it's a marriage relationship
                if (link.data !== null) return link;
            }
        }
        return null;
    }



    // now process the node data to determine marriages
    setupMarriages() {
       // console.log("setupMarriages");
        var model = this.diagram.model;
        var nodeDataArray = model.nodeDataArray;
        for (var i = 0; i < nodeDataArray.length; i++) {
            var data = nodeDataArray[i];
            var key = data.key;
            var uxs = data.cou;
            if (uxs !== undefined) {
                if (typeof uxs === "number") uxs = [uxs];
                for (var j = 0; j < uxs.length; j++) {
                    var wife = uxs[j];
                    if (key === wife) {
                        // or warn no reflexive marriages
                        continue;
                    }
                    var link = this.findMarriage(key, wife);
                    if (link === null) {
                        // add a label node for the marriage link
                        var mlab = {
                            s: "LinkLabel"
                        };
                        model.addNodeData(mlab);
                        // add the marriage link itself, also referring to the label node
                        var mdata = {
                            from: key,
                            to: wife,
                            labelKeys: [mlab.key],
                            category: "Marriage"
                        };
                        model.addLinkData(mdata);

                    }
                }
            }

        }



    }

    // process parent-child relationships once all marriages are known
   
    
    setupParents() {
       // console.log("setupParent");
        var model = this.diagram.model;
        var nodeDataArray = model.nodeDataArray;
        for (var i = 0; i < nodeDataArray.length; i++) {
            var data = nodeDataArray[i];
            var key = data.key;
            var mother = data.m;
            var father = data.f;
            if (mother !== undefined && father !== undefined) {
                var link = this.findMarriage(mother, father);
                if (link === null) {
                    // or warn no known mother or no known father or no known marriage between them
                    if (window.console) window.console.log("unknown marriage: " + mother + " & " + father);
                    continue;
                }
                var mdata = link.data;
                var mlabkey = mdata.labelKeys[0];
                var cdata = {
                    from: mlabkey,
                    to: key
                };
                this.diagram.model.addLinkData(cdata);
            }
            /*
            else if(mother !== undefined || father !== undefined){
                alert("Key :"+key);
              var parNode;
                if(mother!== undefined){
                 parNode = myDiagram.findNodeForKey(mother);
              }else{
                 parNode = myDiagram.findNodeForKey(father);
              }  
                  var link = parNode.findLinksConnected();
                
            var mdata = link.data;
            var mlabkey = mdata.labelKeys;
            var cdata = { from: mlabkey, to: key };
            myDiagram.model.addLinkData(cdata);
                
            }
            */
        }


    };



    init() {
        //  this.setContextNode();
      //  console.log("in function init");
        this.setupDiagram(1);
      //  console.log("can set Diagram");
        this.setupMarriages();
      //  console.log("can set married");
        this.setupParents();
      //  console.log("can set Parent");

    }



}



//***********************
/*
enGeno.prototype.setSelectedNode = function () {
    var selnode = this.diagram.selection;
    for (var node in selnode) {
        if (node instanceof go.Node) {
            this.selectedNode = [];
            this.selectedNode.push(node);
        }
    }
}

*/

//Now can editNode
enGeno.prototype.editNodeData = function (node, obj) {

    //เปลี่ยน/เพิ่มเติม data ในโหนดที่ส่งเข้ามาเป็นพารามิเตอร์
    this.diagram.model.startTransaction("modified Node");
    node = this.diagram.model.findNodeDataForKey(node.data.key);
    for (var prop in obj) {
        if (obj.hasOwnProperty(prop)) {
            //  console.log("keynode : "+node.data.key);
            
            console.log(prop + " : " + obj[prop]);
            if(prop =="a"){
                obj[a] = reRankAttr(obj[a]);
            }
                
            this.diagram.model.setDataProperty(node, prop, obj[prop]);
        }
    }


    this.diagram.model.commitTransaction("modified Node");
    console.log("edit");
}



enGeno.prototype.changeNodeData =function(node,obj){
     this.diagram.model.startTransaction("modified Node");
    node = this.diagram.model.findNodeDataForKey(node["key"]);
    
     this.diagram.model.commitTransaction("modified Node");
}

//on righr click have a function
enGeno.prototype.setContextNode = function () {

    this.contextNode = $(go.Adornment, "Vertical", // that has one button
        $("ContextMenuButton",
            $(go.TextBlock, "add daughter"), {
                click: this.addChild
            }
        ),
        $("ContextMenuButton",
            $(go.TextBlock, "add son"), {
                click: this.addChild
            }
        ),
        $("ContextMenuButton",
            $(go.TextBlock, "add spouse"), {
                click: this.addSpouse
            }
        ),
        $("ContextMenuButton",
            $(go.TextBlock, "Edit Node"), {
                click: this.editNode
            }
        )

        // more ContextMenuButtons would go here
    );

}


enGeno.prototype.addNode = function (data) {
    this.diagram.startTransaction('new node');
    if (data == 'undefind') {
        var data = {
            key: 5,
            n: "NewNode",
            s: F,
            m: 2,
            f: 3,
            a: [B, H]
        };
    }
    this.diagram.model.addNodeData(data);
    part = this.diagram.findPartForData(data);
    part.location = this.diagram.toolManager.contextMenuTool.mouseDownPoint;
    this.diagram.commitTransaction('new node');
}


//ตรวจว่าเป็นผญไหม-หาเส้นโยงคู่-เจอเส้นที่โยงแต่งงาน-เจอคีย์ผู้ชาย-ได้เส้นออกมา-เอาเส้นมาเพิ่มโหนด
enGeno.prototype.addChild = function (node, gender, data) {

    // take a button panel in an Adornment, get its Adornment, and then get its adorned Node

    var newnode = {
        n: "newNode"
    };
    if (gender == "M" || gender == "m")
        newnode = {
            n: "newNode",
            s: "M"
        };
    else if (gender == "F" || gender == "f")
        newnode = {
            n: "newNode",
            s: "F"
        };
    var keyCou;
    //   var node = b.part.adornedPart;
    var isMarried;
    node = this.diagram.findNodeForKey(node.data.key);
    var arrNode = [];
    node.findNodesOutOf().each(function (n) {
        arrNode.push(n.data.key);
        alert(n.data.key);
        //    n isMarried =  findMarriage(n.data.key, node.data.key);
        //  alert(isMarried.data.category);
        //    keyCou = n.data.key;
    });

    for (var n = 0; n < arrNode.length; n++) {
        alert(arrNode[n]);
        isMarried = this.findMarriage(arrNode[n], node.data.key);
        alert(isMarried.data.category);
        keyCou = n;
    }
    while (isMarried == null) {
        var keyInto = [];
        node.findNodesInto().each(function (n) {
            keyInto.push(n.data.key);
        });
        //  var keyCou = keyInto[0].split(',');
        var keyCou = keyInto[0];
        //  keyCou = keyCou[0];
        isMarried = this.findMarriage(keyCou, node.data.key);
        //alert(isMarried.data.category + " with :" + keyCou);
        //keyCou = n.data.key;
        if (isMarried == null) {
            this.addSpouse(node);
        }
    }
    if (node.data.s == "F") {
        if (isMarried.data.category == "Marriage") {
            newnode["m"] = node.data.key;
            newnode["f"] = keyCou;

        }
    }

    // we are modifying the model, so conduct a transaction

    this.diagram.startTransaction("add node and link");
    // have the Model add the node data
    if (data != 'undefine') {
        for (var prop in data) {
            if (data.hasOwnProperty(prop)) {
                newnode[prop] = data[prop];
            }
        }
    }

    this.diagram.model.addNodeData(newnode);
    var mdata = isMarried.data;
    var mlabkey = mdata.labelKeys[0];
    var cdata = {
        from: mlabkey,
        to: newnode.key
    };
    // and then add a link data connecting the original node with the new one
    // var newlink = { from: node.data.key, to: newnode.key };

    this.diagram.model.addLinkData(cdata);
    //   myDiagram.model.addLinkData(newlink);
    // finish the transaction
    this.diagram.commitTransaction("add node and link");
}

enGeno.prototype.addSon = function (node, data) {
    this.addChild(node, "M", data);
}

enGeno.prototype.addDaughter = function (node, data) {
    this.addChild(node, "F", data);
}

enGeno.prototype.addSpouse = function (node, data) {
    // var node = b.part.adornedPart;
    var data = data;
    this.diagram.startTransaction("add Spouse");
   
    var newnode = {
        n: "Spouse",
        cou: node.key
    };
    if (node.data.s == "M" || node.s == "m" ) {

        newnode.s = "F";

    } else if (node.data.s == "F" || node.s == "f" ) {

        newnode.s = "M";

    }
    if (data != null) {
        newnode = data;
    }
    this.diagram.model.addNodeData(newnode);
    this.diagram.commitTransaction("add Spouse");
    this.setupMarriages();
    this.setupParents();
    
    /*
    var cdata = { from: node.data.key, to: newnode.data.key, labelKeys: [mlab.key], category: "Marriage",s: "LinkLabel" };
    myDiagram.model.addLinkData(cdata);
    myDiagram.commitTransaction("add Spouse and Marriage");
    */
}

enGeno.prototype.getSelectedNode = function () {

    console.log("number : " + this.diagram.selection.count);

    //return Array of Node
    var part = this.diagram.selection.iterator;
    //this.selectedNodes= part;
    //do sth for every Node
    var arrNode = [];
    while (part.next()) {
        //print Node
        var node = part.value;
        console.log("Key: " + node.data.key + ", Name : " + node.data.n);
        arrNode.push(node);
        // this.selectedNodes.push(node);

    }

    //this.diagram.selection.iterator.value;
    return arrNode;
}


enGeno.prototype.findNode = function(data) {
   
    if (typeof data == 'number'){
        var foundNode = this.diagram.findNodeForKey(data);
        if(foundNode != null)
           
        return foundNode.data;
    }
    else if (typeof data == 'object'){
        var foundNode= this.diagram.findNodeForData(data);
        //console.log("foundNode key : "+foundNode.data.key);
        return foundNode.data;
    }
    else
        return null;
}

enGeno.prototype.removeNode = function(node){
    var nodeRemove = this.diagram.findNodeForData(node);
    this.diagram.startTransaction("deleteNode");
    this.diagram.remove(nodeRemove);
    this.diagram.commitTransaction("deleteNode");
}

enGeno.prototype.reRankAttr = function(a){
    
                for(var j = 0; j< a.length ;j++){
                    if(a[j] =='S'){
                        node.a.push({ attr:str[j] , index:17 });
                    }
                    else{
                        a[j].index = j+1;
                    }
                }
            
    return a;
}

//*****************************************












//******************************
/*
function openFile(event) {
    var data=[];
   var text;
  
    var input = event.target;
    alert(input);
    var data=[];
    
    var reader = new FileReader();
    reader.onload = function(){
      var text = reader.result;
      var lines = text.split("\r\n");
       
    for(var line = 0; line < lines.length; line++){
        
     data.push(readByLine(lines[line]));
       
    }
         //alert(JSON.stringify(data));
        init(data);
    
    function readByLine(line){
        var attribute = line.split(',');
        var obj ={};
        for(var item = 0; item < attribute.length; item++){
            var buddle = attribute[item].split(':');
            var key = buddle[0];
            var value = buddle[1]
            
            //if Attribute a
            if(key == 'a'){
                value = value.split('');
            }
            
            obj[key] = value;
        }
        return obj;
    
    }
                                                                    
        
    };
    reader.readAsText(input.files[0]);
    
    
    return data;
  };
*/
//*************************
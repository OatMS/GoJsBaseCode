<!DOCTYPE html>

<style>
/**
 * ContextJS Styles
 * For use WITHOUT Twitters Bootstrap CSS
 */

.nav-header {
	display: block;
	padding: 3px 15px;
	font-size: 11px;
	font-weight: bold;
	line-height: 20px;
	color: #999;
	text-shadow: 0 1px 0 rgba(255, 255, 255, 0.5);
	text-transform: uppercase;
}
.dropdown-menu {
	position: absolute;
	top: 100%;
	left: 0;
	z-index: 1000;
	display: none;
	float: left;
	min-width: 160px;
	padding: 5px 0;
	margin: 2px 0 0;
	list-style: none;
	background-color: #ffffff;
	border: 1px solid #ccc;
	border: 1px solid rgba(0, 0, 0, 0.2);
	font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
	font-size: 14px;
	*border-right-width: 2px;
	*border-bottom-width: 2px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	border-radius: 6px;
	-webkit-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-moz-box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
	-webkit-background-clip: padding-box;
	-moz-background-clip: padding;
	background-clip: padding-box;
	text-align:left;
}
.dropdown-menu.pull-right {
	right: 0;
	left: auto;
}
.dropdown-menu .divider {
	*width: 100%;
	height: 1px;
	margin: 9px 1px;
	*margin: -5px 0 5px;
	overflow: hidden;
	background-color: #e5e5e5;
	border-bottom: 1px solid #ffffff;
}
.dropdown-menu a {
	display: block;
	padding: 3px 20px;
	clear: both;
	font-weight: normal;
	line-height: 20px;
	color: #333333;
	white-space: nowrap;
	text-decoration: none;
}
.dropdown-menu li > a:hover, .dropdown-menu li > a:focus, .dropdown-submenu:hover > a {
	color: #ffffff;
	text-decoration: none;
	background-color: #0088cc;
	background-color: #0081c2;
	background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
	background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
	background-image: -o-linear-gradient(top, #0088cc, #0077b3);
	background-image: linear-gradient(to bottom, #0088cc, #0077b3);
	background-repeat: repeat-x;
	filter: progid: dximagetransform.microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0);
}
.dropdown-menu .active > a, .dropdown-menu .active > a:hover {
	color: #ffffff;
	text-decoration: none;
	background-color: #0088cc;
	background-color: #0081c2;
	background-image: linear-gradient(to bottom, #0088cc, #0077b3);
	background-image: -moz-linear-gradient(top, #0088cc, #0077b3);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#0088cc), to(#0077b3));
	background-image: -webkit-linear-gradient(top, #0088cc, #0077b3);
	background-image: -o-linear-gradient(top, #0088cc, #0077b3);
	background-repeat: repeat-x;
	outline: 0;
	filter: progid
	: dximagetransform.microsoft.gradient(startColorstr='#ff0088cc', endColorstr='#ff0077b3', GradientType=0);
}
.dropdown-menu .disabled > a, .dropdown-menu .disabled > a:hover {
	color: #999999;
}
.dropdown-menu .disabled > a:hover {
	text-decoration: none;
	cursor: default;
	background-color: transparent;
}
.open {
	*z-index: 1000;
}
.open > .dropdown-menu {
	display: block;
}
.pull-right > .dropdown-menu {
	right: 0;
	left: auto;
}
.dropup .caret, .navbar-fixed-bottom .dropdown .caret {
	border-top: 0;
	border-bottom: 4px solid #000000;
	content: "\2191";
}
.dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu {
	top: auto;
	bottom: 100%;
	margin-bottom: 1px;
}
.dropdown-submenu {
	position: relative;
}
.dropdown-submenu > .dropdown-menu {
	top: 0;
	left: 100%;
	margin-top: -6px;
	margin-left: -1px;
	-webkit-border-radius: 0 6px 6px 6px;
	-moz-border-radius: 0 6px 6px 6px;
	border-radius: 0 6px 6px 6px;
}
.dropdown-submenu > .dropdown-menu.drop-left{
	left:-100%;
}
.dropdown-submenu:hover .dropdown-menu {
	display: block;
}
.dropdown-submenu > a:after {
	display: block;
	float: right;
	width: 0;
	height: 0;
	margin-top: 5px;
	margin-right: -10px;
	border-color: transparent;
	border-left-color: #cccccc;
	border-style: solid;
	border-width: 5px 0 5px 5px;
	content: " ";
}
.dropdown-submenu:hover > a:after {
	border-left-color: #ffffff;
}
.dropdown .dropdown-menu .nav-header {
	padding-right: 20px;
	padding-left: 20px;
}
/**
 * 	Context Styles
 */

.dropdown-context .nav-header {
	cursor: default;
}
.dropdown-context:before, .dropdown-context-up:before {
	position: absolute;
	top: -7px;
	left: 9px;
	display: inline-block;
	border-right: 7px solid transparent;
	border-bottom: 7px solid #ccc;
	border-left: 7px solid transparent;
	border-bottom-color: rgba(0, 0, 0, 0.2);
	content: '';
}
.dropdown-context:after, .dropdown-context-up:after {
	position: absolute;
	top: -6px;
	left: 10px;
	display: inline-block;
	border-right: 6px solid transparent;
	border-bottom: 6px solid #ffffff;
	border-left: 6px solid transparent;
	content: '';
}
.dropdown-context-up:before, .dropdown-context-up:after {
	top: auto;
	bottom: -7px;
	z-index: 9999;
}
.dropdown-context-up:before {
	border-right: 7px solid transparent;
	border-top: 7px solid #ccc;
	border-bottom: none;
	border-left: 7px solid transparent;
}
.dropdown-context-up:after {
	border-right: 6px solid transparent;
	border-top: 6px solid #ffffff;
	border-left: 6px solid transparent;
	border-bottom: none;
}
.dropdown-context-sub:before, .dropdown-context-sub:after {
	display: none;
}
.dropdown-context .dropdown-submenu:hover .dropdown-menu {
	display: none;
}
.dropdown-context .dropdown-submenu:hover > .dropdown-menu {
	display: block;
}

.compressed-context a{
	padding-left: 14px;
	padding-top: 0;
	padding-bottom: 0;
	font-size: 13px;
	}
.compressed-context .divider{
	margin: 5px 1px;
	}
.compressed-context .nav-header{
	padding:1px 13px;
	}
	/* ---------------demo------------------------ */
	body{
	margin:0;
	padding:0;
	color:#333;
	background:#eee url(http://subtlepatterns.subtlepatterns.netdna-cdn.com/patterns/retina_dust.png);
	text-shadow:0 1px 0 #fff;
	text-align:center;
	font-family:arial;
	cursor:default;
	}
a, a:visited{
	color:#333
	}
::selection{
	background:transparent;
	}
-moz-::selection{
	background:transparent;
	}
h1, h2, h4{
	font-family: 'Rokkitt', serif;
	font-weight:100;
	font-size:72px;
	}
	h1{
		text-align:center;
		}
	h2{
		font-size:36px;
		margin-bottom:0;
		}
	h4{
		font-size:30px;
		text-align:center;
		}
	h4 a{
		text-decoration:none;
		}
h3{
	font-family: 'Rokkitt', serif;
	margin-bottom: 0;
	border-bottom: 1px solid #DDD;
	-webkit-box-shadow: 0 1px 0 white;
	-moz-box-shadow: 0 1px 0 white;
	box-shadow: 0 1px 0 white;
	margin-top: 20px;
	}
	#download{
	    background: #fefefe;
	    width: 500px;
	    margin: 0 auto;
	    padding: 20px;
	    -webkit-border-radius: 5px;
	    -moz-border-radius: 5px;
	    border-radius: 5px;
	    border: 1px solid rgba(0,0,0,0.2);
		}
		
	.description{
		text-align:left;
		width:540px;
		margin:0 auto;
		padding:20px;
	}
	
	pre{
	    background: #333;
	    overflow: auto;
	    padding: 10px;
	    color: #fefefe;
	    text-shadow: 0 1px 2px #000;
	    -webkit-box-shadow: 0 1px 0 #fff, 0 1px 2px #000 inset;
	    -moz-box-shadow: 0 1px 0 #fff, 0 1px 2px #000 inset;
	    box-shadow: 0 1px 0 #fff, 0 1px 2px #000 inset;
		}
		
	.dropdown-menu{
		text-shadow:none;
	}
	
	
	table{
		font-size:12px;
		border-collapse:collapse;
		background:#fefefe;
	    border: 1px solid rgba(0,0,0,0.2);
	    font-family:monospace;
	    }
	    table th:last-child{
		    width:175px;
	    }
	
	table th, table td:last-child{
		font-family:arial;
	}
	
	.me-codesta{
		display: block;
		margin: 0 auto;
		}
		
	.amp{
		font-family:Baskerville,'Goudy Bookletter 1911',Palatino,'Book Antiqua',serif;
		font-style:italic;
	}
	.finale{
		position:relative;
		height:150px;
	}
	.finale h1{
		position:absolute;
		width:100%;
		-webkit-transition: opacity 0.2s linear; 
		-moz-transition: opacity 0.2s linear; 
		-o-transition: opacity 0.2s linear; 
         transition: opacity 0.2s linear; 
         }
         .finale .toggle{
	         opacity:0;
	         }
	         
	#donate{
		display:none;
	}
	.thanks{
		width:500px;
		margin:30px auto;
	}
	a#download{
		display:block;
		text-decoration:none;
	}


</style>

<html>
<head>
</head>

<body>
<h1>context.js</h1>
		
		<div id="download">Right Click to Demo <span class="amp">&amp;</span> Download</div>
		
		<div class="description">
			
			<h2>About</h2>
			<p>ContextJS is a lightweight solution for contextual menus. Currently, there are two versions.</p> <p>The first is to be used <i>with</i> <a href="twitter.github.com/bootstrap/" target="_blank">Twitters Bootstrap</a> (bootstrap.css specifically). If you do not use or want to use bootstrap.css, there is a standalone stylesheet to give the menu it's base styles.</p>
			
			<h2>Features</h2>
			
			<ul>
				<li>Linted: Valid JS</li>
				<li>Can be used with or without Twitters Bootstrap.css</li>
				<li>Event Based Links</li>
				<li>Anchor Links</li>
				<li>Headers</li>
				<li>Dividers</li>
				<li>Recursive Menus (infinite depth)</li>
				<li>Vertical Space Detection (turns into a "dropup")</li>
				<li>Horizontal Space Detection (Drops to the left instead of right)</li>
				<li>Add/Delete menus Dynamically</li>
				<li>Even works on <a href="http://google.com" class="inline-menu">Inline Links</a></li>
			</ul>
			
			<h2>Public API</h2>
			
			<h3>Initializing</h3>
			<pre>context.init({
    fadeSpeed: 100,
    filter: function ($obj){},
    above: 'auto',
    preventDoubleContext: true,
    compress: false
});</pre>

			<table border="1" cellpadding="6">
				<thead>
					<tr>
						<th>Paramater</th>
						<th>Type</th>
						<th>Default</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>fadeSpeed</td>
						<td>int</td>
						<td>100</td>
						<td>The speed in which the context menu fades in (in milliseconds)</td>
					</tr>
					<tr>
						<td>filter</td>
						<td>function</td>
						<td>null</td>
						<td>Function that each finished list element will pass through for extra modification.</td>
					</tr>
					<tr>
						<td>above</td>
						<td>string || boolean</td>
						<td>'auto'</td>
						<td>If set to 'auto', menu will appear as a "dropup" if there is not enough room below it. Settings to true will make the menu a "popup" by default.</td>
					</tr>
					<tr>
						<td>preventDoubleContext</td>
						<td>boolean</td>
						<td>true</td>
						<td>If set to true, browser-based context menus will not work on contextjs menus.</td>
					</tr>
					<tr>
						<td>compress</td>
						<td>boolean</td>
						<td>false</td>
						<td>If set to true, context menus will have less padding, making them (hopefully) more unobtrusive</td>
					</tr>
				</tbody>
			</table>

			<h3>Updating Settings</h3>
			<pre>context.settings({initSettings});</pre>
			
			<table border="1" cellpadding="6">
				<thead>
					<tr>
						<th>Paramater</th>
						<th>Type</th>
						<th>Default</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>settings</td>
						<td>object</td>
						<td>null</td>
						<td>The init settings can be placed in here to update context menus written to the DOM. Changing settings between attaching menus will give the menus their own options.</td>
					</tr>
				</tbody>
			</table>

			<h3>Attaching</h3>
			<pre>context.attach('#download', [menuObjects]);</pre>
			
			<table border="1" cellpadding="6">
				<thead>
					<tr>
						<th>Paramater</th>
						<th>Type</th>
						<th>Default</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>selector</td>
						<td>string</td>
						<td>null</td>
						<td>The jQuery (or css) selector of the element you want to apply the context menu to</td>
					</tr>
					<tr>
						<td>menuObjects</td>
						<td>array</td>
						<td>null</td>
						<td>An array of objects that define the menus structure</td>
					</tr>
				</tbody>
			</table>
			
			
			<h3>Destroying</h3>
			<pre>context.destroy('#download');</pre>
			
			<table border="1" cellpadding="6">
				<thead>
					<tr>
						<th>Paramater</th>
						<th>Type</th>
						<th>Default</th>
						<th>Description</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>selector</td>
						<td>string</td>
						<td>null</td>
						<td>The jQuery (or css) selector of the element you want to remove the context menu from</td>
					</tr>
				</tbody>
			</table>
			
			
			<h2>Menu Objects</h2>
			
			<h3>Headers</h3>
			<pre>{
	header: 'My Header Title'
}</pre>
			
			<h3>Anchor Links</h3>
			<pre>{
	text: 'My Link Title', 
	href: 'http://contextjs.com/', 
	target: '_blank'
}</pre>
			
			<h3>Dividers</h3>
			<pre>{
	divider: true
}</pre>
			
			<h3>Event Based Actions</h3>
			<pre>{
    text: 'Event Based Link',
    action: function(e){
    	e.preventDefault();
        alert('Do Something');
    }
}</pre>

			<h3>Sub-Menus</h3>
			<pre>{
    text: 'My Sub-menu',
    subMenu: [menuObjects]
}</pre>
			<h3>Tracking Links with Google Analytics</h3>
			<pre>{
	text: 'context.js', 
	href: 'http://contextjs.com/context.js', 
	target:'_blank', 
	action: function(e){
		_gaq.push(['_trackEvent', 'ContextJS Download', this.pathname, this.innerHTML]);
	}
}</pre>
			
			<h2>Changelog</h2>
			
			<h3>Version 1.0 (Initial Release)</h3>
			<h3>Version 1.5</h3>
			<ul>
				<li>Added Initialize Options</li>
				<li>Removal of Dropdown ID paramater</li>
				<li>Added Event-based items</li>
				<li>Added Headers</li>
				<li>Added Recursive Menus</li>
				<li>Vertical Space Detection</li>
			</ul>
			
			<h3>Version 2.0</h3>
			<ul>
				<li>Refined Vertical Space Detection</li>
				<li>Added Horizontal Space Detection</li>
				<li>Added an optional standalone CSS file for use without bootstrap</li>
				<li>Added preventDoubleContext parameter in the init function</li>
				<li>Added target parameter to links</li>
				<li>Fixed event bubbling (multi-level dropdowns in the DOM)</li>
			</ul>
			
			<h3>Version 2.1</h3>
			<ul>
				<li>Added settings function</li>
				<li>Added compressed code <span class="amp">&amp;</span> styles</li>
				<li>Cleaned up context.js code</li>
			</ul>
			
			<h3>Version 2.1.1</h3>
			<ul>
				<li>Fixed multiple menus becoming visible</li>
				<li>Refined Support for IE7 <span class="amp">&amp;</span> IE8</li>
			</ul>
			
			<h2>Notes</h2>
			<ul>
				<li>Stray trailing commas are disliked by IE. Make sure when creating your menu, you take that into account, elsewise, you will get the <code>SCRIPT5007: Unable to get value of the property</code> error.</li>
			</ul>
			
			<h2>Credits</h2>
			<ul>
				<li><a href="http://twitter.github.com/bootstrap/">Twitter Bootstrap</a></li>
				<li><script type="text/javascript" src="http://lab.jakiestfu.com/code.js" data-color="#ddd" id="codejs"></script></li>
			</ul>	
			<h4><a href="http://twitter.com/jakiestfu" target="_blank">Tweet to me with Bugs</a></h4>
			
			<div class="finale">
				<h1>Enjoy</h1>
				<h1 class="toggle">Me Codesta</h1>
			</div>
			<img src="mecodesta.png" class="me-codesta">
		</div>
		
		
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" id="donate"><input type="hidden" name="cmd" value="_s-xclick"><input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----"><input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!"><img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1"></form>

		
		
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		
		
		<script type="text/javascript">

		  var _gaq = _gaq || [];
		  _gaq.push(['_setAccount', 'UA-34440227-1']);
		  _gaq.push(['_trackPageview']);
		
		  (function() {
		    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		  })();
		
		</script>
</body>



</html>



<script>

//-------------------Context----------------------------
$(document).ready(function(){
	
	context.init({preventDoubleContext: false});

	context.attach('.body', [
		
		{header: 'Download'},
		{text: 'The Script', subMenu: [
			{header: 'Requires jQuery'},
			{text: 'context.js', href: 'http://lab.jakiestfu.com/contextjs/context.js', target:'_blank', action: function(e){
				_gaq.push(['_trackEvent', 'ContextJS Download', this.pathname, this.innerHTML]);
			}}
		]},
		{text: 'The Styles', subMenu: [
		
			{text: 'context.bootstrap.css', href: 'http://lab.jakiestfu.com/contextjs/context.bootstrap.css', target:'_blank', action: function(e){
				_gaq.push(['_trackEvent', 'ContextJS Bootstrap CSS Download', this.pathname, this.innerHTML]);
			}},
			
			{text: 'context.standalone.css', href: 'http://lab.jakiestfu.com/contextjs/context.standalone.css', target:'_blank', action: function(e){
				_gaq.push(['_trackEvent', 'ContextJS Standalone CSS Download', this.pathname, this.innerHTML]);
			}}
		]},
		{divider: true},
		{header: 'Meta'},
		{text: 'The Author', subMenu: [
			{header: '@jakiestfu'},
			{text: 'Website', href: 'http://jakiestfu.com/', target: '_blank'},
			{text: 'Forrst', href: 'http://forrst.com/people/jakiestfu', target: '_blank'},
			{text: 'Twitter', href: 'http://twitter.com/jakiestfu', target: '_blank'},
			{text: 'Donate?', action: function(e){
				e.preventDefault();
				$('#donate').submit();
			}}
		]},
		{text: 'Hmm?', subMenu: [
			{header: 'Well, thats lovely.'},
			{text: '2nd Level', subMenu: [
				{header: 'You like?'},
				{text: '3rd Level!?', subMenu: [
					{header: 'Of course you do'},
					{text: 'MENUCEPTION', subMenu: [
						{header:'FUCK'},
						{text: 'MAKE IT STOP!', subMenu: [
							{header: 'NEVAH!'},
							{text: 'Shieeet', subMenu: [
								{header: 'WIN'},
								{text: 'Dont Click Me', href: 'http://bit.ly/1dH1Zh1', target:'_blank', action: function(){
									_gaq.push(['_trackEvent', 'ContextJS Weezy Click', this.pathname, this.innerHTML]);
								}}
							]}
						]}
					]}
				]}
			]}
		]}
	]);
	
	context.settings({compress: true});
	
	context.attach('html', [
		{header: 'Compressed Menu'},
		{text: 'Back', href: '#'},
		{text: 'Reload', href: '#'},
		{divider: true},
		{text: 'Save As', href: '#'},
		{text: 'Print', href: '#'},
		{text: 'View Page Source', href: '#'},
		{text: 'View Page Info', href: '#'},
		{divider: true},
		{text: 'Inspect Element', href: '#'},
		{divider: true},
		{text: 'Disable This Menu', action: function(e){
			e.preventDefault();
			context.destroy('html');
			alert('html contextual menu destroyed!');
		}},
		{text: 'Donate?', action: function(e){
			e.preventDefault();
			$('#donate').submit();
		}}
	]);
	
	
	$(document).on('mouseover', '.me-codesta', function(){
		$('.finale h1:first').css({opacity:0});
		$('.finale h1:last').css({opacity:1});
	});
	
	$(document).on('mouseout', '.me-codesta', function(){
		$('.finale h1:last').css({opacity:0});
		$('.finale h1:first').css({opacity:1});
	});
	
});


//----------------------------

/* 
 * Context.js
 * Copyright Jacob Kelley
 * MIT License
 */

var context = context || (function () {
    
	var options = {
		fadeSpeed: 100,
		filter: function ($obj) {
			// Modify $obj, Do not return
		},
		above: 'auto',
		preventDoubleContext: true,
		compress: false
	};

	function initialize(opts) {
		
		options = $.extend({}, options, opts);
		
		$(document).on('click', 'html', function () {
			$('.dropdown-context').fadeOut(options.fadeSpeed, function(){
				$('.dropdown-context').css({display:''}).find('.drop-left').removeClass('drop-left');
			});
		});
		if(options.preventDoubleContext){
			$(document).on('contextmenu', '.dropdown-context', function (e) {
				e.preventDefault();
			});
		}
		$(document).on('mouseenter', '.dropdown-submenu', function(){
			var $sub = $(this).find('.dropdown-context-sub:first'),
				subWidth = $sub.width(),
				subLeft = $sub.offset().left,
				collision = (subWidth+subLeft) > window.innerWidth;
			if(collision){
				$sub.addClass('drop-left');
			}
		});
		
	}

	function updateOptions(opts){
		options = $.extend({}, options, opts);
	}

	function buildMenu(data, id, subMenu) {
		var subClass = (subMenu) ? ' dropdown-context-sub' : '',
			compressed = options.compress ? ' compressed-context' : '',
			$menu = $('<ul class="dropdown-menu dropdown-context' + subClass + compressed+'" id="dropdown-' + id + '"></ul>');
        var i = 0, linkTarget = '';
        for(i; i<data.length; i++) {
        	if (typeof data[i].divider !== 'undefined') {
				$menu.append('<li class="divider"></li>');
			} else if (typeof data[i].header !== 'undefined') {
				$menu.append('<li class="nav-header">' + data[i].header + '</li>');
			} else {
				if (typeof data[i].href == 'undefined') {
					data[i].href = '#';
				}
				if (typeof data[i].target !== 'undefined') {
					linkTarget = ' target="'+data[i].target+'"';
				}
				if (typeof data[i].subMenu !== 'undefined') {
					$sub = ('<li class="dropdown-submenu"><a tabindex="-1" href="' + data[i].href + '">' + data[i].text + '</a></li>');
				} else {
					$sub = $('<li><a tabindex="-1" href="' + data[i].href + '"'+linkTarget+'>' + data[i].text + '</a></li>');
				}
				if (typeof data[i].action !== 'undefined') {
					var actiond = new Date(),
						actionID = 'event-' + actiond.getTime() * Math.floor(Math.random()*100000),
						eventAction = data[i].action;
					$sub.find('a').attr('id', actionID);
					$('#' + actionID).addClass('context-event');
					$(document).on('click', '#' + actionID, eventAction);
				}
				$menu.append($sub);
				if (typeof data[i].subMenu != 'undefined') {
					var subMenuData = buildMenu(data[i].subMenu, id, true);
					$menu.find('li:last').append(subMenuData);
				}
			}
			if (typeof options.filter == 'function') {
				options.filter($menu.find('li:last'));
			}
		}
		return $menu;
	}

	function addContext(selector, data) {
		
		var d = new Date(),
			id = d.getTime(),
			$menu = buildMenu(data, id);
			
		$('body').append($menu);
		
		
		$(document).on('contextmenu', selector, function (e) {
			e.preventDefault();
			e.stopPropagation();
			
			$('.dropdown-context:not(.dropdown-context-sub)').hide();
			
			$dd = $('#dropdown-' + id);
			if (typeof options.above == 'boolean' && options.above) {
				$dd.addClass('dropdown-context-up').css({
					top: e.pageY - 20 - $('#dropdown-' + id).height(),
					left: e.pageX - 13
				}).fadeIn(options.fadeSpeed);
			} else if (typeof options.above == 'string' && options.above == 'auto') {
				$dd.removeClass('dropdown-context-up');
				var autoH = $dd.height() + 12;
				if ((e.pageY + autoH) > $('html').height()) {
					$dd.addClass('dropdown-context-up').css({
						top: e.pageY - 20 - autoH,
						left: e.pageX - 13
					}).fadeIn(options.fadeSpeed);
				} else {
					$dd.css({
						top: e.pageY + 10,
						left: e.pageX - 13
					}).fadeIn(options.fadeSpeed);
				}
			}
		});
	}
	
	function destroyContext(selector) {
		$(document).off('contextmenu', selector).off('click', '.context-event');
	}
	
	return {
		init: initialize,
		settings: updateOptions,
		attach: addContext,
		destroy: destroyContext
	};
})();
</script>
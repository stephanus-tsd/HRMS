<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" type="text/css" href="css/test.css" />

<!--[if lte IE 7]>
<style type="text/css">
html .jquerycssmenu{height: 1%;} /*Holly Hack for IE7 and below*/
</style>
<![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.2.6/jquery.min.js"></script>
<script type="text/javascript">
var arrowimages={down:['downarrowclass', 'arrow-down.jpg', 25], right:['rightarrowclass', 'arrow-right.jpg']}

var jquerycssmenu={

fadesettings: {overduration: 350, outduration: 100}, //duration of fade in/ out animation, in milliseconds

buildmenu:function(menuid, arrowsvar){
	jQuery(document).ready(function($){
		var $mainmenu=$("#"+menuid+">ul")
		var $headers=$mainmenu.find("ul").parent()
		$headers.each(function(i){
			var $curobj=$(this)
			var $subul=$(this).find('ul:eq(0)')
			this._dimensions={w:this.offsetWidth, h:this.offsetHeight, subulw:$subul.outerWidth(), subulh:$subul.outerHeight()}
			this.istopheader=$curobj.parents("ul").length==1? true : false
			$subul.css({top:this.istopheader? this._dimensions.h+"px" : 0})
			$curobj.children("a:eq(0)").css(this.istopheader? {paddingRight: arrowsvar.down[2]} : {}).append(
				'<img src="'+ (this.istopheader? arrowsvar.down[1] : arrowsvar.right[1])
				+'" class="' + (this.istopheader? arrowsvar.down[0] : arrowsvar.right[0])
				+ '" style="border:0;" />'
			)
			$curobj.hover(
				function(e){
					var $targetul=$(this).children("ul:eq(0)")
					this._offsets={left:$(this).offset().left, top:$(this).offset().top}
					var menuleft=this.istopheader? 0 : this._dimensions.w
					menuleft=(this._offsets.left+menuleft+this._dimensions.subulw>$(window).width())? (this.istopheader? -this._dimensions.subulw+this._dimensions.w : -this._dimensions.w) : menuleft
					$targetul.css({left:menuleft+"px"}).fadeIn(jquerycssmenu.fadesettings.overduration)
				},
				function(e){
					$(this).children("ul:eq(0)").fadeOut(jquerycssmenu.fadesettings.outduration)
				}
			) //end hover
		}) //end $headers.each()
		$mainmenu.find("ul").css({display:'none', visibility:'visible'})
	}) //end document.ready
}
}

//build menu with ID="myjquerymenu" on page:
jquerycssmenu.buildmenu("myjquerymenu", arrowimages)
</script>

</head>

<body>
<div id="myjquerymenu" class="jquerycssmenu">

<ul>
<li><a href="HOME.php">Home</a></li>
<li><a href="#">Employee</a>
  <ul>
  <li><a href="employee_list.php">Employee List</a></li>
  <li><a href="input_new_employee.php">Input New Employee</a></li>
  </ul>
</li>
<li><a href="#">Cuti</a>
  <ul>
  <li><a href="cuti.php">Pengajuan Cuti</a></li>
  <li><a href="cuti_delete.php">Cancel Cuti</a></li>
  <li><a href="cuti_report.php">Report Pengajuan Cuti</a></li>
  </ul>
</li>
<li><a href="#">Item 4</a></li>
</ul>
<br style="clear: left" />
</div>

</body>
</html>

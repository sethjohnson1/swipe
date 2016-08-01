<?
//get the images
$image=array();
foreach (glob('hat/*.JPG') as $key=>$filename) $image[$key]=$filename;
//if it's lowercase...
if (empty($image)) foreach (glob('hat/*.jpg') as $key=>$filename) $image[$key]=$filename;
?>
<html>
<head>
<script type="text/javascript" src="jquery-3.1.0.min.js"></script>
<script type="text/javascript" src="jquery.touchSwipe.min.js"></script>
<script type="text/javascript" src="jquery-easing.js"></script>

<script>
    $(function() {
		//do some math
		var totalimages=<?=count($image)?>;
		var increment=($( window ).width()/totalimages);

      //Enable swiping...
      $("#image_container").swipe( {
		swipeStatus:function(event) {
			percent=event.changedTouches[0].clientX/$( window ).width();
			imgnum=Math.round(totalimages*percent);
			if (imgnum<0) imgnum=0;
			if (imgnum>=totalimages) imgnum=totalimages-1;
			$(".images").hide();
			$("#img_"+imgnum).show();
        },

       // threshold:200,
        //maxTimeThreshold:5000,
        //fingers:'all'
      });
	  //show the first image
	  $("#img_0").fadeIn();
    });
</script>
<style>

body{
	background-color:black;
}
.images{
	display:none;
	width:100%;
	margin: 0 auto;
}
#image_container{
//don't work on nabi
//	position: relative;
//	top: 50%;
//	transform: 			translateY(-50%);
	width:100%;
}
</style>
</head>

<body>
<div id="image_container">
<?foreach($image as $k=>$img):?>
<img src="<?=$img?>" id="img_<?=$k?>" class="images" />
<?endforeach?>
</div>
<div id="test"></div>
</body>

</html>
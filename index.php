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
		var xwidth=$( window ).width();
		var increment=(xwidth/totalimages);
		var counter=0;
//event.changedTouches[0].clientX
      //Enable swiping...
      $("#image_container").swipe( {
		
	  //including all possible return values
		swipeStatus:function(event, phase, direction, distance, duration, fingers, fingerData, currentDirection) {
			val = event.target.id;
			current_imgnum = parseInt(val.substr(val.indexOf("_") + 1));
			if (direction=="right"){
				counter=counter+increment;
				if (counter>=(increment*(totalimages-1))) counter=0;
				imgnum=Math.round(counter/increment);
				
			}
			else if (direction=="left"){
				counter=counter-increment;
				if (counter<=0) counter=(totalimages-1)*increment;
				imgnum=Math.round(counter/increment);
			}
			else imgnum=current_imgnum;

			//a small delay might help, nothing now
			$(".images").delay(0).hide();
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
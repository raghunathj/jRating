<?php
//This is the rating script
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Rating</title>
		<style>
		.rating{
			display:none;
		}
			.rating_slot{
				background:url("images/star-blank.png") no-repeat;
				padding:10px;
				overflow:visible;
				float:left;
			}

			.rating_active{
				background:url("images/star-gold.png") no-repeat;
			}

			.ratingslot div span{
				visibility: hidden;
			}
		</style>
	</head>
	<body>
		<div id="ratingblock">
			<?php
				for($i = 1; $i <= 4; $i++){
				$ran = rand(2,5);
			?>
			<div class="rating rateset_<?php echo $i;?>" data-rating-default="<?php echo $ran; ?>">
			<div class="ratingslot">
				<?php
					for($s = 1; $s <= 5; $s++){
				?>
				<div class="rating_slot star_<?php echo $s;?>" data-product="<?php echo $i;?>" data-rating-default="<?php echo $ran;?>" data-rating="<?php echo $s;?>"><span><?php echo $s;?></span></div>
				<?php
					}
				?>
			</div>
			<div class="ratingcount_<?php echo $i;?>">
				<span class="ratecountnumber"><?php echo $ran; ?></span>/5
			</div>
		</div>
			<hr style="clear:both;"/>
			<?php
			}
		?>
		</div>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
		<script>
			$(document).ready(function(){
				//Rating Script Starts Here
				//Load Rating script for the first time
				loadrating();

				//Change rating position on hover
					$(".rating_slot").hover(
						function(){
							//Change Hover
							var rate_product = $(this).attr("data-product");
							$(this).prevAll().andSelf().addClass("rating_active");
							$(this).nextAll().removeClass('rating_active'); 
							$(".ratingcount_"+rate_product+" .ratecountnumber").html($(this).attr("data-rating"));
						},
						function(){
							var rate_product = $(this).attr("data-product");
							$(this).prevAll().andSelf().removeClass("rating_active");
							var def_rating = $(this).attr("data-rating-default");
							var data_rating = $(this).attr("data-rating");
							console.log(data_rating);
							//Reset If not clicked
								resetrating(rate_product,def_rating);
								$(".ratingcount_"+rate_product+" .ratecountnumber").html(def_rating);
						}
					);


				//Load Default ratings
				function loadrating(){
					var rating_class = '.rating';
					var rating_length = $(rating_class).length;
					for(var s = 1; s <= rating_length; s++){
						var rate_value = $(".rateset_"+s).attr("data-rating-default");
						$(".rateset_"+s).css("display","block");
						for(var d = 1; d <= rate_value; d++){
							$(".rateset_"+s+" .ratingslot .star_"+d).addClass("rating_active");
						}
					}
				}

				//Reset Rating - To be used only for hover
				function resetrating(i,cnt){
					console.log("HOVER ON: "+cnt);
					for(var d = 1; d <= cnt; d++){
							$(".rateset_"+i+" .ratingslot .star_"+d).addClass("rating_active");
					}
				}

				//Rating Action

				//Rating Scripts Ends here
			});
		</script>
	</body>
</html>
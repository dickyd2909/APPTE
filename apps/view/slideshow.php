<div id="bgslideshow">
	<script src="../assets/js/jssor.slider-23.1.0.min.js"></script>
	<script type="text/javascript">
		window.jssor_1_slider_init = function() {

			var jssor_1_SlideshowTransitions = [
			{$Duration:3000,$Zoom:11,$Easing:{$Zoom:$Jease$.$InCubic,$Opacity:$Jease$.$OutQuad},$Opacity:2}
			];

			var jssor_1_options = {
			$AutoPlay: 1,
			$SlideshowOptions: {
				$Class: $JssorSlideshowRunner$,
				$Transitions: jssor_1_SlideshowTransitions
			},
			$ArrowNavigatorOptions: {
				$Class: $JssorArrowNavigator$,
				$ChanceToShow: 1
			},
			$BulletNavigatorOptions: {
				$Class: $JssorBulletNavigator$,
				$SpacingX: 20,
				$SpacingY: 20,
				$ChanceToShow: 1
			}
			};

			var jssor_1_slider = new $JssorSlider$("jssor_1", jssor_1_options);

			/*#region responsive code begin*/

			var MAX_WIDTH = 3000;

			function ScaleSlider() {
				var containerElement = jssor_1_slider.$Elmt.parentNode;
				var containerWidth = containerElement.clientWidth;

				if (containerWidth) {

					var expectedWidth = Math.min(MAX_WIDTH || containerWidth, containerWidth);

					jssor_1_slider.$ScaleWidth(expectedWidth);
				}
				else {
					window.setTimeout(ScaleSlider, 30);
				}
			}

			ScaleSlider();

			$Jssor$.$AddEvent(window, "load", ScaleSlider);
			$Jssor$.$AddEvent(window, "resize", ScaleSlider);
			$Jssor$.$AddEvent(window, "orientationchange", ScaleSlider);
			/*#endregion responsive code end*/
		};
	</script>
	<style>
		/*jssor slider bullet skin 132 css*/
		.jssorb132 {position:absolute;}
		.jssorb132 .i {position:absolute;cursor:pointer;}
		.jssorb132 .i .b {fill:#fff;fill-opacity:0.8;stroke:#000;stroke-width:1600;stroke-miterlimit:10;stroke-opacity:0.7;}
		.jssorb132 .i:hover .b {fill:#000;fill-opacity:.7;stroke:#fff;stroke-width:2000;stroke-opacity:0.8;}
		.jssorb132 .iav .b {fill:#000;stroke:#fff;stroke-width:2400;fill-opacity:0.8;stroke-opacity:1;}
		.jssorb132 .i.idn {opacity:0.3;}

		/*jssor slider arrow skin 051 css*/
		.jssora051 {display:block;position:absolute;cursor:pointer;}
		.jssora051 .a {fill:none;stroke:#fff;stroke-width:360;stroke-miterlimit:10;}
		.jssora051:hover {opacity:.8;}
		.jssora051.jssora051dn {opacity:.5;}
		.jssora051.jssora051ds {opacity:.3;pointer-events:none;}
		
		.learnmore {padding:10px 20px;border-radius:3px;background:#E16E00;color:#fff;}
		.learnmore:hover {background:#004E81;}
		
		.remarks {padding:0;}
	</style>
	<div id="jssor_1" style="position:relative;margin:0 auto;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;visibility:hidden;">
		<div data-u="slides" style="cursor:default;position:relative;top:0px;left:0px;width:1920px;height:800px;overflow:hidden;">
			<?php
				$sdb = $koneksi->query("SELECT * FROM slideshow WHERE slideshow_status = 'Aktif' ORDER BY slideshow_order ASC");
				while($sdt = $sdb->fetch_array()){
			?>	  
				<div>
					<img data-u="image" src="../assets/images/slideshow/<?= $sdt['slideshow_image']; ?>" alt="<?= $sdt['slideshow_judul']; ?>" title="<?= $sdt['slideshow_judul']; ?>"/>
				</div>
			<?php } ?>
		</div>
		<!-- Bullet Navigator -->
		<div data-u="navigator" class="jssorb132" style="position:absolute;bottom:24px;right:16px;" data-autocenter="1" data-scale="0.5" data-scale-bottom="0.75">
			<div data-u="prototype" class="i" style="width:12px;height:12px;">
				<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
					<circle class="b" cx="8000" cy="8000" r="5800"></circle>
				</svg>
			</div>
		</div>
		<!-- Arrow Navigator -->
		<div data-u="arrowleft" class="jssora051" style="width:55px;height:55px;top:0px;left:25px;" data-autocenter="2" data-scale="0.75" data-scale-left="0.75">
			<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
				<polyline class="a" points="11040,1920 4960,8000 11040,14080 "></polyline>
			</svg>
		</div>
		<div data-u="arrowright" class="jssora051" style="width:55px;height:55px;top:0px;right:25px;" data-autocenter="2" data-scale="0.75" data-scale-right="0.75">
			<svg viewbox="0 0 16000 16000" style="position:absolute;top:0;left:0;width:100%;height:100%;">
				<polyline class="a" points="4960,1920 11040,8000 4960,14080 "></polyline>
			</svg>
		</div>
	</div>
	<script type="text/javascript">jssor_1_slider_init();</script>
</div>
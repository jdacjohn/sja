<?php $pagetitle = "Control Panel"; include '../core/base.php'; $div="panel"; include '../'.$head; check_logged();





?>
<h1>PHP Image Resizer</h1>

	<div class='block'>
		<?php $settings = array('w'=>300); ?>
		<div><img src='<?=resize('/assets/img/calendar.jpg',$settings)?>' border='0' /></div>
		<p>Image resized by width only</p>
		<div><pre><code>src: /assets/img/calendar.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
	</div>

	<div class='block'>
		<?php $settings = array('w'=>300,'h'=>300); ?>
		<div><img src='<?=resize('/assets/img/calendar.jpg',$settings)?>' border='0' /></div>
		<p>Image resized by width and height</p>
		<div><pre><code>src: /assets/img/calendar.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
	</div>

	<div class='block'>
		<?php $settings = array('w'=>240,'h'=>240,'canvas-color'=>'#ff0000'); ?>
		<div><img src='<?=resize('/assets/img/calendar.jpg',(array('w'=>240,'h'=>240,'canvas-color'=>'#ff0000')))?>' border='0' /></div>
		<p>Image resized by width and height and custom canvas color</p>
		<div><pre><code>src: /assets/img/calendar.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
	</div>

	<div class='block'>
		<?php $settings = array('w'=>300,'h'=>300,'crop'=>true); ?>
		<div><img src='<?=resize('/assets/img/calendar.jpg',$settings)?>' border='0' /></div>
		<p>Image cropped &amp; resized by width and height</p>
		<div><pre><code>src: /assets/img/calendar.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
	</div>

	<div class='block'>
		<?php $settings = array('w'=>300,'h'=>300,'scale'=>true); ?>
		<div><img src='<?=resize('/assets/img/calendar.jpg',$settings)?>' border='0' /></div>
		<p>Image scaled by width and height</p>
		<div><pre><code>src: /assets/img/calendar.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
	</div>

	<div class='block'>
		<?php $settings = array('w'=>100,'h'=>100,'crop'=>true); ?>
		<div><img src='<?=resize('http://farm4.static.flickr.com/3210/2934973285_fa4761c982.jpg',$settings)?>' border='0' /></div>
		<p>Image cropped &amp; resized by width and height from a remote location.</p>
		<div><pre><code>src: http://farm4.static.flickr.com/3210/2934973285_fa4761c982.jpg<?php echo "\n\n"; print_r($settings)?></code></pre></div>
<?php
echo $clear;





include '../'.$foot; ?>
<section id="<?php echo $id ?>" class="spotlight style3 left">
	<span class="image fit main bottom"><img src="{{ asset('plugins/landed/images/pic04.jpg') }}" alt="" /></span>
	<div class="content">
		<header>
			<h2><?php echo $title ?></h2>
			<p><?php echo $paragraph ?></p>
		</header>
		<p><?php echo $paragraph1 ?></p>
		<ul class="actions">
			<li><a href="<?php echo $liref ?>" class="button" style='<?php echo $listyle ?>'><?php echo $lititle ?></a></li>
		</ul>
	</div>
	<a href="<?php echo $aref ?>" class="goto-next scrolly" style='<?php echo $astyle ?>'><?php echo $atitle ?></a>
</section>
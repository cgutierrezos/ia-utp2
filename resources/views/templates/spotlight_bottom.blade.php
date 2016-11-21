<section id="<?php echo $id ?>" class="spotlight style1 bottom">
	<span class="image fit main"><img src="{{ asset('plugins/landed/images/pic02.jpg') }}" alt="" /></span>
	<div class="content">
		<div class="container">
			<div class="row">
				<div class="4u 12u$(medium)">
					<header>
						<h2><?php echo $title ?></h2>
						<p><?php echo $paragraph ?></p>
					</header>
				</div>
				<div class="4u 12u$(medium)">
					<p><?php echo $paragraph1 ?></p>
				</div>
				<div class="4u$ 12u$(medium)">
					<p><?php echo $paragraph2 ?></p>
				</div>
			</div>
		</div>
	</div>
	<a href="<?php echo $aref ?>" class="goto-next scrolly" style="<?php echo $astyle ?>" ><?php echo $atitle ?></a>
</section>
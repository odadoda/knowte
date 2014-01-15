<section>
	
	<aside class="meta">
		
		<h1><?php the_title(); ?></h1>
		<time id="published"><?php echo the_date('j F Y')?></time>
	</aside>
	
	<aside class="social">
	<?php 
		global $withcomments; $withcomments = 1; 
		comments_template(); 
		?>
	</aside>
	<main>
		<?php the_content(); ?>
	</main>
</section>
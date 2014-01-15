<? get_header(); ?>

	<aside class="meta">
		<?php display_navigation(); ?>
		
		<div class="archive">
		<h1>Tag: 
			<?php echo single_tag_title(); ?>
		</h1>
		</div>
	</aside>
	<main>
		<ul class="old-posts">
		<?php if ( have_posts() ) : ?>
	
			<?php while ( have_posts() ) : the_post(); ?>
				<?php //echo get_the_title();?>
				<?php //get_template_part( 'content', get_post_format() ); ?>
				<li>
					<a href="<?php echo get_permalink( $post->ID ) ?>">
					<div class="square"></div>
					<div class="post-data">
					
						<?php echo $post->post_title ?>
						
						<time><?php echo date("d M Y", strtotime($post->post_date)) ?></time>
					</div>
					</a>
					<article>
						<?php echo the_content()?>
					</article>
				</li>
			<?php endwhile; ?>

	
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
		</ul>

	</main>

<?php get_footer(); ?>
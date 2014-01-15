<?php


get_header();

?>

<section>
<?php display_searchbar(); ?>

<ul class="posts">
<?php 
				
while ( have_posts() ) : the_post(); ?>
	<li>
		<article>
			<aside class="meta">
					
					<div class="square">
					    <ul>
    					<?php
    					$tags = wp_get_post_tags(get_the_ID());
    					foreach($tags as $tag){
    					   echo '<li>
            					    <a href="'.get_tag_link($tag->term_id).'">' . $tag->name . '</a>
                                  </li>';
    					}
    					?>
					    </ul>
					</div>
					<div class="data">
						<h1><?php the_title(); ?></h1>
						<time id="published"><?php echo the_date('j F Y')?></time>
					</div>
				</aside>
			<div class="main">
			<?php the_content(); ?>
			</div>
		</article>
	</li>
	<?php endwhile; ?>
</ul>
</section>


<?php

get_footer();

?>
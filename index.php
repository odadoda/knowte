<?php


get_header();

?>

<section>
<?php display_searchbar(); ?>

    <ul class="posts" id="main-post-list">
        <?php 
        $args = "posts_per_page=40&category__in=9";
        query_posts($args);
        
        /* Start the Loop */ 
        while ( have_posts() ) : the_post(); ?>
        	<li>    
        	    <?php
        		 get_template_part( 'content', 'post' );
                 ?>
        	</li>
        	<?php 
        	endwhile;
            	
        	?>
    </ul>
</section>


<?php

get_footer();

?>
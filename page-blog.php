<?php
/**
 * Template name: blog
 */
 
get_header(); 
?>
<section>

<?php display_searchbar(); ?>

    <ul class="posts">
        <?php 
        $args = array( 'posts_per_page'  => 200, 'order_by' => 'ID', 'order' => 'DESC', 'category__in' => '95');
        $posts_array = new WP_Query( $args );
        
        while( $posts_array->have_posts() ) : $posts_array->the_post(); ?>
            <li>
            <?php  get_template_part( 'content', 'post' ); ?>
            </li>
        <?php 
        endwhile;
        
        ?>
        </ul>
    </ul>
</section>
<?php
get_footer();
?>
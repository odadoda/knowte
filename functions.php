<?php

add_action( 'after_setup_theme', 'stac_setup' );

function stac_setup(){
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style();
	add_theme_support( 'post-thumbnails' );
}


function scripts(){
    	wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js');	
}

add_action('wp_enqueue_scripts', 'scripts');




/*
	PEWPEW search
*/
add_filter( 'posts_where', 'pewpew_posts_where', 10, 2 );
function pewpew_posts_where( $where, $wp_query ){
    
    global $wpdb;
    if ( $pewpew_title =  $wp_query->get( 's' )  ) { //
        if($pewpew_title != ''){
        	$where .= ' AND ' . $wpdb->posts . '.post_title LIKE \'%' . esc_sql( like_escape( $pewpew_title ) ) . '%\'';
		}
    }
    return $where;
}


function pewpew_search(){
	
	$query = $_REQUEST['s'];
	
	
	// Match on title
	
	$post_args = array( 'category__in' => 9, 's' => $query, 'posts_per_page' => 100 );
	$posts = get_posts( $post_args );
	
	$html = "";
	
	foreach( $posts as $post ){
		$html .= '<li>
    				<article>
    					<aside class="meta">
    							<div class="square">
    							    <ul>';
    					$tags = wp_get_post_tags($post->ID);
    					foreach($tags as $tag){
    					   $html .= '<li>
            					        <a href="'.get_tag_link( $tag->term_id ).'">' . $tag->name . '</a>
                                     </li>';
    					}
    					
					    						
    	$html .= '  		    </ul>
    	                   </div>
    							<div class="data">
    								<h1>' . $post->post_title . '</h1>
    								<time id="published">' . the_date('j F Y') . '</time>
    							</div>
    					</aside>
                        <div class="main">
    					' . $post->post_content . '
    					</div>
    				</article>
				 </li>'; 		
	}

	echo $html;
	
	die();
}
    add_action("wp_ajax_pewpew_search", "pewpew_search",1,2);
    add_action("wp_ajax_nopriv_pewpew_search", "pewpew_search",1,2);

add_action( 'init', 'my_script_enqueuer' );


function my_script_enqueuer() {
   wp_register_script( "pewpew_search", get_bloginfo('template_url') . '/js/pewpew_search.js', array('jquery') );
   wp_localize_script( 'pewpew_search', 'pewpew', array( 'ajaxurl' => admin_url( 'admin-ajax.php' )));        

   wp_enqueue_script( 'jquery' );
   wp_enqueue_script( 'pewpew_search' );

}


function display_searchbar(){
	
	$tags = get_tags();
	
	?>
	<form id="pewpew_searchform" action="#" method="post" class="searchbar">
	    <label for="pewpew_searchbar" class="audible">Filtrer</label>
	    <input tabindex="0" list="taglist" type="text" id="pewpew_searchbar" name="pewpew_searchbar" tabindex="2" placeholder="tag / title"/>
	    <datalist id="taglist">
	    <?php 
	    foreach($tags as $tag){
    	    echo '<option value="'.$tag->name.'">'.$tag->name.'</option>';
	    }
        ?>
	    </datalist>
	</form>
	
	<?php
}

/********************************
*	END OF PEWPEW search
*********************************/


// Setting paths to the resources we will need later, js and styles
$path_to_js 	= get_stylesheet_directory_uri() . '/js/';
$path_to_styles = get_stylesheet_directory_uri() . '/style/';


// We don't want to load unnecessary things when browsing the Dashboard, right?
if ( ! is_admin() and is_page(772) != 1) {

	function load_LESS() {
	
		// Retrieving the paths we set above
		global $path_to_js, $path_to_styles;
		$path_to_js 	= get_stylesheet_directory_uri() . '/js/';
		$path_to_styles = get_stylesheet_directory_uri() . '/style/';

		// Actually printing the lines we need to load LESS in the HEAD
		print "\n<!-- Loading LESS styles and js -->\n".is_page(772);
		print "<link rel='stylesheet/less' id='style-less-css'  href='" . $path_to_styles . "style.less' type='text/css' media='screen, projection' />\n";
		print "<script type='text/javascript' src='" . $path_to_js . "less.js'></script>\n\n";
	}
	
	// Adding the action to the HEAD
	add_action( 'wp_head', 'load_LESS' );
    
} // END ! is_admin() 






function comment_box( $comment, $args, $depth ){
	$GLOBALS['comment'] = $comment;
	global $post;
	?>
	<li>
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<header>
				<div class="comment-author">
				<?php
					echo get_avatar( $comment, 44 );
					printf( '<cite class="fn">%1$s %2$s</cite>',
						get_comment_author_link(),
						// If current post author is also comment author, make it known visually.
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post author', 'stac' ) . '</span>' : ''
					);
				?>
				</div>
				<div class="comment-meta">
				<?php
				
					printf( '<time datetime="%2$s">%3$s</time>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'stac' ), get_comment_date('d  F Y'), get_comment_time() )
					);
				?>
				</div>
			</header><!-- .comment-meta -->
	
			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'stac' ); ?></p>
			<?php endif; ?>
	
			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'stac' ), '<p class="edit-link">', '</p>' ); ?>
			</section><!-- .comment-content -->
	
			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'stac' ), 'after' => ' <span>&darr;</span>', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	
	<?php
}

?>
<?php

if ( post_password_required() )
	return;
?>

<div id="comments" class="comments-area">

	<?php 
		$fields =  array(

		  'author' =>'<input type="text" name="author" id="author" placeholder="Name"/>',
		
		  'email' => '<input id="email" type="text" aria-required="true" size="30" value="" name="email" placeholder="Email (will not be shown)" />',
		
		);
		
		$args = array(
			'fields' => $fields,
			'comment_field' => '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="Reply"></textarea>',
			'comment_notes_after' => '',
			'comment_notes_before' => '',
			'title_reply' => '');
			
		comment_form($args); 
		
	?>
	<?php if ( have_comments() ) : ?>
	
		<ol class="commentlist">
			<!-- 'callback' => 'twentytwelve_comment',-->
			<?php wp_list_comments( array(  'style' => 'ol', 'callback' => 'comment_box') ); ?>
		</ol><!-- .commentlist -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
		<nav id="comment-nav-below" class="navigation" role="navigation">
			<h1 class="assistive-text section-heading"><?php _e( 'Kommentar navigasjon', 'stac' ); ?></h1>
			<div class="nav-previous"><?php previous_comments_link( __( '&larr; Eldre kommentarer', 'stac' ) ); ?></div>
			<div class="nav-next"><?php next_comments_link( __( 'Nyere kommentarer &rarr;', 'stac' ) ); ?></div>
		</nav>
		<?php endif; // check for comment navigation ?>

		<?php
		/* If there are no comments and comments are closed, let's leave a note.
		 * But we only want the note on posts and pages that had comments in the first place.
		 */
		if ( ! comments_open() && get_comments_number() ) : ?>
		<p class="nocomments"><?php _e( 'Kommentarfeltet er stengt.' , 'stac' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	

</div>
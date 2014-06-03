<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package Tress
 * @since Tress 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            <?php if ( !is_single() ) { ?>
                     <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>">
                            <?php the_post_thumbnail('post_feature_full_width'); ?>
                         <span class="link"><i class="fa fa-link"></i></span>
                         <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" ><span class="read_more"></span></a>
			 <?php $format = get_post_format( $post->ID );
			  ?>
			 <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>" ><span class="post_format">
			 <?php if ($format == 'video')  { ?>
			 <i class="fa fa-film"></i>
			 <?php } elseif ($format == 'gallery')  { ?>
			 <i class="fa fa-picture-o"></i>
			 <?php } elseif ($format == 'image')  { ?>
			 <i class="fa fa-file-image-o"></i>
			 <?php } elseif ($format == 'quote')  { ?>
			 <i class="fa fa-quote-left"></i>
			 <?php } elseif ($format == 'link')  { ?>
			 <i class="fa fa-link"></i>
			 <?php } else { ?>
			 <i class="fa fa-file-text"></i>
			 
			 <?php } ?>
			 </span></a>
                        </a>
            <?php } ?>
            
		<header class="entry-header">
                   
			<?php if ( is_single() ) { ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php }
			else { ?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html__( 'Permalink to %s', 'tress' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
			<?php } // is_single() ?>
			<?php tress_posted_on(); ?>
			<?php if ( has_post_thumbnail() && is_single() && !is_search() ) { ?>
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( esc_html_e( 'Permalink to %s', 'tress' ), the_title_attribute( 'echo=0' ) ) ); ?>">
					<?php the_post_thumbnail( 'post-thumb' ); ?>
				</a>
			<?php } ?>
		</header> <!-- /.entry-header -->

		<?php if ( is_search() || is_home() || is_archive()) { // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div> <!-- /.entry-summary -->
		<?php }
		else { ?>
			<div class="entry-content">
				<?php the_content( wp_kses( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'tress' ), array( 'span' => array( 
					'class' => array() ) ) )
					); ?>
				<?php wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'tress' ),
					'after' => '</div>',
					'link_before' => '<span class="page-numbers">',
					'link_after' => '</span>'
				) ); ?>
			</div> <!-- /.entry-content -->
		<?php } ?>

		<footer class="entry-meta">
			<?php if ( is_singular() ) {
				// Only show the tags on the Single Post page
				tress_entry_meta();
			} ?>
			<?php edit_post_link( esc_html__( 'Edit', 'tress' ) . ' <i class="fa fa-angle-right"></i>', '<div class="edit-link">', '</div>' ); ?>
			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) {
				// If a user has filled out their description and this is a multi-author blog, show their bio
				get_template_part( 'author-bio' );
			} ?>
		</footer> <!-- /.entry-meta -->
          
	</article> <!-- /#post -->

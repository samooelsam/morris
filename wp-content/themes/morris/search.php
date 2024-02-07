<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package Shape
 * @since Shape 1.0
 */

get_header(); ?>
<div class="middle-section-wrapper clearafix">
    <div class="single-post centerize grid_12 clearfix">
    <?php
        $counter = 0; 
        $searchQuery = $_GET['s'];
        if ( have_posts() ) : ?>
        <div class="single-post-content clearfix grid_8">
            <section id="primary" class="content-area">
                <div id="content" class="site-content" role="main">
                    <?php if(!empty($searchQuery)) {?>
                    <header class="search-page-header">
                        <h1 class="search-page-title"><?php printf( __( 'search results for %s', 'shape' ), '<span>"' . get_search_query() . '"</span>' ); ?></h1>
                    </header><!-- .page-header -->
                    <?php } ?>

                    <?php /* Start the Loop */ 
                    ?>
                    <?php while ( have_posts() ) : the_post(); ?>
                        
                        <?php
                        
                        get_template_part( 'templates/content', 'search' ); ?>

                    <?php
                    
                    endwhile; 
                    the_posts_pagination();?>
                    

                

                </div><!-- #content .site-content -->
            </section><!-- #primary .content-area -->
        </div>
        <?php else :?>
            nothing found
            <?php endif;?>
           
        
     </div>
</div>

<?php get_footer(); ?>
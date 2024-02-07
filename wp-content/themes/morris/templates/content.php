<article class="hr-blog-post-item content-search clearfix">
    <figure class="image-wrapper clearfix">
        <a href="<?php the_permalink();?>">
            <?php the_post_thumbnail( 'news-thumbnail-set' );?>
            <figcaption class="blur clearfix"></figcaption>
        </a>
    </figure>
    <div class="hr-blog-post-item-content clearfix">
        <h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
        <?php the_excerpt();?>
    </div>
</article>
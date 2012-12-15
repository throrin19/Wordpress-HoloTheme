<?php get_header(); ?>

<!-- Main Page Content and Sidebar -->
<div class="row">
    <!-- Main Blog Content -->
    <div class="nine columns" role="content">


        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article>
            <h3 class="title">
                <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </h3>
            <div class="row details">
                <div class="six columns">
                    <i class="ic-action-small ic-action-small-calendar-month"></i>
                    <?php echo the_date("l j F Y, G:i") ?>
                </div>
                <div class="six columns txt-right">
                    <i class="ic-action-small ic-action-small-star-10"></i>
                    <?php the_category(', ') ?>
                </div>
            </div>

            <div class="row content">
                <div class="twelve columns">
                    <?php the_content(); ?>
                </div>
            </div>
            <div class="row infos">
                <div class="four columns">
                    <i class="ic-action-small ic-action-small-user"></i><?php the_author_link(); ?>
                </div>
                <div class="four columns">
                    <i class="ic-action-small ic-action-small-sms"></i><?php comments_popup_link('Pas de Commentaires', '1 Commentaire ', '% Commentaire(s)'); ?>
                </div>
                <div class="four columns txt-right">

                </div>
            </div>
        </article>
        <?php endwhile; ?>

        <?php else : ?>
        <p>Désolé, mais vous cherchez quelque chose qui n'est pas ici.</p>
        <?php endif; ?>

        <div class="credential">
            <div class="connexe">
                <h5>A propos de l'auteur</h5>
            </div>
            <div class="author relative">
                <div class="picture">
                    <?php echo get_avatar( get_the_author_id() , 60 ); ?>
                </div>
                <div class="infos">
                    <h5><?php the_author_firstname(); ?> <?php the_author_lastname(); ?></h5>
                    <p><?php the_author_description(); ?></p>
                </div>
            </div>
            <div class="connexe">
                <?php
                    $backup = $post;
                    $tags = wp_get_post_tags($post->ID);
                    if ($tags) {
                        $tag_ids = array();
                        foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;

                        $args=array(
                            'tag__in' => $tag_ids,
                            'post__not_in' => array($post->ID),
                            'showposts'=>4, // Number of related posts that will be shown.
                            'caller_get_posts'=>1
                        );
                        $my_query = new wp_query($args);
                        if( $my_query->have_posts() ) {
                            echo "<h5>Articles Connexes</h5>";
                            $i = 1;
                            while ($my_query->have_posts()) {
                                $my_query->the_post();
                                if($i%2 == 1){ echo "<div class='row'>";  }
                ?>
                                <div class="six columns post">
                                    <div class="post-thumb">
                                        <?php the_post_thumbnail(array(60,60)); ?>
                                    </div>
                                    <div class="link">
                                        <h5><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h5>
                                    </div>
                                </div>
                <?php
                                if($i%2 == 0){ echo "</div>"; }
                                if($i/2 == 1 && !$my_query->have_posts()){ echo '<div class="six columns post"></div></div>'; }
                                ++$i;
                            }
                        }
                    }
                    $post = $backup;
                    wp_reset_query();
                ?>
            </div>
        </div>

        <?php comments_template(); ?>

    </div>
    <!-- End Main Content -->

    <!-- Sidebar -->
    <aside class="three columns">
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php get_footer(); ?>
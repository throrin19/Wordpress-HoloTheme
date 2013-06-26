<?php get_header(); ?>

        <!-- Main Page Content and Sidebar -->
        <div class="row">
            <!-- Main Blog Content -->
            <div class="nine columns" role="content">
                <!-- début titre recherche/catégorie/... -->
                <?php if(is_month()) { ?>
                <div class="archive-title">
                    Browsing articles from "<strong><?php the_time('F, Y') ?></strong>"
                </div>
                <?php } ?>
                <?php if(is_category()) { ?>
                <div class="archive-title">
                    Browsing articles in "<strong><?php $current_category = single_cat_title("", true); ?></strong>"
                </div>
                <?php } ?>
                <?php if(is_tag()) { ?>
                <div class="archive-title">
                    Browsing articles tagged with "<strong><?php wp_title('',true,''); ?></strong>"
                </div>
                <?php } ?>
                <?php if(is_author()) { ?>
                <div class="archive-title">
                    Browsing articles by "<strong><?php wp_title('',true,''); ?></strong>"
                </div>
                <?php } ?>
                <!-- fin titre recherche/titre/catégorie -->

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

                    <div class="row content summary">
                        <?php if(has_post_thumbnail()){ ?>
                            <?php
                                $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), array(684,375) );
                                $thumbnailSrc = $url[0];

                                $thumbSrc = get_template_directory_uri()."/timthumb.php?src=$thumbnailSrc&h=250&w=456&zc=1q=10";
                            ?>
                        <div class="four columns txt-center thumb" style="background-image: url('<?php echo $thumbSrc; ?>');"></div>
                        <div class="eight columns">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php }else{ ?>
                        <div class="twelve columns">
                            <?php the_excerpt(); ?>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="row infos">
                        <div class="four columns">
                            <i class="ic-action-small ic-action-small-user"></i><?php the_author_link(); ?>
                        </div>
                        <div class="four columns">
                            <i class="ic-action-small ic-action-small-sms"></i><?php comments_popup_link('Post Comments', '1 Comment ', '% Comment(s)'); ?>
                        </div>
                        <div class="four columns txt-right">
                            <a href="<?php the_permalink() ?>"><i class="ic-action-small ic-action-small-news"></i> Read more</a>
                        </div>
                    </div>
                </article>
                <?php endwhile; ?>

                <?php else : ?>
                <p>Désolé, mais vous cherchez quelque chose qui n'est pas ici.</p>
                <?php endif; ?>

                <?php
                    if (function_exists("holo_paginate")) {
                        holo_paginate();
                    }
                ?>
            </div>
            <!-- End Main Content -->

            <!-- Sidebar -->
            <aside class="three columns">
                <?php get_sidebar(); ?>
            </aside>
        </div>

<?php get_footer(); ?>
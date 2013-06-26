<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="keywords" content="<?php echo get_option('holo_keywords'); ?>" />
        <meta name="description" content="<?php echo get_option('holo_description'); ?>" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

        <!-- Included CSS Files (Compressed) -->
        <link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/foundation.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/jquery.nailthumb.1.1.min.css">
        <link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/stylesheets/app.css">

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/modernizr.foundation.js"></script>

        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php wp_get_archives('type=monthly&format=link'); ?>
        <?php wp_head(); ?>
    </head>
    <body>
    <!-- Header and Nav -->
    <div class="action-bar">
        <div class="row">
            <nav class="twelve columns top-bar">
                <ul class="action-bar-title">
                    <!-- Title Area -->
                    <li class="name">
                        <h1>
                            <a href="<?php bloginfo('url'); ?>/"><?php bloginfo('name'); ?></a>
                        </h1>
                    </li>
                    <li class="toggle-topbar"><a href="#"></a></li>
                </ul>
                <section>
                    <!-- Left Nav Section -->
                    <ul class="p-menu left cats">
                        <li class="divider"></li>

                        <?php
                            $pages = get_pages();
                            foreach($pages as $page){
                                if ($page->parent == 0) {
                                    $childs =  get_pages('parent='.$page->ID);
                        ?>
                        <li <?php if(count($childs) > 0){ ?>class="has-dropdown"<?php } ?>>
                            <a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
                            <?php if(count($childs) > 0){ ?>
                                 <ul class="dropdown">
                                     <?php foreach($childs as $child){ ?>
                                     <li><a href="<?php echo get_page_link($child->ID); ?>"><?php echo $child->post_title; ?></a></li>
                                     <?php } ?>
                                 </ul>
                            <?php } ?>
                        </li>
                        <li class="divider"></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>

                    <ul class="p-menu right">
                        <li class="has-dropdown ic-overflow">
                            <a href="#">
                                <span class="show-940">Overflow</span>
                                <img class="hide-940" src="<?php bloginfo('template_directory'); ?>/images/ic_action_overflow.png" alt="Overflow" />
                            </a>
                            <ul class="dropdown">
                                <?php
                                    $overflows = get_bookmarks( array (
                                                                    'category_name' => 'Menu'
                                                                       )
                                                              );
                                    foreach($overflows as $overflow){
                                ?>
                                <li>
                                    <a href="<?php echo $overflow->link_url; ?>"><?php echo $overflow->link_name; ?></a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </li>
                    </ul>
                </section>
            </nav>
        </div>
    </div>
    <!-- End Header and Nav -->

    <div class="title-bar">
        <div class="row">
            <div class="nine columns title-logo">
                <a href="<?php bloginfo('url'); ?>/">
                    <img src="<?php echo get_option('holo_logo_img'); ?>" alt="<?php echo get_option('holo_logo_alt'); ?>" />
                </a>
                <br>
                <span><?php echo get_settings('blogdescription');?></span>
            </div>
            <div class="three columns socials-buttons">
                <a class="ic-btn ic-action ic-action-feed" href="<?php bloginfo('rss2_url'); ?>"></a>
                <?php if(get_option('holo_twitter_link')!=""){ ?>
                <a class="ic-btn ic-action ic-action-twitter" href="<?php echo get_option('holo_twitter_link'); ?>"></a>
                <?php } ?>
                <?php if(get_option('holo_linkedin_link')!=""){ ?>
                <a class="ic-btn ic-action ic-action-linkedin" href="<?php echo get_option('holo_linkedin_link'); ?>"></a>
                <?php } ?>
                <?php if(get_option('holo_gplus_link')!=""){ ?>
                <a class="ic-btn ic-action ic-action-gplus" href="<?php echo get_option('holo_gplus_link'); ?>"></a>
                <?php } ?>
                <?php if(get_option('holo_github_link')!=""){ ?>
                <a class="ic-btn ic-action ic-action-github" href="<?php echo get_option('holo_github_link'); ?>"></a>
                <?php } ?>
                <?php if(get_option('holo_playstore_link')!=""){ ?>
                <a class="ic-btn ic-action ic-action-google-play" href="<?php echo get_option('holo_playstore_link'); ?>"></a>
                <?php } ?>
            </div>
        </div>
    </div>

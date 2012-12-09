<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
        <meta name="keywords" content="<?php echo get_option('alltuts_keywords'); ?>" />
        <meta name="description" content="<?php echo get_option('alltuts_description'); ?>" />

        <!-- Set the viewport width to device width for mobile -->
        <meta name="viewport" content="width=device-width" />

        <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

        <!-- Included CSS Files (Compressed) -->
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
                    <ul class="p-menu left">
                        <li class="divider"></li>

                        <?php
                            $categories = get_categories();
                            foreach($categories as $category){
                                if ($category->parent == 0) {
                                    $childs =  get_categories('parent='.$category->cat_ID);
                        ?>
                        <li <?php if(count($childs) > 0){ ?>class="has-dropdown"<?php } ?>>
                            <a href="<?php echo get_category_link($category->term_id); ?>"><?php echo $category->name; ?></a>
                            <?php if(count($childs) > 0){ ?>
                                 <ul class="dropdown">
                                     <?php foreach($childs as $child){ ?>
                                     <li><a href="<?php echo get_category_link($child->term_id); ?>"><?php echo $child->name; ?></a></li>
                                     <?php } ?>
                                 </ul>
                            <?php } ?>
                        </li>
                        <li class="divider"></li>
                        <?php
                                }
                            }
                        ?>

                        <!-- <li class="has-dropdown">
                            <a class="active" href="#">Main Item 1</a>
                            <ul class="dropdown">
                                <li><label>Section Name</label></li>
                                <li><a href="#" class="">Dropdown Level 1</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li class="divider"></li>
                                <li><label>Section Name</label></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li class="divider"></li>
                                <li><a href="#">See all &rarr;</a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>
                        <li><a href="#">Main Item 2</a></li>
                        <li class="divider"></li>
                        <li class="has-dropdown">
                            <a href="#">Main Item 3</a>
                            <ul class="dropdown">
                                <li><a href="#">Dropdown Option</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li><a href="#">Dropdown Option</a></li>
                                <li class="divider"></li>
                                <li><a href="#">See all &rarr;</a></li>
                            </ul>
                        </li>
                        <li class="divider"></li>  -->
                    </ul>

                    <ul class="p-menu right">
                        <li class="has-dropdown ic-overflow">
                            <a href="#">
                                <span class="show-940">Overflow</span>
                                <img class="hide-940" src="<?php bloginfo('template_directory'); ?>/images/ic_action_overflow.png" alt="Overflow" />
                            </a>
                            <ul class="dropdown">
                                <?php
                                    $pages = get_pages();
                                    foreach($pages as $page){
                                ?>
                                <li>
                                    <a href="<?php echo get_page_link($page->ID); ?>"><?php echo $page->post_title; ?></a>
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
                    <img src="http://placehold.it/550x100&text=[img]" alt="">
                </a>
                <br>
                <span><?php echo get_settings('blogdescription');?></span>
            </div>
            <div class="three columns socials-buttons">
                <a class="ic-btn ic-action ic-action-feed" href="<?php bloginfo('rss2_url'); ?>"></a>
                <a class="ic-btn ic-action ic-action-twitter" href="#"></a>
                <a class="ic-btn ic-action ic-action-linkedin" href="#"></a>
                <a class="ic-btn ic-action ic-action-gplus" href="#"></a>
                <a class="ic-btn ic-action ic-action-github" href="#"></a>
                <a class="ic-btn ic-action ic-action-google-play" href="#"></a>
            </div>
        </div>
    </div>

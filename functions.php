<?php
// Permet de rentre don thème widgets friendly
// Revu pour permettre de les adapter à notre thème
if ( function_exists('register_sidebar') ){
    register_sidebar(array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5><div class="content">',
    ));
    register_sidebar(array(
        'name'          => __( 'footer column 1' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5><div class="content">',
    ));
    register_sidebar(array(
        'name'          => __( 'footer column 2' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5><div class="content">',
    ));
    register_sidebar(array(
        'name'          => __( 'footer column 3' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5><div class="content">',
    ));
}

// widget des commentaires récents modifié pour notre thème
function widget_last_comments_widgets($args) {
    extract($args);
    $comments = get_comments( array(
        'number'    => 5,
        'status'    => 'approve'
    ) );
    ?>
<?php echo $before_widget; ?>
<?php echo $before_title
        . 'Commentaires Récents'
        . $after_title; ?>
<ul class="small">
    <?php foreach($comments as $comment){ ?>
    <?php $post = get_post($comment->comment_post_ID ); ?>
    <li>
        <a href="<?php echo get_comment_link($comment); ?>">
            <span><?php echo $comment->comment_author; ?></span>
            <span class="small"><?php echo $post->post_title; ?></span>
        </a>
    </li>
    <?php } ?>
</ul>
<?php echo $after_widget; ?>
<?php
}
wp_register_sidebar_widget('lcw_holo', 'Holo Last Comments', 'widget_last_comments_widgets');

// Widget des posts avec le plus de commentaires
// widget des commentaires récents modifié pour notre thème
function widget_popular_posts_widgets($args) {
    extract($args);
    $posts_array = get_posts(array(
        "orderby"       => "comment_count ",
        "order"         => "DESC",
        'numberposts'   => 10,
    ));
    ?>
<?php echo $before_widget; ?>
<?php echo $before_title
        . 'Messages Populaires'
        . $after_title; ?>
<ul class="small">
    <?php foreach($posts_array as $post){ ?>
    <li>
        <a href="<?php echo get_permalink($post->ID); ?>">
            <span><?php echo $post->post_title; ?></span>
            <span class="small"><?php echo $post->comment_count; ?> commentaire(s)</span>
        </a>
    </li>
    <?php } ?>
</ul>
<?php echo $after_widget; ?>
<?php
}
wp_register_sidebar_widget('ppw_holo', 'Holo Popular Posts', 'widget_popular_posts_widgets');

// fonctions de pagination
/*******************************
PAGINATION
 ********************************
 * Retrieve or display pagination code.
 *
 * The defaults for overwriting are:
 * 'page' - Default is null (int). The current page. This function will
 *      automatically determine the value.
 * 'pages' - Default is null (int). The total number of pages. This function will
 *      automatically determine the value.
 * 'range' - Default is 3 (int). The number of page links to show before and after
 *      the current page.
 * 'gap' - Default is 3 (int). The minimum number of pages before a gap is
 *      replaced with ellipses (...).
 * 'anchor' - Default is 1 (int). The number of links to always show at begining
 *      and end of pagination
 * 'before' - Default is '<div class="emm-paginate">' (string). The html or text
 *      to add before the pagination links.
 * 'after' - Default is '</div>' (string). The html or text to add after the
 *      pagination links.
 * 'title' - Default is '__('Pages:')' (string). The text to display before the
 *      pagination links.
 * 'next_page' - Default is '__('&raquo;')' (string). The text to use for the
 *      next page link.
 * 'previous_page' - Default is '__('&laquo')' (string). The text to use for the
 *      previous page link.
 * 'echo' - Default is 1 (int). To return the code instead of echo'ing, set this
 *      to 0 (zero).
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param array|string $args Optional. Override default arguments.
 * @return string HTML content, if not displaying.
 */

function holo_paginate($args = null) {
    $defaults = array(
        'page' => null, 'pages' => null,
        'range' => 3, 'gap' => 3, 'anchor' => 1,
        'before' => '<div class="emm-paginate">', 'after' => '</div>',
        'title' => __('Pages:'),
        'nextpage' => __('&raquo;'), 'previouspage' => __('&laquo'),
        'echo' => 1
    );

    $r = wp_parse_args($args, $defaults);
    extract($r, EXTR_SKIP);

    if (!$page && !$pages) {
        global $wp_query;

        $page = get_query_var('paged');
        $page = !empty($page) ? intval($page) : 1;

        $posts_per_page = intval(get_query_var('posts_per_page'));
        $pages = intval(ceil($wp_query->found_posts / $posts_per_page));
    }

    $output = "";
    if ($pages > 1) {
        $output .= "$before<span class='emm-title'>$title</span>";
        $ellipsis = "<span class='emm-gap'>...</span>";

        if ($page > 1 && !empty($previouspage)) {
            $output .= "<a href='" . get_pagenum_link($page - 1) . "' class='emm-prev'>$previouspage</a>";
        }

        $min_links = $range * 2 + 1;
        $block_min = min($page - $range, $pages - $min_links);
        $block_high = max($page + $range, $min_links);
        $left_gap = (($block_min - $anchor - $gap) > 0) ? true : false;
        $right_gap = (($block_high + $anchor + $gap) < $pages) ? true : false;

        if ($left_gap && !$right_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $pages, $page)
            );
        }
        else if ($left_gap && $right_gap) {
            $output .= sprintf('%s%s%s%s%s',
                emm_paginate_loop(1, $anchor),
                $ellipsis,
                emm_paginate_loop($block_min, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else if ($right_gap && !$left_gap) {
            $output .= sprintf('%s%s%s',
                emm_paginate_loop(1, $block_high, $page),
                $ellipsis,
                emm_paginate_loop(($pages - $anchor + 1), $pages)
            );
        }
        else {
            $output .= emm_paginate_loop(1, $pages, $page);
        }

        if ($page < $pages && !empty($nextpage)) {
            $output .= "<a href='" . get_pagenum_link($page + 1) . "' class='emm-next'>$nextpage</a>";
        }

        $output .= $after;
    }

    if ($echo) {
        echo $output;
    }

    return $output;
}

/**
 * Helper function for pagination which builds the page links.
 *
 * @access private
 *
 * @author Eric Martin <eric@ericmmartin.com>
 * @copyright Copyright (c) 2009, Eric Martin
 * @version 1.0
 *
 * @param int $start The first link page.
 * @param int $max The last link page.
 * @return int $page Optional, default is 0. The current page.
 */
function emm_paginate_loop($start, $max, $page = 0) {
    $output = "";
    for ($i = $start; $i <= $max; $i++) {
        $output .= ($page === intval($i))
            ? "<span class='emm-page emm-current'>$i</span>"
            : "<a href='" . get_pagenum_link($i) . "' class='emm-page'>$i</a>";
    }
    return $output;
}
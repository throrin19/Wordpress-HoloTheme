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
        'numberposts'   => 5,
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


/*******************************
THUMBNAIL SUPPORT
 ********************************/

add_theme_support( 'post-thumbnails' );
set_post_thumbnail_size( 180, 160, true );

/*******************************
CUSTOM COMMENTS
 ********************************/

function mytheme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment; ?>
<div <?php comment_class('clearfix', "comment"); ?> id="li-comment-<?php comment_ID() ?>" >
    <div class="avatar">
        <?php echo get_avatar($comment,$size='38',$default='http://www.gravatar.com/avatar/61a58ec1c1fba116f8424035089b7c71?s=32&d=&r=G' ); ?>
    </div>

    <div id="comment-<?php comment_ID(); ?>" class="comment-content">
        <div class="comment-meta commentmetadata clearfix row">
            <div class="six columns">
                <i class="ic-action-small ic-action-small-user"></i>
                <?php printf(__('<strong>%s</strong>'), get_comment_author_link()) ?><?php edit_comment_link(__('(Edit)'),'  ','') ?>
            </div>
            <div class="six columns txt-right">
                <i class="ic-action-small ic-action-small-calendar-day"></i>
                <span><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></span>
            </div>
        </div>

        <div class="text">
            <?php comment_text() ?>
        </div>

        <?php if ($comment->comment_approved == '0') : ?>
        <em><?php _e('Your comment is awaiting moderation.') ?></em>
        <br />
        <?php endif; ?>

        <div class="reply">
            <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
        </div>
    </div>
</div>
<?php }


/*******************************
THEME OPTIONS PAGE
 ********************************/

add_action('admin_menu', 'holo_theme_page');
function holo_theme_page ()
{
    if ( count($_POST) > 0 && isset($_POST['holo_settings']) )
    {
        $options = array ('logo_img', 'logo_alt','linkedin_link','twitter_link','gplus_link','github_link','playstore_link','keywords','description','analytics', 'copyright');

        foreach ( $options as $opt )
        {
            delete_option ( 'holo_'.$opt, $_POST[$opt] );
            add_option ( 'holo_'.$opt, $_POST[$opt] );
        }

    }
    add_menu_page(__('Holo Options'), __('Holo Options'), 'edit_themes', basename(__FILE__), 'holo_settings');
    add_submenu_page(__('Holo Options'), __('Holo Options'), 'edit_themes', basename(__FILE__), 'holo_settings');
}
function holo_settings()
{?>
<div class="wrap">
    <h2>holo Options Panel</h2>

    <form method="post" action="">
        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
            <legend style="margin-left:5px; padding:0 5px;color:#2481C6; text-transform:uppercase;"><strong>General Settings</strong></legend>
            <table class="form-table">
                <!-- General settings -->

                <tr valign="top">
                    <th scope="row"><label for="logo_img">Change logo (full path to logo image)</label></th>
                    <td>
                        <input name="logo_img" type="text" id="logo_img" value="<?php echo get_option('holo_logo_img'); ?>" class="regular-text" /><br />
                        <em>current logo:</em> <br /> <img src="<?php echo get_option('holo_logo_img'); ?>" alt="<?php echo get_option('holo_logo_alt'); ?>" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="logo_alt">Logo ALT Text</label></th>
                    <td>
                        <input name="logo_alt" type="text" id="logo_alt" value="<?php echo get_option('holo_logo_alt'); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>
        </fieldset>

        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
            <input type="hidden" name="holo_settings" value="save" style="display:none;" />
        </p>

        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
            <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Social Links</strong></legend>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row"><label for="linkedin_link">LinknedIn link</label></th>
                    <td>
                        <input name="linkedin_link" type="text" id="linkedin_link" value="<?php echo get_option('holo_linkedin_link'); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="linkedin_link">Twitter link</label></th>
                    <td>
                        <input name="twitter_link" type="text" id="twitter_link" value="<?php echo get_option('holo_twitter_link'); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="linkedin_link">Google+ link</label></th>
                    <td>
                        <input name="gplus_link" type="text" id="gplus_link" value="<?php echo get_option('holo_gplus_link'); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="linkedin_link">Github link</label></th>
                    <td>
                        <input name="github_link" type="text" id="github_link" value="<?php echo get_option('holo_github_link'); ?>" class="regular-text" />
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row"><label for="linkedin_link">Play Store Editor link</label></th>
                    <td>
                        <input name="playstore_link" type="text" id="playstore_link" value="<?php echo get_option('holo_playstore_link'); ?>" class="regular-text" />
                    </td>
                </tr>
            </table>
        </fieldset>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
            <input type="hidden" name="holo_settings" value="save" style="display:none;" />
        </p>

        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
            <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>Footer</strong></legend>
            <table class="form-table">
                <tr>
                    <th><label for="copyright">Copyright Text</label></th>
                    <td>
                        <textarea name="copyright" id="copyright" rows="4" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('holo_copyright')); ?></textarea><br />
                        <em>You can use HTML for links etc.</em>
                    </td>
                </tr>
            </table>
        </fieldset>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
            <input type="hidden" name="holo_settings" value="save" style="display:none;" />
        </p>

        <fieldset style="border:1px solid #ddd; padding-bottom:20px; margin-top:20px;">
            <legend style="margin-left:5px; padding:0 5px; color:#2481C6;text-transform:uppercase;"><strong>SEO</strong></legend>
            <table class="form-table">
                <tr>
                    <th><label for="keywords">Meta Keywords</label></th>
                    <td>
                        <textarea name="keywords" id="keywords" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('holo_keywords'); ?></textarea><br />
                        <em>Keywords comma separated</em>
                    </td>
                </tr>
                <tr>
                    <th><label for="description">Meta Description</label></th>
                    <td>
                        <textarea name="description" id="description" rows="7" cols="70" style="font-size:11px;"><?php echo get_option('holo_description'); ?></textarea>
                    </td>
                </tr>
                <tr>
                    <th><label for="ads">Google Analytics code:</label></th>
                    <td>
                        <textarea name="analytics" id="analytics" rows="7" cols="70" style="font-size:11px;"><?php echo stripslashes(get_option('holo_analytics')); ?></textarea>
                    </td>
                </tr>

            </table>
        </fieldset>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="Save Changes" />
            <input type="hidden" name="holo_settings" value="save" style="display:none;" />
        </p>
    </form>
</div>
<?php }
/*******************************
CONTACT FORM
 ********************************/

function hexstr($hexstr) {
    $hexstr = str_replace(' ', '', $hexstr);
    $hexstr = str_replace('\x', '', $hexstr);
    $retstr = pack('H*', $hexstr);
    return $retstr;
}

function strhex($string) {
    $hexstr = unpack('H*', $string);
    return array_shift($hexstr);
}
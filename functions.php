<?php
// Permet de rentre don thème widgets friendly
// Revu pour permettre de les adapter à notre thème
if ( function_exists('register_sidebar') )
    register_sidebar(array(
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></div>',
        'before_title' => '<h5 class="title">',
        'after_title' => '</h5><div class="content">',
    ));

// Ici on met notre widget des commentaires récents modifié pour notre thème
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

<?php

// Do not delete these lines
	if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
		die ('Please do not load this page directly. Thanks!');

	if ( post_password_required() ) { ?>
		<p class="nocomments">Ce poste est protégé par mot de passe. Entrez le mot de passe pour afficher les commentaires.</p>
	<?php
		return;
	}
?>

<!-- You can start editing here. -->
<?php if ('open' == $post->comment_status) : ?>

    <div id="respond" class="comments" name="comments">

        <h5 id="commentsForm"><?php comment_form_title( 'Laisser un commentaire', 'Laisser un commentaire à %s' ); ?></h5>

        <div class="cancel-comment-reply">
            <small><?php cancel_comment_reply_link(); ?></small>
        </div>

        <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p>Vous devez être <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?redirect_to=<?php echo urlencode(get_permalink()); ?>">connectés</a> pour poster un commentaire.</p>
        <?php else : ?>

        <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">

            <?php if ( $user_ID ) : ?>

            <p>Connecté en tant que <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a>. <a href="<?php echo wp_logout_url(get_permalink()); ?>" title="Log out of this account">Se déconnecter &raquo;</a></p>

            <?php else : ?>


            <div class="holo-field">
                <div class="holo-field-bckg"></div>
                <input type="text" name="author" id="author"
                       value="<?php echo $comment_author; ?>" size="22" tabindex="1"
                    <?php if ($req) echo "aria-required='true'"; ?>
                       placeholder="Nom <?php if ($req) echo "(required)"; ?>" />
            </div>
            <div class="holo-field">
                <div class="holo-field-bckg"></div>
                <input type="email" name="email" id="email"
                       value="<?php echo $comment_author_email; ?>"
                       size="22" tabindex="2"
                    <?php if ($req) echo "aria-required='true'"; ?>
                       placeholder="E-mail (ne sera pas publié) <?php if ($req) echo "(required)"; ?>" />
            </div>

            <div class="holo-field">
                <div class="holo-field-bckg"></div>
                <input type="url" name="url" id="url"
                       value="<?php echo $comment_author_url; ?>"
                       size="22" tabindex="3"
                       placeholder="Site Internet" />
            </div>

            <?php endif; ?>

            <div class="holo-field">
                <div class="holo-field-bckg"></div>
                <textarea name="comment" id="comment" cols="100%" rows="10" tabindex="4" placeholder="Comment"></textarea>
            </div>

            <p><input name="submit" type="submit" id="submit" class="secondary button" tabindex="5" value="POSTER" />
                <?php comment_id_fields(); ?>
            </p>
            <?php do_action('comment_form', $post->ID); ?>

        </form>

        <?php endif; // If registration required and not logged in ?>
    </div>
<?php else : // this is displayed if there are no comments so far ?>
    <!-- If comments are closed. -->
    <p class="nocomments">Les commentaires sont fermés.</p>
<?php endif; ?>


<?php if ( have_comments() ) : ?>
        <div class="comments">

	        <h5>Comments</h5>

	        <div class="commentlist">
	            <?php wp_list_comments('callback=mytheme_comment'); ?>
	        </div>
        </div>
<?php endif; // if you delete this the sky will fall on your head ?>

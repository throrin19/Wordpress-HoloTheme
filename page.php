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
            <div class="row content">
                <div class="twelve columns">
                    <?php the_content(); ?>
                </div>
            </div>
        </article>
        <?php endwhile; ?>

        <?php else : ?>
        <p>Désolé, mais vous cherchez quelque chose qui n'est pas ici.</p>
        <?php endif; ?>

    </div>
    <!-- End Main Content -->

    <!-- Sidebar -->
    <aside class="three columns">
        <?php get_sidebar(); ?>
    </aside>
</div>

<?php get_footer(); ?>
<!-- Sidebar.php -->
<form class="search" id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
    <div class="search-box relative">
        <div class="holo-field-bckg"></div>
        <i class="icons-search icon-action-search"></i>
        <input type="text" id="s" name="s" placeholder="Tapez votre Recherche Ici">
        <button type="submit" id="searchsubmit" class="submit"><i class="icons-search icon-social-send-now"></i></button>
    </div>
</form>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?><?php endif; ?>
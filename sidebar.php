<!-- Sidebar.php -->
<form class="search" id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
    <div class="search-box relative">
        <div class="holo-field-bckg"></div>
        <i class="ic-action-small ic-action-small-search"></i>
        <input type="text" id="s" name="s" placeholder="Tapez votre Recherche Ici">
        <input type="submit" value="" class="submit ic-action-small ic-action-small-send" id="searchsubmit">
    </div>
</form>

<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?><?php endif; ?>
        <!-- Footer -->
        <footer class="bottom-bar">
            <div class="row">
                <div class="twelve columns">
                    <div class="row">
                        <div class="four columns">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(2) ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="four columns">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(3) ) : ?>
                            <?php endif; ?>
                        </div>
                        <div class="four columns">
                            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar(4) ) : ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="twelve columns">
                    <p class="site-info">
                        <?php if (get_option('holo_copyright') <> ""){
                            echo stripslashes(stripslashes(get_option('holo_copyright')));
                        }else{
                            echo 'Copyright © 2009 - 2012 Throrin\'s Studio • Optimisé Webkit • Responsive WebDesign';
                        }?>
                    </p>

                </div>
            </div>
        </footer>
        <!-- End Footer -->

        <!-- Included JS Files (Uncompressed) -->
        <!--

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.mediaQueryToggle.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.forms.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.reveal.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.orbit.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.navigation.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.buttons.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.tabs.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.tooltips.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.accordion.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.placeholder.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.alerts.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.topbar.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.joyride.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.clearing.js"></script>

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.foundation.magellan.js"></script>

        -->
        <!-- Included JS Files (Compressed) -->
        <script src="<?php bloginfo('template_directory'); ?>/javascripts/jquery.js"></script>

        <!-- <script src="<?php bloginfo('template_directory'); ?>/javascripts/flexie.js"></script>  -->

        <script src="<?php bloginfo('template_directory'); ?>/javascripts/foundation.min.js"></script>

        <!-- Initialize JS Plugins -->
        <script src="<?php bloginfo('template_directory'); ?>/javascripts/app.js"></script>

        <?php if (get_option('holo_analytics') <> "") {
            echo stripslashes(stripslashes(get_option('holo_analytics')));
        } ?>
        <?php wp_footer(); ?>
    </body>
</html>
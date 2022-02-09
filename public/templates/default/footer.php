<?php
    global $current_user, $wp;
    wp_get_current_user();
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
    //available tag $template_id, $user_id;
    $footer_copyright_text = get_post_meta($template_id,"footer_copyright_text",true);
    if(empty($footer_copyright_text)){ $footer_copyright_text = "© ".get_the_date( 'Y' )." ".get_bloginfo('name').". All Right Reserved"; }
?>

<?php
    if(!empty($footer_copyright_text)){
?>
<div class="copyright-w3layouts py-xl-3 py-2 mt-xl-5 mt-4 text-center">
    <p> <?php echo do_shortcode($footer_copyright_text); ?></p>
</div>
<?php
  }
?>

    
    <script>
        
        (function( $ ) {
        	'use strict';
        	//paste this code under head tag or in a seperate js file.
        	
            <!-- loading-gif Js -->
                // Wait for window load
                $(window).load(function () {
                    // Animate loader off screen
                    $(".se-pre-con").fadeOut("slow");;
                });
            <!--// loading-gif Js -->
            
            <!-- Sidebar-nav Js -->
                $(document).ready(function () {
                    $('#sidebarCollapse').on('click', function () {
                        $('#sidebar').toggleClass('active');
                    });
                });
            <!--// Sidebar-nav Js -->
            
            <!-- dropdown nav -->
            $(document).ready(function () {
                $(".dropdown").hover(
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                        $(this).toggleClass('open');
                    },
                    function () {
                        $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                        $(this).toggleClass('open');
                    }
                );
            });
            <!-- //dropdown nav -->
        
        
        })( jQuery );

    </script>
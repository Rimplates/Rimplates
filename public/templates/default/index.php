<?php
global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $preloader_img = get_post_meta($template_id,"preloader-img",true);
    $default_post = get_post_meta($template_id,"default-post",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));

?>
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
   


    <div class="se-pre-con"></div>
    <div class="wrapper">

        <!-- Left Sidebar Start -->
        <?php include 'sidebar.php'; ?>
        <!-- Left Sidebar End

         <!-- Page Content Holder -->
         <div id="content">
            
             <!-- top-bar -->
             <?php include 'header.php'; ?>     
             <!--// top-bar -->            
             <div class="container-fluid">
             <?php 
                $content_id = sanitize_text_field($_GET["rimplenet-view-post"]);
                if(is_numeric($content_id)){
                  $content = get_post_field('post_content', $content_id);
                }
                elseif(is_numeric($default_post)){
                  $content = get_post_field('post_content', $default_post);
                }else{
                   $content = get_post_field('post_content', $template_id);
                }
                 echo apply_filters('the_content',$content );
                 
               ?>
            </div>
            
            <!-- Copyright -->
             <?php include 'footer.php'; ?>  
            <!--// Copyright -->
        </div>
    </div>
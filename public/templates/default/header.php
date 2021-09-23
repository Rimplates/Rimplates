<?php
    global $current_user, $wp;
    wp_get_current_user();
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request ));
    //available tag $template_id, $user_id;
    $header_text = get_post_meta($template_id,"header-text",true);
    if(!empty($header_text)){
        $header_text = $header_text;
    }
    elseif(is_numeric(sanitize_text_field($_GET["rimplenet-view-post"]))){
        $header_text = get_the_title(sanitize_text_field($_GET["rimplenet-view-post"]));
    }
    elseif(get_post_meta($template_id,"default-post",true)){
        $header_text = get_the_title(get_post_meta($template_id,"default-post",true));
    }
?>
 <nav class="navbar navbar-default mb-xl-5 mb-4">
                <div class="container-fluid">

                    <div class="navbar-header">
                        <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                            <i class="fas fa-bars"></i>
                        </button>
                        
                    </div>
                    <div>
                        <h4 class="tittle-w3-agileits mb-4"> <?php echo do_shortcode($header_text); ?> </h4>
                    </div>
                    
                 
                </div>
             </nav>  
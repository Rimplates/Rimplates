 <?php
    global $current_user, $wp;
    wp_get_current_user();
    //available tag $template_id, $user_id;
    $sidebar_mode = get_post_meta($template_id,"sidebar-mode",true);
    $viewed_url = add_query_arg($_SERVER['QUERY_STRING'], '', home_url($wp->request));
    
    
    $sidebar_menu = get_post_meta($template_id,"sidebar-menu",true);
    
    
    $dashboard_title = get_post_meta($template_id,"title",true);
    if(empty($dashboard_title)){ $dashboard_title = get_the_title($template_id); }
    $dashboard_small_title = get_post_meta($template_id,"small-title",true);
    if(empty($dashboard_small_title)){ $dashboard_small_title = "---"; }
    
    $dashboard_logo = get_post_meta($template_id,"dashboard-logo",true);
    if(empty($dashboard_logo)){ $dashboard_logo = get_site_icon_url('', ''); }
    
    $dashboard_logo_dark = get_post_meta($template_id,"dashboard-logo-dark",true);
?> 
    
    <nav id="sidebar" class="">
        <div class="sidebar-header">
            <h1>
                <a href="<?php echo esc_url(__(get_permalink(), 'rimplates')); ?>"><?php echo esc_html(__($dashboard_title, 'rimplates'));  ?></a>
            </h1>
            <span><?php echo esc_html(__($dashboard_small_title, 'rimplates')); ?></span>
        </div>
        <div class="profile-bg"></div>
         <ul class="list-unstyled components">
             
            <?php
                    
                    
              $leftMenuChosen = $sidebar_menu;
              $leftMenu = wp_get_nav_menu_items($leftMenuChosen);
              if ($leftMenu!=false) {
              
               //var_dump($leftMenu);
               
               
                $menu_parent_ids = array_column($leftMenu, 'menu_item_parent');
                $menu_parent_ids_count =  array_count_values($menu_parent_ids);
                foreach ($leftMenu as $key => $menu) {
                   
                 //$menu_item_target = get_post_meta( $menu->ID, '_menu_item_target',true);
                 $post_id = $menu->object_id;
                
                  if (get_post_meta( $menu->ID, '_rimplenet_menu_meta',true)) {
                    $icon_name = get_post_meta( $menu->ID, '_rimplenet_menu_meta',true);
                    $icon_disp = '<span class="material-icons">'.$icon_name.'</span>';
                  }
                  else{
                    $icon_disp = '';
                  }
                 if(rtrim(get_permalink(), "/")==rtrim($menu->url, "/") ){//if it's this same page link
                    $active_menu_disp = 'active';
                 }
                else{
                    $active_menu_disp = '';
                  }
                                     
                if($menu->type=='custom'){
                    $menu_item_link = $menu->url;
                    }
                elseif( rtrim(get_permalink(), "/")== rtrim($menu->url, "/") ){//if it's this same page link
                    $menu_item_link = $menu->url;
                    }
                else{
                    $menu_item_link = get_permalink().'?rimplenet-view-post='.$post_id;
                  }
                 //echo var_dump($menu);
                  
                  
                  if ($menu->menu_item_parent == 0) {//has no parent
                    $child_counter = $menu_parent_ids_count[$menu->ID];
                    if($child_counter>1){ //if has children, open tag <li> and <a with class dropdown ot be closed in COUNTER REDUCTION FXN
                         ?>
                         
                        <li class="<?php echo esc_attr(__($active_menu_disp, 'rimplates')); ?>">
                            <a href="#Dropdown<?php echo esc_attr(__($menu->ID, 'rimplates')); ?>" data-toggle="collapse" aria-expanded="false"  target="<?php  echo esc_attr(__($menu->target, 'rimplates')); ?>">
                                           
                               <?php echo esc_html(__($icon_disp, 'rimplates'));  ?> <?php echo esc_html(__($menu->title, 'rimplates'));?> 
                                <i class="fas fa-angle-down fa-pull-right"></i>
                            </a>
                            <ul class="collapse list-unstyled" id="Dropdown<?php echo esc_attr(__($menu->ID, 'rimplates')); ?>" >
                         <?php
                            }
                            else{
                             ?>
                            <li class="<?php echo esc_attr(__($active_menu_disp, 'rimplates')); ?>">
                                <a href="<?php echo esc_url(__($menu_item_link, 'rimplates')); ?>" target="<?php echo esc_attr(__($menu->target, 'rimplates')); ?>">
                                    
                                   <?php echo esc_html(__($icon_disp, 'rimplates')); ?> <?php echo esc_html(__($menu->title, 'rimplates')); ?> 
                                </a>
                            </li>
                        
                             <?php    
                            }
                  }
                  else{ //When it has parent
                  
               ?>
                   
                   <li class="<?php echo esc_attr(__($active_menu_disp, 'rimplates')); ?>">
                        <a href="<?php echo esc_url(__($menu_item_link, 'rimplates')); ?>" target="<?php echo esc_attr(__($menu->target, 'rimplates')); ?>">
                           
                           <?php echo esc_html(__($icon_disp, 'rimplates')); ?> <?php echo esc_html(__($menu->title, 'rimplates')); ?>  
                           
                        </a>
                    </li>

               
              <?php
              
                      $child_counter--;//reduce remaining children - COUNTER REDUCTION FXN 
                      if($child_counter==0){
                ?>
                          </ul>
                        </li>
                <?php
                          $child_counter = 'not_yet';
                      }
                  }
                 
                 }

               ?>
              

            <?php

            }

             else{
              echo '<li>
                    <a href="javascript:void(0)">
                        <i class="far fa-map"></i>
                        Set Menu in Template Settings Page- (<small> visible to only you </small>)
                    </a>
                </li>';
              }
            ?>            
             
        </ul>
    </nav>

<?php
        $template_post_id = $meta_id->ID;
        $template = get_post_meta($template_post_id, 'template', true);
        //$small_title = get_post_meta( $template_post_id, 'small_title', true );
        $small_title = get_post_meta($template_post_id, 'small_title', true);
        
        $rimplates_template_header = get_post_meta($template_post_id, 'title', true);
        $rimplates_template_footer = get_post_meta($template_post_id, 'footer_copyright_text', true);
        
        $sidebar_menu = get_post_meta($template_post_id, 'sidebar_menu', true);
        $rimplates_page_id = get_post_meta($template_post_id, 'rimplates_default_post', true);

        $rimplates_dashboard_pic = get_post_meta($template_post_id, 'rimplates_dashboard_pic', true);

?>
    <table class="form-table">
          <tbody>
            <tr>
                <th colspan="2"><h2>BASIC SETTINGS</h2> </th>  
            </tr>
    
               <tr>
                <th>
                 <label for="rimplates_template"> 
                     Template 
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Template"></span>
                 </label>
                </th>
                <td>
                   <select name="rimplates_template" id="rimplates_template" style="width: 100%;max-width: 400px; height: 40px;" required>
                         <option selected="selected" value="default"> Default </option> 
                      </select>
                </td>
            </tr>

            <tr>
                <th><label for="rimplates_small_title"> 
                     Small Title 
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Small Title"></span>
                </label></th>
                <td><input name="rimplates_small_title" id="rimplates_small_title" type="text" value="<?php echo esc_attr($small_title); ?>" placeholder="RNSD" maxlength="4" maxlength=4 class="regular-text" required style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>

             <tr>
                <th>
                 <label for="rimplates_default_post"> 
                     Default Page
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Default Page"></span>
                 </label>
                </th>
                <td> <?php wp_dropdown_pages([
                                'depth'                 => 0,
                                'child_of'              => 0,
                                'selected'              => isset($rimplates_page_id) ? $rimplates_page_id : 0,
                                'echo'                  => 1,
                                'name'                  => 'rimplates_default_post',
                                'id'                    => '',
                                'class'                 => '',
                                'show_option_none'      => '',
                                'show_option_no_change' => '',
                                'option_none_value'     => '',
                                'value_field'           => 'ID',
                            ]);
                        ?> 
                   <!-- <select name="rimplates_page_template" id="rimplates_page_template" style="width: 100%;max-width: 400px; height: 40px;" required>
                       
                      </select> -->
                </td>
            </tr>

             <tr>
                <th>
                 <label for="rimplates_sidebar_menu_template"> 
                     Sidebar Menu 
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Sidebar Menu"></span>
                 </label>
                </th>
                <td>
                   <?php $nav_menus = wp_get_nav_menus(); 
                    $menu_names = wp_list_pluck($nav_menus, 'name');
                    $menu_slugs = wp_list_pluck($nav_menus, 'slug');

                   ?>
                      <select name="rimplates_sidebar_menu" id="rimplates_sidebar_menu_template" style="width: 100%;max-width: 400px; height: 40px;">
                        <option value=""> Choose one menu </option>
                        <?php foreach ($nav_menus as $key => $value) { ?>
                            <option <?php selected( $sidebar_menu, $menu_slugs[$key] ); ?> value="<?= $menu_slugs[$key]; ?>"><?= $menu_names[$key]; ?></option>
                        <?php } ?>
                </td>
            </tr>
      

            <tr>
                <th><label for="rimplates_template_header_text"> 
                     Header Text 
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Header Text"></span>
                </label></th>
                <td><input name="rimplates_template_header_text" id="rimplates_template_header_text" type="text" value="<?php echo esc_attr($rimplates_template_header); ?>" placeholder="Header Text" class="regular-text" maxlength="10" required style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>

            <tr>
                <th><label for="rimplates_company_profile_pic"> 
                     Company Dashboard Profile Picture
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Company Dashboard Profile Picture"></span>
                </label></th>
                <td><input name="rimplates_dashboard_pic" id="rimplates_company_profile_pic" type="file" value="<?php echo esc_attr($rimplates_dashboard_pic); ?>" class="regular-text" style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>


            <tr>
                <th>
                 <label for="rimplates_template_footer_text"> 
                     Footer Copyright 
                     <span class="dashicons dashicons-editor-help rimplates-admin-tooltip" title="Footer Copyright"></span>
                 </label>
                </th>
                <td><input name="rimplates_template_footer_text" id="rimplates_template_footer_text" type="text" value="<?php echo esc_attr($rimplates_template_footer); ?>" placeholder="Footer Text" class="regular-text" style="width:100%;max-width: 400px; height: 40px;"> </td>
            </tr>
            
            <?php 
                if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))){
                //Only show below fields if Woocommerce is Installed and Activated
            ?>
          
            <?php
                }
            ?>
         
            </tbody>
        </table>
     

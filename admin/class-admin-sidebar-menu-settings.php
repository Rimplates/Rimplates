<?php  
//This file is included at admin/class-rimplates-admin.php.php

class RimplatesAdminSidebarMenuSettings {
  
  public function __construct() {
        
        //Hook into the admin menu
        //add_action( 'admin_menu', array( $this, 'admin_menu_dashboard' ) );
     
        add_action( 'admin_menu', array( $this, 'admin_menu_docs_setup_link' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu_donate_link' ) );
        
        add_filter("plugin_action_links_rimplates/rimplates.php", array( $this, 'my_plugin_settings_link') );// Display link on plugins page
        add_action( 'admin_footer', array($this,'make_class_menu_target_blank' )); // makes some links target="_blank"   

        
    }
 
  public function admin_menu_dashboard(){
     add_submenu_page(
            'edit.php?post_type=rimplates',
            __( 'Dashboard', 'rimplates' ),
            __( 'Dashboard', 'rimplates' ),
            'manage_options',
            'dashboard',
            array( $this, 'tab_manager_dashboard_fxn' )
            );
  }

  public function tab_manager_dashboard_fxn(){
      include_once plugin_dir_path( dirname( __FILE__ ) ) . '/admin/layouts/tab-manager-dashboard.php';
   }

  
    public function admin_menu_docs_setup_link(){
     add_submenu_page(
            'edit.php?post_type=rimplates',
            __( '<strong style="color:#FCB214;" class="open-submenu-blank"> Docs / Setup Info</strong>', 'rimplates' ),
            __( '<strong style="color:#FCB214;" class="open-submenu-blank"> Docs / Setup Info</strong>', 'rimplates' ),
            'manage_options',
            'https://rimplenet.com/docs'
            );
       
    }


     
    public function admin_menu_donate_link(){
     add_submenu_page(
            'edit.php?post_type=rimplates',
            __( '<strong style="color:#31a231;" class="open-submenu-blank"> Donate </strong>', 'rimplates' ),
            __( '<strong style="color:#31a231;" class="open-submenu-blank"> Donate </strong>', 'rimplates' ),
            'manage_options',
            'https://rimplenet.com/donate'
            
            );
    }
  
    function make_class_menu_target_blank(){
        ?>
        <script type="text/javascript">
          jQuery(document).ready(function($) {
            $('.open-submenu-blank').parent().attr('target','_blank');
          });
        </script>
        <?php
    }
     
    function my_plugin_settings_link($links) { 
      //Works on Plugins Acivation / Deactiavtion Page
      // Build and escape the URL. 
      $url = esc_url('https://rimplenet.com/docs');
      // Create the link.
      $docs_link = "<a href='https://rimplenet.com/docs'  style='color: #93003c;font-weight: 800;' target='_blank'>" . __( 'Docs / Setup Info' ) . '</a>';
      $donate_link = "<a href='https://rimplenet.com/donate' style='color: #FCB214;font-weight: 800;' target='_blank'>" . __( 'Donate' ) . '</a>';
      // Adds the link to the end of the array.
      $added_links = array($docs_link,$donate_link);
      
      $all_links = array_merge($added_links,$links);
      return $all_links;
    }
     
  
 }

$RimplatesAdminSidebarMenuSettings = new RimplatesAdminSidebarMenuSettings();
?>
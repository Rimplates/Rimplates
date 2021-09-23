<?php

function add_rimplates_default_template_stylesheet() 
    {
     //Bootstrap Css 
      wp_enqueue_style('rimplates-template-default-bootstrap', plugins_url('/assets/css/bootstrap.css', __FILE__ ) );
     //Bars Css 
      wp_enqueue_style( 'rimplates-template-default-bars', plugins_url( '/assets/css/bar.css', __FILE__ ) );
      //Calendar Css 
      wp_enqueue_style( 'rimplates-template-default-calendar', plugins_url( '/assets/css/pignose.calender.css', __FILE__ ) );
      //Common Css 
      wp_enqueue_style( 'rimplates-template-default-common', plugins_url( '/assets/css/style.css', __FILE__ ) );
      //Nav Css
      wp_enqueue_style( 'rimplates-template-default-nav', plugins_url( '/assets/css/style4.css', __FILE__ ) );
      //Widgets Css
      wp_enqueue_style( 'rimplates-template-default-widgets', plugins_url( '/assets/css/widgets.css', __FILE__ ) );
      //Fontawesome Css
      wp_enqueue_style( 'rimplates-template-default-fontawesome', plugins_url( '/assets/css/fontawesome-all.css', __FILE__ ) );
      
     //Google Font
      wp_enqueue_style('rimplates-template-default-google-font-poiret-one', '//fonts.googleapis.com/css?family=Poiret+One');
      wp_enqueue_style('rimplates-template-default-google-font-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600,700');
      
      wp_enqueue_style('rimplates-template-default-google-font-icons', '//fonts.googleapis.com/css?family=Material+Icons');
      
    }

add_action('wp_enqueue_scripts', 'add_rimplates_default_template_stylesheet');



function add_rimplates_default_template_js() {
      //Js for bootstrap working
      wp_enqueue_script( 'rimplates-template-default-bootstrap',  plugins_url( '/assets/js/bootstrap.min.js', __FILE__ ), array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'add_rimplates_default_template_js' );

?>
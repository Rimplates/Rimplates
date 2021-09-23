<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://rimplates.com
 * @since      1.0.0
 *
 * @package    Rimplates
 * @subpackage Rimplates/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rimplates
 * @subpackage Rimplates/public
 * @author     Nellalink <info@rimplates.com>
 */
class Rimplates_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
        
        add_shortcode('rimplates-template', array($this, 'RetrieveTemplate'));
        add_action('wp', array($this, 'LoadTemplateFunctions'));
        add_action('init', array($this, 'LoadTemplateServiceFunctions'));
        
	}
	
		
	public function LoadTemplateFunctions() {
	    
        global $post;
        if ( is_a( $post, 'WP_Post' ) && has_shortcode( $post->post_content, 'rimplates-template') ) {
            
            $pattern = get_shortcode_regex();
            preg_match_all('/'. $pattern .'/s', $post->post_content, $matches); 
            foreach($matches[0] as $match){
              
             if(has_shortcode( $match, 'rimplates-template')){
                 
                 $atts = shortcode_parse_atts($match);
                 $template_id = $atts['id']; 
                 $template_id = str_replace("]","",$template_id);//replace ] with empty string
                 
                 $template_folder = get_post_meta($template_id, 'template',true); 
                 include plugin_dir_path(__FILE__) . "templates/$template_folder/functions.php"; 
             }
             
           }
           
        }
        
        
        
    }
    
    public function LoadTemplateServiceFunctions() {
	    
        //$template_folder = get_post_meta($template_id, 'template',true); 
        
        $template_paths = glob(plugin_dir_path( __FILE__ ) . 'templates/*' , GLOB_ONLYDIR);// Get all folders in that dir templates
        foreach($template_paths as $template_path){
            $service_file = $template_path."/services.php";
            if(file_exists($service_file)){
                include_once $service_file;
            }
        }  
	  
    }


	public function RetrieveTemplate($atts) {
	        

	    ob_start();
	    
	     global $current_user;
         wp_get_current_user();
        
         $atts = shortcode_atts( array(
        
            'id' => 'empty',
            'user_id' => $current_user->ID,
        
         ), $atts);
         
        $template_id = $atts['id'];
        $user_id = $atts['user_id'];
         if($template_id=='empty'){
             echo "Specified Template Not Found or No Template was specified, reverting to default..";
             $template_id = "default";
         }
             
         
         $template_folder = get_post_meta($template_id, 'template',true);
           
	     include plugin_dir_path(__FILE__) . "templates/$template_folder/index.php";  
        

	    $output = ob_get_clean();

	    return $output;
	  
    }


	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rimplates_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rimplates_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/rimplates-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Rimplates_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Rimplates_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/rimplates-public.js', array( 'jquery' ), $this->version, false );

	}

}

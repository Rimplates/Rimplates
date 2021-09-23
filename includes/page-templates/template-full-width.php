<?php 
global $post, $wpdb,$current_user;
wp_get_current_user();
$userinfo = wp_get_current_user();
$user_id = $userinfo->ID; 

?>

<?php get_header(); ?>

<div class="clearfix"></div><br>
 
<?php while ( have_posts() ) : ?>

	<?php the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php the_content(); ?>

	</article>

<?php endwhile; ?>

<div class="clearfix"></div><br>
<?php get_footer(); ?>
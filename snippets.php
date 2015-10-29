<?php // get custom taxonomy ID, and query posts with this ID ?>
<?php foreach((get_the_terms($post->ID, 'business-category')) as $term) { $the_terms = $term->term_id. ''; } ?>


<?php
$display_similar_properties = get_option('theme_display_similar_properties');
if( $display_similar_properties == 'true' ){
        global $post;
        $similar_properties_args = array(
            'post_type' => 'business',
            'posts_per_page' => 3,
            'post__not_in' => array( $post->ID ),
            'order' => 'ASC',
            'tax_query' => array(
		array(
			'taxonomy' => 'business-category',
			'field' => 'id',
			'terms' => $the_terms,
			)
	));
?>



<?php //list similar the same post type, exclude current post from the query ?>


					<h3><?php _e('Similar Objects','_tk'); ?></h3>
					
					
<?php $exclude_id = get_the_ID();  ?> 					



		  			<?php $count_properties = 0 ?>
					  			<?php if ( have_posts() ) : ?>
								<?php /* Start the Loop for Product Sheets Category */ ?>
								<?php 	query_posts( array ( 
								'post_type'=>  array(get_post_type( $post )),
								'post__not_in' => (array($exclude_id)),
								'orderby' => 'rand',
								'posts_per_page' => 3 ) ); ?>
								<?php while ( have_posts() ) : the_post(); ?>							
								<?php $count_properties++ ?>				
								<div class="property-listing-sidebar">
								<h4><?php the_title(); ?></h4>
								<a href="<?php the_permalink(); ?>">
								<?php 
								if ( has_post_thumbnail() ) {the_post_thumbnail(); } ?></a>
					
					<a href="<?php the_permalink(); ?>"><button type="button" class="btn btn-primary btn-large sidebar-button" role="button">
<?php _e('More Info','_tk'); ?>
</button></a>

										</div>		 <!-- END PROPERTY LISTING SIDEBAR  -->								
				
											 <?php endwhile; ?>
											 <?php endif; ?>
											 <?php wp_reset_query(); ?>







<?php 
	
$the_post_type = $_SERVER["REQUEST_URI"]; // gives /test/test/ from http://example.org/test/test/

$the_post_type = trim($the_post_type, '/');

if($the_post_type == ''){
	$the_post_type = 'post';
} 

echo $the_post_type;

?>


<?php
//Echo custom taxonomy name on archive page
?>

<?php $term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) ); echo $term->name; ?>

<?php
$taxonomy = 'concerts';
$queried_term = get_query_var($taxonomy);
$terms = get_terms($taxonomy, 'slug='.$queried_term);
if ($terms) {
  foreach($terms as $term) {
    echo '<p> This is the Term name ' . $term->name . 'and description '. $term->description . '</p> ';
  }
}
?>




<?php
/**
 * Loop - Archive
 *
 * This is the loop logic used on all archive screens.
 *
 * To override this loop in a particular archive type (in all categories, for example), 
 * duplicate the `archive.php` file and rename the duplicate to `category.php`.
 * In the code of `category.php`, change `get_template_part( 'loop', 'archive' );` to 
 * `get_template_part( 'loop', 'category' );` and save the file.
 *
 * Create a duplicate of this file and rename it to `loop-category.php`.
 * Make any changes to this new file and they will be reflected on all your category screens.
 *
 * @package WooFramework
 * @subpackage Template
 */
 global $more; $more = 0;
?> 
<?php //start by fetching the terms for the animal_cat taxonomy
$terms = get_terms( 'omraden', array(
    'orderby'    => 'count',
    'hide_empty' => 0,
) );
?>


<?php
// now run a query for each animal family
foreach( $terms as $term ) {
 
    // Define the query
    $args = array(
        'post_type' => 'personal',
        'omraden' => $term->slug
    );
    $query = new WP_Query( $args );
             
    // output the term name in a heading tag                
    echo'<h2>' . $term->name . '</h2>';
     
    // output the post titles in a list
    echo '<ul>';
     
        // Start the Loop
        while ( $query->have_posts() ) : $query->the_post(); ?>
 
        <li class="animal-listing" id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </li>
         
        <?php endwhile;
     
    echo '</ul>';

    // use reset postdata to restore orginal query
    wp_reset_postdata();
 
} ?>

Remove separator in repeater custom fields list

			<?php if(get_field('focus_industries')): ?>
						<?php $rowCount = count(get_field('focus_industries')); ?>
						<?php $i = 1; ?>
						<p class="info-listing"><span class="info-title">Focus Industries:</span>  
	<?php while(the_repeater_field('focus_industries')): ?>
						<?php the_sub_field('industry'); ?><?php if($i < $rowCount): ?>, <?php endif; ?>
		<?php $i++; ?>
						
						<?php endwhile; ?></p>
						<?php endif; ?>
						
						
						
echo custom taxonomies						
						
<?php
$terms = get_the_terms( $post->ID, 'industries' );
						
if ( $terms && ! is_wp_error( $terms ) ) : 

	$industries_links = array();

	foreach ( $terms as $term ) {
		$industries_links[] = $term->name;
	}
						
	$industries = join( ", ", $industries_links );
?>		
						

						
						<p class="info-listing"><span class="info-title">Focus Industries:</span>  
	<?php echo $industries ; ?></p>
						<?php endif; ?>
						



<?php
//custom excerpt lengths, good to use with count++

function excerpt($limit) {
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	if (count($excerpt)>=$limit) {
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt).'...';
	} else {
	$excerpt = implode(" ",$excerpt);
	}
	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
	return $excerpt;
	}
	 
	function content($limit) {
	$content = explode(' ', get_the_content(), $limit);
	if (count($content)>=$limit) {
	array_pop($content);
	$content = implode(" ",$content).'...';
	} else {
	$content = implode(" ",$content);
	}
	$content = preg_replace('/[.+]/','', $content);
	$content = apply_filters('the_content', $content);
	$content = str_replace(']]>', ']]&gt;', $content);
	return $content;
}
?>



 <!-- smooth scroll -->
<script>
	$(function() {
  $('a[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});
	
</script>





add_filter( 'manage_pages_columns', 'page_column_views' );
add_action( 'manage_pages_custom_column', 'page_custom_column_views', 5, 2 );
function page_column_views( $defaults )
{
   $defaults['page-layout'] = __('Template');
   return $defaults;
}
function page_custom_column_views( $column_name, $id )
{
   if ( $column_name === 'page-layout' ) {
       $set_template = get_post_meta( get_the_ID(), '_wp_page_template', true );
       if ( $set_template == 'default' ) {
           echo 'Default';
       }
       $templates = get_page_templates();
       ksort( $templates );
       foreach ( array_keys( $templates ) as $template ) :
           if ( $set_template == $templates[$template] ) echo $template;
       endforeach;
   }
}






//SQL STUFF
// http://www.newurl  http://www.oldurl
//move and change urls  
UPDATE wp_options SET option_value = replace(option_value, 'http://www.oldurl', 'http://www.newurl') WHERE option_name = 'home' OR option_name = 'siteurl';

UPDATE wp_posts SET guid = replace(guid, 'http://www.oldurl','http://www.newurl');

UPDATE wp_posts SET post_content = replace(post_content, 'http://www.oldurl', 'http://www.newurl');

UPDATE wp_postmeta SET meta_value = replace(meta_value,'http://www.oldurl','http://www.newurl');



//Change name of META filed. Used for move from example wp-types to ACF
UPDATE `wp_postmeta` SET `meta_key` = 'ref' WHERE `meta_key` = 'refer'




//remove the need of adding SFTP details in WP backend
chown -R www-data:www-data catalog
catalog = ie /var/www/domain.com/






<?php
/**
 * The template for displaying member pages.
 *
 *
 Template Name: Itunes feed
 */
 
header("Content-Type: application/rss+xml; charset=UTF-8");
echo '<?xml version="1.0" encoding="UTF-8"?>';

 $wl = get_locale();  
 
 $posts_per_rss = get_option('posts_per_rss');
 
   $args = array(
	'numberposts' => $posts_per_rss,
	'post_type' => 'mediacast',	
	'meta_query' => array(
        'relation' => 'OR',
        array(
            'key'     => 'cro_mediamp3',
            'value'   => '',
            'compare' => '!=',
        ),
        array(
            'key'     => 'cro_mp3alt',
            'value'   => '',          
            'compare' => '!=',
        ),
    ),	
   );
   
   $feeds = new WP_Query($args);

?>

<?php while ( have_posts() ) : the_post();
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
endwhile; ?>
<rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" version="2.0">

	<channel>

		<title><?php echo get_bloginfo('name'); ?></title>

		<link><?php echo home_url(); ?></link>	

		<language><?php echo $wl; ?></language>

		<copyright>&#x2117; &amp; &#xA9; <?php echo date("Y"); ?> <?php echo htmlspecialchars((get_bloginfo('name'))); ?></copyright>

		<itunes:subtitle><?php echo htmlspecialchars((get_bloginfo('description'))); ?></itunes:subtitle>

		<itunes:author><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:author>		
	
		<itunes:owner>

			<itunes:name><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:name>

			<itunes:email><?php echo get_option('admin_email'); ?></itunes:email>

		</itunes:owner>	

		<itunes:image href="<?php echo $image[0]; ?>" /> 		
		
		<itunes:category></itunes:category> 

	<?php

	while ( $feeds->have_posts() ) : $feeds->the_post();

		if ( get_post_meta(get_the_ID(), 'cro_mp3alt', true) != ''  ){ 
		
			$aud_url = get_post_meta(get_the_ID(),'cro_mp3alt', true); 
			
		}else{
		
			$aud_url = get_post_meta(get_the_ID(),'cro_mediamp3', true);
		}
	?>

		<item>
			<title><?php the_title(); ?></title>
			<itunes:author><?php echo htmlspecialchars((get_bloginfo('name'))); ?></itunes:author>
			<itunes:summary><?php echo  htmlspecialchars(strip_tags(get_the_excerpt())); ?></itunes:summary> 
			<enclosure url="<?php echo $aud_url; ?>"  type="audio/mpeg" /> 
			<guid><?php echo $aud_url; ?></guid>
			<pubDate><?php echo get_the_date('D, d M Y H:i:s T', '', ''); ?></pubDate>			
		</item>			

		<?php endwhile; ?>

	</channel>

</rss>
<?php 
global $qode_options_proya;
$blog_hide_comments = "";
if (isset($qode_options_proya['blog_hide_comments'])) {
	$blog_hide_comments = $qode_options_proya['blog_hide_comments'];
}
$blog_author_info="no";
if (isset($qode_options_proya['blog_author_info'])) {
	$blog_author_info = $qode_options_proya['blog_author_info'];
}
$qode_like = "on";
if (isset($qode_options_proya['qode_like'])) {
	$qode_like = $qode_options_proya['qode_like'];
}
?>
<?php
$_post_format = get_post_format();
?>
<?php
	switch ($_post_format) {
		case "video":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_image">
					<?php $_video_type = get_post_meta(get_the_ID(), "video_format_choose", true);?>
					<?php if($_video_type == "youtube") { ?>
						<iframe src="//www.youtube.com/embed/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?wmode=transparent" wmode="Opaque" frameborder="0" allowfullscreen></iframe>
					<?php } elseif ($_video_type == "vimeo"){ ?>
						<iframe src="//player.vimeo.com/video/<?php echo get_post_meta(get_the_ID(), "video_format_link", true);  ?>?title=0&amp;byline=0&amp;portrait=0" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
					<?php } elseif ($_video_type == "self"){ ?> 
						<div class="video"> 
						<div class="mobile-video-image" style="background-image: url(<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>);"></div> 
						<div class="video-wrap"  > 
							<video class="video" poster="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" preload="auto"> 
								<?php if(get_post_meta(get_the_ID(), "video_format_webm", true) != "") { ?> <source type="video/webm" src="<?php echo get_post_meta(get_the_ID(), "video_format_webm", true);  ?>"> <?php } ?> 
								<?php if(get_post_meta(get_the_ID(), "video_format_mp4", true) != "") { ?> <source type="video/mp4" src="<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>"> <?php } ?> 
								<?php if(get_post_meta(get_the_ID(), "video_format_ogv", true) != "") { ?> <source type="video/ogg" src="<?php echo get_post_meta(get_the_ID(), "video_format_ogv", true);  ?>"> <?php } ?> 
								<object width="320" height="240" type="application/x-shockwave-flash" data="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf"> 
									<param name="movie" value="<?php echo get_template_directory_uri(); ?>/js/flashmediaelement.swf" /> 
									<param name="flashvars" value="controls=true&file=<?php echo get_post_meta(get_the_ID(), "video_format_mp4", true);  ?>" /> 
									<img src="<?php echo get_post_meta(get_the_ID(), "video_format_image", true);  ?>" width="1920" height="800" title="No video playback capabilities" alt="Video thumb" /> 
								</object> 
							</video>   
						</div></div> 
					<?php } ?>
				</div>
				<div class="post_text">
					<div class="post_text_inner">
						<h2><span class="date"><?php the_time('d M'); ?></span> <?php the_title(); ?></h2>
						<div class="post_info">
							<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('H:i'); ?><?php _e('h','qode'); ?></span>
							<?php _e('in','qode'); ?> <?php the_category(', '); ?>
							<span class="post_author">
								<?php _e('by','qode'); ?>
								<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
							<?php if($blog_hide_comments != "yes"){ ?>
								<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
							<?php } ?>
							<?php if( $qode_like == "on" ) { ?>
									<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
									<?php if( function_exists('qode_like') ) qode_like(); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
								<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
							<?php } ?>
						</div>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
<?php
		break;
		case "audio":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_image">
					<audio class="blog_audio" src="<?php echo get_post_meta(get_the_ID(), "audio_link", true) ?>" controls>
						<?php _e("Your browser don't support audio player","qode"); ?>
					</audio>
				</div>
				<div class="post_text">
					<div class="post_text_inner">
						<h2><span class="date"><?php the_time('d M'); ?></span> <?php the_title(); ?></h2>
						<div class="post_info">
							<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('H:i'); ?><?php _e('h','qode'); ?></span>
							<?php _e('in','qode'); ?> <?php the_category(', '); ?>
							<span class="post_author">
								<?php _e('by','qode'); ?>
								<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
							<?php if($blog_hide_comments != "yes"){ ?>
								<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
							<?php } ?>
							<?php if( $qode_like == "on" ) { ?>
									<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
									<?php if( function_exists('qode_like') ) qode_like(); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
								<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
							<?php } ?>
						</div>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
	
<?php
		break;
		case "link":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_text">
					<div class="post_text_inner">
						<div class="post_info">
							<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('d M, H:i'); ?><?php _e('h','qode'); ?></span>
							<?php _e('in','qode'); ?> <?php the_category(', '); ?>
							<span class="post_author">
								<?php _e('by','qode'); ?>
								<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
							<?php if($blog_hide_comments != "yes"){ ?>
								<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
							<?php } ?>
							<?php if( $qode_like == "on" ) { ?>
									<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
									<?php if( function_exists('qode_like') ) qode_like(); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
								<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
							<?php } ?>
						</div>
						<i class="link_mark fa fa-link pull-left"></i>
						 <?php $title_link = get_post_meta(get_the_ID(), "title_link", true) != '' ? get_post_meta(get_the_ID(), "title_link", true) : 'javascript: void(0)'; ?>
						<div class="post_title">
							<p><a href="<?php echo $title_link; ?>"><?php the_title(); ?></a></p>
						</div>
					</div>
				</div>
				<?php the_content(); ?>
			</div>
<?php
		break;
		case "gallery":
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<div class="post_image">
					<div class="flexslider">
						<ul class="slides">
							<?php
								$post_content = get_the_content();
								preg_match('/\[gallery.*ids=.(.*).\]/', $post_content, $ids);
								$array_id = explode(",", $ids[1]);
								
								$content =  str_replace($ids[0], "", $post_content);
								$filtered_content = apply_filters( 'the_content', $content);
								
								foreach($array_id as $img_id){ ?>
									<li><?php echo wp_get_attachment_image( $img_id, 'full' ); ?></li>
								<?php } ?>
						</ul>
					</div>
				</div>
				<div class="post_text">
					<div class="post_text_inner">
						<h2><span class="date"><?php the_time('d M'); ?></span> <?php the_title(); ?></h2>
						<div class="post_info">
							<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('H:i'); ?><?php _e('h','qode'); ?></span>
							<?php _e('in','qode'); ?> <?php the_category(', '); ?>
							<span class="post_author">
								<?php _e('by','qode'); ?>
								<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
							<?php if($blog_hide_comments != "yes"){ ?>
								<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
							<?php } ?>
							<?php if( $qode_like == "on" ) { ?>
									<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
									<?php if( function_exists('qode_like') ) qode_like(); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
								<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
							<?php } ?>
						</div>
						<?php echo do_shortcode($filtered_content); ?>	
					</div>
				</div>

			</div>
		
<?php
		break;
		case "quote":
?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<div class="post_content_holder">
					<div class="post_text">
						<div class="post_text_inner">
							<div class="post_info">
								<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('d M, H:i'); ?><?php _e('h','qode'); ?></span>
								<?php _e('in','qode'); ?> <?php the_category(', '); ?>
								<span class="post_author">
									<?php _e('by','qode'); ?>
									<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
								</span>
								<?php if($blog_hide_comments != "yes"){ ?>
									<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
								<?php } ?>
								<?php if( $qode_like == "on" ) { ?>
										<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
										<?php if( function_exists('qode_like') ) qode_like(); ?>
									</div>
								<?php } ?>
								<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
									<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
								<?php } ?>
							</div>	
							<i class="qoute_mark fa fa-quote-right pull-left"></i>
							<div class="post_title">
								<p><?php echo get_post_meta(get_the_ID(), "quote_format", true); ?></p>
								<span class="quote_author">&mdash; <?php the_title(); ?></span>
							</div>
						</div>
					</div>
					<?php the_content(); ?>
				</div>
<?php
		break;
		default:
?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post_content_holder">
				<?php if(get_post_meta(get_the_ID(), "qode_hide-featured-image", true) != "yes") {
					if ( has_post_thumbnail() ) { ?>
						<div class="post_image">
	                        <?php the_post_thumbnail('full'); ?>
						</div>
				<?php } } ?>
				<div class="post_text">
					<div class="post_text_inner">
						<h2><span class="date"><?php the_time('d M'); ?></span> <?php the_title(); ?></h2>
						<div class="post_info">
							<span class="time"><?php _e('Posted at','qode'); ?> <?php the_time('H:i'); ?><?php _e('h','qode'); ?></span>
							<?php _e('in','qode'); ?> <?php the_category(', '); ?>
							<span class="post_author">
								<?php _e('by','qode'); ?>
								<a class="post_author_link" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author_meta('display_name'); ?></a>
							</span>
							<?php if($blog_hide_comments != "yes"){ ?>
								<span class="dots"><i class="fa fa-square"></i></span><a class="post_comments" href="<?php comments_link(); ?>" target="_self"><?php comments_number('0 ' . __('Comments','qode'), '1 '.__('Comment','qode'), '% '.__('Comments','qode') ); ?></a>
							<?php } ?>
							<?php if( $qode_like == "on" ) { ?>
									<span class="dots"><i class="fa fa-square"></i></span><div class="blog_like">
									<?php if( function_exists('qode_like') ) qode_like(); ?>
								</div>
							<?php } ?>
							<?php if(isset($qode_options_proya['enable_social_share'])  && $qode_options_proya['enable_social_share'] == "yes") { ?>
								<span class="dots"><i class="fa fa-square"></i></span><?php echo do_shortcode('[social_share]'); ?>	
							<?php } ?>
						</div>
						<?php the_content(); ?>
					</div>
				</div>
			</div>
		
<?php
}
?>
	<?php if( has_tag()) { ?>
		<div class="single_tags clearfix">
            <div class="tags_text">
				<h5><?php _e('Tags:','qode'); ?></h5>
				<?php 
				if ((isset($qode_options_proya['tags_border_style']) && $qode_options_proya['tags_border_style'] !== '') || (isset($qode_options_proya['tags_background_color']) && $qode_options_proya['tags_background_color'] !== '')){
					the_tags('', ' ', '');
				}
				else{
					the_tags('', ', ', '');
				}
				?>
			</div>
		</div>
	<?php } ?>				
	<?php 
		$args_pages = array(
			'before'           => '<p class="single_links_pages">',
			'after'            => '</p>',
			'link_before'      => '<span>',
			'link_after'       => '</span>',
			'pagelink'         => '%'
		);

		wp_link_pages($args_pages);
	?>
<?php if($blog_author_info == "yes") { ?>
	<div class="author_description">
		<div class="author_description_inner">
			<div class="image">
				<?php echo get_avatar(get_the_author_meta( 'ID' ), 75); ?>
			</div>
			<div class="author_text_holder">
				<h5 class="author_name">
				<?php  
					if(get_the_author_meta('first_name') != "" || get_the_author_meta('last_name') != "") {
						echo get_the_author_meta('first_name') . " " . get_the_author_meta('last_name');
					} else {
						echo get_the_author_meta('display_name');
					}
				?>
				</h5>
				<span class="author_email"><?php echo get_the_author_meta('email'); ?></span>
				<?php if(get_the_author_meta('description') != "") { ?>
					<div class="author_text">
						<p><?php echo get_the_author_meta('description') ?></p>
					</div>
				<?php } ?>
			</div>
		</div>
	</div>
<?php } ?>
</article>
<?php
/**
 * Template Name: Blog Archive 
 *
 */

$category = get_category($cat);
get_header(); 
// Setup category details for template
 ?>
<body>
	<div id="container">
        <?php include 'page-nav.php'; ?>

        <div id="main" role="main">
            <div class="container">
                <div class="sixteen columns">

<?php 
	// Show Widgets Frontpage Content Block (Left, Middle, Right) if Archive is used as frontpage
	if(is_front_page()) {
?>

					<div class="first short row">
						<div class="five columns alpha">

							<div class="bucket">
								<div class="inner">
									<?php dynamic_sidebar( 'Frontpage Content Block Left' ); ?>
								</div> <!--! end of "inner" -->
							</div> <!--! end of "bucket" -->
						</div>
						<div class="six columns">

							<div class="bucket">
								<div class="inner">
									<?php dynamic_sidebar( 'Frontpage Content Block Middle' ); ?>
								</div> <!--! end of "inner" -->
							</div> <!--! end of "bucket" -->
						</div>
						<div class="five columns omega">

							<div class="bucket">
								<div class="inner">
									<?php dynamic_sidebar( 'Frontpage Content Block Right' ); ?>
								</div> <!--! end of "inner" -->
							</div> <!--! end of "bucket" -->

						</div> <!--! end of top_columns[$ct] -->
					
					</div> <!--! end of "short row" -->
<?php
	
	} // endif
?>
<div class="row">
<div id="title">
	<?php if (is_month() || is_year()) { ?> 
	<h1 class="category">
		<a href="<?php echo get_category_link($cat);?>">
		<?php echo $category->name; ?>
		</a>
	</h1>
	<?php }?>
	<h1><?php wp_title('')?></h1>
</div>
</div><!-- end of first row -->
                    <div class="row"><!-- for about page -->
                        <div class="twelve columns alpha">

			<?php if (have_posts()) { 
				while (have_posts()) {
				the_post();?>
			<div class="blog" id="post-<?php the_ID(); ?>">
				<h2 class="title">
					<a href="<?php the_permalink() ?>">
					<?php the_title() ?>
					</a>
				</h2>
				<p class="meta"><?php the_author() ?>, <?php the_time('F jS, Y');?></p>
				<?php the_content("Read More..."); ?>
        <?php edit_post_link('Edit', '', ' |'); ?> <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?> 
				
				<?php if (get_the_tags()) { ?>
				<div class="postTags">
					<?php the_tags(); ?>
				</div>
				<?php } ?>
			</div>
			<?php } } ?>

            <br /><br />
			<?php
			# Add pretty pagination if the plugin PageNavi is installed,
			# otherwise just use the boring stuff.  nkinkade 2008-01-02
			if ( function_exists('wp_pagenavi') ) {
					wp_pagenavi();
			} else {
					posts_nav_link(' &mdash; ', 'previous page', 'next page');
			}
			?>

            </div><!-- end of twelve columns alpha -->

            <div class="four columns omega">
            </div><!-- end of twelve columns omega -->
            </div><!-- end of row -->


                </div><!-- end of sixteen columns -->
            </div><!--! end of .container -->
		</div><!--! end of #main -->
<?php get_footer(); ?>


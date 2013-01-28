<?php
    include 'meta.php';
?>
<?php include 'header-doctype.php'; ?>
<head>
    <meta charset="<?php bloginfo('charset'); ?>" />
    <?php include 'header-common.php'; ?>

    <?php if (is_front_page() || is_404()) {?>
    <title>Creative Commons</title>
    <?php } else if (is_search()) { ?>
    <title>Search Creative Commons</title>
    <?php } else { ?>
    <title><?php wp_title(''); ?> - Creative Commons</title>
    <?php }?>

    <?php if (is_single()) { ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
	<?php } ?>

    <?php if (is_category()) { ?>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_settings('home') . '/categories/' . $category->slug ?>/feed/rss" />
    <?php } else if (is_tag()) { ?>
    <link rel="alternate" type="application/rss+xml" title="RSS 2.0" href="<?php echo get_tag_link($tag_id); ?>/feed/rss" />
    <?php } ?>

	<?php wp_head(); ?>
</head>

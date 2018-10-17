<?php

/**
 * @package JFW
 * @subpackage Blank
 * @since JFW Blank ! 1.0
 */

get_header();

?>

<div id="primary" class="content-area">

	<main id="main" class="site-main" role="main">

<?php

while ( have_posts() )
{
	the_post();
	// do stuff
}

?>

	</main><!-- .site-main -->

</div><!-- .content-area -->

<?php

get_footer();

?>
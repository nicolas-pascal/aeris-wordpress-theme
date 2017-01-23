<?php
/**
 * Template part for displaying a title & breadcrumbs on page
 *
 * @package aeris
 */

?>
<div id="breadcrumbs">
	<div class="wrapper">
		<?php if (function_exists('the_breadcrumb')) the_breadcrumb(); ?>
		<h1>
			<?php the_archive_title(); ?>
		</h1>
	</div>
</div>



<?php
/**
 * The template used for displaying page content.
 *
 * @package Sela
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<h1 class="entry-title calendar-title"><?php the_title(); ?></h1>
		<h2 class="entry-title calendar-subtitle">Making It Easier Than Ever To Keep Up-To-Date On District Events!</h2>
	</header><!-- .entry-header -->

		<div id="calendar" class="fc fc-ltr fc-unthemed calendar-embed"></div>
		<div id="calendar-mini" class="calendar-embed-mini">
			<iframe src="https://www.google.com/calendar/embed?showTitle=0&amp;showPrint=0&amp;showTabs=0&amp;showCalendars=0&amp;mode=AGENDA&amp;height=400&amp;wkst=1&amp;bgcolor=%23FFFFFF&amp;src=qc6lru9dnaj9o1k480aqvtgh3o%40group.calendar.google.com&amp;color=%23182C57&amp;ctz=America%2FNew_York" style=" border-width:0 " width="100%" height="400" frameborder="0" scrolling="no"></iframe>
		</div>

</article><!-- #post-## -->

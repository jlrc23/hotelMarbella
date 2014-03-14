<dl class="faq faq-list <?php if ( $folding == 1 || $folding == 'true' ) echo 'folding-faq-list'; ?>">

	<?php if ( $show_index == 1 || $show_index == 'true' ) : ?>

		<!-- Index -->
		<ol id="index-<?php echo $slug; ?>" class="faq-index">
			<?php foreach ( $faq_items as $faq_item ) : ?>
				<li><a href="#faq-item-<?php echo $faq_item->ID; ?>"><?php echo wptexturize( $faq_item->post_title ); ?></a></li>
			<?php endforeach; ?>
		</ol>

	<?php endif; ?>

	<!-- FAQ List -->
	<?php foreach ( $faq_items as $faq_item ) : ?>

		<dt id="faq-item-<?php echo $faq_item->ID; ?>"><?php echo wptexturize( $faq_item->post_title ); ?></dt>
		<dd>
			<?php echo apply_filters( 'the_content', $faq_item->post_content ); ?>

			<?php if ( $show_index == 1 || $show_index == 'true' ) : ?>
				<p class="faq-top"><a href="#index-<?php echo esc_attr( $slug ); ?>"><?php _e( 'Top&nbsp;&uarr;','ninety-faqs' ) ?></a></p>
			<?php endif; ?>
		</dd>

	<?php endforeach; ?>

</dl>
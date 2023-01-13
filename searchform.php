<?php
$sit_unique_id = wp_unique_id( 'search-form-' );
$sit_aria_label = ! empty( $args['aria_label'] ) ? 'aria-label="' . esc_attr( $args['aria_label'] ) . '"' : '';
?>
<form role="search" <?php echo $sit_aria_label ?> method="get" class="search-form d-flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" id="<?php echo esc_attr( $sit_unique_id ); ?>" class="form-control search-field flex-shrink-1" value="<?php echo get_search_query(); ?>" name="s" />
	<input type="submit" class="btn btn-dark text-uppercase search-submit flex-grow-1" value="<?php echo esc_attr_x( 'Search', 'submit button', 'sit-strings' ); ?>" />
</form>

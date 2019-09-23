<?php


Namespace MyEvent\Core;

//use \WP_Widget;

use WP_Query;

class MyEventWidget extends \WP_Widget {

	//TODO: check escaping
	public function __construct() {
		$widget_options = [
			'classname'   => 'myeventswidget',
			'description' => esc_html__( 'A plugin for display basic events' )
		];
		parent::__construct( 'myeventswidget', esc_html__( 'myEvent Widget' ), $widget_options );
	}

	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];

		//TODO: check escaping if try echo esc
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$this->myevents_widget_content();

		echo $args['after_widget'];

		//TODO: add loading styles from class

	}

	public function form( $instance ) {
		$defaults = [
			'title' => 'My events'
		];

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title = $instance['title'];

		?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
				<?php esc_attr_e( 'Title:' ); ?> >
                <input class="wide"
                       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
                       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
                       type="text"
                       value="<?php echo esc_attr( $title ); ?>"
                />
            </label>
        </p>

		<?php

	}

	public function update( $new_instance, $old_instance ) {
		$instance          = $old_instance;
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

	private function myevents_widget_content() {

		$query = new WP_Query( [
			'post_type'      => 'myevents',
			'posts_per_page' => get_option( 'myevent_option' )['myevents_admin_page-amount']
		] );

		if ( $query->have_posts() ) {
			while ( $query->have_posts() ) :
				$query->the_post();
				$id = get_the_ID();

				$location = get_post_meta( $id, "_location", true );
				$time     = get_post_meta( $id, "_time", true );

				$date  = strtotime( get_post_meta( $id, "_date", true ) );
				$day   = date( 'd', $date );
				$month = date( 'M', $date );

				?>
                <div class="events-box">
                    <div class="events-date"><?php echo $day; ?><span><?php echo $month; ?></span></div>
                    <div class="events-content">
                        <span class="events-event-title"><?php the_title(); ?></span>
                        <span class="events-hours"><?php echo $time; ?></span>
                        <span class="events-location"><?php echo $location; ?></span>
                    </div>
                </div>
			<?php

			endwhile;
			wp_reset_query();
		}
	}
}

<?php
/**
 * Adds Chamadas_Widget widget.
 */
class Chamadas_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'chamadas_widget', // Base ID
			__( 'Chamadas', 'ifrs-ps-theme' ), // Name
			array( 'description' => __( 'Chamadas do Processo Seletivo', 'ifrs-ps-theme' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		$formasingresso_all = get_terms(array(
			'taxonomy' => 'formaingresso',
			'orderby' => 'name',
			'fields' => 'ids',
		));
		$campi_all = get_terms(array(
			'taxonomy' => 'campus',
			'orderby' => 'name',
			'fields' => 'ids',
		));

		$chamadas = array();

		foreach ($formasingresso_all as $id1) {
			foreach ($campi_all as $id2) {
				$chamadas_query = new WP_Query(array(
					'post_type' => 'chamada',
					'post_status' => 'publish',
					'posts_per_page' => '-1',
					'tax_query' => array(
						'relation' => 'AND',
						array(
							'taxonomy' => 'formaingresso',
							'field'    => 'term_id',
							'terms'    => $id1,
						),
						array(
							'taxonomy' => 'campus',
							'field'    => 'term_id',
							'terms'    => $id2,
						),
					)
				));
				if ($chamadas_query->have_posts()) {
					while ($chamadas_query->have_posts()) {
						$chamadas_query->the_post();
						$chamadas[$id1][$id2][] = get_post();
					}
				}
			}
		}

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
		    echo apply_filters('widget_title', $instance['title']);
			echo $args['after_title'];
		}
		?>
		<div class="row">
			<div class="col-12">
				<div id="chamadas">
					<div id="formasingresso">
						<p><?php _e('Selecione a sua forma de ingresso.', 'ifrs-ps-theme'); ?><br><small><?php _e('Os resultados de cada forma de ingresso serão divulgados conforme cronograma.', 'ifrs-ps=theme'); ?></small></p><div class="clearfix"></div>
						<?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
							<?php $formaingresso_obj = get_term($formaingresso_id); ?>
							<a class="btn btn-formaingresso toggle" href="#campi-<?php echo $formaingresso_obj->slug; ?>"><span class="sr-only">Ingresso por </span><?php echo $formaingresso_obj->name; ?></a>
							<div id="campi-<?php echo $formaingresso_obj->slug; ?>" class="campi">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
									<li class="breadcrumb-item active" aria-current="page"><?php echo $formaingresso_obj->name; ?></li>
								</ol>
								<p>Selecione o seu Campus.</p>
								<?php foreach ($campi as $campus_id => $chamada) : ?>
									<?php $campus_obj = get_term($campus_id); ?>
									<a class="btn btn-campus toggle" href="#chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>"><span class="sr-only">Campus </span><?php echo $campus_obj->name; ?></a>
									<div id="chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="chamadas">
										<ol class="breadcrumb">
											<li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
											<li class="breadcrumb-item"><a href="#campi-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-campus"><?php echo $formaingresso_obj->name; ?></a></li>
											<li class="breadcrumb-item active" aria-current="page"><?php echo $campus_obj->name; ?></li>
										</ol>
										<p>Confira abaixo as chamadas já realizadas.</p>
										<div class="list-group">
										<?php foreach ($chamada as $resultado) : ?>
											<a href="<?php echo get_permalink($resultado); ?>" rel="bookmark" class="list-group-item list-group-item-action flex-column align-items-start">
												<div class="d-flex w-100 justify-content-between">
													<h4 class="mb-1"><?php echo $resultado->post_title; ?></h4>
													<p>
														<?php $modalidades = get_post_meta($resultado->ID, '_chamada_resultados_group'); ?>
														<?php foreach ($modalidades[0] as $id => $modalidade) : ?>
															<span class="badge label-modalidade"><?php echo get_term($modalidade['modalidade'], 'modalidade')->name; ?></span>&nbsp;
														<?php endforeach; ?>
													</p>
												</div>
                                                <small><?php echo get_the_time('d/m/Y', $resultado); ?></small>
                                            </a>
										<?php endforeach; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>

        <?php
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Chamadas', 'ifrs-ps-theme' );
		?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class Foo_Widget

// register Foo_Widget widget
function register_chamadas_widget() {
    register_widget( 'Chamadas_Widget' );
}
add_action( 'widgets_init', 'register_chamadas_widget' );

<?php
/**
 * Adds Resultados_Widget widget.
 */
class Resultados_Widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'resultados_widget', // Base ID
			__( 'Resultados', 'ifrs-ps-theme' ), // Name
			array( 'description' => __( 'Resultados do Processo Seletivo', 'ifrs-ps-theme' ), ) // Args
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
		if (WP_DEBUG) {
			wp_enqueue_script( 'resultados', get_stylesheet_directory_uri().'/src/resultados.js', array(), false, true );
		} else {
			wp_enqueue_script( 'resultados', get_stylesheet_directory_uri().'/js/resultados.min.js', array(), false, true );
		}

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
		$modalidades_all = get_terms(array(
			'taxonomy' => 'modalidade',
			'orderby' => 'name',
			'fields' => 'ids',
		));

		$resultados = array();

		foreach ($formasingresso_all as $id1) {
			foreach ($campi_all as $id2) {
				foreach ($modalidades_all as $id3) {
					$resultados_query = new WP_Query(array(
						'post_type' => 'resultado',
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
							array(
								'taxonomy' => 'modalidade',
								'field'    => 'term_id',
								'terms'    => $id3,
							),
						)
					));
					if ($resultados_query->have_posts()) {
						while ($resultados_query->have_posts()) {
							$resultados_query->the_post();
							$resultados[$id1][$id2][$id3][] = get_post();
						}
					}
				}
			}
		}

		echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'];
		?>
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/resultados-title.png" alt="<?php echo apply_filters('widget_title', $instance['title']); ?>" class="img-responsive"/>
		<?php
			echo $args['after_title'];
		}
		?>
		<div class="row">
			<div class="col-xs-12">
				<div id="resultados">
					<div id="formasingresso">
						<p>Selecione a sua forma de ingresso.<br><small>Os resultados de cada forma de ingresso serão divulgados conforme cronograma.</small></p><div class="clearfix"></div>
						<?php foreach ($resultados as $formaingresso_id => $campi) : ?>
							<?php $formaingresso_obj = get_term($formaingresso_id); ?>
							<a class="btn btn-formaingresso btn-lg toggle" href="#campi-<?php echo $formaingresso_obj->slug; ?>" title="<?php echo $formaingresso_obj->name; ?>"><?php echo $formaingresso_obj->name; ?></a>
							<div id="campi-<?php echo $formaingresso_obj->slug; ?>" class="campi">
								<ol class="breadcrumb">
									<li><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
									<li class="active"><?php echo $formaingresso_obj->name; ?></li>
								</ol>
								<p>Selecione o seu Campus.</p>
								<?php foreach ($campi as $campus_id => $modalidades) : ?>
									<?php $campus_obj = get_term($campus_id); ?>
									<a class="btn btn-campus toggle" href="#modalidades-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" title="<?php echo $campus_obj->name; ?>"><?php echo $campus_obj->name; ?></a>
									<div id="modalidades-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="modalidades">
										<ol class="breadcrumb">
											<li><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
											<li><a href="#campi-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-campus"><?php echo $formaingresso_obj->name; ?></a></li>
											<li class="active"><?php echo $campus_obj->name; ?></li>
										</ol>
										<p>Selecione a modalidade.</p>
										<?php foreach ($modalidades as $modalidade_id => $resultados) : ?>
											<?php $modalidade_obj = get_term($modalidade_id); ?>
											<a class="btn btn-modalidade btn-lg toggle" href="#resultados-<?php echo $modalidade_obj->slug; ?>-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" title="<?php echo $modalidade_obj->name; ?>"><?php echo $modalidade_obj->name; ?></a>
											<div id="resultados-<?php echo $modalidade_obj->slug; ?>-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="resultados">
												<ol class="breadcrumb">
													<li><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
													<li><a href="#campi-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-campus"><?php echo $formaingresso_obj->name; ?></a></li>
													<li><a href="#modalidades-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-modalidade"><?php echo $campus_obj->name; ?></a></li>
													<li class="active"><?php echo $modalidade_obj->name; ?></li>
												</ol>
												<p>Veja abaixo as chamadas já realizadas.</p>
												<div class="list-group">
												<?php foreach ($resultados as $key => $resultado_obj) : ?>
													<a href="<?php echo get_permalink($resultado_obj); ?>" rel="bookmark" class="list-group-item">
		                                                <h4 class="list-group-item-heading">
															<?php echo $resultado_obj->post_title; ?>&nbsp;
															<span class="label label-modalidade"><?php echo $modalidade_obj->name; ?></span>&nbsp;
															<span class="label label-campus"><?php echo $campus_obj->name; ?></span>&nbsp;
															<span class="label label-formaingresso"><?php echo $formaingresso_obj->name; ?></span>
														</h4>
		                                                <p class="list-group-item-text"><small><?php echo get_the_time('d/m/Y', $resultado_obj); ?></small></p>
		                                            </a>
												<?php endforeach; ?>
												</div>
											</div>
										<?php endforeach; ?>
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
		$title = ! empty( $instance['title'] ) ? $instance['title'] : __( 'Resultados', 'ifrs-ps-theme' );
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
function register_resultados_widget() {
    register_widget( 'Resultados_Widget' );
}
add_action( 'widgets_init', 'register_resultados_widget' );

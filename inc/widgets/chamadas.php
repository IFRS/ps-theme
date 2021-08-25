<?php
class Chamadas_Widget extends WP_Widget {
    private $widget_fields = array();

	function __construct() {
		parent::__construct(
			'chamadas_widget',
			esc_html__( 'Chamadas', 'ifrs-ps-theme' ),
			array( 'description' => esc_html__( 'Mostra as Chamadas do Processo Seletivo', 'ifrs-ps-theme' ), ) // Args
        );
        $formasingresso = get_terms(array(
            'taxonomy' => 'formaingresso',
            'orderby' => 'name',
            'fields' => 'id=>name',
        ));

        foreach ($formasingresso as $id => $name) {
            $this->widget_fields[] = array(
                'label' => $name,
                'id' => $id,
                'type' => 'checkbox'
            );
        }
	}

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

        $formasingresso_selecionadas = array();
        foreach ($formasingresso_all as $formaingresso_id) {
            if (isset($instance[$formaingresso_id]) && $instance[$formaingresso_id] == '1') {
                $formasingresso_selecionadas[] = $formaingresso_id;
            }
        }

        $chamadas = array();

        foreach ($formasingresso_selecionadas as $id1) {
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
        <div class="widget-chamadas__content">
            <div class="chamadas" aria-live="polite">
                <div id="formasingresso" class="chamadas__formasingresso">
                    <p class="chamadas__text"><?php _e('Selecione a sua forma de ingresso.', 'ifrs-ps-theme'); ?><br><small><?php _e('Os resultados de cada forma de ingresso serão divulgados conforme cronograma.', 'ifrs-ps-theme'); ?></small></p>
                    <?php foreach ($chamadas as $formaingresso_id => $campi) : ?>
                        <?php $formaingresso_obj = get_term($formaingresso_id); ?>
                        <a class="btn btn-formaingresso btn-lg btn-block toggle" href="#campi-<?php echo $formaingresso_obj->slug; ?>"><span class="visually-hidden">Ingresso por </span><?php echo $formaingresso_obj->name; ?></a>
                        <div id="campi-<?php echo $formaingresso_obj->slug; ?>" class="chamadas__campi">
                            <p class="chamadas__text">Selecione o seu Campus.</p>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><?php echo $formaingresso_obj->name; ?></li>
                            </ol>
                            <?php foreach ($campi as $campus_id => $chamada) : ?>
                                <?php $campus_obj = get_term($campus_id); ?>
                                <a class="btn btn-campus btn-block toggle" href="#chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>"><span class="visually-hidden">Campus </span><?php echo $campus_obj->name; ?></a>
                                <div id="chamadas-<?php echo $campus_obj->slug; ?>-<?php echo $formaingresso_obj->slug; ?>" class="chamadas__list">
                                    <p class="chamadas__text">Confira abaixo as chamadas j&aacute; realizadas.</p>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#formasingresso" class="breadcrumb-formaingresso">Formas de Ingresso</a></li>
                                        <li class="breadcrumb-item"><a href="#campi-<?php echo $formaingresso_obj->slug; ?>" class="breadcrumb-campus"><?php echo $formaingresso_obj->name; ?></a></li>
                                        <li class="breadcrumb-item active" aria-current="page"><?php echo $campus_obj->name; ?></li>
                                    </ol>
                                    <?php foreach ($chamada as $resultado) : ?>
                                        <div class="chamada">
                                            <a class="chamada__link btn" href="<?php echo get_permalink($resultado); ?>" rel="bookmark">
                                                <h3 class="chamada__title"><?php echo $resultado->post_title; ?></h3>
                                                <p class="chamada__meta"><?php echo get_the_time('d/m/Y', $resultado); ?></p>
                                                <p class="chamada__badges">
                                                    <?php $modalidades = get_post_meta($resultado->ID, '_chamada_resultados_group'); ?>
                                                    <?php foreach ($modalidades[0] as $id => $modalidade) : ?>
                                                        <?php
                                                            if ($modalidade_obj = get_term($modalidade['modalidade'], 'modalidade')) {
                                                                echo $modalidade_obj->name; ?><?php echo ($id !== array_key_last($modalidades[0])) ? ' / ' : '';
                                                            }
                                                        ?>
                                                    <?php endforeach; ?>
                                                </p>
                                            </a>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </div>
        <?php
        echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'ifrs-ps-theme' );
			switch ( $widget_field['type'] ) {
				case 'checkbox':
					$output .= '<p>';
					$output .= '<input class="checkbox" type="checkbox" '.checked( $widget_value, true, false ).' id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" value="1">';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'ifrs-ps-theme' ).'</label>';
					$output .= '</p>';
					break;
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'ifrs-ps-theme' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
		?>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'ifrs-ps-theme' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

add_action( 'widgets_init', function() {
    register_widget( 'Chamadas_Widget' );
} );

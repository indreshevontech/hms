<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}
/**
 * Framework options
 *
 * @var array $options Fill this array with options to generate framework settings form in backend
 */

$options = array(
   
    fw()->theme->get_options( 'opt/opt_header' ),
    fw()->theme->get_options( 'opt/doctors_single_header' ),
    fw()->theme->get_options( 'opt/opt_blog' ),
    fw()->theme->get_options( 'opt/map_api' ),
    fw()->theme->get_options( 'opt/opt_typo' ),
    fw()->theme->get_options( 'opt/opt_colors' ),
    fw()->theme->get_options( 'opt/opt_footer' ),
    
);

<?php if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    'page_meta_main' => array(
        'title'   => false,
        'type'    => 'box',
        'options' => array(
            fw()->theme->get_options( 'opt/meta_page' ),
        ),
    ),
);
<?php
if ( ! defined( 'FW' ) ) {
    die( 'Forbidden' );
}

$options = array(
    'meta_gallery_main' => array(
        'title'   => false,
        'type'    => 'box',
        'options' => array(
            fw()->theme->get_options( 'opt/meta_gallery' ),
        ),
    ),
);
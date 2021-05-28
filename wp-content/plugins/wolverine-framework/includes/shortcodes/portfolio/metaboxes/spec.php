<?php
/**
 * Add the question & answer meta box
 * @var [type]
 */
$class_metabox_qa = new WPAlchemy_MetaBox(array
(
    'id' => 'portfolio_custom_fields',
    'title' => __('Custom Field', 'wolverine'),
    'template' => plugin_dir_path( __FILE__ ) . 'custom-field.php',
    'types' => array(G5PLUS_PORTFOLIO_POST_TYPE),
    'autosave' => TRUE,
    'priority' => 'high',
    'context' => 'normal',
    'hide_editor' => FALSE
));



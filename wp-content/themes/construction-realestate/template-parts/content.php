<?php
/**
 * The template part for displaying content
 * @package Construction Realestate
 * @subpackage construction_realestate
 * @since 1.0
 */
?>
<?php $construction_realestate_theme_lay = get_theme_mod( 'construction_realestate_post_layouts','Layout 1');
if($construction_realestate_theme_lay == 'Layout 1'){ 
  get_template_part('template-parts/Post-layouts/layout1'); 
}else if($construction_realestate_theme_lay == 'Layout 2'){ 
  get_template_part('template-parts/Post-layouts/layout2'); 
}else if($construction_realestate_theme_lay == 'Layout 3'){ 
  get_template_part('template-parts/Post-layouts/layout3'); 
}else{ 
  get_template_part('template-parts/Post-layouts/layout1'); 
}
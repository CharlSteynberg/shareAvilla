<?php
/**
 * Posts Pro Overviews.
 * @package Posts
 * @author Flipper Code <flippercode>
 **/
$form  = new WCJP_FORM();
echo $form->show_header();
?>

<div class="flippercode-ui">
  <div class="fc-main">
<div class="fc-container">
     <div class="fc-divider">
      <div class="fc-back fc-how">
  <div class="row flippercode-main wpgmp-docs">
    <div class="fc-12">
          <h4 class="fc-title-blue main-heading"> <?php _e( 'How it Works',WCJP_TEXT_DOMAIN ); ?> </h4>
          <div class="wpgmp-overview">
          This plugin lets you to modify your themes or plugins without modify files. You need not to write hooks in functions.php to write custom css or js in the header or footer or within page.
          </div>

          <h4 class="fc-title-blue"> <?php _e( 'How to Add Custom CSS',WCJP_TEXT_DOMAIN ); ?> </h4>
          <div class="wpgmp-overview">
          You can add css in the header or footer section on your website using this plugin. There are 3 ways to do this.
          <ul>
              <li><b>Using Shortcode</b> - Go to 'Add CSS' page and write your css. Choose 'Shortcode' for 'Apply Using' option. You can get shortcode in 'Manage CSS' and paste in your pages or posts.</li>
              <li><b>Using wp_head action</b> - Go to 'Add CSS' page and write your css. Choose 'wp_head' for 'Apply Using' option. You must have wp_head() function in your header.php. CSS will be added automatically before closing head tag.  </li>
               <li><b>Using wp_footer action</b> - Go to 'Add CSS' page and write your css. Choose 'wp_footer' for 'Apply Using' option. You must have wp_footer() function in your footer.php. CSS will be added automatically before closing body tag. </li>
          </ul> 

          <p>Below is example of css code to display using wp_head. </p>

          <img src="<?php echo WCJP_IMAGES ?>/css-example.png" />

          </div>

         <h4 class="fc-title-blue"> <?php _e( 'How to Add Custom Javascript',WCJP_TEXT_DOMAIN ); ?> </h4>
          <div class="wpgmp-overview">
          You can add javascript in the header or footer section on your website using this plugin. There are 3 ways to do this.
          <ul>
              <li><b>Using Shortcode</b> - Go to 'Add JS' page and write your javascript. Choose 'Shortcode' for 'Apply Using' option. You can get shortcode in 'Manage JS' and paste in your pages or posts.</li>
              <li><b>Using wp_head action</b> - Go to 'Add JS' page and write your javascript. Choose 'wp_head' for 'Apply Using' option. You must have wp_head() function in your header.php. Javascript will be added automatically before closing head tag.  </li>
               <li><b>Using wp_footer action</b> - Go to 'Add CSS' page and write your css. Choose 'wp_footer' for 'Apply Using' option. You must have wp_footer() function in your footer.php. Javascript will be added automatically before closing body tag. </li>
          </ul> 

          <p>Below is example of javascript code to display using wp_footer. </p>

          <img src="<?php echo WCJP_IMAGES ?>/js-example.png" />

          </div>

          <h4 class="fc-title-blue"> <?php _e( 'How to Add PHP Code',WCJP_TEXT_DOMAIN ); ?> </h4>
          <div class="wpgmp-overview">
          Adding PHP Code is different from adding css or js. You should be careful and make sure there is no syntax error otherwise your site can be broken. There are 3 ways to execute php code without changing your files.
          <ul>
              <li><b>Using Shortcode</b> - Go to 'Add PHP' page and write your php code. Choose 'Shortcode' for 'Apply Using' option. You can get shortcode in 'Manage PHP' and paste in your pages or posts.</li>
              <li><b>Using Actions</b> - Go to 'Add PHP' page and write your php code. Choose 'WP Action' and write your 'Action' name. You can view list of <a href="https://codex.wordpress.org/Plugin_API/Action_Reference" target="_blank">wp actions</a> here.  </li>
              <li><b>Using Filters</b> - Go to 'Add PHP' page and write your php code. Choose 'WP Filter' and write your 'Filter' name. You can view list of <a href="https://codex.wordpress.org/Plugin_API/Filter_Reference" target="_blank">wp filters</a> here.  </li>
          </ul>

          <p>Below is example of php code to display using shortcode. </p>

          <img src="<?php echo WCJP_IMAGES ?>/php-example.png" />

          </div>

          <h4 class="fc-title-blue"> <?php _e( 'How to Remove PHP Errors',WCJP_TEXT_DOMAIN ); ?> </h4>
          <div class="wpgmp-overview">
          	Incase you have syntax error in your php code, your site will be broken. You can write following code in your wp-confing.php and php code added using this plugin will be not in use so your site will be back. 
          	define('DISABLE_WCE','true');
          </div>

      </div>
    </div>
      </div>
    </div>
          </div>
    </div>


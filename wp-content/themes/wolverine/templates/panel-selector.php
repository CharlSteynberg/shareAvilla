<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 6/20/2015
 * Time: 8:56 AM
 */
?>
<div id="panel-style-selector">
    <div class="panel-wrapper">
        <div class="panel-selector-open"><i class="fa fa-cog"></i></div>
        <div class="panel-selector-header"><?php _e('Style Selector','wolverine');?></div>
        <div class="panel-selector-body clearfix">
            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php _e('Primary Color','wolverine'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <ul class="panel-primary-color">
                        <li class="active" style="background-color: #995958" data-color="#995958"></li>
                        <li style="background-color: #e8aa00" data-color="#e8aa00"></li>
                        <li style="background-color: #6b58cd" data-color="#6b58cd"></li>
                        <li style="background-color: #30ABE2" data-color="#30ABE2"></li>
                    </ul>
                </div>
            </section>

            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php _e('Layout','wolverine'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <a data-type="layout" data-value="wide" href="#" class="panel-selector-btn"><?php _e('Wide','wolverine'); ?></a>
                    <a data-type="layout" data-value="boxed" href="#" class="panel-selector-btn"><?php _e('Boxed','wolverine'); ?></a>
                </div>
            </section>

            <section class="panel-selector-section clearfix">
                <h3 class="panel-selector-title"><?php _e('Background','wolverine'); ?></h3>
                <div class="panel-selector-row clearfix">
                    <ul class="panel-primary-background">
                        <li class="pattern-0" data-name="pattern-1.png" data-type="pattern" style="background-position: 0px 0px;"></li>
                        <li class="pattern-1" data-name="pattern-2.png" data-type="pattern" style="background-position: -45px 0px;"></li>
                        <li class="pattern-2" data-name="pattern-3.png" data-type="pattern" style="background-position: -90px 0px;"></li>
                        <li class="pattern-3" data-name="pattern-4.png" data-type="pattern" style="background-position: -135px 0px;"></li>
                        <li class="pattern-4" data-name="pattern-5.png" data-type="pattern" style="background-position: -180px 0px;"></li>
                        <li class="pattern-5" data-name="pattern-6.png" data-type="pattern" style="background-position: -225px 0px;"></li>
                        <li class="pattern-6" data-name="pattern-7.png" data-type="pattern" style="background-position: -270px 0px;"></li>
                        <li class="pattern-7" data-name="pattern-8.png" data-type="pattern" style="background-position: -315px 0px;"></li>
                    </ul>
                </div>
            </section>
            <section class="panel-selector-section clearfix">
                <div class="panel-selector-row clearfix">
                    <a id="panel-selector-reset" href="#" class="panel-selector-btn"><?php _e('Reset','wolverine'); ?></a>
                </div>
            </section>
        </div>
    </div>
</div>
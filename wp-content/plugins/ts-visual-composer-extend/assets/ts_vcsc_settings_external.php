<div id="ts-settings-files" class="tab-content">
    <h2>External Files Settings</h2>
    <p>This plugin will load some external CSS and JS files in order to make the content elements work on the front end. Your theme or another plugin might already load the same file, which in some cases
    can cause problems. Use this page to enable/disable the files this plugin should be allowed to load on the front end.</p>

    <hr class='style-six' style='margin-top: 20px;'>

    <p>
        <h4>Force Load of jQuery:</h4>
        <p>Please define if you want to force a load of jQuery and jQuery Migrate:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadjQuery" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadjQuery" id="ts_vcsc_extend_settings_loadjQuery" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadjQuery); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadjQuery">Force Load of jQuery<span title="If checked, the plugin will force the load of jQuery and jQuery Migrate, bypassing WordPress standards." class="<?php echo $ToolTipClass; ?>"></span></label>
    </p>
    
    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load ONLY Lightbox Files on ALL Pages:</h4>
        <p>Please define if you want to load the lightbox files on ALL pages, even if no shortcode has been detected:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadLightbox" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadLightbox" id="ts_vcsc_extend_settings_loadLightbox" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadLightbox); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadLightbox">Load Lightbox On All Pages</label><span title="If checked, the plugin will load the lightbox files on all pages, whether a corresponding shortcode has been detected, or not." class="<?php echo $ToolTipClass; ?>"></span>
    </p>
    
    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load ONLY Tooltip Files on ALL Pages:</h4>
        <p>Please define if you want to load the tooltip files on ALL pages, even if no shortcode has been detected:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadTooltip" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadTooltip" id="ts_vcsc_extend_settings_loadTooltip" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadTooltip); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadTooltip">Load Tooltips On All Pages</label><span title="If checked, the plugin will load the tooltips files on all pages, whether a corresponding shortcode has been detected, or not." class="<?php echo $ToolTipClass; ?>"></span>
    </p>
    
    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load ONLY Icon Font Files on ALL Pages:</h4>
        <p>Please define if you want to load the active Icon Font files on ALL pages, even if no shortcode has been detected:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadFonts" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadFonts" id="ts_vcsc_extend_settings_loadFonts" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadFonts); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadFonts">Load active Icon Fonts On All Pages</label><span title="If checked, the plugin will load the active Icon Font files on all pages, whether a corresponding shortcode has been detected, or not." class="<?php echo $ToolTipClass; ?>"></span>
    </p>

    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load ALL Files on ALL Pages:</h4>
        <p>Please define if you want to load ALL of the plugin files on ALL pages, even if no shortcode has been detected:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadForcable" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadForcable" id="ts_vcsc_extend_settings_loadForcable" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadForcable); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadForcable">Load ALL Files On All Pages</label><span title="If checked, the plugin will load the plugin files on all pages, whether a corresponding shortcode has been detected, or not." class="<?php echo $ToolTipClass; ?>"></span>
    </p>
    
    <hr class='style-six' style='margin-top: 20px;'>

    <p>
        <h4>Load External Files in HEAD:</h4>
        <p>Please define where you want to load the JS Files:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadHeader" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadHeader" id="ts_vcsc_extend_settings_loadHeader" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadHeader); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadHeader">Load all Files in HEAD<span title="If checked, the plugin will load all external JS files in the page HEAD section instead of at the end of the page's BODY section." class="<?php echo $ToolTipClass; ?>"></span></label>
    </p>

    <hr class='style-six' style='margin-top: 20px;'>

    <p>
        <h4>Load Files via WordPress Standard:</h4>
        <p>Please define if you want to load the script files via "wp_enqueue_script" and "wp_enqueue_style":</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadEnqueue" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadEnqueue" id="ts_vcsc_extend_settings_loadEnqueue" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadEnqueue); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadEnqueue">Load Files with Standard Method<span title="If checked, the plugin will load all external files via WordPress &quot;wp_enqueue_script&quot; and &quot;wp_enqueue_style&quot;, as recommended." class="<?php echo $ToolTipClass; ?>"></span></label>
    </p>

    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load Modernizr File:</h4>
        <p>Please define if you want to load the Modernizr file to ensure CSS3 compatibility for most browsers:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadModernizr" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadModernizr" id="ts_vcsc_extend_settings_loadModernizr" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadModernizr); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadModernizr">Load Modernizr</label><span title="If checked, the plugin will load the Modernizr file for each page with a corresponding shortcode." class="<?php echo $ToolTipClass; ?>"></span>
    </p>

    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load Waypoints File:</h4>
        <p>Please define if you want to load the Waypoints File for Viewport Animations:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadWaypoints" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadWaypoints" id="ts_vcsc_extend_settings_loadWaypoints" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadWaypoints); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadWaypoints">Load WayPoints</label><span title="If checked, the plugin will load the Waypoints File for Viewport Animations." class="<?php echo $ToolTipClass; ?>"></span>
    </p>
    
    <hr class='style-six' style='margin-top: 20px;'>
        
    <p>
        <h4>Load CountTo File:</h4>
        <p>Please define if you want to load the CountTo File for the Icon Counter:</p>
        <input type="hidden" name="ts_vcsc_extend_settings_loadCountTo" value="0" />
        <input type="checkbox" name="ts_vcsc_extend_settings_loadCountTo" id="ts_vcsc_extend_settings_loadCountTo" value="1" <?php echo checked('1', $ts_vcsc_extend_settings_loadCountTo); ?> />
        <label class="labelCheckBox" for="ts_vcsc_extend_settings_loadCountTo">Load CountTo</label><span title="If checked, the plugin will load the CountTo File for Icon Counter numbers." class="<?php echo $ToolTipClass; ?>"></span>
    </p>
</div>
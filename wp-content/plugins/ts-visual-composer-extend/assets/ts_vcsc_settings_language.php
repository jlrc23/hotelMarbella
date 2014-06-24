<div id="ts-settings-language" class="tab-content">
    <h2>Language Settings</h2>
	
	<h4>Countdown Phrases</h4>
	
	<p style="margin-top: 20px;">
		The new element "TS Countdown" is using some English key words (i.e. Days, Hours, etc.) to indicate what the numbers in the countdown represent. Here, you can translate those key words if you want to show them in a
		different language.
	</p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageDayPlural">"Days" (Plural):</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageDayPlural" name="ts_vcsc_extend_settings_languageDayPlural" value="<?php echo $ts_vcsc_extend_settings_languageDayPlural; ?>" size="100">
        <span title="Define Phrase to be used for multiple days (plural)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageDaySingular">"Day" (Singular):</label>
        <input class="validate[required]" data-error="Text - Single Day" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageDaySingular" name="ts_vcsc_extend_settings_languageDaySingular" value="<?php echo $ts_vcsc_extend_settings_languageDaySingular; ?>" size="100">
        <span title="Define Phrase to be used for a single day (singular)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageHourPlural">"Hours" (Plural):</label>
        <input class="validate[required]" data-error="Text - Multiple Hours" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageHourPlural" name="ts_vcsc_extend_settings_languageHourPlural" value="<?php echo $ts_vcsc_extend_settings_languageHourPlural; ?>" size="100">
        <span title="Define Phrase to be used for multiple hours (plural)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageHourSingular">"Hour" (Singular):</label>
        <input class="validate[required]" data-error="Text - Single Hour" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageHourSingular" name="ts_vcsc_extend_settings_languageHourSingular" value="<?php echo $ts_vcsc_extend_settings_languageHourSingular; ?>" size="100">
        <span title="Define Phrase to be used for a single hour (singular)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageMinutePlural">"Minutes" (Plural):</label>
        <input class="validate[required]" data-error="Text - Multiple Minutes" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageMinutePlural" name="ts_vcsc_extend_settings_languageMinutePlural" value="<?php echo $ts_vcsc_extend_settings_languageMinutePlural; ?>" size="100">
        <span title="Define Phrase to be used for multiple minutes (plural)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageMinuteSingular">"Minute" (Singular):</label>
        <input class="validate[required]" data-error="Text - Single Minute" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageMinuteSingular" name="ts_vcsc_extend_settings_languageMinuteSingular" value="<?php echo $ts_vcsc_extend_settings_languageMinuteSingular; ?>" size="100">
        <span title="Define Phrase to be used for a single minute (singular)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageSecondPlural">"Seconds" (Plural):</label>
        <input class="validate[required]" data-error="Text - Multiple Seconds" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageSecondPlural" name="ts_vcsc_extend_settings_languageSecondPlural" value="<?php echo $ts_vcsc_extend_settings_languageSecondPlural; ?>" size="100">
        <span title="Define Phrase to be used for multiple seconds (plural)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageSecondSingular">"Second" (Singular):</label>
        <input class="validate[required]" data-error="Text - Single Second" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageSecondSingular" name="ts_vcsc_extend_settings_languageSecondSingular" value="<?php echo $ts_vcsc_extend_settings_languageSecondSingular; ?>" size="100">
        <span title="Define Phrase to be used for a single second (singular)" class="<?php echo $ToolTipClass; ?>"></span>
    </p>
	
	<h4>Google Map</h4>
	
	<p style="margin-top: 20px;">
		The new element "TS Google Map" is using some custom control elements that by default, use English. Here, you can translate those key words if you want to show them in a different language.
	</p>
	
	<img src="<?php echo TS_VCSC_GetResourceURL('images/Google_Map.jpg'); ?>" style="border: 1px solid #eeeeee; width:900px; max-width: 100%; height: auto; margin: 20px auto;">
	
	<p style="font-size: 10px;">The iamge above doesn't show all available text items since some of them are conditional and exclude each other, but it should give you a basic idea.</p>
	
	<p style="font-weight: bold;">Text Items in Top Control Bar:</p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextResetMap">"Reset Map":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextResetMap" name="ts_vcsc_extend_settings_languageTextResetMap" value="<?php echo $ts_vcsc_extend_settings_languageTextResetMap; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextCalcShow">"Show Address Input":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextCalcShow" name="ts_vcsc_extend_settings_languageTextCalcShow" value="<?php echo $ts_vcsc_extend_settings_languageTextCalcShow; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextCalcHide">"Hide Address Input":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextCalcHide" name="ts_vcsc_extend_settings_languageTextCalcHide" value="<?php echo $ts_vcsc_extend_settings_languageTextCalcHide; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextDirectionShow">"Show Directions":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextDirectionShow" name="ts_vcsc_extend_settings_languageTextDirectionShow" value="<?php echo $ts_vcsc_extend_settings_languageTextDirectionShow; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextDirectionHide">"Hide Directions":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextDirectionHide" name="ts_vcsc_extend_settings_languageTextDirectionHide" value="<?php echo $ts_vcsc_extend_settings_languageTextDirectionHide; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextDistance">"Total Distance:":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextDistance" name="ts_vcsc_extend_settings_languageTextDistance" value="<?php echo $ts_vcsc_extend_settings_languageTextDistance; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapMiles">"Miles":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapMiles" name="ts_vcsc_extend_settings_languageTextMapMiles" value="<?php echo $ts_vcsc_extend_settings_languageTextMapMiles; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapKilometes">"Kilometers":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapKilometes" name="ts_vcsc_extend_settings_languageTextMapKilometes" value="<?php echo $ts_vcsc_extend_settings_languageTextMapKilometes; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextViewOnGoogle">"View on Google":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextViewOnGoogle" name="ts_vcsc_extend_settings_languageTextViewOnGoogle" value="<?php echo $ts_vcsc_extend_settings_languageTextViewOnGoogle; ?>" size="100">
    </p>
	
	<p style="font-weight: bold;">Text Items in Address and Waypoints Section:</p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextSetTarget">"Please enter your Start Address:":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextSetTarget" name="ts_vcsc_extend_settings_languageTextSetTarget" value="<?php echo $ts_vcsc_extend_settings_languageTextSetTarget; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextButtonAdd">"Add Stop on the Way":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextButtonAdd" name="ts_vcsc_extend_settings_languageTextButtonAdd" value="<?php echo $ts_vcsc_extend_settings_languageTextButtonAdd; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextTravelMode">"Travel Mode":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextTravelMode" name="ts_vcsc_extend_settings_languageTextTravelMode" value="<?php echo $ts_vcsc_extend_settings_languageTextTravelMode; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextDriving">"Driving":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextDriving" name="ts_vcsc_extend_settings_languageTextDriving" value="<?php echo $ts_vcsc_extend_settings_languageTextDriving; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextWalking">"Walking":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextWalking" name="ts_vcsc_extend_settings_languageTextWalking" value="<?php echo $ts_vcsc_extend_settings_languageTextWalking; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextBicy">Text for "Bicycling":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextBicy" name="ts_vcsc_extend_settings_languageTextBicy" value="<?php echo $ts_vcsc_extend_settings_languageTextBicy; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextWP">"Optimize Waypoints":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextWP" name="ts_vcsc_extend_settings_languageTextWP" value="<?php echo $ts_vcsc_extend_settings_languageTextWP; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextButtonCalc">"Show Route":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextButtonCalc" name="ts_vcsc_extend_settings_languageTextButtonCalc" value="<?php echo $ts_vcsc_extend_settings_languageTextButtonCalc; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languagePrintRouteText">"Print Route":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languagePrintRouteText" name="ts_vcsc_extend_settings_languagePrintRouteText" value="<?php echo $ts_vcsc_extend_settings_languagePrintRouteText; ?>" size="100">
    </p>
	
	<p style="font-weight: bold;">Text Items for Custom Map Control Elements:</p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapHome">"Home":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapHome" name="ts_vcsc_extend_settings_languageTextMapHome" value="<?php echo $ts_vcsc_extend_settings_languageTextMapHome; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapBikes">"Bicycle Trails":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapBikes" name="ts_vcsc_extend_settings_languageTextMapBikes" value="<?php echo $ts_vcsc_extend_settings_languageTextMapBikes; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapTraffic">"Traffic":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapTraffic" name="ts_vcsc_extend_settings_languageTextMapTraffic" value="<?php echo $ts_vcsc_extend_settings_languageTextMapTraffic; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapSpeedMiles">"Miles Per Hour":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapSpeedMiles" name="ts_vcsc_extend_settings_languageTextMapSpeedMiles" value="<?php echo $ts_vcsc_extend_settings_languageTextMapSpeedMiles; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapSpeedKM">"Kilometers Per Hour":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapSpeedKM" name="ts_vcsc_extend_settings_languageTextMapSpeedKM" value="<?php echo $ts_vcsc_extend_settings_languageTextMapSpeedKM; ?>" size="100">
    </p>
	
    <p>
        <label class="Uniform" style="display: inline-block;" for="ts_vcsc_extend_settings_languageTextMapNoData">"No Data Available!":</label>
        <input class="validate[required]" data-error="Text - Multiple Days" data-order="2" type="text" style="width: 20%;" id="ts_vcsc_extend_settings_languageTextMapNoData" name="ts_vcsc_extend_settings_languageTextMapNoData" value="<?php echo $ts_vcsc_extend_settings_languageTextMapNoData; ?>" size="100">
    </p>
</div>

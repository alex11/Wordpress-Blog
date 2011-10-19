<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<style type="text/css">
	.eventForm td {
		padding:6px 6px 0 0;
		font-size:11px;
		vertical-align:middle;
	}
	.eventForm select, .eventForm input {
		font-size:11px;
	}
	.eventForm h4 {
		font-size:1.2em;
		margin:2em 0 1em;
	}
	.eventForm h4.event-time {
		margin-top: 0;
	}
	.notice {
		background-color: rgb(255, 255, 224);
		border: 1px solid rgb(230, 219, 85);
		margin: 5px 0 15px;
	}
	#EventInfo {
		border-color:#dfdfdf;
		background-color:#F9F9F9;
		border-width:1px;
		border-style:solid;
		-moz-border-radius:3px;
		-khtml-border-radius:3px;
		-webkit-border-radius:3px;
		border-radius:3px;
		margin: 0;
		width:100%;
		border-style:solid;
		border-spacing:0;
		padding: 10px;
	}
	#eventIntro {
	  margin: 10px 0 25px 0;
	}
	
	.form-table form input {border:none;}
	<?php if( eventsGetOptionValue('donateHidden', false) ) : ?>
		#mainDonateRow {display: none;}
	<?php endif; ?>
	#submitLabel {display: block;}
	#submitLabel input {
		display: block;
		padding: 0;
	}
	<?php if( class_exists( 'Eventbrite_for_The_Events_Calendar' ) ) : ?>
		.eventBritePluginPlug {display:none;}
	<?php endif; ?>
</style><div id="eventIntro">
<div id="tec-post-error" class="tec-events-error error"></div>
<?php
try {
	do_action('sp_events_post_errors', $postId );
	if( !$this->postExceptionThrown ) delete_post_meta( $postId, self::EVENTSERROROPT );
} catch ( TEC_Post_Exception $e) {
	$this->postExceptionThrown = true;
	update_post_meta( $postId, self::EVENTSERROROPT, trim( $e->getMessage() ) );
	$e->displayMessage( $postId );
}
?>
	<p>
		<?php _e('Is this post an event?',$this->pluginDomain); ?>&nbsp;
		<label><input tabindex="<?php $this->tabIndex(); ?>" type='radio' name='isEvent' value='yes' <?php echo $isEventChecked; ?> />&nbsp;<b><?php _e('Yes', $this->pluginDomain); ?></b></label>
		<label><input tabindex="<?php $this->tabIndex(); ?>" type='radio' name='isEvent' value='no' <?php echo $isNotEventChecked; ?> />&nbsp;<b><?php _e('No', $this->pluginDomain); ?></b></label>
	</p>
</div>
<div id='eventDetails' class="inside eventForm">
	<?php
	try {
		do_action('sp_events_detail_top', $postId );
		if( !$this->postExceptionThrown ) delete_post_meta( $postId, self::EVENTSERROROPT );
	} catch ( TEC_Post_Exception $e) {
		$this->postExceptionThrown = true;
		update_post_meta( $postId, self::EVENTSERROROPT, trim( $e->getMessage() ) );
		$e->displayMessage( $postId );
	}
	
	?>
	<table cellspacing="0" cellpadding="0" id="EventInfo">
		<tr>
			<td colspan="2" class="snp_sectionheader"><h4 class="event-time"><?php _e('Event Time &amp; Date', $this->pluginDomain); ?></h4></td>
		</tr>
		<tr>
			<td><?php _e('All day event?', $this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='checkbox' id='allDayCheckbox' name='EventAllDay' value='yes' <?php echo $isEventAllDay; ?> /></td>
		</tr>
		<tr>
			<td style="width:125px;"><?php _e('Start Date / Time:',$this->pluginDomain); ?></td>
			<td>
				<select tabindex="<?php $this->tabIndex(); ?>" name='EventStartMonth'>
					<?php echo $startMonthOptions; ?>
				</select>
				<?php foreach( $startDayOptions as $key => $val ) : ?>
					<select id="<?php echo $key; ?>StartDays" class="eventStartDateField" tabindex="<?php $this->tabIndex(); ?>" name='EventStartDay'>
						<?php echo $val; ?>
					</select>
				<?php endforeach; ?>
				<select tabindex="<?php $this->tabIndex(); ?>" name='EventStartYear'>
					<?php echo $startYearOptions; ?>
				</select>
				<span class='timeofdayoptions'>
					<?php _e('@',$this->pluginDomain); ?>
					<select tabindex="<?php $this->tabIndex(); ?>" name='EventStartHour'>
						<?php echo $startHourOptions; ?>
					</select>
					<select tabindex="<?php $this->tabIndex(); ?>" name='EventStartMinute'>
						<?php echo $startMinuteOptions; ?>
					</select>
					<?php if ( !strstr( get_option( 'time_format', The_Events_Calendar::TIMEFORMAT ), 'H' ) ) : ?>
						<select tabindex="<?php $this->tabIndex(); ?>" name='EventStartMeridian'>
							<?php echo $startMeridianOptions; ?>
						</select>
					<?php endif; ?>
				</span>
			</td>
		</tr>
		<tr>
			<td><?php _e('End Date / Time:',$this->pluginDomain); ?></td>
			<td>
				<select tabindex="<?php $this->tabIndex(); ?>" name='EventEndMonth'>
					<?php echo $endMonthOptions; ?>
				</select>
				<?php foreach( $endDayOptions as $key => $val ) : ?>
					<select id="<?php echo $key; ?>EndDays" class="eventEndDateField" tabindex="<?php $this->tabIndex(); ?>" name='EventEndDay'>
						<?php echo $val; ?>
					</select>
				<?php endforeach; ?>
				<select tabindex="<?php $this->tabIndex(); ?>" name='EventEndYear'>
					<?php echo $endYearOptions; ?>
				</select>
				<span class='timeofdayoptions'>
					<?php _e('@',$this->pluginDomain); ?>
					<select class="spEventsInput"tabindex="<?php $this->tabIndex(); ?>" name='EventEndHour'>
						<?php echo $endHourOptions; ?>
					</select>
					<select tabindex="<?php $this->tabIndex(); ?>" name='EventEndMinute'>
						<?php echo $endMinuteOptions; ?>
					</select>
					<?php if ( !strstr( get_option( 'time_format', The_Events_Calendar::TIMEFORMAT ), 'H' ) ) : ?>
						<select tabindex="<?php $this->tabIndex(); ?>" name='EventEndMeridian'>
							<?php echo $endMeridianOptions; ?>
						</select>
					<?php endif; ?>
				</span>
			</td>
		</tr>
		<tr>
			<td colspan="2" class="snp_sectionheader"><h4><?php _e('Event Location Details', $this->pluginDomain); ?></h4></td>
		</tr>
        <tr>
			<td><?php _e('Featured Event:',$this->pluginDomain); ?></td>
			<td>
            <p>
                <label><input tabindex="<?php $this->tabIndex(); ?>" type='radio' name='EventFeatured' value='yes' <?php echo $isFeaturedEventChecked; ?> />&nbsp;<b><?php _e('Yes', $this->pluginDomain); ?></b></label>
                <label><input tabindex="<?php $this->tabIndex(); ?>" type='radio' name='EventFeatured' value='no' <?php echo $isNotFeaturedEventChecked; ?> />&nbsp;<b><?php _e('No', $this->pluginDomain); ?></b></label>
            </p>
			</td>
		</tr>
		<tr>
			<td><?php _e('Venue:',$this->pluginDomain); ?></td>
			<td>
				<input tabindex="<?php $this->tabIndex(); ?>" type='text' name='EventVenue' size='25'  value='<?php echo $_EventVenue; ?>' />
			</td>
		</tr>
        <tr>
        	<td><?php _e('Register Link:',$this->pluginDomain); ?></td>
            <td>
            	<input tabindex="<?php $this->tabIndex(); ?>" type='text' name='EventRegister' size='25'  value='<?php echo $_EventRegister; ?>' />
            </td>
        </tr>
		<tr>
			<td><?php _e('Country:',$this->pluginDomain); ?></td>
			<td>
				<select tabindex="<?php $this->tabIndex(); ?>" name="EventCountry" id="EventCountry">
					<?php
					$this->constructCountries( $postId );
					$defaultCountry = eventsGetOptionValue('defaultCountry');
					if( $_EventCountry ) {
						foreach ($this->countries as $abbr => $fullname) {
							echo '<option label="' . $abbr . '" value="' . $fullname . '" ';
				       		if ($_EventCountry == $fullname) {
								echo 'selected="selected" ';
								$eventCountryLabel = $abbr;
							}
							echo '>' . $fullname . '</option>';
				     	}
					} elseif( $defaultCountry && !get_post_custom_keys( $postId ) ) {
						foreach ($this->countries as $abbr => $fullname) {
							echo '<option label="' . $abbr . '" value="' . $fullname . '" ';
				       		if ($defaultCountry[1] == $fullname) {
								echo 'selected="selected" ';
								$eventCountryLabel = $abbr;
							}
							echo '>' . $fullname . '</option>';
				     	}
					} else {
						$eventCountryLabel = "";
						foreach ($this->countries as $abbr => $fullname) {
							echo '<option label="' . $abbr . '" value="' . $fullname . '" >' . $fullname . '</option>';
				     	}
					}
				     ?>
			     </select>
				 <input name="EventCountryLabel" type="hidden" value="<?php echo $eventCountryLabel; ?>" />
			</td>
		</tr>
		<tr>
			<td><?php _e('Address:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' name='EventAddress' size='25' value='<?php echo $_EventAddress; ?>' /></td>
		</tr>
		<tr>
			<td><?php _e('City:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' name='EventCity' size='25' value='<?php echo $_EventCity; ?>' /></td>
		</tr>
		<input name="EventStateExists" type="hidden" value="<?php echo ($_EventCountry !== 'United States') ? 0 : 1; ?>">
		<tr id="International" <?php if($_EventCountry == 'United States' || $_EventCountry == '' ) echo('class="tec_hide"'); ?>>
			<td><?php _e('Province:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' name='EventProvince' size='10' value='<?php echo $_EventProvince; ?>' /></td>
		</tr>
		<tr id="USA" <?php if($_EventCountry !== 'United States') echo('class="tec_hide"'); ?>>
			<td><?php _e('State:',$this->pluginDomain); ?></td>
			<td>
				<select tabindex="<?php $this->tabIndex(); ?>" name="EventState">
				    <option value=""><?php _e('Select a State:',$this->pluginDomain); ?></option> 
					<?php $states = array (
						"AL" => __("Alabama", $this->pluginDomain),
						"AK" => __("Alaska", $this->pluginDomain),
						"AZ" => __("Arizona", $this->pluginDomain),
						"AR" => __("Arkansas", $this->pluginDomain),
						"CA" => __("California", $this->pluginDomain),
						"CO" => __("Colorado", $this->pluginDomain),
						"CT" => __("Connecticut", $this->pluginDomain),
						"DE" => __("Delaware", $this->pluginDomain),
						"DC" => __("District of Columbia", $this->pluginDomain),
						"FL" => __("Florida", $this->pluginDomain),
						"GA" => __("Georgia", $this->pluginDomain),
						"HI" => __("Hawaii", $this->pluginDomain),
						"ID" => __("Idaho", $this->pluginDomain),
						"IL" => __("Illinois", $this->pluginDomain),
						"IN" => __("Indiana", $this->pluginDomain),
						"IA" => __("Iowa", $this->pluginDomain),
						"KS" => __("Kansas", $this->pluginDomain),
						"KY" => __("Kentucky", $this->pluginDomain),
						"LA" => __("Louisiana", $this->pluginDomain),
						"ME" => __("Maine", $this->pluginDomain),
						"MD" => __("Maryland", $this->pluginDomain),
						"MA" => __("Massachusetts", $this->pluginDomain),
						"MI" => __("Michigan", $this->pluginDomain),
						"MN" => __("Minnesota", $this->pluginDomain),
						"MS" => __("Mississippi", $this->pluginDomain),
						"MO" => __("Missouri", $this->pluginDomain),
						"MT" => __("Montana", $this->pluginDomain),
						"NE" => __("Nebraska", $this->pluginDomain),
						"NV" => __("Nevada", $this->pluginDomain),
						"NH" => __("New Hampshire", $this->pluginDomain),
						"NJ" => __("New Jersey", $this->pluginDomain),
						"NM" => __("New Mexico", $this->pluginDomain),
						"NY" => __("New York", $this->pluginDomain),
						"NC" => __("North Carolina", $this->pluginDomain),
						"ND" => __("North Dakota", $this->pluginDomain),
						"OH" => __("Ohio", $this->pluginDomain),
						"OK" => __("Oklahoma", $this->pluginDomain),
						"OR" => __("Oregon", $this->pluginDomain),
						"PA" => __("Pennsylvania", $this->pluginDomain),
						"RI" => __("Rhode Island", $this->pluginDomain),
						"SC" => __("South Carolina", $this->pluginDomain),
						"SD" => __("South Dakota", $this->pluginDomain),
						"TN" => __("Tennessee", $this->pluginDomain),
						"TX" => __("Texas", $this->pluginDomain),
						"UT" => __("Utah", $this->pluginDomain),
						"VT" => __("Vermont", $this->pluginDomain),
						"VA" => __("Virginia", $this->pluginDomain),
						"WA" => __("Washington", $this->pluginDomain),
						"WV" => __("West Virginia", $this->pluginDomain),
						"WI" => __("Wisconsin", $this->pluginDomain),
						"WY" => __("Wyoming", $this->pluginDomain),
					);
				      foreach ($states as $abbr => $fullname) {
				        print ("<option value=\"$abbr\" ");
				        if ($_EventState == $abbr) { 
				          print ('selected="selected" '); 
				        }
				        print (">$fullname</option>\n");
				      }
				      ?>
				</select>
			</td>
		</tr>
		<tr>
			<td><?php _e('Postal Code:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' id='EventZip' name='EventZip' size='6' value='<?php echo $_EventZip; ?>' /></td>
		</tr>
		<tr id="google_map_link_toggle"<?php if( !tec_address_exists( $postId ) ) echo ' class="tec_hide"'; ?>>
			<td><?php _e('Show Google Map Link:',$this->pluginDomain); ?></td>
			<td>
				<input tabindex="<?php $this->tabIndex(); ?>" type="checkbox" id="EventShowMapLink" name="EventShowMapLink" size="6" value="true" <?php if( get_post_meta( $postId, '_EventShowMapLink', true ) == 'true' ) echo 'checked="checked"'?> />
			</td>
		</tr>
		<?php if( eventsGetOptionValue('embedGoogleMaps') == 'on' ) : ?>
			<tr id="google_map_toggle"<?php if( !tec_address_exists( $postId ) ) echo ' class="tec_hide"'; ?>>
				<td><?php _e('Show Google Map:',$this->pluginDomain); ?></td>
				<td><input tabindex="<?php $this->tabIndex(); ?>" type="checkbox" id="EventShowMap" name="EventShowMap" size="6" value="true" <?php if( get_post_meta( $postId, '_EventShowMap', true ) == 'true' ) echo 'checked="checked"'; ?> /></td>
			</tr>
		<?php endif; ?>
		<tr>
			<td><?php _e('Phone:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' id='EventPhone' name='EventPhone' size='14' value='<?php echo $_EventPhone; ?>' /></td>
		</tr>
        <tr>
			<td colspan="2" class="snp_sectionheader"><h4><?php _e('Event Cost', $this->pluginDomain); ?></h4></td>
		</tr>
		<tr>
			<td><?php _e('Cost:',$this->pluginDomain); ?></td>
			<td><input tabindex="<?php $this->tabIndex(); ?>" type='text' id='EventCost' name='EventCost' size='6' value='<?php echo $_EventCost; ?>' /></td>
		</tr>
		<tr>
			<td></td>
			<td><small>Leave blank to hide the field. Enter a 0 for events that are free.</small></td>
		</tr>
	</table>
	</div>
	<?php
	try {
		do_action( 'sp_events_above_donate', $postId );
		if( !$this->postExceptionThrown ) delete_post_meta( $postId, self::EVENTSERROROPT );
	} catch ( TEC_Post_Exception $e) {
		$this->postExceptionThrown = true;
		update_post_meta( $postId, self::EVENTSERROROPT, trim( $e->getMessage() ) );
		$e->displayMessage( $postId );
	}	
	?>
	<div id="mainDonateRow" class="eventForm">
			<?php _e('<h4>If You Like This Plugin - Help Support It</h4><p>We spend a lot of time and effort building robust plugins and we love to share them with the community. If you use this plugin consider making a donation to help support its\' continued development. You may remove this message on the <a href="/wp-admin/options-general.php?page=the-events-calendar.php">settings page</a>.</p>', $this->pluginDomain); ?>
				<div id="snp_thanks">
					<?php _e('Thanks', $this->pluginDomain); ?><br/>
					<h5 class="snp_brand">Shane &amp; Peter</h5>
					<a href="http://www.shaneandpeter.com?source=events-plugin" target="_blank">www.shaneandpeter.com</a>		
				</div>
				<div id="snp_donate">
					<a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=10750983&item_name=Events%20Post%20Editor" target="_blank">
						<image src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" alt="" />
					</a>
				</div>
		<div style="clear:both;"></div>
	</div><!-- end mainDonateRow -->
	<style>
	#eventDetails h4,
		#EventBriteDetailDiv h4 {
		text-transform: uppercase;
		border-bottom: 1px solid #e5e5e5;
		padding-bottom: 6px;
	}
	.eventForm td {
		padding-bottom: 10px !important;
		padding-top: 0 !important;
	}
	.eventForm .snp_sectionheader {
		padding-bottom: 5px !important;
	}
	#snp_thanks {
		float: left;
		width: 200px;
		margin: 5px 0 0 0;
	}
	.snp_brand {
		font-weight: normal;
		margin: 8px 0;
		font-family: Georgia !important;
		font-size: 17px !important;
	}
	.eventForm p {
		margin: 0 0 10px 0!important;
	}
	#eventDetails small,
		#EventBriteDetailDiv small {
		color: #a3a3a3;
		font-size: 10px;
	}
	#eventBriteTicketing,
		#mainDonateRow {
		background: url(<?php echo WP_PLUGIN_URL . '/the-events-calendar/resources/images/bg_fade.png';
		?>) repeat-x top left;
		background-color: #fff;
		padding: 10px 15px;
		border: 1px solid #e2e2e2;
		-moz-border-radius: 3px;
		-khtml-border-radius: 3px;
		-webkit-border-radius: 3px;
		-moz-border-radius-topleft: 0;
		-moz-border-radius-topright: 0;
		-webkit-border-top-left-radius: 0;
		-webkit-border-top-right-radius: 0;
		border-radius: 3px;
		margin: -11px 6px 0;
	}
	#eventBriteTicketing h2 {
		background: url(<?php echo WP_PLUGIN_URL . '/the-events-calendar/resources/images/eb_press_little.gif';
		?>) no-repeat top right;
		height: 80px;
		margin: 0;
	}
	.eventForm {
		margin-top: -20px;
	}
	#EventInfo,
		table.eventForm {
		width: 100%;
	}
	td.snp_message {
		padding-bottom: 10px !important;
	}
	</style>
	
<script type="text/javascript" charset="utf-8">
	$(function(){
		// Register event handler for the event toggle
		$("input[name='isEvent']").click(function(){ 
			if ( $(this).val() == 'yes' ) {
				$("#eventDetails").slideDown('fast');
				$("#eventBriteTicketing").slideDown('fast');
			} else {
				$("#eventDetails").slideUp('fast');
				$("#eventBriteTicketing").slideUp('fast');
			}
		});
		// toggle time input
		$('#allDayCheckbox').click(function(){
			$(".timeofdayoptions").toggle();
			$("#EventTimeFormatDiv").toggle();
		});
		if( $('#allDayCheckbox').is(":checked") == true ) {
			$(".timeofdayoptions").css("display", "none");
			$("#EventTimeFormatDiv").css("display", "none");
		}
		// Set the initial state of the event detail and EB ticketing div
		$("input[name='isEvent']").each(function(){
			if( $(this).val() == 'no' && $(this).is(":checked") == true ) {
				$('#eventDetails, #eventBriteTicketing').hide();
			} else if( $(this).val() == 'yes' && $(this).is(":checked") == true ) {
				$('#eventDetails, #eventBriteTicketing').show();
			}
		});
		
		//show state/province input based on first option in countries list, or based on user input of country
		function spShowHideCorrectStateProvinceInput(country) {
			if (country == 'US') {
				$("#USA").css("visibility", "visible");
				$("#International").css("display", "none");
				$('input[name="EventStateExists"]').val(1);
			} else if ( country != '' ) {
				$("#International").css("visibility", "visible");
				$("#USA").css("display", "none");
				$('input[name="EventStateExists"]').val(0);			
			} else {
				$("#International").css("display", "none");
				$("#USA").css("display", "none");
				$('input[name="EventStateExists"]').val(0);
			}
		}
		
		spShowHideCorrectStateProvinceInput( $("#EventCountry > option:selected").attr('label') );
		
		$("#EventCountry").change(function() {
			var countryLabel = $(this).find('option:selected').attr('label');
			$('input[name="EventCountryLabel"]').val(countryLabel);
			spShowHideCorrectStateProvinceInput( countryLabel );
		});
		
		var spDaysPerMonth = [29,31,28,31,30,31,30,31,31,30,31,30,31];
		
		// start and end date select sections
		var spStartDays = [ $('#28StartDays'), $('#29StartDays'), $('#30StartDays'), $('#31StartDays') ];
		var spEndDays = [ $('#28EndDays'), $('#29EndDays'), $('#30EndDays'), $('#31EndDays') ];
				
		$("select[name='EventStartMonth'], select[name='EventEndMonth']").change(function() {
			var t = $(this);
			var startEnd = t.attr("name");
			// get changed select field
			if( startEnd == 'EventStartMonth' ) startEnd = 'Start';
			else startEnd = 'End';
			// show/hide date lists according to month
			var chosenMonth = t.attr("value");
			if( chosenMonth.charAt(0) == '0' ) chosenMonth = chosenMonth.replace('0', '');
			// leap year
			var remainder = $("select[name='Event" + startEnd + "Year']").attr("value") % 4;
			if( chosenMonth == 2 && remainder == 0 ) chosenMonth = 0;
			// preserve selected option
			var currentDateField = $("select[name='Event" + startEnd + "Day']");

			$('.event' + startEnd + 'DateField').remove();
			if( startEnd == "Start") {
				var selectObject = spStartDays[ spDaysPerMonth[ chosenMonth ] - 28 ];
				selectObject.val( currentDateField.val() );
				$("select[name='EventStartMonth']").after( selectObject );
			} else {
				var selectObject = spEndDays[ spDaysPerMonth[ chosenMonth ] - 28 ];
				selectObject.val( currentDateField.val() );
				$('select[name="EventEndMonth"]').after( selectObject );
			}
		});
		
		$("select[name='EventStartMonth'], select[name='EventEndMonth']").change();
		
		$("select[name='EventStartYear']").change(function() {
			$("select[name='EventStartMonth']").change();
		});
		
		$("select[name='EventEndYear']").change(function() {
			$("select[name='EventEndMonth']").change();
		});
		// hide / show google map toggles
		var tecAddressExists = false;
		var tecAddressInputs = ["EventAddress","EventCity","EventZip"];
		function tecShowHideGoogleMapToggles() {
			var selectValExists = false;
			var inputValExists = false;
				if($('input[name="EventCountryLabel"]').val()) selectValExists = true;
				$.each( tecAddressInputs, function(key, val) {
					if( $('input[name="' + val + '"]').val() ) {
						inputValExists = true;
						return false;
					}
				});
			if( selectValExists || inputValExists ) $('tr#google_map_link_toggle,tr#google_map_toggle').removeClass('tec_hide');
			else $('tr#google_map_link_toggle,tr#google_map_toggle').addClass('tec_hide');
		}
		$.each( tecAddressInputs, function(key, val) {
			$('input[name="' + val + '"]').bind('keyup', function(event) {
				var textLength = event.currentTarget.textLength;
				if(textLength == 0) tecShowHideGoogleMapToggles();
				else if(textLength == 1) tecShowHideGoogleMapToggles();
			});
		});
		$('select[name="EventCountry"]').bind('change', function(event) {
			if(event.currentTarget.selectedIndex) tecShowHideGoogleMapToggles();
			else tecShowHideGoogleMapToggles();
		});
		tecShowHideGoogleMapToggles();
		// Form validation
		$("form[name='post']").submit(function() {
			if( $("#isEventNo").is(":checked") == true ) {
				// do not validate since this is not an event
				return true;
			}
			var event_phone = $('#EventPhone');
			
			if( event_phone.length > 0 && event_phone.val().length && !event_phone.val().match(/^((\+\d{1,3}(-| )?\(?\d\)?(-| )?\d{1,5})|(\(?\d{2,6}\)?))(-| )?(\d{3,4})(-| )?(\d{4})(( x| ext)\d{1,5}){0,1}$/) ) {
				event_phone.focus();
				alert("<?php _e('Phone',$this->pluginDomain); ?> <?php _e('is not valid.', $this->pluginDomain); ?>  <?php _e('Valid values are local format (eg. 02 1234 5678 or 123 123 4567) or international format (eg. +61 (0) 2 1234 5678 or +1 123 123 4567).  You may also use an optional extension of up to five digits prefixed by x or ext (eg. 123 123 4567 x89)'); ?> ");
				return false;
			}
			return true;
		});
				
	});
</script>


<?php
try {
	do_action( 'sp_events_details_bottom', $postId );
	if( !$this->postExceptionThrown ) delete_post_meta( $postId, self::EVENTSERROROPT );
} catch ( TEC_Post_Exception $e) {
	$this->postExceptionThrown = true;
	update_post_meta( $postId, self::EVENTSERROROPT, trim( $e->getMessage() ) );
	$e->displayMessage( $postId );
}
?>
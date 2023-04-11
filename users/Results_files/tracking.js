var trackingApp = {};

trackingApp.defaultHistoryRows = 3; //Edit this if you'd like to show more history rows by default
trackingApp.mobileWidth = 768;

//Redelivery Calendar variables
trackingApp.holidayArray = null;
trackingApp.cantUseArray = {};


//9/2019 - Struts CTX no longer works properly, since its old struts code.

//NEW ToolsRestServices LoggedInCheck

$(document).ready(function(){
	
 $.ajax({
     url: "/UspsToolsRestServices/rest/security/loginCheck",
     type: "GET",
     async: false,
     cache: false,
     headers: {
         "Content-Type": "application/json;charset=utf-8"
     },
     dataType: "json",
     success: function (resp) {       	
     	isUserLoggedIn = resp.loggedIn;
     }
     
 });
	
	
});

/** Function Hooks for USPS backend team **/

//Show the tracking results content container
trackingApp.showTrackingResults = function() {
	$('#tracked-numbers').slideDown('slow');
};

//Hide the tracking results content container
trackingApp.hideTrackingResults = function() {
	$('#tracked-numbers').slideUp('slow');
};

//Expand tracking result content
trackingApp.expandTrackingResult = function(link) {
	$(link).parent().find('.product_additional_information').slideDown('slow');
};

//Collapse tracking result content
trackingApp.collapseTrackingResult = function(link) {
	$(link).parent().find('.product_additional_information').slideUp('slow');
	$(link).html('See More <i class="icon-carat_down"></i>');
	$('html, body').animate({
		scrollTop: $(link).closest('.track-bar-container').offset().top
	}, 'slow');
};

//Expand tracking result content
trackingApp.expandTrackingResult = function(link) {
	$(link).parent().find('.product_additional_information').slideDown('slow');
	$(link).html('See Less <i class="icon-carat_up"></i>');
};

//Remove item from tracking list
trackingApp.removeTrackedItem = function(item) {
	$(item).parents('.track-bar-container').fadeOut('slow', function() {
		$(item).parents('.track-bar-container').remove();
	});
};

//Collapse Tracking History Rows
trackingApp.collapseTrackingHistory = function(link) {
	$(link).parent().parent().find('table tr:nth-child(n+' + trackingApp.defaultHistoryRows + ')').hide();
	$(link).html('See More <i class="icon-carat_down"></i>');
	$('html, body').animate({
		scrollTop: $(link).closest('.tracking_history_container').offset().top
	}, 'slow');
};

//Expand Tracking History Rows
trackingApp.expandTrackingHistory = function(link) {
	$(link).parent().parent().find('table tr').not('.row_notification').show();
	$(link).html('See Less <i class="icon-carat_up"></i>');
};

//Add another email address (proof of delivery)
trackingApp.addProofEmailBlock = function(link) {

	var linkId= $(link).attr("id").split("_")[1],
	    podDivObj = $("#proofOfDeliveryPanel_"+linkId),
	    emailInputList = $(podDivObj.selector +" .podEmailInput"),
	    proofOfDeliveryEmailNumber = emailInputList.length;
	
	proofOfDeliveryEmailNumber++;
	if (proofOfDeliveryEmailNumber > 3) {
		$(link).hide();
	} else {
		var another_email_row = '<div class="form-group"><label for="proofOfDelivery_email' + proofOfDeliveryEmailNumber + '_'+ linkId + '">Email Address</label><input type="email" class="form-control podEmailInput" id="proofOfDelivery_email' + proofOfDeliveryEmailNumber + '_'+ linkId + '" name="tEmail'+ proofOfDeliveryEmailNumber +'" placeholder="email123@mail.com" pattern="^([a-zA-Z0-9_\\-\\.]+)@([a-zA-Z0-9_\\-\\.]+)\.([a-zA-Z]{2,5})$" data-pattern-error="Please enter a valid e-mail address" data-required-error="Please enter your e-mail address"><div class="help-block with-errors"></div></div>';
		$(link).before(another_email_row);
		$('#proofOfDelivery_email' + proofOfDeliveryEmailNumber + '_'+ linkId).focus();
		$("#proofOfDelivery_"+linkId).validator('update');
		if (proofOfDeliveryEmailNumber === 3) {
			$(link).hide();
		}
	}
};
//Add another email address (return receipt email)
trackingApp.addReturnReceiptEmailBlock = function(link) {
	
	var linkId= $(link).attr("id").split("_")[1],
	    rreDivObj = $("#returnReceipt_"+linkId),
	    emailInputList = $(rreDivObj.selector +" .rreEmailInput"),
	    returnReceiptEmailNumber = emailInputList.length;

	returnReceiptEmailNumber++;
	if (returnReceiptEmailNumber > 3) {
		$(link).hide();
	} else {
		var another_email_row = '<div class="form-group"><label for="returnReceiptEmail_email' + returnReceiptEmailNumber + '_'+ linkId + '">Email Address</label><input type="email" class="form-control rreEmailInput" id="returnReceiptEmail_email' + returnReceiptEmailNumber + '_'+ linkId + '" name="tEmail'+ returnReceiptEmailNumber +'" placeholder="email123@mail.com" pattern="^([a-zA-Z0-9_\\-\\.]+)@([a-zA-Z0-9_\\-\\.]+)\.([a-zA-Z]{2,5})$" data-pattern-error="Please enter a valid e-mail address" data-required-error="Please enter your e-mail address"><div class="help-block with-errors"></div></div>';
		$(link).before(another_email_row);
		$('#returnReceiptEmail_email' + returnReceiptEmailNumber + '_'+ linkId).focus();
		$("#returnReceiptEmail_"+linkId).validator('update');
		if (returnReceiptEmailNumber === 3) {
			$(link).hide();
		}
	}
};
//Add another email address (Email updates)
trackingApp.addEmailUpdateEmailBlock = function(link) {
	
	var linkId= $(link).attr("id").split("_")[1],
	    euDivObj = $("#textAndEmailUpdatesPanel_"+linkId),
	    emailInputList = $(euDivObj.selector +" .euEmailInput"),
	    emailUpdatesEmailNumber = emailInputList.length;

	emailUpdatesEmailNumber++;
	if (emailUpdatesEmailNumber > 3) {
		$(link).hide();
	} else {
		var another_email_row = '<div class="form-group"><label for="emailUpdate_name' + emailUpdatesEmailNumber + '_'+ linkId + '">Name</label>'+
			  					'<input type="text" class="form-control" id="emailUpdate_name' + emailUpdatesEmailNumber + '_'+ linkId + '" name="name'+ emailUpdatesEmailNumber +'" placeholder="First Last" pattern="^[\\w\\-_&.,`#@!\\s]+$" data-pattern-error="Please enter a valid name" data-required-error="Please enter your name"><div class="help-block with-errors"></div></div>'+
			  					'<div class="form-group"><label>Email Address</label><input type="email" id="emailUpdate_email' + emailUpdatesEmailNumber + '_'+ linkId + '" name="email'+ emailUpdatesEmailNumber +'" class="form-control euEmailInput" pattern="^([a-zA-Z0-9_\\-\\.]+)@([a-zA-Z0-9_\\-\\.]+)\.([a-zA-Z]{2,5})$" data-pattern-error="Please enter a valid e-mail address" data-required-error="Please enter your e-mail address" placeholder="email123@mail.com"><div class="help-block with-errors"></div></div>';
		$(link).before(another_email_row);
		$('#emailUpdate_name' + emailUpdatesEmailNumber + '_'+ linkId).focus();
		$("#textAndEmailUpdate_"+linkId).validator('update');
		if (emailUpdatesEmailNumber === 3) {
			$(link).hide();
		}
	}
};

/** Utility Functions **/
trackingApp.getQueryStringParam = function(param) {
	var query = window.location.search.substring(1);
	var vars = query.split('&');
	for (var i = 0; i < vars.length; i++) {
		var pair = vars[i].split('=');
		if (decodeURIComponent(pair[0]) == param) {
			return decodeURIComponent(pair[1]);
		}
	}
};


/** Delivery Form Continue Btn **/
trackingApp.initDeliveryInstructions = function(id) {
	
	if(isUserLoggedIn) {
		trackingApp.submitDeliveryInstructions($("#delivery-instructions_"+id), id);
	}else{
		$("#diButton_"+id).text("Sign In");
	}
	
	trackingApp.radioFormShowHideListener(id);
	
	$('#delivery-instructions_'+id +' .continue-delivery').on('click', function(e) {
		e.preventDefault();
		
		if($(this).text() === 'Sign In') {
			window.location = trackSigninUrl;
		}else{
			var formIdSplit = this.id.split("_")[1];
			var diDivObj = $("#delivery-instructions_"+formIdSplit);
			trackingApp.submitDeliveryInstructions(diDivObj, formIdSplit);
		}
	});
	
	//Show/Hide Other textarea for Delivery Location
	$(' #changeDeliveryInstructions_location_'+id).on('change', function() {
		var formIdSplit = this.id.split("_")[2];
		if ($(this).val() === 'Other') {
			$('#changeDeliveryInstructions_location_other_'+formIdSplit).closest('.row').show();
		} else {
			$('#changeDeliveryInstructions_location_other_'+formIdSplit).closest('.row').hide();
		}
		$('#changeDeliveryInstructions_'+formIdSplit).validator('update');
	});
	
	$('#delivery-instructions_'+id +' .change-options-btn').on('click', function(e) {
		e.preventDefault();
		var formIdSplit = this.id.split("_")[1];
		$('#delivery-instructions_'+formIdSplit +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
		$('#delivery-instructions_'+formIdSplit +" .panel-actions-content.delivery-instructions-content.error").addClass("hidden");
		$('#delivery-instructions_'+formIdSplit +' .change-delivery-module.step-4').hide();
		$('#delivery-instructions_'+formIdSplit +' .change-delivery-module.step-3').show();
		$('#delivery-instructions_'+formIdSplit +' .main-continue-btn').show();
	});
	
	//Toggle more insurance options
	$('#delivery-instructions_'+id +' .insurance_checkbox').on('change', function() {
		var formIdSplit = this.id.split("_")[1];
		var diDivObj = $("#delivery-instructions_"+formIdSplit);
		var insuranceError = $(diDivObj.selector +" .insurance-response-error"),
			insuranceUpgradeContainer = $(diDivObj.selector +" .more_insurance"),
			insuranceCostField = $(diDivObj.selector +" .insuranceCostField");
		
		insuranceError.html("");
    	insuranceError.hide();
    	
    	if($(this).not(":checked")) {
    		$(insuranceUpgradeContainer.selector +' .insuranceUpgradeResult').hide();
    		$(insuranceUpgradeContainer.selector +' input[name="tInsuranceUpgrade"]').val("");
    		insuranceCostField.val("0");
    		trackingApp.DI_updateTotal(diDivObj);
    	}
		$('#delivery-instructions_'+formIdSplit +' .more_insurance').toggle();
	});
	
    $('#delivery-instructions_'+id +' .calculatePrice').on('click', function(e) {
		e.preventDefault();
		var formIdSplit = this.id.split("_")[1];
		var diDivObj = $("#delivery-instructions_"+formIdSplit);
	    var	diForm = $(diDivObj.selector +' .actions_form'),
	    	label = $(diForm.selector +' input[name="label"]').val();
		var errors = trackingApp.DI_handleInsuranceErrors(diDivObj),
			insuranceError = $(diDivObj.selector +" .insurance-response-error"),
			insuranceUpgradeResult = $(diDivObj.selector +" .insuranceUpgradeResult"),
			insuranceCostField = $(diDivObj.selector +" .insuranceCostField"),
			insuranceValueContainer = $(diDivObj.selector +" .insuranceValueContainer"),
			additionalInsurance = $(diDivObj.selector +" .additionalInsurance"),
			insuranceCost = $(diDivObj.selector +" .insuranceCost");

		i = 0, l = errors.length;
        if (l > 0) {
            var li = '';
            for (; i < l; i++) {
                li += errors[i];
            }
            insuranceError.html(li);
            insuranceError.show();
            insuranceUpgradeResult.hide();
            insuranceError.focus();
            insuranceCostField.val("0");
            trackingApp.DI_updateTotal(diDivObj);
        } else {
        	insuranceError.html("");
        	insuranceError.hide();
        	
		    var stepModule = $(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4]');
		    var stepData = $(stepModule.selector + ' input').serialize();

		    var data = "easrFunc=CalInsurance" + "&";
	    		data += "label=" + label + "&";
	    		data += stepData;
		    
		   	$.ajax({
		   		url: "/go/TrackConfirmEasrAJAXAction.action",
		   		type: 	"POST",
		   		dataType: "json",
		   		data: data,
		   		success: function(resp) {
		   			if(resp.status === true) {
		   				if (insuranceValueContainer.css('display') == 'none') {
		   					additionalInsurance.html("$" + resp.formatInsuranceUpgrade + " Insurance");
		   				}else {
		   					additionalInsurance.html("$" + resp.formatInsuranceUpgrade + " Additional Insurance");
		   				}
		   				insuranceCost.html("$"+ resp.insuranceCost);
		   				insuranceCostField.val(resp.insuranceCost);
		   				insuranceUpgradeResult.show();
		   				insuranceUpgradeResult.focus();
		   			} else {
		   	            insuranceUpgradeResult.hide();
		   	            insuranceError.html(resp.errorScenario);
		   	            insuranceError.show();
		   	            insuranceCostField.val("0");
		   	            insuranceError.focus();
		   			}
	   	            trackingApp.DI_updateTotal(diDivObj);
		   		},
		   		error: function(jqXHR, exception) {
	   	            insuranceUpgradeResult.hide();
	   	            insuranceError.html("We were unable to calculate price at this time. Please try again later.");
	   	            insuranceError.show();
	   	            insuranceCostField.val("0");
	   	            insuranceError.focus();
		   		}
		   	});
        }
	});
    
	$('#delivery-instructions_'+id +' .add-to-cart').on('click', function(e) {

		e.preventDefault();
		var formIdSplit = this.id.split("_")[1];
		var diDivObj = $("#delivery-instructions_"+formIdSplit);
		var cUpdateInsurance = $(diDivObj.selector +" .insurance_checkbox");
		
        if(cUpdateInsurance.is(":checked")) {
            var errors = trackingApp.DI_handleInsuranceErrors(diDivObj),
	            i = 0, l = errors.length,
	            insuranceError = $(diDivObj.selector +" .insurance-response-error"),
	            insuranceUpgradeResult = $(diDivObj.selector +" .insuranceUpgradeResult"),
				insuranceCostField = $(diDivObj.selector +" .insuranceCostField");
            if (l > 0) {
                var li = '';
                for (; i < l; i++) {
                    li += errors[i];
                }
                insuranceError.html(li);
                insuranceError.show();
                insuranceUpgradeResult.hide();
                insuranceError.focus();
                insuranceCostField.val("0");
                trackingApp.DI_updateTotal(diDivObj);                
            } else {
            	insuranceError.html("");
                insuranceError.hide();
                trackingApp.DI_submitAddCart(diDivObj, this);
            }
        }else{
        	trackingApp.DI_submitAddCart(diDivObj, this);
        }
	});
	
	//zip code lookup results
	$('#delivery-instructions_'+id +' .zip-code-lookup-results').hide();
	$('#delivery-instructions_'+id +' .btn-zip-code-search').on('click', function(e) {
		
		e.preventDefault();
		var formIdSplit = this.id.split("_")[1];
		var diDivObj = $("#delivery-instructions_"+formIdSplit);
		var zipSearchError = $(diDivObj.selector +" .zip-search-response-error");
		var zipSearchResult = $(diDivObj.selector +" .zip-code-lookup-results");
		
		var hasErrors = $('#changeDeliveryInstructions_'+formIdSplit).validator('validate').find('.radio-option-4-content').has('.has-error').length;
		if (!hasErrors) {
			zipSearchError.html("");
			zipSearchError.hide();
			
		    var diForm = $(diDivObj.selector +' .actions_form'),
		    	tHfpZip = $(diForm.selector + ' input[name="tHfpZip"]').val(),
		    	label = $(diForm.selector +' input[name="label"]').val();

		    var data = "easrFunc=PoSearch" + "&";
			    data += "label=" + label + "&";
				data += "deliveryOption=4" + "&";		    
	    		data += "tHfpZip=" + tHfpZip;
		    
		   	$.ajax({
		   		url: "/go/TrackConfirmEasrAJAXAction.action",
		   		type: 	"POST",
		   		dataType: "json",
		   		data: data,
		   		success: function(resp) {
		   			if(resp.status === true) {
		   		    	var count = resp.hfplist.length;
		   		    	if(count < 1) {
			   				zipSearchError.html("There were no locations found for the provided ZIP Code&trade;.");
			   				zipSearchError.show();
			   				zipSearchResult.hide();
		   		    	}else{
		   		    		zipSearchResult.show();
		   		    		var locationWefound = $(diDivObj.selector +' .zip-code-result-list');
		   			    	var html = [];

		   			    	$.each(resp.hfplist, function(index, location) {
	   			    			var cls = '';
	   			    			var locationID = location.locationID;
	   			    			var locationName = location.locationName;
	   			    			var address1 = location.address1;
	   							var city = location.city;
	   							var state = location.state;
	   							var zip5 = location.zip5;
	   							var zip4 = location.zip4;
	   			    			if( index == (count-1) ){
	   								cls = 'last';
	   							}
	   			    			html.push('<div class="address-item radio actions_subsection '+cls+'">');
	   			    			html.push('<label>');
	   			    			html.push('<input type="radio" required name="radio-option-zip-change" value="'+locationID+'"/>');
	   			    			html.push('<strong><span class="facName">'+ locationName+'</span></strong><span class="facAddress">'+ address1+'</span><br>');
	   			    			html.push('<span class="facCity">'+ city + '</span>, <span class="facState">'+ state + '</span> <span class="facZip5">'+ zip5 + '</span>');
		    					if( zip4 ){
	   								html.push('-<span class="facZip4">'+ zip4 + '</span>');
	   							}		
	   			    			html.push('</label>');
	   							html.push('</div>');
		   			    	});
		   			    	locationWefound.html(html.join(''));
		   		    	}
		   			} else {
		   				zipSearchError.html(resp.errorScenario);
		   				zipSearchError.show();
		   				zipSearchError.focus();
		   				zipSearchResult.hide();
		   			}
		   		},
		   		error: function(jqXHR, exception) {
	   				zipSearchError.html("We were unable to calculate price at this time. Please try again later.");
	   				zipSearchError.show();
	   				zipSearchResult.hide();
		   		}
		   	});
			
		}else{
			zipSearchResult.hide();
		}
	});
	
};

trackingApp.changeDeliveryNextStep = function(diDivObj, on_Step, deliveryOption) {
	
	// Move to the next Step in 'Change your delivery'; This cycles through the change delivery actions...
	$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + on_Step + ']').hide();
	$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + (on_Step + 1) + ']').show();
	$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + (on_Step + 1) + '] :input:visible:enabled:first').focus();

	if (on_Step == 3) {
		$(diDivObj.selector +' .main-continue-btn').hide();
	} else {
		$(diDivObj.selector +' .main-continue-btn').show();
	}

	if (window.innerWidth < trackingApp.mobileWidth) {
		$('html, body').animate({
			scrollTop: $(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + (on_Step + 1) + ']').offset().top
		}, 'slow');
	}

	if (on_Step > 3) {
		on_Step = -1;
	}
	on_Step++;

	if (on_Step > 0) {
		$(diDivObj.selector +' .main-continue-btn').text("Continue");
	} else {
		$(diDivObj.selector +' .main-continue-btn').text("Sign In");
	}

	if(on_Step === 4) {
		
		if(deliveryOption === "3") {
			$(diDivObj.selector +' .change-delivery-module.step-4 .change-options-content').show();
			$(diDivObj.selector +' .change-delivery-module.step-4 .confirm_text').hide();
		}else if(deliveryOption === "4") {
			$(diDivObj.selector +' .change-delivery-module.step-4 .change-options-content').hide();
			$(diDivObj.selector +' .change-delivery-module.step-4 .confirm_text').show();
			$(diDivObj.selector +' .change-delivery-module[data-deliverymodule="4"]').find('.hint').focus();
		}
	}

	$(diDivObj.selector +' .actions_form').validator('update');

};


/** Radio Buttons on third Step of change delivery  **/
trackingApp.radioFormShowHideListener = function(id) {

	var diDivObj = $("#delivery-instructions_"+id);
	var changeRadioButtons = $(diDivObj.selector +' .delivery-change-option');

	var changeRadioContents = $(diDivObj.selector +' .delivery-change-radio-content');
	changeRadioContents.hide();
	
	$(diDivObj.selector +' .radio-option-1').prop('checked', true);
	$(diDivObj.selector +' .delivery-change-radio-content[data-radioContent="1"]').show();
	
	var diDivObj = $("#delivery-instructions_"+id);
	$(diDivObj.selector +" input[name='deliveryOption']").val("1");
	
	changeRadioButtons.change(function(e) {
		trackingApp.updateValidators();

		var datanumber = $(this).data().radiooption;
		$(diDivObj.selector +" input[name='deliveryOption']").val(datanumber);

		changeRadioContents.each(function(i, contentBlock) {
			if (datanumber == $(contentBlock).data().radiocontent) {
				$(contentBlock).show();

				if (window.innerWidth < trackingApp.mobileWidth) {
					$('html, body').animate({
						scrollTop: $(contentBlock).parent().offset().top
					}, 'slow');
				}

			} else if (datanumber != $(contentBlock).data().radiocontent) {
				$(contentBlock).hide();
			}
		});
		$(diDivObj.selector +" .actions_form").validator('update');
		$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
		$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").addClass("hidden");
	});

};

trackingApp.updateValidators = function() {
	$(".proofOfDelivery").validator('update');
	$(".textAndEmailUpdate").validator('update');
	$('.changeDeliveryInstructions').validator('update');
	$('#trackPackage').validator('update');
	$('.scheduleRedelivery').validator('update');
	$('.returnReceiptEmail').validator('update');
	$(".trackPOD").validator('update');
};

/** Adjust textarea height **/
trackingApp.adjustHeight = function() {
	//console.log("adjustHeight");
	$('textarea').each(function () {
	  this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
	}).on('touchstart touchend input paste', function () {
	  this.style.height = 'auto';
	  this.style.height = (this.scrollHeight) + 'px';
	});
};

/** check keyboard state **/
trackingApp.checkKeyboardState = function() {
	//console.log("checkKeyboardState");
	if($(document.activeElement).attr('type') === "text"){
		//console.log("Keyboard visible");
		// hide keyboard
		document.activeElement.blur();
	}else{
		//console.log("Keyboard not visible");  
	}
};

/** submit form **/
/** Track labels **/
trackingApp.submitForm = function() {
	var tLabels = $('#tracking-input').val().replace(/ /g,'').split('\n')+',',
		tlCount = tLabels.split(',').length,
		tRef = $("input[id=tRef]").val();
		//console.log(tLabels);
	$("input[id=tLc]").val(tlCount);
	$("input[id=tLabels]").val(tLabels);/**/
	//console.log(tLabels + " Sent");
	$("#trackPackage").submit();
	//console.log(tLabels + " Submitted");
};



$(document).ready(function(e) {

	//Initialize form field masks
	if ($().mask) {
		$('.phone').mask('000-000-0000');
		$('.zipcode').mask('00000-0000');
	};
	
	// collapse all tracking history panels except first one
	var closedTwisty = '<a href="#" role="button" class="see-all show-less tracking-result-collapser">See More <i class="icon-carat_down"></i></a>';
	$('div.product_additional_information:not(:eq(0))').hide();
	$('div.product_additional_information:not(:eq(0))').parent().parent().next().replaceWith(closedTwisty);

	//Build the state select from the state array stored in data/data.js
	var stateSelect = $('select.state');
	//unless we don't want to
	if (typeof trackingData !== "undefined") {
		for (var i = 0, max = trackingData.states.length; i < max; i++) {
			stateSelect.append('<option value="' + trackingData.states[i].value + '">' + trackingData.states[i].label + '</option>');
		};
	}
	//Hide all but a few tracking history elements by default
	trackingApp.defaultHistoryRows += 3;
	$('.tracking_history tr:nth-child(n+' + trackingApp.defaultHistoryRows + ')').hide();

	/** Validate input for tracking when pasted **/
	$('#tracking-input').on('touchstart input paste blur', trackingApp.adjustHeight);

	/** Click Handlers for buttons **/

	/** Track labels **/
	// deferred object for tracking
	var deferred = $.Deferred();
	 
	// Add handlers to be called when deferred is resolved
	deferred.done(trackingApp.checkKeyboardState, trackingApp.adjustHeight, trackingApp.submitForm);
	  
	// Resolve the Deferred object when the button is clicked
	$(".tracking-btn").on( "click", function() {
		var hasErrors = $('#trackPackage').validator('validate').has('.has-error').length;
		if (!hasErrors) {
			deferred.resolve();
		}
	});
	
	//Show tracking results
	$('.tracking-btn').on('click', function(e) {
		// e.preventDefault();
		if ($('#tracked-numbers').css('display') === 'none') {
			trackingApp.showTrackingResults();
			trackingApp.updateValidators();
		} else {
			// trackingApp.hideTrackingResults();
		}
	});

	//Remove item from the list
	$('.remove-span').on('click', function(e) {
		e.preventDefault();
		// ID Cross Sell!
		
		if(trackingApp.isIDready == false)
		{
			trackingApp.clickedRemove = true;
			trackingApp.crossSellURLREF = trackingApp.crossSellURL.replace("CHANGEMEHERE","removeTrack");
			trackingApp.isIDready = true;
			idCrossSell();
			trackingApp.removeTrackedItem(this);
		}
		
		else
			{		
				trackingApp.removeTrackedItem(this);
			}
	});

	//Collapse/show the Tracking Result
    $('.tracking-result-collapser').on('click', function(e) {
        e.preventDefault();
        if ($(this).text().indexOf('More') !== -1) {
            trackingApp.expandTrackingResult(this);
            trackingApp.updateValidators();
        } else {
            trackingApp.collapseTrackingResult(this);

            //Show the hidden jump action button
            $(this).parent().find('.action_jump').show();
        }
    });

	//Collapse/show the Tracking History
	$('.tracking-history-collapser').on('click', function(e) {
		e.preventDefault();
		if ($(this).text().indexOf('More') !== -1) {
			trackingApp.expandTrackingHistory(this);
		} else {
			trackingApp.collapseTrackingHistory(this);
		}
	});

	//Scroll to Available Actions section
	$('.avail_actions').on('click', function(e) {
		e.preventDefault();
		var self = this;
		$('html, body').animate({
			scrollTop: $(self).parent().parent().find('.available-actions-menu-container').offset().top
		}, 'slow');
	});

	//Scroll to Schedule redelivery
	$('.delivery-attempted-notification a').on('click', function(e) {
		e.preventDefault();
		var self = this;
		$(self).closest('.track-bar-container').find('.schedule-redelivery-anchor .panel-collapse').collapse('show');
		$('html, body').animate({
			scrollTop: $(self).closest('.track-bar-container').find('.schedule-redelivery-anchor').offset().top
		}, 'slow');
	});

    //Scroll to action
    $('a.action_jump').on('click', function(e) {
        e.preventDefault();
        var anchor = $(this).attr('data-action');
        goToAnchor(anchor, this);
		trackingApp.updateValidators();
    });

    function goToAnchor(anchor, link) {
        if ($(link).closest('.track-bar-container').find('.tracking-result-collapser').text().lastIndexOf('More') !== -1) {
            $(link).closest('.track-bar-container').find('.tracking-result-collapser').click();
        }
        if ($(link).parent().attr("class") == "status_feed"){
            $(link).hide();
        } else {
        	 //do not hide 'get updates' link
        }

        var self = link;
        $(link).closest('.track-bar-container').find('.' + anchor + '-anchor .panel-collapse').collapse('show');
        $('html, body').animate({
            scrollTop: $(link).closest('.track-bar-container').find('.' + anchor + '-anchor').offset().top
        }, 'slow');
    };

	$('.collapser').on('click', function(e) {
		e.preventDefault();

		var collapse_element = $(this).next();

		collapse_element.collapse('toggle');

		trackingApp.updateValidators();


	});
	
	//
	$('.panel').on('shown.bs.collapse', function() {
		$(this).find('.down-arr, .up-arr').toggleClass("down-arr up-arr");
		$(this).find('.panel-word').toggleClass("red-underline");
	})

	$('.panel').on('hidden.bs.collapse', function() {
		$(this).find('.down-arr, .up-arr').toggleClass("down-arr up-arr");
		$(this).find('.panel-word').toggleClass("red-underline");
	})


	//Info tooltip
	$('.hint').on('click', function(e) {
		$('.speech_bubble').hide();

		var text = $(this).find('.speech_bubble');
		if (window.innerWidth < trackingApp.mobileWidth) {
			e.preventDefault();
			$('#modal .modal-body').html(text.html()).css('fontSize','14px');
			$('#modal').modal('show');
		} else {
			text.show();
		}
	});

	
	//Clear out the modal content on hide
	$('#modal').on('hidden.bs.modal', function(e) {
		$('#modal .modal-body').html('');
	});

	//Close tooltip when click off of the bubble
	$('body').on('click touchstart', function(e) {
		if ($(e.target).attr('class') && $(e.target).attr('class').indexOf('icon-tooltip') > -1) {
			return;
		} else {
			$('.speech_bubble').hide();
		}
	});

	//Toggle privacy read more link
	$('.readMore').on('click', function(e) {
		e.preventDefault();

		//If it is collapsed...
		if ($(this).hasClass('closed')) {
			$(this).parent().find('.collapsible').removeClass('collapsed');
			$(this).removeClass('closed');
			$(this).find('span').text('Read less');
		} else {
			$(this).parent().find('.collapsible').addClass('collapsed');
			$(this).addClass('closed');
			$(this).find('span').text('Read more');
		}
	});

	//Toggle the 'track another package'
	$('.track-another-package-close').hide();
	
	// Informed Delivery 2019 - Cross Sell Check
	trackingApp.isIDready = false;
	
	// Check Methods
	idXSCheck();
	idXSLoggedIn();
	
	$('.track-another-package-open').on('click', function() {

		$('#trackPackage').validator('update');
				$('.tracking-group').toggle();
				$('.tracking_form_container h3').toggleClass('open');
		trackingApp.updateValidators();

		if ($('.tracking-group').css('display') != 'none') {
			// check for setting
			$('.track-another-package-close').show();

		} else if ($('.tracking-group').css('display') == 'none') {
			$('.track-another-package-close').hide();
		}

	});
	
	
	$("#faqHeader").on('click', function(){
		
		$('#trackPackage').validator('update');

		if(trackingApp.isIDready == false)
			{
				trackingApp.isIDready = true;
				trackingApp.clickedFAQ = true;
				trackingApp.crossSellURLREF = trackingApp.crossSellURL.replace("CHANGEMEHERE","faqHeader");
				idCrossSell();
			}
		else
			{
				window.open("https://www.usps.com/faqs/uspstracking-faqs.htm", "_blank");
			}
		
	});
	$("#idxsFAQBtn").on('click', function(){
		
		$('#trackPackage').validator('update');

		if(trackingApp.isIDready == false)
			{
				trackingApp.isIDready = true;
				trackingApp.crossSellURLREF = trackingApp.crossSellURL.replace("CHANGEMEHERE","faqButton");
				trackingApp.clickedFAQ = true;
				idCrossSell();
			}
		else
			{
				window.open("https://www.usps.com/faqs/uspstracking-faqs.htm", "_blank");
			}
		
	});
	
	
	// Informed Delivery Cross Sell 2019
	// idxsSignedUp
	function idXSLoggedIn()
	{
	    jQuery.ajax({
	        url: "/UspsToolsRestServices/rest/idCrossSell/secure/idxsSignedUp",
	        type: "GET",
	        cache: false,
	        headers: {
	            "Content-Type": "application/json;charset=utf-8"
	        },
	        dataType: "json",
	        success: function (resp) {
	        	
	        	var idEnrolled = resp.IDEnrolled;
	        	
	        	var isLoggedInUser = resp.ValidLoginSession;
	        	trackingApp.isIDRegUser = isLoggedInUser;
	        	
	        	var isEligible = idEnrolled.IDAddressEligible;
	        	var hasBeenAsked = idEnrolled.IDHasBeenAsked;
	        	var accountType = resp.AccountType;
	        	var isAccountIDEleg = idEnrolled.IDEligible;
	        	var isUserInID = idEnrolled.IDGroup;
	        	
	        	if(isEligible == "false" || hasBeenAsked == "Y" || accountType == "BUSINESS" || isAccountIDEleg == "N" || isUserInID == "GRANT")
	        		{
	        			trackingApp.isIDready = true;
	        		}
	        },
	        error: function (jqXHR, exception) {
	        	console.log("ERROR: ID Cross Sell - Defaulting to OFF")
	        }
	    });
	}
	function idXSCheck()
	{
	    jQuery.ajax({
	        url: "/UspsToolsRestServices/rest/idCrossSell/getIDStatus",
	        type: "GET",
	        cache: false,
	        headers: {
	            "Content-Type": "application/json;charset=utf-8"
	        },
	        dataType: "json",
	        success: function (resp) {
	        	
	        	if(resp.status == "false"){
	        		
	        		trackingApp.isIDready = true;
	        	}
	        	else {
	        		trackingApp.isIDready = false;
	        	}
	        	
	        	let idAskSession = sessionStorage.getItem('idCrossSellAsk');
	        	
	        	if(idAskSession == "YES")
	        		{
	        			trackingApp.isIDready = true;
	        		}

	        	trackingApp.crossSellURL = resp.crossSellURL;
				trackingApp.crossSellURLREF = trackingApp.crossSellURL.replace("CHANGEMEHERE","homepageBanner");
				
				var bannerURL = trackingApp.crossSellURL.replace("CHANGEMEHERE","homepageBanner");
				$("#crossSellBanner").prop("href", bannerURL);
	        	
	        	
	        },
	        error: function (jqXHR, exception) {
	        	console.log("ERROR: ID Cross Sell - Defaulting to OFF");
	        	trackingApp.isIDready = true;
	        }
	    });
	}
	
	function updateIDXSRecord()
	{
		if(trackingApp.isIDRegUser)
			{
		    jQuery.ajax({
		        url: "/UspsToolsRestServices/rest/idCrossSell/updateIDStatus",
		        type: "GET",
		        cache: false,
		        headers: {
		            "Content-Type": "application/json;charset=utf-8"
		        },
		        dataType: "json",
		        success: function (resp) {
		        },
		        error: function (jqXHR, exception) {
		        }
		    });
			}
	}
	
	function idCrossSell() {
		
		dataLayer.push({ 
			  'event': 'application',
			  'application': {
			    'element': 'IDXS Prompt',
				'userAction': 'impression'
			  }
			});
		sessionStorage.setItem('idCrossSellAsk', 'YES');
    	$('#track-package-modal').modal('show');
		$('#track-package-modal').modal({backdrop: 'static', keyboard: false})
			
	}
	
	// Display modal sign-up message after selecting the "Yes" radio button. 
	$("input:radio[name='track-package-rb']").change(function() {
		if ($('#trackradio1').is(':checked')) {
			$('.signup-txt').show();
			$('.error-message').hide();
		} else if ($('#trackradio2').is(':checked')) {
			$('.signup-txt').hide();
			$('.error-message').hide();
		}
    });
	
	
	// Display error message in modal if none of the options have been selected.
	$('.submit-btn').click(function() {
		if ($("input[name='track-package-rb']:checked").val()) {
			$('#track-package-modal').modal('hide');
			
			if($('#trackradio1').is(':checked'))
				{
				dataLayer.push({ 
					  'event': 'application',
					  'application': {
					    'element': 'IDXS Prompt',
						'userAction': 'interaction',
					    'selectedCheckbox' : 'Yes'
					  }
					});

					window.open(trackingApp.crossSellURLREF, "_blank");
				}
			if($('#trackradio2').is(':checked'))
			{
				updateIDXSRecord();
			dataLayer.push({ 
				  'event': 'application',
				  'application': {
				    'element': 'IDXS Prompt',
					'userAction': 'interaction',
				    'selectedCheckbox' : 'No'
				  }
				});
			}
			if(trackingApp.clickedFAQ == true){
				window.open("https://www.usps.com/faqs/uspstracking-faqs.htm", "_self");
				trackingApp.clickedFAQ = false;
			}
			if(trackingApp.clickedClose == true)
				{

				$('.tracking-group').hide();
				$('.tracking_form_container h3').removeClass('open');
				if ($('.tracking-group').css('display') != 'none') {
					$('.track-another-package-close').show();
				} else if ($('.tracking-group').css('display') == 'none') {
					$('.track-another-package-close').hide();
				}
				trackingApp.clickedClose = false;
				}
			if(trackingApp.clickedRemove == true)
				{
				trackingApp.clickedRemove = false;
				}
		} else {
			$('.error-message').show();
		}
	});
	
	

	$('.track-another-package-close').on('click', function() {		
		if(trackingApp.isIDready == false)
		{
			trackingApp.clickedClose = true;
			trackingApp.crossSellURLREF = trackingApp.crossSellURL.replace("CHANGEMEHERE","trackClose");
			trackingApp.isIDready = true;
			idCrossSell();
		}
	else
		{
		$('.tracking-group').hide();
		$('.tracking_form_container h3').removeClass('open');
		if ($('.tracking-group').css('display') != 'none') {
			$('.track-another-package-close').show();
		} else if ($('.tracking-group').css('display') == 'none') {
			$('.track-another-package-close').hide();
		}
	}

	});

/** 
  * Available Actions: Change Delivery Instructions 
  */
trackingApp.submitDeliveryInstructions = function(diDivObj, formIdSplit) {
	
	
	if($(diDivObj.selector + ' .change-delivery-module').filter(':visible').length == 0) {
		trackingApp.changeDeliveryNextStep(diDivObj, 0, "");
	}else{
		var diForm = $(diDivObj.selector +' .actions_form');
		var on_Step = parseInt($(diDivObj.selector + ' .change-delivery-module').filter(':visible').data().deliverymodule);
    	var deliveryOption = "";
			if ($(diForm.selector +' .radio-option-1').is(":checked")){deliveryOption = "1";} else 
			if ($(diForm.selector +' .radio-option-2').is(":checked")){deliveryOption = "2";} else 
			if ($(diForm.selector +' .radio-option-3').is(":checked")){deliveryOption = "3";} else 
			if ($(diForm.selector +' .radio-option-4').is(":checked")){deliveryOption = "4";};

		var hasErrors = diForm.validator('validate').has('.has-error').length;
		var submitAjax = true;
		if(on_Step === 3) {
			hasErrors = $(diForm.selector +' .radio-option-'+deliveryOption+ '-content').has('.has-error').length;
		}

		if (!hasErrors) {
			if(on_Step === 0 || on_Step === 1) {
				trackingApp.changeDeliveryNextStep(diDivObj, on_Step, "");
			}else{
			    var label = $(diForm.selector +' input[name="label"]').val(),
					destinationZip = $(diForm.selector +' input[name="destinationZip"]').val(),
					tFwdCustomerFName = $(diForm.selector +' input[name="tFwdCustomerFName"]').val(),
					custRegZip5 = $(diForm.selector +' input[name="custRegZip5"]').val();
			    var data = "";
			    var stepModule = $(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + on_Step + ']');
			    var stepData = $(stepModule.selector + ' input, textarea, select').serialize();
			
			    if(on_Step === 2) {
			    	data = "easrFunc=Verify" + "&";
			    	data += "label=" + label + "&";
			    	data += "destinationZip=" + destinationZip + "&";
			    	data += stepData;
			    }else if(on_Step === 3) {
			    	if(deliveryOption === "4") {
			    		var holdAtPostOffice = $(diDivObj.selector +' .zip-code-lookup-results');
			    		var selectedLocation = $(holdAtPostOffice.selector +' input[name="radio-option-zip-change"]:checked');
			    		var zipSearchError = $(holdAtPostOffice.selector +" .zip-search-response-error");
			    		if(selectedLocation != null && selectedLocation != '' && selectedLocation != undefined && selectedLocation.length > 0){
			    			zipSearchError.html("");
			    			zipSearchError.hide();
			        		var p = selectedLocation.closest('div.address-item'),
			        			hfpFacilityId = selectedLocation.val(),
			        			hfpFacilityAddress = p.find(".facAddress").text(), 
			        			hfpFacilityCity = p.find(".facCity").text(),
			        			hfpFacilityState = p.find(".facState").text(),
			        			hfpFacilityZip5 = p.find(".facZip5").text(),
			        			hfpFacilityZip4 = p.find(".facZip4").text();
							   	
			        			data = "easrFunc=Dropoff" + "&";
							   	data += "label=" + label + "&";
							   	data += "custRegZip5=" + custRegZip5 + "&";
							   	data += "deliveryOption=" + deliveryOption + "&";
							   	data += "hfpFacilityId=" + hfpFacilityId + "&";
							   	data += "hfpFacilityAddress=" + hfpFacilityAddress + "&";
							   	data += "hfpFacilityCity=" + hfpFacilityCity + "&";
							   	data += "hfpFacilityState=" + hfpFacilityState + "&";
							   	data += "hfpFacilityZip5=" + hfpFacilityZip5 + "&";
							   	data += "hfpFacilityZip4=" + hfpFacilityZip4;
			            }else{
			            	submitAjax = false;
			        	}    		
			    	}else{
					   	 data = "easrFunc=Dropoff" + "&";
					   	 data += "label=" + label + "&";
					   	 data += "custRegZip5=" + custRegZip5 + "&";
					   	 data += "deliveryOption=" + deliveryOption + "&";
					   	 data += stepData;
			    	}
			    }
			    
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").addClass("hidden");
			    
			    if (submitAjax) {
			    	
			    	var buttonOrgText = $("#diButton_"+formIdSplit).text();
			    	$("#diButton_"+formIdSplit).prop("disabled", true);
			    	$("#diButton_"+formIdSplit).text("Processing");
			   	
				   	$.ajax({
				   		url: "/go/TrackConfirmEasrAJAXAction.action",
				   		type: 	"POST",
				   		dataType: "json",
				   		data: data,
				   		success: function(resp) {
				   			if(resp.status === true) {
				   				if(on_Step === 2) {
				   					$(diDivObj.selector +" .radio-option-2-content .city").html(resp.city);
				   					$(diDivObj.selector +" .radio-option-2-content .state").html(resp.state);
				   					$(diDivObj.selector +" .radio-option-2-content .zip").html(resp.zip);
				   					$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(resp.firstName);
				   					trackingApp.changeDeliveryNextStep(diDivObj, on_Step, deliveryOption);
				   				} else if(on_Step === 3) {
					   				if(deliveryOption === "1" || deliveryOption === "2"){
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=' + on_Step + ']').hide();
					   					$(diDivObj.selector +' .continue-delivery').parent().hide();
						   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").removeClass("hidden");
						   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").addClass("hidden");
										$(diDivObj.selector +" .panel-body.sample-number-panels").addClass("hidden"); // ALM 545
						   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success .firstName").html(resp.firstName);
					   				}else{
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressLineOne"]').val(resp.fwdAddressLineOne);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressLineTwo"]').val(resp.fwdAddressLineTwo);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressCity"]').val(resp.fwdAddressCity);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressState"]').val(resp.fwdAddressState);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressZip5"]').val(resp.fwdAddressZip5);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdAddressZip4"]').val(resp.fwdAddressZip4);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdCustomerFName"]').val(resp.fwdCustomerFName);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdCustomerMName"]').val(resp.fwdCustomerMName);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdCustomerLName"]').val(resp.fwdCustomerLName);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="tFwdCustomerCompany"]').val(resp.fwdCustomerCompany);
					   					$(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4] input[name="hfpFacilityId"]').val(resp.hfpFacilityId);
					   			        
					   					if(deliveryOption === "3") {
						   					$(diDivObj.selector +" .change-options-content .fwdAddressLineOne").html(resp.fwdAddressLineOne);
						   					$(diDivObj.selector +" .change-options-content .fwdAddressLineTwo").html(resp.fwdAddressLineTwo);
						   					$(diDivObj.selector +" .change-options-content .fwdAddressCity").html(resp.fwdAddressCity);
						   					$(diDivObj.selector +" .change-options-content .fwdAddressState").html(resp.fwdAddressState);
						   					$(diDivObj.selector +" .change-options-content .fwdAddressZip5").html(resp.fwdAddressZip5);
						   			        if(resp.fwdAddressZip4){
						   			        	$(diDivObj.selector +" .change-options-content .fwdAddressZip4").html('-'+resp.fwdAddressZip4);
						   					}
					   						trackingApp.DI_displayMailSelection(diDivObj, resp, deliveryOption);
					   					}else if(deliveryOption === "4") {
						   					$(diDivObj.selector +" .confirm_text .fwdAddressLineOne").html(resp.fwdAddressLineOne);
						   					$(diDivObj.selector +" .confirm_text .fwdAddressLineTwo").html(resp.fwdAddressLineTwo);
						   					$(diDivObj.selector +" .confirm_text .fwdAddressCity").html(resp.fwdAddressCity);
						   					$(diDivObj.selector +" .confirm_text .fwdAddressState").html(resp.fwdAddressState);
						   					$(diDivObj.selector +" .confirm_text .fwdAddressZip5").html(resp.fwdAddressZip5);
						   			        if(resp.fwdAddressZip4){
						   			        	$(diDivObj.selector +" .confirm_text .fwdAddressZip4").html('-'+resp.fwdAddressZip4);
						   					}
					   					}
						   				trackingApp.changeDeliveryNextStep(diDivObj, on_Step, deliveryOption);
					   				}
				   				}
				   			} else {
				   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").removeClass("hidden");
				   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
				   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(resp.firstName);
				   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .errorScenario").html(resp.errorScenario);
				   			}
				   		},
				   		error: function(jqXHR, exception) {
				   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").removeClass("hidden");
				   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
				   			//$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(tFwdCustomerFName);
				   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .errorScenario").html("the system is having technical difficulties");
				   		},
						complete: function(resp) {
							$("#diButton_"+formIdSplit).prop("disabled", false);
							$("#diButton_"+formIdSplit).text(buttonOrgText);
				        }
				   	});
			    }else{
		   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").removeClass("hidden");
		   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
		   			//$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(tFwdCustomerFName);
		   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .errorScenario").html("Post Office is not selected. Please select a Post Office.");
			    }
			}
		}		
	}
	

};

trackingApp.DI_displayMailSelection = function(diDivObj, resp, deliveryOption) {

	var html_upsellServiceType = [],
		tServiceVal = resp.tService,
		servicePmVal = resp.servicePm,
		servicePmeVal = resp.servicePme,
		xtraServiceScVal = resp.xtraServiceSc,
		cUpdateInsurance = $(diDivObj.selector +" .insurance_checkbox"),
		insuranceUpgradeContainer = $(diDivObj.selector +" .more_insurance"),
		insuranceValueContainer = $(diDivObj.selector +" .insuranceValueContainer"),
		insuranceUpgradeResult = $(diDivObj.selector +" .insuranceUpgradeResult"),
		insuranceCostField = $(diDivObj.selector +" .insuranceCostField");
			
	$.each(resp.serviceList, function(index, serviceType) {
		var serviceTypeName = serviceType.name;
		var serviceTypeDispName = serviceType.name;
		var price = serviceType.price;
		var description = serviceType.description;
		
		var displayPrice = serviceType.price;
		if(displayPrice != null && displayPrice.length > 0) {
			displayPrice = '$' + displayPrice;
		}
		var checkedVal = '';
		if(tServiceVal != null && tServiceVal == serviceTypeName) {
			checkedVal = 'checked';
		}
		if(serviceTypeDispName === servicePmVal) {
			serviceTypeDispName = 'Priority Mail';
		}
	
		html_upsellServiceType.push('<div class="actions_priced upsell_ServiceWrap">');
		html_upsellServiceType.push('<div class="radio">');
		html_upsellServiceType.push('<label><input type="radio" name="tService" value="'+serviceTypeName+'" ' +checkedVal+' /><strong>'+serviceTypeDispName+'</strong></label>');
		html_upsellServiceType.push('<p>'+description+'</p>');
		html_upsellServiceType.push('</div>');
		html_upsellServiceType.push('<input type="hidden" class="upsell_service_amount" value="'+price+'"/>');
		html_upsellServiceType.push('<div class="price">');
		html_upsellServiceType.push('<strong>'+displayPrice+'</strong>');
		html_upsellServiceType.push('</div>');
		html_upsellServiceType.push('</div>');
	});
	$(diDivObj.selector +" .upsell_service_type_list").html(html_upsellServiceType.join(''));

	if(cUpdateInsurance != null) {
		cUpdateInsurance.prop('checked', false);
	}
	insuranceUpgradeContainer.hide();
	insuranceUpgradeResult.hide();
	$(diDivObj.selector +" input[name='tInsuranceUpgrade']").val("");
	insuranceCostField.val("0");
	$(diDivObj.selector +" .insurance-response-error").html("");
	$(diDivObj.selector +" .insurance-response-error").hide();
	
	
	var hasInsurance = resp.hasInsurance;
	if(hasInsurance != null && hasInsurance == 'true') {
		var existingInsurance = resp.formatInsuranceValue;
		insuranceValueContainer.html('<p>This shipment already includes $' + existingInsurance  + ' of insurance.</p>');
		insuranceValueContainer.show();
	}else{
		insuranceValueContainer.hide();
	}
	
	var html_upsell_X_pmServiceType = [];
	
	$.each(resp.pmXtraServiceList, function(index, xtraServiceType) {
		var xtraServiceTypeName = xtraServiceType.name;
		var xtraServiceTypeDispName = xtraServiceType.name;
		var price = xtraServiceType.price;
		var displayPrice = xtraServiceType.price;
		if(displayPrice != null && displayPrice.length > 0) {
			displayPrice = '$' + displayPrice;
		}
		var checkedVal = '';
		if(index == 0){
			checkedVal = 'checked';
		}
		if(xtraServiceTypeDispName === xtraServiceScVal) {
			xtraServiceTypeDispName = xtraServiceScVal + '&trade;';
			}
		
		html_upsell_X_pmServiceType.push('<div class="actions_priced upsell_PmExtraServiceWrap">');
		html_upsell_X_pmServiceType.push('<div class="radio">');
		html_upsell_X_pmServiceType.push('<label><input type="radio" name="tPmExtraService" value="'+xtraServiceTypeName+'" ' +checkedVal+' /><strong>'+xtraServiceTypeDispName+'</strong></label>');
		html_upsell_X_pmServiceType.push('</div>');
		html_upsell_X_pmServiceType.push('<input type="hidden" class="upsell_pm_extra_service_amount" value="'+price+'"/>');
		html_upsell_X_pmServiceType.push('<div class="price">');
		html_upsell_X_pmServiceType.push('<strong>'+displayPrice+'</strong>');
		html_upsell_X_pmServiceType.push('</div>');
		html_upsell_X_pmServiceType.push('</div>');
	});
	$(diDivObj.selector +" .upsell_X_service_pm_type_list").html(html_upsell_X_pmServiceType.join(''));
	
	var html_upsell_X_pmeServiceType = [];
	$.each(resp.pmeXtraServiceList, function(index, xtraServiceType) {
		var xtraServiceTypeName = xtraServiceType.name;
		var xtraServiceTypeDispName = xtraServiceType.name;
		var price = xtraServiceType.price;
		var displayPrice = xtraServiceType.price;
		if(displayPrice != null && displayPrice.length > 0) {
			displayPrice = '$' + displayPrice;
		}
		var checkedVal = '';
		if(index == 0){
			checkedVal = 'checked';
		}
		if(xtraServiceTypeDispName === xtraServiceScVal) {
			xtraServiceTypeDispName = xtraServiceScVal + '&trade;';
		}
		
		html_upsell_X_pmeServiceType.push('<div class="actions_priced upsell_PmeExtraServiceWrap">');
		html_upsell_X_pmeServiceType.push('<div class="radio">');
		html_upsell_X_pmeServiceType.push('<label><input type="radio" name="tPmeExtraService" value="'+xtraServiceTypeName+'" ' +checkedVal+' /><strong>'+xtraServiceTypeDispName+'</strong></label>');
		html_upsell_X_pmeServiceType.push('</div>');
		html_upsell_X_pmeServiceType.push('<input type="hidden" class="upsell_pme_extra_service_amount" value="'+price+'"/>');
		html_upsell_X_pmeServiceType.push('<div class="price">');
		html_upsell_X_pmeServiceType.push('<strong>'+displayPrice+'</strong>');
		html_upsell_X_pmeServiceType.push('</div>');
		html_upsell_X_pmeServiceType.push('</div>');
	});
	$(diDivObj.selector +" .upsell_X_service_pme_type_list").html(html_upsell_X_pmeServiceType.join(''));
	
	trackingApp.DI_updateExtraService(diDivObj, servicePmVal, servicePmeVal);
	
	var serviceOptions = $(diDivObj.selector +" input[name='tService']");
	if(serviceOptions != null) {
		serviceOptions.each(function() {
			$(this).on('click', function(e) {
            	if(cUpdateInsurance != null) {
            		cUpdateInsurance.prop('checked', false);
            	}
            	insuranceUpgradeContainer.hide();
            	insuranceUpgradeResult.hide();
            	$(diDivObj.selector +" input[name='tInsuranceUpgrade']").val("");
            	insuranceCostField.val("0");
            	$(diDivObj.selector +" .insurance-response-error").html("");
            	$(diDivObj.selector +" .insurance-response-error").hide();

            	trackingApp.DI_updateExtraService(diDivObj, servicePmVal, servicePmeVal);	
			});
        }); 
	}
	
	var pmXtraServiceOptions = $(diDivObj.selector +" input[name='tPmExtraService']");
	if(pmXtraServiceOptions != null) {
		pmXtraServiceOptions.each(function() {
			$(this).on('click', function(e) {
				trackingApp.DI_updateTotal(diDivObj);
			});
        }); 
	}
	
	var pmeXtraServiceOptions = $(diDivObj.selector +" input[name='tPmeExtraService']");
	if(pmeXtraServiceOptions != null) {
		pmeXtraServiceOptions.each(function() {
			$(this).on('click', function(e) {
				trackingApp.DI_updateTotal(diDivObj);
			});
        }); 
	}
	
};

trackingApp.DI_updateExtraService = function(diDivObj, servicePmVal, servicePmeVal) {

	var serviceOption = $(diDivObj.selector +" input[name='tService']:checked").val(),
		extrasDefault = $(diDivObj.selector +" .upsell_X_defaultWrap"),
		extraPmServicesList = $(diDivObj.selector +" .upsell_X_pmServiceWrap"),
		extraPmeServicesList = $(diDivObj.selector +" .upsell_X_pmeServiceWrap");

	if(serviceOption != null) {
    	if(serviceOption === servicePmVal){
    		extrasDefault.hide();
            extraPmServicesList.show();
            extraPmeServicesList.hide();
    	}else if(serviceOption === servicePmeVal){
    		extrasDefault.hide();
    		extraPmServicesList.hide();
    		extraPmeServicesList.show();
        }else {
        	extrasDefault.show();
        	extraPmServicesList.hide();
        	extraPmeServicesList.hide();
        }
	}
	trackingApp.DI_updateTotal(diDivObj);
};

trackingApp.DI_updateTotal = function(diDivObj) {
    var upsellTotalAmount = $(diDivObj.selector +" .upsellTotalAmount"),
	    serviceOption = $(diDivObj.selector +" input[name='tService']:checked"),
	    pmXtraServicesList = $(diDivObj.selector +" .upsell_X_pmServiceWrap"),
	    pmXtraService = $(diDivObj.selector +" input[name='tPmExtraService']:checked"),
	    pmeXtraServicesList = $(diDivObj.selector +" .upsell_X_pmeServiceWrap"),
	    pmeXtraService = $(diDivObj.selector +" input[name='tPmeExtraService']:checked"),
	    serviceWrapDiv = serviceOption.closest('div.upsell_ServiceWrap'),
	    serviceCostField = serviceWrapDiv.children(".upsell_service_amount"),
	    serviceCost = parseFloat(serviceCostField.val()),
	    insuranceCost = parseFloat($(diDivObj.selector +" .insuranceCostField").val()),
	    insuranceValueContainer = $(diDivObj.selector +" .insuranceValueContainer"),
	    insuranceValueBIContainerWrapper = $(diDivObj.selector +" .insuranceValueBIContainerWrapper"),
	    insuranceValueBIContainer = $(diDivObj.selector +" .insuranceValueBIContainer"),
	    insuranceValueBIContainerPrice = $(diDivObj.selector +" .insuranceValueBIContainerPrice"),
	    total = 0;

    total += serviceCost + insuranceCost;
    
    insuranceValueBIContainerWrapper.hide();
    insuranceValueBIContainer.hide();
    insuranceValueBIContainerPrice.hide();

    if(pmXtraServicesList != null && pmXtraServicesList.length !== 0 && pmXtraServicesList.css('display') != 'none')
    {
        if(pmXtraService != null && pmXtraService.length !== 0) {
        	var pmWrapDiv = pmXtraService.closest('div.upsell_PmExtraServiceWrap'),
                pmCostField = pmWrapDiv.children(".upsell_pm_extra_service_amount"),
                pmCost = 0;
            if(pmCostField != null && pmCostField.length !== 0 && pmCostField.val().length > 0) {
            	pmCost = parseFloat(pmCostField.val());
            }
            total += pmCost;

            if (insuranceValueContainer.css('display') == 'none') {
            	insuranceValueBIContainer.html('<p>Insurance for packages valued up to $50</p>');
            	insuranceValueBIContainerPrice.html('<p><strong>FREE</strong></p>');
            	insuranceValueBIContainer.show();
            	insuranceValueBIContainerPrice.show();
            	insuranceValueBIContainerWrapper.show();
            }
        }
    }
    
    if(pmeXtraServicesList != null && pmeXtraServicesList.length !== 0 && pmeXtraServicesList.css('display') != 'none')
    {
        if(pmeXtraService != null && pmeXtraService.length !== 0) {
        	var pmeWrapDiv = pmeXtraService.closest('div.upsell_PmeExtraServiceWrap'),
                pmeCostField = pmeWrapDiv.children(".upsell_pme_extra_service_amount"),
                pmeCost = 0;
            if(pmeCostField != null && pmeCostField.length !== 0 && pmeCostField.val().length > 0) {
            	pmeCost = parseFloat(pmeCostField.val());
            }
            total += pmeCost;

            if (insuranceValueContainer.css('display') == 'none') {
                insuranceValueBIContainer.html('<p>Insurance for packages valued up to $100</p>');
            	insuranceValueBIContainerPrice.html('<p><strong>FREE</strong></p>');                	
            	insuranceValueBIContainer.show();
            	insuranceValueBIContainerPrice.show();
            	insuranceValueBIContainerWrapper.show();
            }
       
        }
    }
                
    upsellTotalAmount.html("$" + (total.toFixed(2)));
	
};

trackingApp.DI_handleInsuranceErrors = function(diDivObj) {

	var tInsuranceUpgrade = $(diDivObj.selector +"  input[name='tInsuranceUpgrade']"),
	    currancyRegEx = /^(\d*|\d+|\d{1,3},\d{3})(\.\d{1,2})?$/,
	    errorMessage1 = "Please enter a valid additional insurance amount and press 'Calculate Price'.",
	    errorMessage2 = "Please enter an additional insurance amount and press 'Calculate Price'.",
	    val = tInsuranceUpgrade.val().trim(),
	    errors = [];
        
    if(val.length == 0) {
        errors.push(errorMessage2);
    }else if(!currancyRegEx.test(val)) {
        errors.push(errorMessage1);
    }else if(parseFloat(val) <= 0) {
        errors.push(errorMessage1);
    }
    return errors;
};

trackingApp.DI_submitAddCart = function(diDivObj, buttonObj) {
	
    var cartDiv = $("#tracking_page_wrapper .global-header-cart-2")[0];		
    if(cartDiv != null && cartDiv.hasChildNodes() != true) {
		var script = document.createElement('script');
		script.setAttribute('src', atgCartWidgetUrl);
		cartDiv.appendChild(script);
    }
    
    var	diForm = $(diDivObj.selector +' .actions_form'),
    	label = $(diForm.selector +' input[name="label"]').val(),
    	deliveryOption = '';
    
    var buttonIdName = buttonObj.id.split("_")[0];
    if(buttonIdName === 'redirectAddCartButton') {
    	deliveryOption = "3";
    }else if(buttonIdName === 'hfpAddCartButton') {
    	deliveryOption = "4";
    }
    
    var stepModule = $(diDivObj.selector +' .change-delivery-module[data-deliverymodule=4]');
    var stepData = $(stepModule.selector + ' input, radio').serialize();

    var data = "easrFunc=AddCart" + "&";
		data += "label=" + label + "&";
		data += "deliveryOption=" + deliveryOption + "&";
		data += stepData;
		
	$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
	$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").addClass("hidden");
	
	var buttonOrgText = $(buttonObj).text();
	$(buttonObj).prop("disabled", true);
	$(buttonObj).text("Processing");
    
   	$.ajax({
   		url: "/go/TrackConfirmEasrAJAXAction.action",
   		type: 	"POST",
   		dataType: "json",
   		data: data,
   		success: function(resp) {
    		if($("#global-header-cart") != null) {
    			$("#global-header-cart").hide();
    		}
   			if(resp.status === true) {
   				window.location.href = resp.redirectUrl;
   			} else {
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").removeClass("hidden");
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(resp.firstName);
   				$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .errorScenario").html(resp.errorScenario);
   				$(buttonObj).prop("disabled", false);
   				$(buttonObj).text(buttonOrgText);
   			}
   		},
   		error: function(jqXHR, exception) {
   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error").removeClass("hidden");
   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.success").addClass("hidden");
   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .firstName").html(tFwdCustomerFName);
   			$(diDivObj.selector +" .panel-actions-content.delivery-instructions-content.error .errorScenario").html("the system is having technical difficulties");
			$(buttonObj).prop("disabled", false);
			$(buttonObj).text(buttonOrgText);
   		}
   	});

};

/** 
  * Available Actions: text and eMail Updates 
  */
trackingApp.initTextAndEmailUpdates = function(id) {
	
	trackingApp.activeTextAndEmailUpdates(id);
	
	// Checkbox interactions
	// hide/show functionality
	$('#textAll_'+id).on('click', function() {
		if (this.checked) {
			$('div#textAndEmailUpdatesPanel_'+id+' .text-enabled-option').prop('checked',true);
			//$('div#textAndEmailUpdatesPanel_'+id+' .text-enabled-option').prop('disabled',true);	
		} else {
			$('div#textAndEmailUpdatesPanel_'+id+' .text-enabled-option').prop('checked',false);
			$('#textUpdatePhoneNumber_'+id).val('');
			$('#agreedTextUpdates_'+id).prop('checked',false);
			//$('div#textAndEmailUpdatesPanel_'+id+' .text-enabled-option').prop('disabled',false);			
		};
		trackingApp.activeTextAndEmailUpdates(id);
	});

	// hide/show functionality
	$('#emailAll_'+id).on('click', function() {
		if (this.checked) {
			$('div#textAndEmailUpdatesPanel_'+id+' .email-enabled-option').prop('checked',true);
			//$('div#textAndEmailUpdatesPanel_'+id+' .email-enabled-option').prop('disabled',true);	
		} else {
			$('div#textAndEmailUpdatesPanel_'+id+' .email-enabled-option').prop('checked',false);
			$('#emailUpdate_name1_'+id).val('');
			$('#emailUpdate_name2_'+id).val('');
			$('#emailUpdate_name3_'+id).val('');
			$('#emailUpdate_email1_'+id).val('');
			$('#emailUpdate_email2_'+id).val('');
			$('#emailUpdate_email3_'+id).val('');
			//$('div#textAndEmailUpdatesPanel_'+id+' .email-enabled-option').prop('disabled',false);	
		};
		trackingApp.activeTextAndEmailUpdates(id);
	});
	
	$('#textFuture_'+id +', #textToday_'+id +', #textDnd_'+id +', #textPickup_'+id +', #textPickup_'+id +', #textAlert_'+id +', #textOA_'+id).on('click', function() {
		var selected = [],
			maxLength = $('input.textupdates_'+id+':not('+'#textAll_'+id+')').length,
			selectedLength = $('input.textupdates_'+id+':checked:not('+'#textAll_'+id+')').length;
			//console.log('maxLength'+id+' text: '+maxLength);
			console.log('selectedLength'+id+' text: '+selectedLength);
		$('input.text-updates-label:checked').each(function() {
			selected.push($(this).attr('id'));
			//console.log($(this).attr('id'));
		});
	
		if(selectedLength === 0) {
			$('#textUpdatePhoneNumber_'+id).val('');
			$('#agreedTextUpdates_'+id).prop('checked',false);
		};
	
		if(selectedLength < maxLength) {
			$('#textAll_'+id).prop('checked',false);
		} else {
			$('#textAll_'+id).prop('checked',true);
		};
		
	});

	$('#emailFuture_'+id +', #emailToday_'+id +', #emailDnd_'+id +', #emailPickup_'+id +', #emailPickup_'+id +', #emailAlert_'+id +', #emailOA_'+id).on("click", function() {
		var selected = [],
			maxLength = $('input.emailupdates_'+id+':not('+'#emailAll_'+id+')').length,
			selectedLength = $('input.emailupdates_'+id+':checked:not('+'#emailAll_'+id+')').length;
			//console.log('maxLength'+id+' email: '+maxLength);
			console.log('selectedLength'+id+' email: '+selectedLength);
		$('input.email-updates-label:checked').each(function() {
			selected.push($(this).attr('id'));
			//console.log($(this).attr('id'));
		});
	
		if(selectedLength === 0) {
			$('#emailUpdate_name1_'+id).val('');
			$('#emailUpdate_name2_'+id).val('');
			$('#emailUpdate_name3_'+id).val('');
			$('#emailUpdate_email1_'+id).val('');
			$('#emailUpdate_email2_'+id).val('');
			$('#emailUpdate_email3_'+id).val('');
		};
	
		if(selectedLength < maxLength) {
			$('#emailAll_'+id).prop('checked',false);
		} else {
			$('#emailAll_'+id).prop('checked',true);
		};
	});
	
	$('#textAll_'+id +', #textFuture_'+id +', #textToday_'+id +', #textDnd_'+id +', #textPickup_'+id +', #textPickup_'+id +', #textAlert_'+id +', #textOA_'+id +',#emailAll_'+id +',#emailFuture_'+id +', #emailToday_'+id +', #emailDnd_'+id +', #emailPickup_'+id +', #emailPickup_'+id +', #emailAlert_'+id +', #emailOA_'+id).on('click', function() {
		trackingApp.activeTextAndEmailUpdates(id);
	});
	// end checkbox interactions
	
	
	//Add another Email
	$('#textAndEmailUpdatesPanel_'+id + ' .add-another-email').on('click', function(e) {
		e.preventDefault();
		trackingApp.addEmailUpdateEmailBlock(this);
	});


	$('#textAndEmailUpdatesPanel_'+id +' button.getTextAndEmailUpdates').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var teuDivObj = $("#textAndEmailUpdatesPanel_"+formIdSplit),
			teuFormObj = $("#textAndEmailUpdate_"+formIdSplit);	
			
		$(teuDivObj.selector +" .panel-actions-content.text-updates-content.success").addClass("hidden");
		$(teuDivObj.selector +" .panel-actions-content.text-updates-content.error").addClass("hidden");
		
		$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success").addClass("hidden");
		$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error").addClass("hidden");
		$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .data-error-div-result").html("");
		$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error").removeClass("hidden");
		$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error-number").html("");
		
		
		var hasErrors = teuFormObj.validator('validate').has('.has-error').length;
		if (!hasErrors) {		
			trackingApp.getTextAndEmailUpdates(teuDivObj, formIdSplit);
		}
	});
	
};

trackingApp.activeTextAndEmailUpdates = function(id) {
	
	var numTextChecked = 0;
	$.each($('div#checkbox-wrapper_'+id+' .text-updates-label'), function(index, checkboxObj) {
		if($(checkboxObj).is(":checked")) {
			numTextChecked++;
		}
	});
	if (numTextChecked > 0) {
		$('#text-updates-wrapper_'+id).removeClass('hidden');
		$('#text-updates-messages_'+id).removeClass('hidden');
		$('#update-text-tac_'+id).removeClass('hidden');
		if(!$('div#textAndEmailUpdatesPanel_'+id+' .textRequired').prop('required')){
			$('div#textAndEmailUpdatesPanel_'+id+' .textRequired').attr('required', true);
		}
	} else {
		$('#text-updates-wrapper_'+id).addClass('hidden');
		$('#text-updates-messages_'+id).addClass('hidden');
		$('#update-text-tac_'+id).addClass('hidden');
		if($('div#textAndEmailUpdatesPanel_'+id+' .textRequired').prop('required')){
			$('div#textAndEmailUpdatesPanel_'+id+' .textRequired').removeAttr('required');
		}
	};
	
	var numEmailChecked = 0;
	$.each($('div#checkbox-wrapper_'+id+' .email-updates-label'), function(index, checkboxObj) {
		if($(checkboxObj).is(":checked")) {
			numEmailChecked++;
		}
	});
	if (numEmailChecked > 0) {
		$('#email-updates-wrapper_'+id).removeClass('hidden');
		$('#teuButton_'+id).removeClass('hidden');
		if(!$('div#textAndEmailUpdatesPanel_'+id+' .emailRequired').prop('required')){
			$('div#textAndEmailUpdatesPanel_'+id+' .emailRequired').attr('required', true);
		}
	} else {
		$('#email-updates-wrapper_'+id).addClass('hidden');
		$('#teuButton_'+id).addClass('hidden');
		if($('div#textAndEmailUpdatesPanel_'+id+' .emailRequired').prop('required')){
			$('div#textAndEmailUpdatesPanel_'+id+' .emailRequired').removeAttr('required');
		}
	};

	if($('div#checkbox-wrapper_'+id+' :checkbox:checked').length >0) {
		$('#teuButton_'+id).removeClass('hidden');
	} else {
		$('#teuButton_'+id).addClass('hidden');
	};
	
};

trackingApp.getTextAndEmailUpdates = function(teuDivObj, formIdSplit) {
	
	var data = $("#textAndEmailUpdate_"+formIdSplit+ ", .input, .checkbox").serialize();
	
	var buttonOrgText = $("#teuButton_"+formIdSplit).text();
	$("#teuButton_"+formIdSplit).prop("disabled", true);
	$("#teuButton_"+formIdSplit).text("Processing");
	
	$.ajax({
		url: "/go/TrackConfirmRequestUpdateAJAXAction",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if(resp.textResult.length > 0) {
				if(resp.textServiceError == "false") {
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.success").removeClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.error").addClass("hidden");
					$(teuDivObj.selector +" .euPanalAction").addClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.success .text-updates-success-number").html(resp.label);
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.success .text-updates-success-phone").html(resp.textResult);
				} else {
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.error").removeClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.success").addClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.text-updates-content.error .data-error-div-result").html(resp.textResult);
				}
			}
			
			if(resp.emailResult.length > 0) {
				if(resp.emailServiceError == "false") {
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success").removeClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error").addClass("hidden");
					$(teuDivObj.selector +" .euPanalAction").addClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success .email-updates-success-number").html(resp.label);
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success .email-updates-success-email").html(resp.emailResult.replace(/\s/g,'<br/>'));
				} else {
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error").removeClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success").addClass("hidden");
					$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .data-error-div-result").html(resp.emailResult.replace(/\s/g,'<br/>'));
				}
			}
		},
		error: function(jqXHR, exception) {
			var errMsg = "An error occurred while creating your Online email update. Please try again later.";
			if (jqXHR.status === 0) {
				errMsg = "Not connect.\n Verify Network.";
			} else if (jqXHR.status == 404) {
				errMsg = "Requested page not found. [404]";
			} else if (jqXHR.status == 500) {
				errMsg = "Internal Server Error [500].";
			} else if (exception === 'parsererror') {
				errMsg = "Requested JSON parse failed.";
			} else if (exception === 'timeout') {
				errMsg = "Time out error.";
			} else if (exception === 'abort') {
				errMsg = "Ajax request aborted.";
			} else {
				errMsg = "Uncaught Error.\n" + jqXHR.responseText;
			}
			
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error").removeClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success").addClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error").addClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error-number").html(errMsg);
			
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error").removeClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.success").addClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error").addClass("hidden");
			$(teuDivObj.selector +" .panel-actions-content.email-updates-content.error .email-updates-error-number").html(errMsg);
		},
		complete: function(resp) {
			$("#teuButton_"+formIdSplit).prop("disabled", false);
			$("#teuButton_"+formIdSplit).text(buttonOrgText);
        }
	});
};


/** 
  * Available Actions: Schedule Redelivery 
  */
trackingApp.initScheduleRedelivery = function(id) {
	
	//Use Same address checkbox
	$('#scheduleRedelivery-useSameAddress_'+id).on('change', function() {

		var formIdSplit = this.id.split("_")[1];
		var rdFormObj = $("#scheduleRedelivery_"+formIdSplit),
			lFNameRd = $(rdFormObj.selector + ' input[name="lFNameRd"]'),
			lLNameRd = $(rdFormObj.selector + ' input[name="lLNameRd"]'),
			lStreetRd = $(rdFormObj.selector + ' input[name="lStreetRd"]'),
			lStreet2Rd = $(rdFormObj.selector + ' input[name="lStreet2Rd"]'),
			lCityRd = $(rdFormObj.selector + ' input[name="lCityRd"]'),
			lStateRd = $(rdFormObj.selector + ' select[name="lStateRd"]'),
			lZipRd = $(rdFormObj.selector + ' input[name="lZipRd"]');
		
    	if($(this).is(":checked")) {
    		lFNameRd.val($(rdFormObj.selector + ' .profile-first-name').val());
    		lLNameRd.val($(rdFormObj.selector + ' .profile-last-name').val());
    		lStreetRd.val($(rdFormObj.selector + ' .profile-address-one').val());
    		lStreet2Rd.val($(rdFormObj.selector + ' .profile-address-two').val());
    		lCityRd.val($(rdFormObj.selector + ' .profile-city').val());
    		lStateRd.val($(rdFormObj.selector + ' .profile-state').val());
    		lZipRd.val($(rdFormObj.selector + ' .profile-zip').val());
    	}else{
    		lFNameRd.val('');
    		lLNameRd.val('');
    		lStreetRd.val('');
    		lStreet2Rd.val('');
    		lCityRd.val('');
    		lStateRd.val('');
    		lZipRd.val('');
    	}
    	
		$('#scheduleRedelivery_'+id).validator('destroy');
		$('#scheduleRedelivery_'+id).validator();
	});
	
	$('#redeliveryPanel_'+id +' button.doScheduleRedelivery').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var rdDivObj = $("#redeliveryPanel_"+formIdSplit),
			rdFormObj = $("#scheduleRedelivery_"+formIdSplit);		
		
		$('#redeliveryPanel_'+id +' .datepicker').prop('readonly', false);
				
		$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.success").addClass("hidden");
		$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error").addClass("hidden");
		
		var hasErrors = rdFormObj.validator('validate').has('.has-error').length;
		if (!hasErrors) {		
			trackingApp.doScheduleRedelivery(rdDivObj, formIdSplit);
		}
	});
	
	var receiveType = $('#redeliveryPanel_'+id + ' #scheduleRedelivery-receiveType_'+id);
	trackingApp.RD_activeRedeliveryDate(receiveType.val(), id);
	receiveType.on('change', function() {
		var formIdSplit = this.id.split("_")[1];
		trackingApp.RD_activeRedeliveryDate($(this).val(), formIdSplit);
	});
	
	trackingApp.RD_loadRedeliveryCalendar(id);
	$('#redeliveryPanel_'+id +' .mailtype-select').on('change', function() {
		trackingApp.RD_loadRedeliveryCalendar(id);
	});
	
	$('#redeliveryPanel_'+id +' .datepicker').on('click', function() {
		$(this).prop('readonly', true);
	});
};

trackingApp.RD_activeRedeliveryDate = function(receiveTypeValue, id) {
	
	var rdDivObj = $("#redeliveryPanel_"+id);
	var calModal = $(rdDivObj.selector +" .calendar-modal-link"),
		dateInut = $(rdDivObj.selector +" #scheduleRedelivery-date_"+id);
	if (receiveTypeValue === 'Redelivery') {
		dateInut.prop('required',true);
		calModal.show();
	}else{
		dateInut.removeAttr('required');
		calModal.hide();
	}
	$('#scheduleRedelivery_'+id).validator('destroy');
	$('#scheduleRedelivery_'+id).validator();
};

trackingApp.doScheduleRedelivery = function(rdDivObj, formIdSplit) {
	
	var data = $("#scheduleRedelivery_"+formIdSplit+ ", .input, .select, .textarea").serialize();
	
    var redeliveryMessages = {
            "noRedelivery": 'Sorry. Online redelivery is not available for this address.<br />Retreive your item at your local <span class="redelivery-address-error-link"><a href="https://tools.usps.com/go/POLocatorAction!input.action" target="_blank">Post Office</a></span>',
            "lFNameRd": "Please enter a First Name.",
            "lLNameRd": "Please enter a Last Name.",
            "lEmailRd": "Please enter a Email Address.",
            "lPhoneRd": "Please enter a Phone Number.",
            "lStreetRd": "Please enter a Street Address.",
            "lCityRd": "Please enter a City.",
            "lStateRd": "Please enter a State.",
            "lZipRd": "Please enter a ZIP Code&trade;.",
            "lItemTypeRd": "Please select the type of item.",
            "lDeliveryDateRd": "Please select a Redelivery Date.",
            "lItemPreferenceRd": "Please select how you want to receieve your items."
        };	
    
	var buttonOrgText = $("#rdButton_"+formIdSplit).text();
	$("#rdButton_"+formIdSplit).prop("disabled", true);
	$("#rdButton_"+formIdSplit).text("Processing");

	$.ajax({
		url: "/go/TrackConfirmRedeliveryAJAXAction.action",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if(resp.status === true) {
				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.success").removeClass("hidden");
				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error").addClass("hidden");
				$(rdDivObj.selector +" .redeliveryPanalAction").addClass("hidden");
				trackingApp.showRedeliverySuccess($(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.success"), resp);
			} else {
				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error").removeClass("hidden");
				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.success").addClass("hidden");
    			if(resp.checkAddressResult == false) {
    				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error .errorMsg").html(redeliveryMessages.noRedelivery);
    			}else{
    				$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error .errorMsg").html(resp.errorMessage);
    			}
			}
		},
		error: function(jqXHR, exception) {
			$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error").removeClass("hidden");
			$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.success").addClass("hidden");
			$(rdDivObj.selector +" .panel-actions-content.scheduleRedelivery-content.error .errorMsg").html("An error occurred while creating your Online redelivery. Please try again later.");
		},
		complete: function(resp) {
			$("#rdButton_"+formIdSplit).prop("disabled", false);
			$("#rdButton_"+formIdSplit).text(buttonOrgText);
        }
	});
};

trackingApp.showRedeliverySuccess = function(successDiv, resp) {
	
	$(successDiv.selector +" .redelivery-success-number--num").html(resp.confirmationNumber);
	$(successDiv.selector +" .redelivery-success-first-name").html(resp.firstName);
	if(resp.middleName){
		$(successDiv.selector +" .redelivery-success-middle-initial").html(resp.middleName+' ');
	}
	$(successDiv.selector +" .redelivery-success-last-name").html(resp.lastName);	
	$(successDiv.selector +" .redelivery-success-address-one").html(resp.addressOne);
	if(resp.addressTwo){
		$(successDiv.selector +" .redelivery-success-address-two").html(resp.addressTwo);
	}
	$(successDiv.selector +" .redelivery-success-city").html(resp.city);
	$(successDiv.selector +" .redelivery-success-state").html(resp.state);
	$(successDiv.selector +" .redelivery-success-zip").html(resp.zip);
	if(resp.ext){
		$(successDiv.selector +" .redelivery-success-phone").html(resp.phone+' EXT. ' +resp.ext);
	}else{
		$(successDiv.selector +" .redelivery-success-phone").html(resp.phone);
	}
	$(successDiv.selector +" .redelivery-success-email").html(resp.email);
	
	if(resp.redeliveryType.indexOf('Redelivery') != -1) {
		$(successDiv.selector +" .redelivery-success-date").removeClass("hidden");
		$(successDiv.selector +" .redelivery-success-date--date").html(resp.redeliveryDate+'.');
		$(successDiv.selector +" .redelivery-success-address-verbiage").html('We will redeliver to:');
		$(successDiv.selector +" .redelivery-success-mailtype-verbiage").html('Redelivering items of mail type:');
	}else{
		$(successDiv.selector +" .redelivery-success-date").addClass("hidden");
		if(resp.redeliveryType.indexOf('Pickup') != -1) {
			$(successDiv.selector +" .redelivery-success-address-verbiage").html('We will hold mail for:');
			$(successDiv.selector +" .redelivery-success-mailtype-verbiage").html('Holding items of mail type:');
		}else if(resp.redeliveryType.indexOf('Return') != -1) {
			$(successDiv.selector +" .redelivery-success-address-verbiage").html('We will return to sender of mail for:');
			$(successDiv.selector +" .redelivery-success-mailtype-verbiage").html('Returning items of mail type:');
		}
	}
	
	$(successDiv.selector +" .redelivery-success-mailtype").html(resp.mailType);
	
	if(resp.addtionalInformation){
		$(successDiv.selector +" .redelivery-success-instructions").removeClass("hidden");
		$(successDiv.selector +" .redelivery-success-additional-information").html(resp.addtionalInformation);
	}else{
		$(successDiv.selector +" .redelivery-success-mailtype-div").removeClass("redelivery-success-address");
		$(successDiv.selector +" .redelivery-success-mailtype-div").addClass("redelivery-success-instructions");
	}
};

trackingApp.RD_setHolidays = function() {
		
	$.ajax({
		url: "/go/TrackConfirmRedeliveryAJAXAction_getPostalHolidays",
		type: 	"POST",
		dataType: "text",
		async: false,
		success: function(resp) {
			var outputArray    = [];
			var parser = new DOMParser();
			var xmlDoc = parser.parseFromString(resp, "text/xml");

			var years = xmlDoc.documentElement.childNodes;

			//Loop through years
			for (var i = 0, max = years.length; i < max; i++) {
				var year = years[i].getAttribute('value'),
					months = years[i].childNodes;

				//Loop through months
				for (var j = 0, maxMonths = months.length; j < maxMonths; j++) {
					// console.log('years[i].childNodes[0].getAttribute(value)', years[i].childNodes[0].getAttribute('value'));
					var month = months[j].getAttribute('value'),
						holidays = months[j].childNodes;

					//Loop through holidays
					for (var k = 0, maxHolidays = holidays.length; k < maxHolidays; k++) {
						var day = holidays[k].childNodes[1].childNodes[0].nodeValue;
						outputArray.push(month + '/' + day + '/' + year);
					}
				}
			}
			trackingApp.holidayArray = outputArray;
		},
		error: function(jqXHR, exception) {
			var errMsg = "An error occurred while creating your Online email update. Please try again later.";
			if (jqXHR.status === 0) {
				errMsg = "Not connect.\n Verify Network.";
			} else if (jqXHR.status == 404) {
				errMsg = "Requested page not found. [404]";
			} else if (jqXHR.status == 500) {
				errMsg = "Internal Server Error [500].";
			} else if (exception === 'parsererror') {
				errMsg = "Requested JSON parse failed.";
			} else if (exception === 'timeout') {
				errMsg = "Time out error.";
			} else if (exception === 'abort') {
				errMsg = "Ajax request aborted.";
			} else {
				errMsg = "Uncaught Error.\n" + jqXHR.responseText;
			}
			console.log(errMsg);
		}
	});
		
};

trackingApp.RD_loadRedeliveryCalendar = function(formId) {
	
	if (trackingApp.holidayArray == null || trackingApp.holidayArray === undefined) {
		trackingApp.RD_setHolidays();
	}
	
	if (trackingApp.cantUseArray[formId] === undefined) {
		trackingApp.RD_setCantUse(formId);
    }
	
    var mailTypeSelect = $('#redeliveryPanel_'+formId +' .mailtype-select'),
		mailTypeForRedeliverDate = $('#redeliveryPanel_'+formId +' .mailTypeForRedeliverDate'),
		returnDate = $('#redeliveryPanel_'+formId +' .returnDate');
	
    if(mailTypeSelect.val() != '') {
    	if(mailTypeForRedeliverDate.val() != mailTypeSelect.val()) {
    		mailTypeForRedeliverDate.val(mailTypeSelect.val());
    		trackingApp.RD_setCantUse(formId);
    	}
    }

    $('#redeliveryPanel_'+formId +' .datepicker').datepicker("destroy");
	$('#redeliveryPanel_'+formId +' .datepicker').datepicker({
		keyboardNavigation: true,
		todayHighlight: false,
		maxViewMode: 0,
		onSelect: function() {
			$(this).valid();
		},
		autoclose: true,
		toggleActive: false,
		immediateUpdates: true,
		templates: {
			leftArrow: '<i class="icon-textlinkcarat_red_left"></i>',
			rightArrow: '<i class="icon-carat_right icon-textlinkcarat_red"></i>'
		},
		// 'add' param below is: 0 - today, 1 - tomorrow, etc.
		startDate: moment().add(0, 'days').format('MM/DD/Y'),
		endDate: removeSunday(returnDate.val()).format('MM/DD/Y'),
		daysOfWeekDisabled: [0],
		datesDisabled: trackingApp.holidayArray,
		beforeShowDay: function(theDate) {
			if (checkCantUse(theDate, formId)) {
				return {
					enabled: false,
					classes: 'disabled'
				};
			}
		}
	});
	$('#redeliveryPanel_'+formId +' .datepicker').datepicker("refresh");
	
};

trackingApp.RD_setCantUse = function(formId) {
	
	var returnDate = $('#scheduleRedelivery_'+formId + ' .returnDate').val(),
		returnDaysCount = $('#scheduleRedelivery_'+formId + ' .returnDaysCount').val(),
		mailTypeForRedeliverDate = $('#scheduleRedelivery_'+formId + ' .mailTypeForRedeliverDate').val();
	
	$.ajax({
		url: "/go/TrackConfirmRedeliveryAJAXAction_getUnAvailableReturnDates?mailTypeForRedeliverDate="+mailTypeForRedeliverDate + "&returnDate="+returnDate + "&returnDaysCount="+returnDaysCount,
		type: 	"POST",
		dataType: "text",
		async: false,
		success: function(resp) {
			var outputArray    = [];
			var parser = new DOMParser();
			var xmlDoc = parser.parseFromString(resp, "text/xml");

			var years = xmlDoc.documentElement.childNodes;

			//Loop through years
			for (var i = 0, max = years.length; i < max; i++) {
				var year = years[i].getAttribute('value'),
					months = years[i].childNodes;

				//Loop through months
				for (var j = 0, maxMonths = months.length; j < maxMonths; j++) {
					// console.log('years[i].childNodes[0].getAttribute(value)', years[i].childNodes[0].getAttribute('value'));
					var month = months[j].getAttribute('value'),
						holidays = months[j].childNodes;

					//Loop through holidays
					for (var k = 0, maxHolidays = holidays.length; k < maxHolidays; k++) {
						var day = holidays[k].childNodes[1].childNodes[0].nodeValue;
						outputArray.push(month + '/' + day + '/' + year);
					}
				}
			}
			trackingApp.cantUseArray[formId] = outputArray;
		},
		error: function(jqXHR, exception) {
			var errMsg = "An error occurred while creating your Online email update. Please try again later.";
			if (jqXHR.status === 0) {
				errMsg = "Not connect.\n Verify Network.";
			} else if (jqXHR.status == 404) {
				errMsg = "Requested page not found. [404]";
			} else if (jqXHR.status == 500) {
				errMsg = "Internal Server Error [500].";
			} else if (exception === 'parsererror') {
				errMsg = "Requested JSON parse failed.";
			} else if (exception === 'timeout') {
				errMsg = "Time out error.";
			} else if (exception === 'abort') {
				errMsg = "Ajax request aborted.";
			} else {
				errMsg = "Uncaught Error.\n" + jqXHR.responseText;
			}
			console.log(errMsg);
		}
	});
		
};

/** 
  * Available Actions: Get Proof of Delivery 
  */
trackingApp.initProofOfDelivery = function(id) {

	//Add another Email
	$('#proofOfDeliveryPanel_'+id +' .add-another-email').on('click', function(e) {
		e.preventDefault();
		trackingApp.addProofEmailBlock(this);
	});

	$('#proofOfDeliveryPanel_'+id +' button.doProofOfDelivery').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var podDivObj = $("#proofOfDeliveryPanel_"+formIdSplit),
			podFormObj = $("#proofOfDelivery_"+formIdSplit);		
		
		$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success").addClass("hidden");
		$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error").addClass("hidden");
		
		var hasErrors = podFormObj.validator('validate').has('.has-error').length;
		if (!hasErrors) {		
			trackingApp.getProofOfDelivery(podDivObj, formIdSplit);
		}
	});
	
	$('#proofOfDeliveryPanel_'+id +' a.doSignIn').on('click', function(e) {
		e.preventDefault();
		window.location = trackSigninUrl;
	});
	
	if(isUserLoggedIn) {
		$("#podSignIn_"+id).hide();
	}else{
		$("#podSignIn_"+id).show();
	}
	
};

trackingApp.getProofOfDelivery = function(podDivObj, formIdSplit) {
	
	var data = $("#proofOfDelivery_"+formIdSplit+ ", .input").serialize();
	
	var buttonOrgText = $("#podButton_"+formIdSplit).text();
	$("#podButton_"+formIdSplit).prop("disabled", true);
	$("#podButton_"+formIdSplit).text("Processing");

	$.ajax({
		url: "/go/TrackConfirmAJAXAction.action",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if(resp.status === true) {
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success").removeClass("hidden");
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error").addClass("hidden");
				$(podDivObj.selector +" .podPanalAction").addClass("hidden");
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .responseString").html(resp.responseString);
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .email1").html(resp.tEmail1);
				if(resp.tEmail2){
					$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .email2-div").removeClass("hidden");
					$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .email2").html(resp.tEmail2);
				}
				if(resp.tEmail3){
					$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .email3-div").removeClass("hidden");
					$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success .email3").html(resp.tEmail3);
				}
			} else {
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error").removeClass("hidden");
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success").addClass("hidden");
				$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error .errorMsg").html("An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.");
			}
		},
		error: function(jqXHR, exception) {
			$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error").removeClass("hidden");
			$(podDivObj.selector +" .panel-actions-content.pod-updates-content.success").addClass("hidden");
			$(podDivObj.selector +" .panel-actions-content.pod-updates-content.error .errorMsg").html("An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.");
		},
		complete: function(resp) {
			$("#podButton_"+formIdSplit).prop("disabled", false);
			$("#podButton_"+formIdSplit).text(buttonOrgText);
        }
	});
};

/** 
 * Available Actions: Return Receipt Email 
 */
trackingApp.initReturnReceipt = function(id) {
	
	//Add another Email
	$('#returnReceipt_'+id +' .add-another-email').on('click', function(e) {
		e.preventDefault();
		trackingApp.addReturnReceiptEmailBlock(this);
	});

	$('#returnReceipt_'+id +' button.getReturnReceiptEmail').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var rreDivObj = $("#returnReceipt_"+formIdSplit),
			rreFormObj = $("#returnReceiptEmail_"+formIdSplit);		
		
		$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success").addClass("hidden");
		$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error").addClass("hidden");
		
		var hasErrors = rreFormObj.validator('validate').has('.has-error').length;
		if (!hasErrors) {		
			trackingApp.getReturnReceiptEmail(rreDivObj, formIdSplit);
		}
	});
	
	$('#returnReceipt_'+id +' a.doSignIn').on('click', function(e) {
		e.preventDefault();
		window.location = trackSigninUrl;
	});
	
	if(isUserLoggedIn) {
		$("#rreSignIn_"+id).hide();
	}else{
		$("#rreSignIn_"+id).show();
	}
	
};

trackingApp.getReturnReceiptEmail = function(rreDivObj, formIdSplit) {
	
	var data = $("#returnReceiptEmail_"+formIdSplit+ ", .input").serialize();
	
	var buttonOrgText = $("#rreButton_"+formIdSplit).text();
	$("#rreButton_"+formIdSplit).prop("disabled", true);
	$("#rreButton_"+formIdSplit).text("Processing");

	$.ajax({
		url: "/go/TrackConfirmAJAXAction.action",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if(resp.status === true) {
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success").removeClass("hidden");
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error").addClass("hidden");
				$(rreDivObj.selector +" .rrePanalAction").addClass("hidden");
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .responseString").html(resp.responseString);
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .email1").html(resp.tEmail1);
				if(resp.tEmail2){
					$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .email2-div").removeClass("hidden");
					$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .email2").html(resp.tEmail2);
				}
				if(resp.tEmail3){
					$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .email3-div").removeClass("hidden");
					$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success .email3").html(resp.tEmail3);
				}
			} else {
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error").removeClass("hidden");
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success").addClass("hidden");
				$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error .errorMsg").html("An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.");
			}
		},
		error: function(jqXHR, exception) {
			$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error").removeClass("hidden");
			$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.success").addClass("hidden");
			$(rreDivObj.selector +" .panel-actions-content.rre-updates-content.error .errorMsg").html("An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.");
		},
		complete: function(resp) {
			$("#rreButton_"+formIdSplit).prop("disabled", false);
			$("#rreButton_"+formIdSplit).text(buttonOrgText);
        }
	});
};

trackingApp.initDuplicate = function(id) {
	
	//Open 'need more details'
	$('#nd-link_'+id).on('click', function(e){
		e.preventDefault();
		$('#need-details-panel_'+id).removeClass('hide');
		$('#trackConfirmDetailsForm_'+id).validator('update');
	});

	$('#trackConfirmDetailsForm_'+id +' button.submitDuplicate').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var duFormObj = $("#trackConfirmDetailsForm_"+formIdSplit),
		    duDivObj = $("#need-details-panel_"+formIdSplit);	
		
		$(duDivObj.selector +" #errors-details_"+id).addClass('hide');
		$(duDivObj.selector +" #errors-details-msg_"+id).html('');
			
		var hasErrors = duFormObj.validator('validate').has('.has-error').length;
		
		if(this.id.indexOf("zip") != -1) {
			hasErrors = $(duFormObj.selector +' #to-zip_'+id).has('.has-error').length;
		}
		if (!hasErrors) {		
			trackingApp.submitDetailsAjax(duDivObj, formIdSplit, this.id);
		}
	});
	
};

trackingApp.submitDetailsAjax = function(duDivObj, formIdSplit, buttonId) {
	
	var data = $("#trackConfirmDetailsForm_"+formIdSplit+ ", .input").serialize();
	var toggleSubmit = $("#toggle-submit_"+formIdSplit);
	
	var buttonOrgText = $("#"+buttonId).text();
	$("#"+buttonId).prop("disabled", true);
	$("#"+buttonId).text("Processing");
	
	$.ajax({
		url: "/go/TrackConfirmDuplicateDetailsAction",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if((resp.success == 'true') && (resp.mode != 'zip') && (resp.mpdate.length > 0)){
				trackingApp.reSubmitAllLabelsForDuplicateQuery(formIdSplit);
			}else{
				if (toggleSubmit.val() === "0")	{
					toggleSubmit.val("1");
					$(duDivObj.selector +" #tSendDate_"+formIdSplit).val('');
					$(duDivObj.selector +" #to-zip_"+formIdSplit).removeClass('hide');
					$(duDivObj.selector +" #send-date_"+formIdSplit).addClass('hide');
					$("#trackConfirmDetailsForm_"+formIdSplit).validator('update');
				}else{
					trackingApp.reSubmitAllLabelsForDuplicateQuery(formIdSplit);
				}
			}
		},
		error: function(jqXHR, exception) {
			var errMsg = "An error occurred while creating your Online email update. Please try again later.";
			if (jqXHR.status === 0) {
				errMsg = "Not connect.\n Verify Network.";
			} else if (jqXHR.status == 404) {
				errMsg = "Requested page not found. [404]";
			} else if (jqXHR.status == 500) {
				errMsg = "Internal Server Error [500].";
			} else if (exception === 'parsererror') {
				errMsg = "Requested JSON parse failed.";
			} else if (exception === 'timeout') {
				errMsg = "Time out error.";
			} else if (exception === 'abort') {
				errMsg = "Ajax request aborted.";
			} else {
				errMsg = "Uncaught Error.\n" + jqXHR.responseText;
			}
			
			$(duDivObj.selector +" #errors-details_"+formIdSplit).removeClass('hide');
			$(duDivObj.selector +" #errors-details-msg_"+formIdSplit).html(errMsg);
		},
		complete: function(resp) {
			$("#"+buttonId).prop("disabled", false);
			$("#"+buttonId).text(buttonOrgText);
        }
	});
	
};

trackingApp.reSubmitAllLabelsForDuplicateQuery = function(formIdSplit) {
	
	var queryString = $("#trackConfirmDetailsForm_"+formIdSplit+ ", .input").serialize();
	queryString = queryString.replace("qtc_tLabels",'qtc_tLabels1');
	queryString = queryString.replace("qtc_senddate",'qtc_senddate1');
	queryString = queryString.replace("qtc_zipcode",'qtc_zipcode1');

	window.location.href = "/go/TrackConfirmAction_input?" + queryString;		
};

trackingApp.initTrackProofOfDelivery = function(id) {
	
	if(isUserLoggedIn) {
		$("#trackPODSignIn_"+id).hide();
		$("#trackPOD_"+id).show();
	}else{
		$("#trackPODSignIn_"+id).show();
		$("#trackPOD_"+id).hide();
	}
	
	$('#trackPODPanel_'+id +' button.doSignIn').on('click', function(e) {
		e.preventDefault();
		window.location = trackSigninUrl;
	});

	$('#trackPODPanel_'+id +' .add-another-email').on('click', function(e) {
		e.preventDefault();
		trackingApp.addTrackProofEmailBlock(this);
	});

	$('#trackPODPanel_'+id +' button.doTrackPOD').on('click', function(e) {
		e.preventDefault();
		
		var formIdSplit = this.id.split("_")[1];
		var tpodDivObj = $("#trackPODPanel_"+formIdSplit),
			tpodFormObj = $("#trackPOD_"+formIdSplit);		
		
		$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success").addClass("hidden");
		$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error").addClass("hidden");
		
		var hasErrors = tpodFormObj.validator('validate').has('.has-error').length;
		if (!hasErrors) {		
			trackingApp.getTrackProofOfDelivery(tpodDivObj, formIdSplit);
		}
	});
	
};

trackingApp.addTrackProofEmailBlock = function(link) {

	var linkId= $(link).attr("id").split("_")[1],
	    tpodDivObj = $("#trackPODPanel_"+linkId),
	    emailInputList = $(tpodDivObj.selector +" .tpodEmailInput"),
	    tpodEmailNumber = emailInputList.length;
	
	tpodEmailNumber++;
	if (tpodEmailNumber > 3) {
		$(link).hide();
	} else {
		var another_email_row = '<div class="form-group"><label for="trackPOD_emaill' + tpodEmailNumber + '_'+ linkId + '">Email Address</label><input type="email" class="form-control tpodEmailInput" id="trackPOD_email1' + tpodEmailNumber + '_'+ linkId + '" name="tEmail'+ tpodEmailNumber +'" placeholder="email123@mail.com" pattern="^([a-zA-Z0-9_\\-\\.]+)@([a-zA-Z0-9_\\-\\.]+)\.([a-zA-Z]{2,5})$" data-pattern-error="Please enter a valid e-mail address" data-required-error="Please enter your e-mail address"><div class="help-block with-errors"></div></div>';
		$(link).before(another_email_row);
		$('#trackPOD_email' + tpodEmailNumber + '_'+ linkId).focus();
		$("#trackPOD_"+linkId).validator('update');
		if (tpodEmailNumber === 3) {
			$(link).hide();
		}
	}
};

trackingApp.getTrackProofOfDelivery = function(tpodDivObj, formIdSplit) {
	
	var data = $("#trackPOD_"+formIdSplit+ ", .input").serialize();
	
	var buttonOrgText = $("#tpodButton_"+formIdSplit).text();
	$("#tpodButton_"+formIdSplit).prop("disabled", true);
	$("#tpodButton_"+formIdSplit).text("Processing");

	$.ajax({
		url: "/go/TrackConfirmAJAXAction.action",
		type: 	"POST",
		dataType: "json",
		data: data,
		success: function(resp) {
			if(resp.status === true) {
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success").removeClass("hidden");
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error").addClass("hidden");
				$(tpodDivObj.selector +" .tpodPanalAction").addClass("hidden");
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .responseString").html(resp.responseString);
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .email1").html(resp.tEmail1);
				if(resp.tEmail2){
					$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .email2-div").removeClass("hidden");
					$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .email2").html(resp.tEmail2);
				}
				if(resp.tEmail3){
					$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .email3-div").removeClass("hidden");
					$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success .email3").html(resp.tEmail3);
				}
			} else {
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error").removeClass("hidden");
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success").addClass("hidden");
				var errorMessage = "An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.";
				if(resp.responseString != null && resp.responseString.length > 0) {
					errorMessage = resp.responseString;
				}
				$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error .errorMsg").html(errorMessage);
			}
		},
		error: function(jqXHR, exception) {
			$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error").removeClass("hidden");
			$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.success").addClass("hidden");
			$(tpodDivObj.selector +" .panel-actions-content.tpod-updates-content.error .errorMsg").html("An error has occured. Please try your request again.  If the error still occurs, please contact 1-800-ASK-USPS.");
		},
		complete: function(resp) {
			$("#tpodButton_"+formIdSplit).prop("disabled", false);
			$("#tpodButton_"+formIdSplit).text(buttonOrgText);
        }
	});
};


//
	//query string section
	var step_to = trackingApp.getQueryStringParam('step');
	var accordionBlade = trackingApp.getQueryStringParam('panel');
	var allSteps = $(".change-delivery-module");
	if (step_to || accordionBlade) {
		allSteps.each(function(i, step) {
			if ($(step).data().deliverymodule == step_to) {
				$(step).show();
			} else {
				$(step).hide();
			}

		});

		$('.collapser').each(function(i, collapser) {
			if (i == accordionBlade) {
				$(collapser).next().collapse('toggle');
			}
		})
	};

	$.fn.validator.Constructor.INPUT_SELECTOR = ':input:not([type="hidden"], [type="submit"], [type="reset"], button):visible';
	
	$('#trackPackage').validator();
	
	if($('.diPanel') && $('.diPanel').length > 0) {
		$('.diPanel').each(function(i, diPanelBlock) {
			var diIdSplit = $(diPanelBlock).attr('id').split("_")[1];
			$('#changeDeliveryInstructions_'+diIdSplit).validator();
			trackingApp.initDeliveryInstructions(diIdSplit);
		});
	};
	
	if($('.textAndEmailUpdatesPanel') && $('.textAndEmailUpdatesPanel').length > 0) {
		$('.textAndEmailUpdatesPanel').each(function(i, teuPanelBlock) {
			var teuIdSplit = $(teuPanelBlock).attr('id').split("_")[1];
			$('#textAndEmailUpdate_'+teuIdSplit).validator();
			trackingApp.initTextAndEmailUpdates(teuIdSplit);
		});
	};

	if($('.redeliveryPanel') && $('.redeliveryPanel').length > 0) {
		$('.redeliveryPanel').each(function(i, rdPanelBlock) {
			var rdIdSplit = $(rdPanelBlock).attr('id').split("_")[1];
			$('#scheduleRedelivery_'+rdIdSplit).validator();
			trackingApp.initScheduleRedelivery(rdIdSplit);
		});
	};

	if($('.proofOfDeliveryPanel') && $('.proofOfDeliveryPanel').length > 0) {
		$('.proofOfDeliveryPanel').each(function(i, podPanelBlock) {
			var podIdSplit = $(podPanelBlock).attr('id').split("_")[1];
			$('#proofOfDelivery_'+podIdSplit).validator();
			trackingApp.initProofOfDelivery(podIdSplit);
		});
	};
	
	if($('.rrePanel') && $('.rrePanel').length > 0) {
		$('.rrePanel').each(function(i, rrePanelBlock) {
			var rreIdSplit = $(rrePanelBlock).attr('id').split("_")[1];
			$("#returnReceipt_"+rreIdSplit).validator();
			trackingApp.initReturnReceipt(rreIdSplit);
		});
	}

	if($('.duplicatePanel') && $('.duplicatePanel').length > 0) {
		$('.duplicatePanel').each(function(i, duPanelBlock) {
			var duIdSplit = $(duPanelBlock).attr('id').split("_")[1];
			$('#trackConfirmDetailsForm_'+duIdSplit).validator();
			trackingApp.initDuplicate(duIdSplit);
		});
	};
	
	if($('.trackPODPanel') && $('.trackPODPanel').length > 0) {
		$('.trackPODPanel').each(function(i, tpodPanelBlock) {
			var tpodIdSplit = $(tpodPanelBlock).attr('id').split("_")[1];
			$('#trackPODPanel_'+tpodIdSplit).validator();
			trackingApp.initTrackProofOfDelivery(tpodIdSplit);
		});
	};
	

	/************************
	Date picker function
	**************************/

	function removeSunday(date, days) {
		date = moment(date);

		while (days > 0) {
			date = date.add(1, 'days');
			// decrease "days" only if it's not sunday.
			if (date.isoWeekday() !== 7) {
				days -= 1;
			}
		}
		return date;
	}

	function checkCantUse(date, formId) {
		for (var i = 0, max = trackingApp.cantUseArray[formId].length; i < max; i++) {
			if (moment(trackingApp.cantUseArray[formId][i]).isSame(date)) {
				return true;
			}
		}
		return false;
	}
});

/** Add a 'can-touch' class to the HTML tag on touch devices - used to prevent stickyhover states **/
document.addEventListener('touchstart', function addtouchclass(e) { // first time user touches the screen
	document.documentElement.classList.add('can-touch') // add "can-touch" class to document root using classList API
	document.removeEventListener('touchstart', addtouchclass, false) // de-register touchstart event
}, false)
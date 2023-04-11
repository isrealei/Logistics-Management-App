// BEGIN Desktop Common Core
var DesktopMetricsCore = function () {
	this.initialize();
};

DesktopMetricsCore.prototype = {
		
		initialize: function () {
			var self = this;
			//this is intended to provide the one place this code references the dataLayer
			this.pageLandData = dataLayer[0];

			/**
			 * easier outside for reference purposes
			 * base implementations; these may be overridden 
			 */
			this.__stripParams = function(fullPath)
			{
				if ((fullPath != null) && (fullPath.lastIndexOf('?') != -1))
				{
					fullPath = fullPath.substring(0, fullPath.lastIndexOf('?') );
				}
				return fullPath;
			},
			this.getEcomListClickWrapper = function(listName,products){
				return JSON.parse(JSON.stringify(
						{"event":"ecomListClick",
						 "ecommerce":{
							 "click" : {
								 "actionField" : {"list":listName},
								 "products" : products
							 }
						 }}));
			},
			
			this.getTrackInfoFromDataLayer = function(trackNumber) {
				var retData = {};
				trackNumber = trackNumber.trim();
				//will try to steal from dataLayer, but only if i trust it
				if (  typeof self.pageLandData !== "undefined" 
				   && typeof self.pageLandData.ecommerce !== "undefined"
				   && typeof self.pageLandData.ecommerce.impressions !== "undefined") {
					var imp = self.pageLandData.ecommerce.impressions;
					$.each(imp, function(key, value) {
						if (typeof value.id !== "undefined" && value.id.toUpperCase() == trackNumber.toUpperCase()) {
							retData = value;
							return false;
						}
					});
				}
				return retData;
			},
			
			this.TrackClickScript = function(e) {
				var retData = {};
				var products = [];
				var t = {};
				//will try to use tracking number as key
				var clicked = e.target;
				var trackingNumber = $(clicked).closest('div.container-fluid').find('.tracking-number').text();
				if (trackingNumber !== "") {
					t = self.getTrackInfoFromDataLayer(trackingNumber);
					delete t["list"];
				}
				products.push(t);
				retData = self.getEcomListClickWrapper("Tracking Tool Results",products);
				return retData;			
			},
			this.TrackUpdatesAjaxScript = function(settings, event, xhr) {
				// need to find a better selector, possibly update tracking dom b/c this is a bit fragile.
				var data = this.__transformToAssocArray(settings.data);
				var label = data['label'];
				var event = {};
				event  = {'event' : 'availableActions'};
				var atr = {'category': 'USPS Tracking Available Actions', 'action' : 'Text & Email Updates'};
				var opts = [];
				$('form.textAndEmailUpdate input[value="' + label +'"]').parent().find('div[id*="checkbox-wrapper"] div.row').each(function() {
					var thisOpt={};
					var tf = $(this).find('input[type=checkbox].text-updates-label')[0];
					thisOpt['text'] = $(tf).prop('checked')? 1 : 0;
					var ef = $(this).find('input[type=checkbox].email-updates-label')[0];
					thisOpt['email'] = $(ef).prop('checked')? 1 : 0;
					var st = $(ef).closest('div').next().find('span')[0];
					thisOpt['option'] = $(st).prop('innerText');
					if (typeof thisOpt['option'] !== 'undefined' ) {
						opts.push(thisOpt);
					}
				});
				atr['options'] = opts;
				event['attribute']=atr;
				return event;
			},
			
			/*
			 * MAIN map for associating clicks with tealium data
			 * typically overridden by extending object
			 * standard form: "<_stripBasePath() output>" : {"<selector string>" : <JSON to send to Tealium> }
			 *        example: "TrackConfirmAction" : {	"input.schedule" : {"section" : "tracking", "ns_type":  "hidden"}}
			 */
			this.clickLandMap = {
					"ScheduleAPickupAction" : {
						"input[name*=dogAnswer]" : {"section" : "dogalert", "event":"GAeventInteraction"},
					},
					"TrackConfirmAction" : {
						"#tracked-numbers div.track-bar-container a.tracking-result-collapser" : self.TrackClickScript,
						"button.getTextUpdates": {"event": "availableActions",
												   "attribute": {"category": "USPS Tracking Available Actions",
														          "action": "Text Updates"}},
				        "button.getEmailUpdates": {"event": "availableActions",
															   "attribute": {"category": "USPS Tracking Available Actions",
															                 "action": "Email Updates"}},
				        "button.doScheduleRedelivery": {"event": "availableActions",
															   "attribute": {"category": "USPS Tracking Available Actions",
																	          "action": "Schedule Redelivery"}},
				        "button.doProofOfDelivery": {"event": "availableActions",
				        										"attribute": {"category": "USPS Tracking Available Actions",
				        														"action": "Proof of Delivery"}},
				        "button.getReturnReceiptEmail": {"event": "availableActions",
																"attribute": {"category": "USPS Tracking Available Actions",
																				"action": "Return Receipt"}},
				        "button.submitDuplicate": {"event": "availableActions",
																	"attribute": {"category": "USPS Tracking Available Actions",
																					"action": "Duplicate"}},
				        "div.diPanel button.white btn-zip-code-search": {"event": "availableActions",
																	"attribute": {"category": "USPS Tracking Available Actions",
																					"action": "DI Zip Search"}},
				        "div.diPanel button.change-options-btn": {"event": "availableActions",
																	"attribute": {"category": "USPS Tracking Available Actions",
																					"action": "DI Change Options"}},
				        "div.diPanel button.add-to-cart": {"event": "availableActions",
																	"attribute": {"category": "USPS Tracking Available Actions",
																					"action": "DI Add to Cart"}},
				        "div.diPanel button.calculatePrice": {"event": "availableActions",
																		"attribute": {"category": "USPS Tracking Available Actions",
																						"action": "DI Calculate Price"}},
				        "div.diPanel button.continue-delivery": {"event": "availableActions",
																			"attribute": {"category": "USPS Tracking Available Actions",
																							"action": "DI Continue"}}
																				
																				
					},
			},
			this.ajaxCompleteMap = {
					"TrackConfirmAction" : {
						"TrackConfirmRequestUpdateAJAXAction" :  self.TrackUpdatesAjaxScript
						
					},
			},
			this.actionSynonymMap = {
					"ScheduleAPickupAction!input" : "ScheduleAPickupAction"
			},

			/**
			 * easier outside for reference purposes
			 * base implementations; these may be overridden (typically by DesktopMetricsCore, or something like it)
			 */
			this.__stripBasePath = function(fullPath)
			{
				var shortPath = "";
				if ((fullPath != null) && (fullPath.lastIndexOf('/') != -1))
				{
					shortPath = fullPath.substring(fullPath.lastIndexOf('/') + 1);
					//sometimes this is on there, sometimes it isn't - for the same page
					//for our purposes, strip this out to avoid two names
					if ((shortPath != null) && (shortPath.lastIndexOf('.action') != -1))
					{
						shortPath = shortPath.substring(0, shortPath.lastIndexOf('.action'));
					}
					if ((shortPath != null) && (shortPath.lastIndexOf('_') != -1))
					{
						shortPath = shortPath.substring(0, shortPath.lastIndexOf('_'));
					}
				}
				return shortPath;
			},

			this.__transformToAssocArray = function(prmstr) {
				var params = {};
				var prmarr = prmstr.split("&");
				for ( var i = 0; i < prmarr.length; i++) {
					var tmparr = prmarr[i].split("=");
					params[tmparr[0]] = tmparr[1];
				}
				return params;
			},

			this.getSearchParameters = function(prmstr) {
				if (prmstr == null)
				{
					prmstr = window.location.search.substr(1);
				}
				return prmstr != null && prmstr != "" ? this.__transformToAssocArray(prmstr) : {};
			};
			this.bindEvents = function(eventType, eventMap) {
				var self = this;
				var action = this.__stripBasePath(window.location.pathname);

				//sometimes an action is known by several names
				if ((this.actionSynonymMap !== null) && (typeof this.actionSynonymMap !== "undefined" )
						&& (typeof this.actionSynonymMap[action]  !== "undefined"))
				{
					action = this.actionSynonymMap[action];
				}
				var actions = [action];
				for (var i = 0; i < actions.length ; i ++)
				{
					var thisAction = actions[i];
					if (thisAction != null)
					{
						var actionMap = eventMap[actions[i]];
						if (actionMap !== undefined)
						{
							for (var linkKey in actionMap) {
								if (actionMap.hasOwnProperty(linkKey)) {
									var btn = $(linkKey);
									if (btn !== null) {
										var td = actionMap[linkKey];
										$(btn).each(function() {
											$(this).on( eventType, this, handleEvent.bind(self,td));
										});

									};
								};
							};
						};
					};
				}
			};

			this.bindAjaxEvents = function(eventMap) {
				var self = this;
				var action = self.__stripBasePath(window.location.pathname);
				//sometimes an action is known by several names
				if (typeof self.actionSynonymMap !== "undefined" && typeof self.actionSynonymMap[action] !== "undefined")
				{
					action = self.actionSynonymMap[action];
				}
				if (typeof action !== "undefined")
				{
					var ajaxHandler = eventMap[action];
					if (typeof ajaxHandler !== "undefined")
					{
						$( document ).on('ajaxComplete', self, function(event, xhr, settings ) {
							var shortPath = self.__stripBasePath(settings.url);
							shortPath = self.__stripParams(shortPath);
							thisAjaxHandler = ajaxHandler[shortPath];
							if (typeof thisAjaxHandler !== "undefined") {
								var md = thisAjaxHandler.bind(self, settings, event, xhr)();
								if (typeof md === "function") {
									md = md();  			//take that! strongly typed languages :)>
								}
								if (!$.isEmptyObject(md)) {			//allows us to conditionally fire events; no data = no event to send
									handleEvent.bind(self,md, event)();
								}
							}
						});
					}
				};
			};
		}
};
// END Desktop Common Core
// BEGIN GTM Core
var GTMCore = function () {
	this.initialize();
};


//it was important to timing to defer what the click event was actually, that is why this is outside
function handleEvent(data,e) {
	if (this.userEvent !== undefined)
	{
		this.userEvent(data,e);
	}
};

GTMCore.prototype = {
		initialize: function () {

			this.userEvent = function(labels, e) {
				if (typeof dataLayer !== "undefined")
				{
					if (labels !== null && labels !== undefined) {
						if (typeof labels == "function") labels = labels(e);
						if (labels !== null && labels !== undefined) {
							dataLayer.push(labels);
						}
					} 
				}
			};
		}
};
//END GTM Core

$(document).ready(function() {
	var dmc = new DesktopMetricsCore();	
	var gtmc = new GTMCore();
	// override DesktopMetricsCore  functions/data with  GTMCore
	$.extend(dmc, gtmc);
	dmc.bindEvents("click", dmc.clickLandMap);
	dmc.bindAjaxEvents(dmc.ajaxCompleteMap);
});
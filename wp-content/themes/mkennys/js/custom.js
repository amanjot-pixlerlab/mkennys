var getUrl = window.location;
if (getUrl.pathname.split('/')[1] == 'dev') {
	var path = getUrl.protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1] + "/";
}
else {
	var path = getUrl.protocol + "//" + getUrl.host + "/";
}
//var path = getUrl .protocol + "//" + getUrl.host + "/" + getUrl.pathname.split('/')[1]+"/";
//alert(path);
//jQuery.noConflict();
jQuery(document).ready(function (e) {

	jQuery.ajaxSetup({ cache: false });
	eventFlag = true;
	zoneFlag = true;
	pageLoadCounter = 0;

	jQuery("#show_date").hide();
	jQuery("#show_time").hide();
	//alert("Higgg");
	jQuery("a.view_desc").click(function (e) {
		if (!jQuery(this).hasClass("active")) {
			jQuery(this).addClass("active");
			jQuery(this).next(".pri_desc").slideDown(200);
			return false
		} else if (jQuery(this).hasClass("active")) {
			jQuery(this).removeClass("active");
			jQuery(this).next(".pri_desc").slideUp(200);
			return false
		}
	});
	jQuery(".filters a").click(function () {
		jQuery(".filters a").removeClass("active");
		jQuery(this).addClass("active")
	});
	jQuery(".all_content li a").click(function () {
		jQuery(".all_content li a").removeClass("active");
		jQuery(this).addClass("active");
		if (jQuery(this).attr("data-name")) {
			jQuery(".style_name").text(jQuery(this).attr("data-name"))
		}
	});
	jQuery(".footer h6, .contact_details h6").click(function () {
		jQuery(this).next("ul").toggleClass("active")
	})
});
jQuery(document).ready(function () {
	function t() {
		var e = 0;
		jQuery(".crousal li").each(function () {
			e += jQuery(this).outerWidth()
		});
		jQuery(".crousal").width(e)
	}

	function n(e, t) {
		this.selector = e;
		this.obj = jQuery(e);
		this.alwaysPrevent = t;
		this.bindSubmit()
	}
	jQuery(".cform_validation").validationEngine("attach", {
		scroll: false,
		onValidationComplete: function (e, t) {
			if (t) {
				jQuery("#mail_loader").show();
				jQuery("#csubmit").attr("disabled", "disabled");
				if (jQuery("#feedback").is(":checked")) {
					var n = "feedback"
				} else {
					var n = ""
				}
				var r = jQuery("#first_name").val();
				var i = jQuery("#last_name").val();
				var s = jQuery("#primary_contact").val();
				var o = jQuery("#alter_contact").val();
				var u = jQuery("#best_time_reached").val();
				var a = jQuery("#cemail").val();
				var f = jQuery("#address").val();
				var l = jQuery("#city").val();
				var c = jQuery("#cstate").val();
				var h = jQuery("#message").val();
				jQuery(".rresult").html('Please wait...').show();
				jQuery.post("contact_process.php", {
					feedback: n,
					first_name: r,
					last_name: i,
					primary_contact: s,
					alter_contact: o,
					best_time_reached: u,
					email: a,
					address: f,
					city: l,
					state: c,
					message: h
				}, function (e) {
					jQuery("#mail_loader").hide();
					_gaq.push(['_trackEvent', 'ContactUs', 'ContactUsClicked']);

					jQuery("#csubmit").removeAttr("disabled");
					jQuery("#cresult").html(e).show();
					jQuery(".cform_validation").each(function () {
						this.reset()
					})
				})
			}
		}
	});
	jQuery(".creset").click(function () {
		//jQuery(this).parents("form")[0].reset();
		jQuery("#safirst_name").val('');
		jQuery("#salast_name").val('');
		jQuery("#saphone").val('');
		jQuery("#saemail").val('');
		jQuery("#samessage").val('');
		jQuery("#captcha_code").val('');
		jQuery(".check").removeAttr('checked');
		jQuery(this).parents("form").find(".cv_error").remove()
	});
	key = 0;
	jQuery(".main_menu li").hover(function (e) {
		hover = true
	}, function () {
		if (hover == true) {
			obj = jQuery(this).find(".sub_menu");
			obj.css("display", "block");
			clearTimeout(key);
			key = setTimeout(function () {
				obj.fadeOut(function () {
					jQuery(this).removeAttr("style")
				})
			}, 1e3)
		}
	});
	jQuery(".single_content p input, .gall-trigger2").click(function () {
		var e = jQuery(this).attr("data");
		jQuery("#sastate").val(e);
		jQuery(".popup_overlay2").fadeIn()
	});
	jQuery(".close_btn a").click(function () {
		// clear list and re-init the states dropdown
		jQuery(".demo").fSelect('destroy');
		var elements = document.getElementById("sastate").options;
		for (var i = 0; i < elements.length; i++) {
			elements[i].selected = false;
		}
		jQuery(".demo").fSelect('create');
		jQuery(".app_form_validation").each(function () {
			this.reset();
			jQuery(".rresult").hide();
		});
		jQuery(".close_btn a").parents(".popup_overlay2").fadeOut();
		return false
	});
	jQuery(".single_content p input, .gall-trigger").click(function () {

		var e = jQuery(this).attr("data");
		if (e) {
			jQuery("#sastate").val(e);
			e = e.toLowerCase();
			location.hash = e;
			document.getElementById('date').removeAttribute('disabled');
			document.getElementById('time').removeAttribute('disabled');
		}
		jQuery(".popup_overlay").fadeIn();

	});
	jQuery(".close_btn a").click(function () {
		jQuery(".app_form_validation").each(function () {
			this.reset();
			jQuery(".rresult").hide();
		});
		jQuery(".close_btn a").parents(".popup_overlay").fadeOut();
		return false
	});
	var e = {
		width: 0,
		selector: ".crousal",
		item_width: 0,
		margin: 10,
		init: function () {
			var e = 0;
			var t = 10;
			jQuery(this.selector).find("li").each(function () {
				e += jQuery(this).outerWidth() + t
			});
			this.width = e;
			this.item_width = jQuery(this.selector).find("li").outerWidth() + t;
			jQuery(this.selector).width(this.width)
		},
		next: function () {
			var e = parseInt(jQuery(".crousal").css("left"));
			var t = this.width - Math.abs(e) - jQuery(window).width();
			var n = this.item_width;
			if (t < this.item_width + 50) {
				n = t
			}
			jQuery(".crousal").stop().animate({
				left: e - n + "px"
			})
		},
		prev: function () {
			var e = parseInt(jQuery(".crousal").css("left"));
			var t = Math.abs(e);
			var n = this.item_width;
			if (t < this.item_width + 50) {
				n = t
			}
			jQuery(".crousal").stop().animate({
				left: e + n + "px"
			})
		}
	};
	jQuery(document).ready(function (t) {
		jQuery(".gall-trigger").click(function () {
			e.init()
		});
		jQuery(".next").click(function () {
			e.next()
		});
		jQuery(".prev").click(function () {
			e.prev()
		})
	});
	jQuery(".filters a").click(function (e) {
		tp = 0;
		obj = jQuery(jQuery(this).attr("href"));
		jQuery("#scrollbar2 .viewport").scrollTop(0);
		tp = obj.position().top;
		if (scrollbar2) {
			scrollbar2.tinyscrollbar_update(tp)
		}
		e.preventDefault()
	});
	n.prototype.submitFunc = function () { };
	n.prototype.bindSubmit = function () {
		var e = this;
		jQuery(this.selector).submit(function (t) {
			var n = false;
			jQuery(this).find(".cv_error").remove();
			jQuery(this).find(".cv_required").each(function (e, t) {
				if (jQuery(this).val() == "") {
					var r = jQuery(this);
					var i = r.outerHeight() - parseInt(r.css("border-top-width")) * 2;
					i += "px";
					jQuery("<span class='cv_error'>Required Field!</span>").css({
						left: r.position().left,
						top: r.position().top,
						height: i,
						"margin-top": r.css("border-top-width"),
						"line-height": i
					}).insertAfter(jQuery(this)).click(function () {
						jQuery(this).remove();
						r.focus()
					});
					n = true;
					r.unbind("click").bind("click", function () {
						jQuery(this).next(".cv_error").remove()
					});
					r.unbind("focus").bind("focus", function () {
						jQuery(this).next(".cv_error").remove()
					})
				}
			});
			jQuery(this).find(".cv_number").each(function (e, t) {
				var r = /^[0-9]+$/;
				if (!jQuery(this).val().match(r)) {
					var i = jQuery(this);
					var s = i.outerHeight() - parseInt(i.css("border-top-width")) * 2;
					s += "px";
					jQuery("<span class='cv_error'>Invalid Number!</span>").css({
						left: i.position().left,
						top: i.position().top,
						height: s,
						"margin-top": i.css("border-top-width"),
						"line-height": s
					}).insertAfter(jQuery(this)).click(function () {
						jQuery(this).remove();
						i.focus()
					});
					n = true;
					i.unbind("click").bind("click", function () {
						jQuery(this).next(".cv_error").remove()
					});
					i.unbind("focus").bind("focus", function () {
						jQuery(this).next(".cv_error").remove()
					})
				}
			});
			jQuery(this).find(".cv_email").each(function (e, t) {
				var r = /^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i;
				if (!jQuery(this).val().match(r)) {
					var i = jQuery(this);
					var s = i.outerHeight() - parseInt(i.css("border-top-width")) * 2;
					s += "px";
					jQuery("<span class='cv_error'>Invalid Email Address!</span>").css({
						left: i.position().left,
						top: i.position().top,
						height: s,
						"margin-top": i.css("border-top-width"),
						"line-height": s
					}).insertAfter(jQuery(this)).click(function () {
						jQuery(this).remove();
						i.focus()
					});
					n = true;
					i.unbind("click").bind("click", function () {
						jQuery(this).next(".cv_error").remove()
					});
					i.unbind("focus").bind("focus", function () {
						jQuery(this).next(".cv_error").remove()
					})
				}
			});
			if (n) {
				t.preventDefault()
			} else {
				e.obj = jQuery(this);
				e.submitFunc()
			} if (e.alwaysPrevent) {
				t.preventDefault()
			}
		})
	};

	//var path='http://localhost/mkennys/';
	newsletter = new n(".newsletter-form", true);
	newsletter.submitFunc = function () {


		var e = this.obj.find("#nname").val();
		var t = this.obj.find(".cv_email").val();
		var n = this.obj.find("#map_state").val();
		jQuery(".rresult").html('Please wait...').show();
		jQuery.ajax({
			type: 'POST',
			url: path + 'newsletter_process.php',
			data: 'name=' + e + '&email=' + t + '&map_state=' + n,
			success: function (html) {
				jQuery('.hideOnSent').hide();
				jQuery(".rresult").html(html).show();
				jQuery(".rresult").show();
				jQuery(".newsletter-form").each(function () {
					this.reset();
				});

			}
		});



	};

	cp_form = new n(".cp_form", true);
	cp_form.submitFunc = function () {
		var n = this.obj.find("#ip_name").val();
		// alert(n); return false;
		var s = this.obj.find(".ip_state").val();
		var e = this.obj.find(".cv_email").val();
		jQuery(".ip_result").html('Please wait...').show();
		jQuery.post("ip_popup_process.php", {
			name: n,
			email: e,
			state: s
		}, function (e) {
			setTimeout(function () { jQuery('.cookie_popup').hide(); }, 3000);
			jQuery("#mail_loader").hide();
			jQuery(".ip_result").html(e).show();
			jQuery(".ip_result").fadeOut(8000);
			_gaq.push(['_trackEvent', 'PopupSubscribe', 'PopupSubscribeClicked']);

			jQuery(".cp_form").each(function () {
				this.reset()
			})
		})
	};









	jQuery(".interested  input:checkbox").change(function () {
		var e = "";
		e = jQuery(".interested  input:checkbox").map(function (e) {
			if (this.checked) {
				return this.value
			}
		}).get().join(", ");
		console.log(e);
		jQuery("#sinterested").val(e)
	});









	/*	 
	jQuery("#sastate").change(function () {
		 
      var state_id = jQuery(this).val();
	  //jQuery("#datess").val('');
	  jQuery("#show_date").show();
		 if(state_id){
			 alert("Here");
            jQuery.ajax({
                type:'POST',
                url:path+'ajax_date.php',
                data:'state_id='+state_id,
				dataType: 'json',
                success:function(html){	
				var enableDays='';
                 //alert(html.dates[0]);
				   jQuery("#show_date").hide();
					 enableDays = html.dates;
					jQuery('#datess').datepicker("destroy");
					function enableAllTheseDays(date){
						//alert(date);
						var sdate = jQuery.datepicker.formatDate( 'mm/dd/yy', date)
						//console.log(sdate)
						if(jQuery.inArray(sdate, enableDays) != -1) {
							return [true];
						}
						return [false];
					}    
					jQuery('#datess').datepicker({
						
							dateFormat: 'mm/dd/yy',
							setDate:enableDays['0'], 
							beforeShowDay:enableAllTheseDays,
							onSelect: function(selecteddate) {
										var stateId = jQuery("#sastate").val(); 
										 jQuery("#show_time").show();
										  jQuery("#time").val('');
								
									  jQuery.ajax({
												type:'POST',
												url:path+'ajax_time.php',
												data:'appointmentTime='+selecteddate+'&stateid='+stateId,				
											success:function(html){
												 jQuery("#show_time").hide();
												jQuery('#time').html(html);
											}
										});
									 
							}
					}).datepicker("setDate", enableDays['0']);;
					
					
				}	
				
			}); 
			
        }else{
            jQuery('#datess').html(''); 
        }
    });
	
	*/











	jQuery(".app_form_validation").submit(function (e) {





		var t = jQuery("#date").val();
		if (t == '') {
			// return false;
			e.preventDefault();
			jQuery("#date").css("border", "1px solid #993300");
			jQuery("#sa_submit").attr("disabled", "disabled");
		}
		else {
			jQuery("#date").css("border", "1px solid #D6D6D6");
			jQuery("#sa_submit").removeAttr("disabled");
		}



	});

	appointment = new n(".app_form_validation", true);
	appointment.submitFunc = function () {

		//jQuery(".appointment_result").html("Please Wait...");



		jQuery("#show_date").show();

		var data = jQuery("#app_form_validation").serialize();
		jQuery("body").data('appointmentDetails', data);

		jQuery.ajax({
			type: "POST",
			url: path + "schedule_appointment.php",
			data: data,
		}).done(function (msg) {
			jQuery("#show_date").hide();
			msg = jQuery.parseJSON(msg);
			ts_title = msg['title'];
			ts_location = msg['location'];
			ts_start_date = msg['datess'];
			ts_start_hour = msg['hour'];
			ts_start_min = msg['min'];

			ts_end_date = msg['datess'];
			ts_end_hour = msg['end_hour'];
			ts_end_min = msg['end_min'];

			ts_event_time_format = msg['g_timeFormat'];





			if (msg['msg'] == "error") {
				jQuery("#captcha").html("<span style='color:red'>Please enter the correct answer to verify submission</span>");
			} else {

				jQuery(".popup_overlay").css('display', 'none');
				jQuery(".popup_overlay2").css('display', 'none');
				//jQuery("#responsecontainer").load(path+'tour-schedule');	
				//location.reload();					
				jQuery("#rcData").html(msg['succMsg']);
				jQuery(".popup_overlay3").fadeIn();


				jQuery(".app_form_validation").each(function () {
					this.reset()
				})
			}

		})



	}
});
var screenWidth = window.screen.width;
var screenHeight = window.screen.height;
if (screenWidth >= 768 || screenHeight >= 1024) {
	jQuery("#mp-menu").hide()
}

/* clicked on Get Fitted then Values selected Automatically  */
var event_id = '';

jQuery(document).ready(function () {
	//var path='http://localhost/mkennys/';	
	jQuery(document).on('click', 'a.gall-trigger,.fc-content', function () {

		pageLoadCounter = 0;
		eventFlag = true;
		zoneFlag = true;
		state_id = '';
		appId = '';
		bookedDate = '';

		//alert(jQuery(this).attr('class'));

		if (jQuery(this).hasClass('fc-content')) {
			//alert('pp');
			/*This is appid code*/
			appId = jQuery(this).attr('alt');
			bookedDate = jQuery(this).attr('rel');

		}

		event_id = jQuery(this).attr('id');
		var appointment_date = jQuery(this).attr('rel');
		jQuery.ajax({
			type: "POST",
			url: path + "before_appointment_process.php",
			data: 'state_id=' + state_id + '&event_id=' + event_id + '&appId=' + appId + '&bookedDate=' + bookedDate,
			dataType: 'json',
			beforeSend: function () {
				jQuery("#show_date").show();
			},
			success: function (appointment_data) {
				// alert(appointment_data.stateID);						
				jQuery('#state_zone').show();

				jQuery('#sastate').html(appointment_data.multiStateDropDown);
				jQuery('.demo').fSelect('destroy');
				jQuery('.demo').fSelect('create');
				jQuery('#state_zone').html('');
				jQuery('#city_name').html('');
				if (appointment_data.stateZone == "multiStateWithoutZone") {
					jQuery('#state_zone').hide();
				}

				jQuery('#state_zone').html(appointment_data.stateZone);

				var stateZone = appointment_data.stateZone;


				if (stateZone[0] == "" || stateZone[0] == "0" || stateZone[0] == '<option value="">Not Available</option>') {

					jQuery('#state_zone').hide();
				}

				jQuery('#city_name').html(appointment_data.city);

				enableDays = appointment_data.dates;

				//jQuery('#datess').datepicker("destroy");
				function enableAllTheseDays(date) {
					//alert(date);
					var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date)
					//console.log(sdate)
					if (jQuery.inArray(sdate, enableDays) != -1) {
						return [true];
					}
					return [false];
				}
				//alert(enableDays['0']);
				var ajaxEventTimeFlag = false;

				jQuery('#datess').datepicker({
					showButtonPanel: true,
					closeText: "Close",
					dateFormat: 'mm/dd/yy',
					setDate: enableDays['0'],
					beforeShowDay: enableAllTheseDays,
					onSelect: function (selecteddate) {
						//jQuery("#show_date").show();
						var eventId = event_id;
						ajaxEventTimeFlag = true;
						jQuery.ajax({
							type: 'POST',
							url: path + 'ajax_time_event.php',
							data: 'appointmentTime=' + selecteddate + '&eventId=' + eventId + '&appId=' + appId,
							beforeSend: function () {
								jQuery("#show_date").show();
							},
							success: function (html) {
								jQuery("#show_date").hide();
								jQuery('#time').html(html);
							}
						});
					}
				}).datepicker("setDate", enableDays['0']);
				jQuery('.ui-datepicker-current-day').click();


				if (ajaxEventTimeFlag == false) {
					var eventId = event_id;
					selecteddate = enableDays['0'];

					if (appId) {
						selecteddate = jQuery("#app_booked_date").val();
					}

					jQuery.ajax({
						type: 'POST',
						url: path + 'ajax_time_event.php',
						data: 'appointmentTime=' + selecteddate + '&eventId=' + eventId + '&appId=' + appId,
						beforeSend: function () {
							jQuery("#show_date").show();
						},
						success: function (html) {
							jQuery("#show_date").hide();
							jQuery('#time').html(html);
						}
					});
				}
				//event_id = "";
			},
			error: function (appointment_data) { // if error occured
				//alert("Error occured.please try again");        
				//jQuery(placeholder).removeClass('loading');
			},

			complete: function () {
				//jQuery("#show_date").hide();
			}
		});
	});


	jQuery("#sastate").change(function () {



		if (pageLoadCounter > 0) {


			var state_id = jQuery(this).val();
			jQuery("#show_date").show();
			jQuery("#state_zone").show();

			var countState = jQuery('#sastate :selected').length;
			if (countState == '1') {
				jQuery("#show_date").show();
				if (state_id) {

					jQuery.ajax({
						type: 'POST',
						url: path + 'ajax_date.php',
						data: 'state_id=' + state_id,
						dataType: 'json',

						beforeSend: function () {
							jQuery("#show_date").show();
						},
						success: function (html) {
							jQuery("#time").html('');
							jQuery('#city_name').html('');
							jQuery("#state_zone").html('');
							// jQuery("#datess").val('');
							jQuery('#datess').datepicker("destroy");

							jQuery('#state_zone').show();
							jQuery('#state_zone').attr('disabled', false);
							jQuery("#state_zone").html(html.stateZone);
							var stateZone = html.stateZone;
							if (stateZone[0] == "" || stateZone[0] == "0" || stateZone[0] == '<option value="">Not Available</option>') {
								jQuery('#state_zone').hide();
							}
							jQuery('#city_name').html(html.city);
							//console.log(html.times);		
							jQuery('#time').html(html.times);





							var enableDays = '';
							//alert(html.dates[0]);
							jQuery("#show_date").hide();
							enableDays = html.dates;
							function enableAllTheseDays(date) {
								//alert(date);
								var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date)
								//console.log(sdate)
								if (jQuery.inArray(sdate, enableDays) != -1) {
									return [true];
								}
								return [false];
							}
							var ajaxEventTimeFlag = false;
							jQuery('#datess').datepicker({
								showButtonPanel: true,
								closeText: "Close",
								dateFormat: 'mm/dd/yy',
								setDate: enableDays['0'],
								beforeShowDay: enableAllTheseDays,
								onSelect: function (selecteddate) {
									ajaxEventTimeFlag = true;
									var stateId = jQuery("#sastate").val();
									var eventId = jQuery("#city_name").val();
									jQuery("#time").val('');
									jQuery("#show_date").show();

									jQuery.ajax({
										type: 'POST',
										url: path + 'ajax_time.php',
										data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
										beforeSend: function () {
											jQuery("#show_time").show();
										},
										success: function (html) {
											jQuery("#show_date").hide();
											jQuery('#time').html(html);
										},
										error: function (appointment_data) { // if error occured
											//alert("Error occured.please try again");        
											//jQuery(placeholder).removeClass('loading');
										},
										complete: function () {
											jQuery("#show_time").hide();
										}
									});

								}
							}).datepicker("setDate", enableDays['0']);
							jQuery('.ui-datepicker-current-day').click();

							if (ajaxEventTimeFlag == false) {
								selecteddate = enableDays['0'];
								var stateId = jQuery("#sastate").val();
								var eventId = jQuery("#city_name").val();
								jQuery.ajax({
									type: 'POST',
									url: path + 'ajax_time.php',
									data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
									beforeSend: function () {
										jQuery("#show_time").show();
									},
									success: function (html) {
										jQuery("#show_date").hide();
										jQuery('#time').html(html);
									},
									error: function (appointment_data) { // if error occured
										//alert("Error occured.please try again");        
										//jQuery(placeholder).removeClass('loading');
									},
									complete: function () {
										jQuery("#show_time").hide();
									}
								});


							}
							if (JSON.stringify(html.city) === JSON.stringify([""])) {

								jQuery("#state_zone").html('<option value="">N/A</option>');
								jQuery("#city_name").html('<option value="">N/A</option>');
								jQuery("#datess").val('N/A');
								jQuery("#time").html('<option value="">N/A</option>');
								jQuery("#show_date").hide();


							}


							if (html.city === null) {

								jQuery("#state_zone").html('<option value="">N/A</option>');
								jQuery("#city_name").html('<option value="">N/A</option>');
								jQuery("#datess").val('N/A');
								jQuery("#time").html('<option value="">N/A</option>');
								jQuery("#show_date").hide();


							}



						},

						error: function (appointment_data) { // if error occured
							//alert("Error occured.please try again");        
							//jQuery(placeholder).removeClass('loading');
						},

						complete: function () {
							jQuery("#show_date").hide();
						}




					});

				}

			}

			if (countState > 1) {
				jQuery("#state_zone").html('');
				jQuery("#state_zone").hide();


				var state_id = jQuery(this).val();
				jQuery("#show_date").show();
				if (state_id) {

					jQuery.ajax({
						type: 'POST',
						url: path + 'ajax_multiselect.php',
						data: 'state_id=' + state_id,
						dataType: 'json',

						beforeSend: function () {
							jQuery("#show_date").show();
						},
						success: function (html) {
							jQuery("#time").html('');
							jQuery('#city_name').html('');
							jQuery("#state_zone").html('');
							// jQuery("#datess").val('');
							jQuery('#datess').datepicker("destroy");

							jQuery('#state_zone').hide();
							jQuery('#state_zone').attr('disabled', false);
							jQuery('#city_name').html(html.city);
							jQuery('#time').html(html.times);





							var enableDays = '';
							//alert(html.dates[0]);
							jQuery("#show_date").hide();
							enableDays = html.dates;
							function enableAllTheseDays(date) {
								//alert(date);
								var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date)
								//console.log(sdate)
								if (jQuery.inArray(sdate, enableDays) != -1) {
									return [true];
								}
								return [false];
							}
							var ajaxEventTimeFlag = false;
							jQuery('#datess').datepicker({
								showButtonPanel: true,
								closeText: "Close",
								dateFormat: 'mm/dd/yy',
								setDate: enableDays['0'],
								beforeShowDay: enableAllTheseDays,
								onSelect: function (selecteddate) {
									ajaxEventTimeFlag = true;
									var stateId = jQuery("#sastate").val();
									var eventId = jQuery("#city_name").val();
									jQuery("#time").val('');
									jQuery("#show_date").show();

									jQuery.ajax({
										type: 'POST',
										url: path + 'ajax_time.php',
										data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
										beforeSend: function () {
											jQuery("#show_time").show();
										},
										success: function (html) {
											jQuery("#show_date").hide();
											jQuery('#time').html(html);




										},
										error: function (appointment_data) { // if error occured
											//alert("Error occured.please try again");        
											//jQuery(placeholder).removeClass('loading');
										},
										complete: function () {
											jQuery("#show_time").hide();
										}
									});

								}
							}).datepicker("setDate", enableDays['0']);
							jQuery('.ui-datepicker-current-day').click();

							if (ajaxEventTimeFlag == false) {
								selecteddate = enableDays['0'];
								var stateId = jQuery("#sastate").val();
								var eventId = jQuery("#city_name").val();
								jQuery("#time").val('');
								jQuery("#show_date").show();

								jQuery.ajax({
									type: 'POST',
									url: path + 'ajax_time.php',
									data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
									beforeSend: function () {
										jQuery("#show_time").show();
									},
									success: function (html) {
										jQuery("#show_date").hide();
										jQuery('#time').html(html);




									},
									error: function (appointment_data) { // if error occured
										//alert("Error occured.please try again");        
										//jQuery(placeholder).removeClass('loading');
									},
									complete: function () {
										jQuery("#show_time").hide();
									}
								});


							}

							var citySuc = html.city;
							if (typeof (citySuc[0]) === "undefined") {
								jQuery("#city_name").html('<option value="">N/A</option>');
							}

							var datesSuc = html.dates;
							if (typeof (datesSuc[0]) === "undefined") {
								jQuery("#datess").val('N/A');
							}

							var timesSuc = html.times;
							if (typeof (timesSuc[0]) === "undefined") {
								jQuery("#time").html('<option value="">N/A</option>');
							}


						},

						error: function (appointment_data) { // if error occured
							//alert("Error occured.please try again");        
							//jQuery(placeholder).removeClass('loading');
						},

						complete: function () {
							jQuery("#show_date").hide();
						}




					});

				}




			}


			if (countState == '0') {

				jQuery("#state_zone").html('<option value="">N/A</option>');
				jQuery("#city_name").html('<option value="">N/A</option>');
				jQuery("#datess").val('N/A');
				jQuery("#time").html('<option value="">N/A</option>');
				jQuery("#show_date").hide();


			}


		}

		pageLoadCounter++;



	});






	/* zone ajax code */
	jQuery("#state_zone").change(function () {

		//alert("Here");

		//if(pageLoadCounter > 1){

		var zoneId = jQuery(this).val();
		// alert(zoneId);
		var state_id = jQuery("#sastate").val();

		if (zoneId != '') {

			jQuery.ajax({
				type: 'POST',
				url: path + 'ajax_zone.php',
				data: 'zoneId=' + zoneId + '&state_id=' + state_id,
				dataType: 'json',
				beforeSend: function () {
					jQuery("#show_date").show();
				},
				success: function (html) {
					jQuery("#show_date").show();
					jQuery("#time").html('');
					jQuery('#city_name').html('');
					jQuery('#datess').datepicker("destroy");
					jQuery('#city_name').html(html.city);
					jQuery('#time').html(html.times);

					var enableDays = '';
					//alert(html.dates[0]);
					jQuery("#show_date").hide();
					enableDays = html.dates;
					function enableAllTheseDays(date) {
						//alert(date);
						var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date)
						//console.log(sdate)
						if (jQuery.inArray(sdate, enableDays) != -1) {
							return [true];
						}
						return [false];
					}
					var ajaxEventTimeFlag = false;
					jQuery('#datess').datepicker({
						showButtonPanel: true,
						closeText: "Close",
						dateFormat: 'mm/dd/yy',
						setDate: enableDays['0'],
						beforeShowDay: enableAllTheseDays,
						onSelect: function (selecteddate) {
							ajaxEventTimeFlag = true;
							var stateId = jQuery("#sastate").val();
							var eventId = jQuery("#city_name").val();
							jQuery("#time").val('');
							jQuery("#show_date").show();

							jQuery.ajax({
								type: 'POST',
								url: path + 'ajax_time.php',
								data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
								beforeSend: function () {
									jQuery("#show_time").show();
								},
								success: function (html) {
									jQuery("#show_date").hide();
									jQuery('#time').html(html);
								},
								error: function (appointment_data) { // if error occured
									//alert("Error occured.please try again");        
									//jQuery(placeholder).removeClass('loading');
								},
								complete: function () {
									jQuery("#show_time").hide();
								}
							});

						}
					}).datepicker("setDate", enableDays['0']);
					jQuery('.ui-datepicker-current-day').click();

					if (ajaxEventTimeFlag == false) {
						selecteddate = enableDays['0'];
						var stateId = jQuery("#sastate").val();
						var eventId = jQuery("#city_name").val();
						jQuery("#time").val('');
						jQuery("#show_date").show();

						jQuery.ajax({
							type: 'POST',
							url: path + 'ajax_time.php',
							data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
							beforeSend: function () {
								jQuery("#show_time").show();
							},
							success: function (html) {
								jQuery("#show_date").hide();
								jQuery('#time').html(html);
							},
							error: function (appointment_data) { // if error occured
								//alert("Error occured.please try again");        
								//jQuery(placeholder).removeClass('loading');
							},
							complete: function () {
								jQuery("#show_time").hide();
							}
						});
					}
					if (JSON.stringify(html.city) === JSON.stringify([""])) {

						jQuery("#city_name").html('<option value="">N/A</option>');
						jQuery("#datess").val('N/A');
						jQuery("#time").html('<option value="">N/A</option>');
						jQuery("#show_date").hide();
					}
					if (html.city === null) {

						jQuery("#city_name").html('<option value="">N/A</option>');
						jQuery("#datess").val('N/A');
						jQuery("#time").html('<option value="">N/A</option>');
						jQuery("#show_date").hide();
					}


				},

				error: function (appointment_data) { // if error occured
					//alert("Error occured.please try again");        
					//jQuery(placeholder).removeClass('loading');
				},

				complete: function () {
					jQuery("#show_date").hide();
				}




			});


		}

		if (zoneId == '') {

			jQuery("#city_name").html('<option value="">N/A</option>');
			jQuery("#datess").val('N/A');
			jQuery("#time").html('<option value="">N/A</option>');
			//jQuery("#show_date").hide();

		}

		//}

	});
	/* #zone ajax code */

	/* city ajax code */
	jQuery("#city_name").change(function () {




		var cityId = jQuery(this).val();
		var zoneId = jQuery("#state_zone").val();
		var state_id = jQuery("#sastate").val();

		if (cityId != '') {

			jQuery.ajax({
				type: 'POST',
				url: path + 'ajax_city.php',
				data: 'zoneId=' + zoneId + '&state_id=' + state_id + '&cityId=' + cityId,
				dataType: 'json',
				beforeSend: function () {
					jQuery("#show_date").show();
				},
				success: function (html) {
					jQuery("#time").html('');
					jQuery('#datess').datepicker("destroy");
					jQuery('#time').html(html.times);

					var enableDays = '';
					//alert(html.dates[0]);
					jQuery("#show_date").hide();
					enableDays = html.dates;
					function enableAllTheseDays(date) {
						//alert(date);
						var sdate = jQuery.datepicker.formatDate('mm/dd/yy', date)
						//console.log(sdate)
						if (jQuery.inArray(sdate, enableDays) != -1) {
							return [true];
						}
						return [false];
					}
					var ajaxEventTimeFlag = false;
					jQuery('#datess').datepicker({
						showButtonPanel: true,
						closeText: "Close",
						dateFormat: 'mm/dd/yy',
						setDate: enableDays['0'],
						beforeShowDay: enableAllTheseDays,
						onSelect: function (selecteddate) {
							ajaxEventTimeFlag = true;
							var stateId = jQuery("#sastate").val();
							var eventId = jQuery("#city_name").val();
							jQuery("#time").val('');

							jQuery.ajax({
								type: 'POST',
								url: path + 'ajax_time.php',
								data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
								beforeSend: function () {
									jQuery("#show_time").show();
								},
								success: function (html) {
									jQuery('#time').html(html);
								},
								error: function (appointment_data) { // if error occured
									//alert("Error occured.please try again");        
									//jQuery(placeholder).removeClass('loading');
								},
								complete: function () {
									jQuery("#show_time").hide();
								}
							});

						}
					}).datepicker("setDate", enableDays['0']);
					jQuery('.ui-datepicker-current-day').click();

					if (ajaxEventTimeFlag == false) {
						selecteddate = enableDays['0'];
						var stateId = jQuery("#sastate").val();
						var eventId = jQuery("#city_name").val();
						jQuery("#time").val('');

						jQuery.ajax({
							type: 'POST',
							url: path + 'ajax_time.php',
							data: 'appointmentTime=' + selecteddate + '&stateId=' + stateId + '&eventId=' + eventId,
							beforeSend: function () {
								jQuery("#show_time").show();
							},
							success: function (html) {

								jQuery('#time').html(html);
							},
							error: function (appointment_data) { // if error occured
								alert("Error occured.please try again");
								//jQuery(placeholder).removeClass('loading');
							},
							complete: function () {
								jQuery("#show_time").hide();
							}
						});
					}

				},

				error: function (appointment_data) { // if error occured
					alert("Error occured.please try again");
					//jQuery(placeholder).removeClass('loading');
				},

				complete: function () {
					jQuery("#show_date").hide();
				}

			});

		}



	});
	/* #city ajax code */




});


jQuery(document).ready(function () {

	jQuery(document).on('click', '.close_btn', function () {
		location.reload();
	});

	jQuery(".close_btn a").click(function () {
		jQuery(".close_btn a").parents(".popup_overlay3").fadeOut();
	});

});


jQuery(document).ready(function () {
	var hash = location.hash;
	hash = hash.replace('#', '');
	jQuery.post("before_appointment_process.php", {
		stateVal: hash
	}, function (e) {
		if (e !== "false") {
			jQuery("#date").html(e);
			jQuery("#date").css("border", "1px solid #D6D6D6");
			jQuery("#sa_submit").removeAttr("disabled");
		} else {
			jQuery("#date").html('<option value="">Select Date first</option>')
		}
	})


	jQuery(document).on('click', '.gall-trigger', function () {
		refreshCaptcha();
	});

	jQuery('.popup_overlay3 .close_btn a').click(function (e) {
		e.preventDefault();
		location.reload();
	});




});

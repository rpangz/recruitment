jQuery(document).ready(function() {
	/*jQuery('img').each(function() {
		jQuery(this).error(function () {
			if (jQuery(this).attr('id') !== undefined) {
				var id = jQuery(this).attr('id');
				setTimeout(function(){reloadimage(id)},(2+Math.random()*4)*1000);
			}
		});
		var src = jQuery(this).attr("src");
		jQuery(this).attr("src", src);
	});*/

	var postdata = "testing=true";
	jQuery.ajax({
					url: '//test.mensa.no/calculate.php',
				type: "POST",
		dataType: 'json',
		data: postdata,
		success: function(data) {
			jQuery("#pre").show();
					},
		error: function(jqXHR, textStatus, errorThrown) {
			console.error(jqXHR);
			console.error(textStatus);
			console.error(errorThrown);
			jQuery("#errorinit").show();
		}
	});
});
var retries = [];
function reloadimage(id) {
	var img = jQuery("#" + id);
	var src = img.attr("src");
	retries[id] = (retries[id] == undefined) ? 0 : retries[id] + 1;
	var newsrc = src;
	if (retries[id] > 5) {
		img.unbind("error").removeAttr("src").attr("src", newsrc);
	} else {
		img.removeAttr("src").attr("src", newsrc);
	}
}
function startover() {
	jQuery("#resultzero").hide();
	jQuery("#result").hide();
	jQuery("#pre").show();
	}
function starttest() {
	jQuery("#pre").hide();
	jQuery("#age").show();
		window.scrollTo(0, 0);
}
var timeout;
var testtimer;
var starttime = new Array();
function setage(age) {
	setcookie("age", age, 1);
	jQuery("#pre").hide();
	jQuery("#age").hide();
	var now = getnow();
	setcookie("starttime", now, 1);
	timeout = now + 1500000;
	updatetimer();
	jQuery(".timer").show();
			jQuery(".progress").show();
		for (var i = 1; i <= 35; i++) {
		deletecookie("test-" + i);
		deletecookie("time-" + i);
	}
	jQuery('img').each(function() {
		jQuery(this).removeClass("answer");
		jQuery(this).removeClass("btn-danger");
	});
	testtimer = setTimeout("calculatescore();",1500000);
	starttime = [];
	current = "test-" + 1;
	setcookie("tests", 0, 1);
	starttime[1] = now;
	jQuery("#" + current).show();
	
}
function answerbyletter(letter) {
	if (current.substr(0, 5) == "test-" && current.length >= 6) {
		answer(parseInt(current.substr(5)),letter);
	}
}
var current = "";
function answer(test,answer) {
	var previous = getcookie(current);
	if (previous) {
		jQuery("#answer-"+test+"-"+previous).removeClass("answer");
		jQuery("#answer-"+test+"-"+previous).removeClass("btn-danger");
	}
	current = "test-" + test;
	setcookie(current, answer, 1);

	var now = getnow();
	var used = getcookie("time-" + test);
	if (used != null) {
		used = parseInt(used);
	}
	if (isNaN(used)) {
		used=0;
	}
	var time = used + (now - starttime[test]);
	setcookie("time-" + test, time);

	jQuery("#answer-"+test+"-"+answer).addClass("answer");
	jQuery("#answer-"+test+"-"+answer).addClass("btn-danger");
	var tests = getcookie("tests");
	var done = Math.max(tests, test);
	setcookie("tests", done, 1);
	var next = jQuery("#test-" + (test + 1));
	if (next.length > 0) {
		jQuery("#" + current).hide();
		current = "test-" + (test + 1);
		starttime[test+1] = now;
		next.show();
		var hasanswered = getcookie(current);
					updateprogressbar(test, hasanswered);
				if (hasanswered && test+1 == 35) {
							jQuery(".progress").hide();
						jQuery(".finished").show();
		}
				} else {
					updateprogressbar(test-1, getcookie(current));
			jQuery(".progress").hide();
				jQuery(".finished").show();
	}
}
function goback(test) {
	current = "test-" + (test);
	jQuery("#" + current).hide();
	jQuery(".finished").hide();
	jQuery(".progress").show();
	var previous = jQuery("#test-" + (test - 1));
	if (previous.length > 0) {
		current = "test-" + (test - 1);
		starttime[test-1] = getnow();
		previous.show();
					updateprogressbar(test-2, getcookie(current));
					} else {
		jQuery("#age").show();
				if (updater) {
			clearTimeout(updater);
		}
		if (testtimer) {
			clearTimeout(testtimer);
		}
	}
}
function goforward(test) {
	current = "test-" + (test);
	jQuery("#" + current).hide();
	var next = jQuery("#test-" + (test + 1));
	if (next.length > 0) {
		current = "test-" + (test + 1);
		starttime[test+1] = getnow();
		next.show();
		var hasanswered = getcookie(current);
					updateprogressbar(test, hasanswered);
				if (hasanswered && test+1 == 35) {
							jQuery(".progress").hide();
						jQuery(".finished").show();
		}
			} else {
		calculatescore();
	}
}
function updateprogressbar(progress, hasanswered) {
	progress += hasanswered ? 1 : 0;
	progress = progress*100 / 35;
	progress = Math.round(progress);
	jQuery('#progressbar').css("width", progress + "%");
	jQuery('#progresstext').html(progress + "%");
}
var updater;
function updatetimer() {
	var now = new Date().getTime();
	var timeleft = (timeout - now) / 1000;
	if (timeleft >= 60){
		var minutes = Math.floor(timeleft/60);
		timeleft = (timeleft%60);
	} else {
		var minutes = 0;
	}
	var seconds = Math.floor(timeleft);
	if (seconds < 10) {
		seconds = "0" + seconds;
	}
	jQuery("#timer").html(minutes + ":" + seconds);
	updater = setTimeout("updatetimer();",1*1000);
}
function calculatescore() {
	var now = new Date().getTime();
	setcookie("stoptime", now, 1);

	jQuery("#" + current).hide();
	jQuery(".timer").hide();
	jQuery(".finished").hide();
			jQuery(".progress").hide();
		if (updater) {
		clearTimeout(updater);
	}
	if (testtimer) {
		clearTimeout(testtimer);
	}

	var postdata = "username=" + (typeof getcookie("username") === "undefined" ? "" : getcookie("username"));
	postdata += "&name=" + (typeof getcookie("name") === "undefined" ? "" : getcookie("name"));
	postdata += "&id=" + (typeof getcookie("id") === "undefined" ? "" : getcookie("id"));
	postdata += "&age=" + getcookie("age");
	postdata += "&starttime=" + getcookie("starttime");
	postdata += "&stoptime=" + getcookie("stoptime");
	postdata += "&language=" + "en";

	var tests = getcookie("tests");
	postdata += "&tests=" + tests;

	for (var i = 1; i <= tests; i++) {
		var a = getcookie("test-" + i);
		postdata += "&test-" + i + "=" + getcookie("test-" + i);
		postdata += "&time-" + i + "=" + getcookie("time-" + i);
	}

	jQuery.ajax({
					url: '//test.mensa.no/calculate.php',
				type: "POST",
		dataType: 'json',
		data: postdata,
		success: function(data) {
			var iq = 100;
			jQuery.each(data, function(key, value) {
				if (jQuery("#" + key).length > 0) {
					jQuery("#" + key).html(value);
				}
				if (key == "iq") {
					iq = value;
				}
			});
			if (iq == 0 || iq == "null" || iq == null) {
				jQuery("#resultzero").show();
							} else {
				jQuery("#result").show();
				var iq_int = iq.toString().replace(/[^\d.]/g, '');
				//var iq_int = iq;
				var div = jQuery("#result-body");
				var innerwidth = div.innerWidth() - div.css("padding-left").replace("px", "") - div.css("padding-right").replace("px", "");
				if (innerwidth > 0) {
					var width = Math.min(634, innerwidth);
				} else {
					var width = 634;
				}
				var height = Math.round(width / 1.54);
				jQuery("#iqgraph").attr('src','http://test.mensa.no/graph.php?iq='+iq_int+'&w='+width+'&h='+height);
							}
			setcookie("iq", iq, 1);
		},
		error: function(jqXHR, textStatus, errorThrown) {
						jQuery("#resultzero").show();
					}
	});
}
function invitefriends() {
	FB.ui({method: 'apprequests', message: 'Are you smart enough for Mensa?'});
}
function publishscore(withscore) {
	var caption = "Mensa IQ Test";
	var name = "test.mensa.no";
	if (withscore) {
		var score = getcookie("iq");
		var description = "I have taken Mensa's IQ Test and scored " + score + "! Can you beat my score?";
		var picture = 'http://test.mensa.no/graph.php?iq='+score+'&w=460&h=300';
	} else {
		var description = "I have taken Mensa's IQ Test! Can you beat my score?";
		var picture = 'http://www.mensa.no/wordpress/wp-content/themes/attitude-child/images/mensalogo.png';
	}
	FB.ui({
				app_id: '244909692205352',
		method: 'share',
						picture: picture,
		//caption: caption,
		//caption: name,
		description: description,
		actions: [
			{
				name: 'mensa.no',
				link: 'http://www.mensa.no'
			}
		],
								link: 'http://test.mensa.no',
			href: 'http://test.mensa.no',
				//name: name
	});
}
var cookies = [];
function setcookie(name, value, days) {
	cookies[name] = value;
	if (days) {
		var date = new Date();
		date.setTime(date.getTime()+(days*24*60*60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
}
function getcookie(name) {
	var nameEQ = name + "=";
	var ca = document.cookie.split(';');
	for(var i=0;i < ca.length;i++) {
		var c = ca[i];
		while (c.charAt(0)==' ') c = c.substring(1, c.length);
		if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
	}
	return cookies[name];
	return null;
}
function deletecookie(name) {
	setcookie(name, "", -1);
}
function getnow() {
	return new Date().getTime();
}
jQuery(document).bind('keydown', 'a',function (evt){answerbyletter(1);});
jQuery(document).bind('keydown', 'b',function (evt){answerbyletter(2);});
jQuery(document).bind('keydown', 'c',function (evt){answerbyletter(3);});
jQuery(document).bind('keydown', 'd',function (evt){answerbyletter(4);});
jQuery(document).bind('keydown', 'e',function (evt){answerbyletter(5);});
jQuery(document).bind('keydown', 'f',function (evt){answerbyletter(6);});
jQuery(document).bind('keydown', '1',function (evt){answerbyletter(1);});
jQuery(document).bind('keydown', '2',function (evt){answerbyletter(2);});
jQuery(document).bind('keydown', '3',function (evt){answerbyletter(3);});
jQuery(document).bind('keydown', '4',function (evt){answerbyletter(4);});
jQuery(document).bind('keydown', '5',function (evt){answerbyletter(5);});
jQuery(document).bind('keydown', '6',function (evt){answerbyletter(6);});

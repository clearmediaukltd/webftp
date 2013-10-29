/**
 * 
 * This is the ClearMedia in-house JavaScript framework, this is not free software it
 * is copyright Clear Media UK Ltd (c) 2008, Clear Media UK Ltd. If you are using this
 * framework it is licensed for use under the Clear Media UK Ltd. EULA.
 *
 * Portions of this JavaScript framework have been sourced from external authors, where
 * appropriate they have been credited and links provided to the original licence permitting
 * our use of the JavaScript functions / classes. You may use these functions / classes under
 * the original authors license terms.
 *
 * @package
 * @author		Clear Media UK Ltd Dev Team
 * @copyright	Copyright (c) 2008 Clear Media UK.
 * @license		
 * @link		http://clearmediawebsites.co.uk
 * @since		Version 1
 * @filesource
 */
 
/**
 * Browser detection script courtesy of quirksmode.org
 *
 * @licence http://www.quirksmode.org/about/copyright.html
 */
var BrowserDetect = {
	init: function () {
		this.browser = this.searchString(this.dataBrowser) || "An unknown browser";
		this.version = this.searchVersion(navigator.userAgent)
			|| this.searchVersion(navigator.appVersion)
			|| "an unknown version";
		this.OS = this.searchString(this.dataOS) || "an unknown OS";
	},
	searchString: function (data) {
		for (var i=0;i<data.length;i++)	{
			var dataString = data[i].string;
			var dataProp = data[i].prop;
			this.versionSearchString = data[i].versionSearch || data[i].identity;
			if (dataString) {
				if (dataString.indexOf(data[i].subString) != -1)
					return data[i].identity;
			}
			else if (dataProp)
				return data[i].identity;
		}
	},
	searchVersion: function (dataString) {
		var index = dataString.indexOf(this.versionSearchString);
		if (index == -1) return;
		return parseFloat(dataString.substring(index+this.versionSearchString.length+1));
	},
	dataBrowser: [
		{ 	string: navigator.userAgent,
			subString: "OmniWeb",
			versionSearch: "OmniWeb/",
			identity: "OmniWeb"
		},
		{
			string: navigator.vendor,
			subString: "Apple",
			identity: "Safari"
		},
		{
			prop: window.opera,
			identity: "Opera"
		},
		{
			string: navigator.vendor,
			subString: "iCab",
			identity: "iCab"
		},
		{
			string: navigator.vendor,
			subString: "KDE",
			identity: "Konqueror"
		},
		{
			string: navigator.userAgent,
			subString: "Firefox",
			identity: "Firefox"
		},
		{
			string: navigator.vendor,
			subString: "Camino",
			identity: "Camino"
		},
		{		// for newer Netscapes (6+)
			string: navigator.userAgent,
			subString: "Netscape",
			identity: "Netscape"
		},
		{
			string: navigator.userAgent,
			subString: "MSIE",
			identity: "Explorer",
			versionSearch: "MSIE"
		},
		{
			string: navigator.userAgent,
			subString: "Gecko",
			identity: "Mozilla",
			versionSearch: "rv"
		},
		{ 		// for older Netscapes (4-)
			string: navigator.userAgent,
			subString: "Mozilla",
			identity: "Netscape",
			versionSearch: "Mozilla"
		}
	],
	dataOS : [
		{
			string: navigator.platform,
			subString: "Win",
			identity: "Windows"
		},
		{
			string: navigator.platform,
			subString: "Mac",
			identity: "Mac"
		},
		{
			string: navigator.platform,
			subString: "Linux",
			identity: "Linux"
		}
	]

};
BrowserDetect.init();

/**
 * A duplicate of php's number_format()
 * 
 * @param 
 * @return 
 */
function number_format(number, decimals, dec_point, thousands_sep) {

    var n = number, prec = decimals;
 
    var toFixedFix = function (n,prec) {
        var k = Math.pow(10,prec);
        return (Math.round(n*k)/k).toString();
    };
 
    n = !isFinite(+n) ? 0 : +n;
    prec = !isFinite(+prec) ? 0 : Math.abs(prec);
    var sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep;
    var dec = (typeof dec_point === 'undefined') ? '.' : dec_point;
 
    var s = (prec > 0) ? toFixedFix(n, prec) : toFixedFix(Math.round(n), prec); //fix for IE parseFloat(0.55).toFixed(0) = 0;
 
    var abs = toFixedFix(Math.abs(n), prec);
    var _, i;
 
    if (abs >= 1000) {
        _ = abs.split(/\D/);
        i = _[0].length % 3 || 3;
 
        _[0] = s.slice(0,i + (n < 0)) +
              _[0].slice(i).replace(/(\d{3})/g, sep+'$1');
        s = _.join(dec);
    } else {
        s = s.replace('.', dec);
    }
 
    var decPos = s.indexOf(dec);
    if (prec >= 1 && decPos !== -1 && (s.length-decPos-1) < prec) {
        s += new Array(prec-(s.length-decPos-1)).join(0)+'0';
    }
    else if (prec >= 1 && decPos === -1) {
        s += dec+new Array(prec).join(0)+'0';
    }
    return s;
}

/**
 * Asks the user to confirm deletion of various options
 * 
 * @return false
 */
function confirmDel() {
	if(confirm("Are you sure you want to delete this record?")) {
	} else {
		return false;
	}
}

/**
 * Alias for confirmDel()
 *
 * @return void
 */
function confirm_del() {
	if(confirm("Are you sure you want to delete this record?")) {
	} else {
		return false;
	}
}

/**
 * Nice bit of shorthand
 *
 * @param string
 * @return object
 */
function get(id) {
	return document.getElementById(id);
}

/**
 * Sets dropdown options to selected
 * Saves a lot of messing around with PHP code
 * 
 * @return void
 */
var option;
var dropdown_name;

function set_selected(option, dropdown_name) {
	
	var current_dropdown = document.getElementById(dropdown_name);
	
	
	for(var i = 0; i < current_dropdown.options.length; i++) {
		
		if(current_dropdown.options[i].value == option) {
			current_dropdown.options[i].selected = true;
		}
	}
}

/**
 * Sets dropdown options to selected
 * Saves a lot of messing around with PHP code
 * 
 * @return void
 */
var checkbox_name;

function set_checked(option, checkbox_name) {
	
	var checkbox = document.getElementById(checkbox_name);
	
	if(option == true) {
		checkbox.checked = true;
	} else {
		checkbox.checked = false;
	}
}

/**
 * Creates a unique code
 * 
 * @return string
 */
function create_unique_id() {
	
	if(BrowserDetect.browser != 'Explorer') {
		var uid = ((new Date()).getTime() + "" + Math.floor(Math.random() * 1000000)).substr(-6);
	} else {
		var unique = ((new Date()).getTime() + "" + Math.floor(Math.random() * 1000000));
		var length = unique.length;
		var start = length-6;
		var uid = unique.substr(start, length);
	}
	return uid; 
}

/**
 * Alias for create_unique_id()
 *
 * @return string //unique code
 */
function create_code() {
	var uid = create_unique_id();
	return uid;
}

/**
 * Clear contents of search box
 * 
 * @param string //the id of the box you want to clear
 */
function clear_box(box){
	if(box.value==box.defaultValue) {
		box.value = "";
	 }
}

/**
 * ensures a checkbox is checked
 *
 * @param void
 * @return bool
 */
function checkbox_checked(chk, message) {

	if (chk.checked == 1) {
		return true;
	} else {
		alert(message);
		return false;
	}
	
}

/**
 * New getElementsByClassName() function
 * 
 * @param string
 * @return array of objects 
 */
document.getElementsByClassName = function(class_name) {
    var docList = this.all || this.getElementsByTagName('*');
    var matchArray = new Array();

    /*Create a regular expression object for class*/
    var re = new RegExp("(?:^|\\s)"+class_name+"(?:\\s|$)");
    for (var i = 0; i < docList.length; i++) {
        if (re.test(docList[i].className) ) {
            matchArray[matchArray.length] = docList[i];
        }
    }

	return matchArray;
}


/**
 * Checks if a textfield contains a decimal
 * 
 * @param string
 * @return array of objects 
 */
function check_decimal(element) {

	if (/^\.?$/.test(get(element).value) || !/^-?\d*\.?\d*$/.test(get(element).value)) {
		alert('This field requires a Number'); 
		get(element).value=''; 
		get(element).focus()
	}
	
}
		
function trim(str, chars) {
	return ltrim(rtrim(str, chars), chars);
}
 
function ltrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}
 
function rtrim(str, chars) {
	chars = chars || "\\s";
	return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}  		
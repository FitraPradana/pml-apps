var dateFormat = function () {
	var	token = /d{1,4}|m{1,4}|yy(?:yy)?|([HhMsTt])\1?|[LloSZ]|"[^"]*"|'[^']*'/g,
		timezone = /\b(?:[PMCEA][SDP]T|(?:Pacific|Mountain|Central|Eastern|Atlantic) (?:Standard|Daylight|Prevailing) Time|(?:GMT|UTC)(?:[-+]\d{4})?)\b/g,
		timezoneClip = /[^-+\dA-Z]/g,
		pad = function (val, len) {
			val = String(val);
			len = len || 2;
			while (val.length < len) val = "0" + val;
			return val;
		};

	// Regexes and supporting functions are cached through closure
	return function (date, mask, utc) {
		var dF = dateFormat;

		// You can't provide utc if you skip other args (use the "UTC:" mask prefix)
		if (arguments.length == 1 && Object.prototype.toString.call(date) == "[object String]" && !/\d/.test(date)) {
			mask = date;
			date = undefined;
		}

		// Passing date through Date applies Date.parse, if necessary
		date = date ? new Date(date) : new Date;
		if (isNaN(date)) throw SyntaxError("invalid date");

		mask = String(dF.masks[mask] || mask || dF.masks["default"]);

		// Allow setting the utc argument via the mask
		if (mask.slice(0, 4) == "UTC:") {
			mask = mask.slice(4);
			utc = true;
		}

		var	_ = utc ? "getUTC" : "get",
			d = date[_ + "Date"](),
			D = date[_ + "Day"](),
			m = date[_ + "Month"](),
			y = date[_ + "FullYear"](),
			H = date[_ + "Hours"](),
			M = date[_ + "Minutes"](),
			s = date[_ + "Seconds"](),
			L = date[_ + "Milliseconds"](),
			o = utc ? 0 : date.getTimezoneOffset(),
			flags = {
				d:    d,
				dd:   pad(d),
				ddd:  dF.i18n.dayNames[D],
				dddd: dF.i18n.dayNames[D + 7],
				m:    m + 1,
				mm:   pad(m + 1),
				mmm:  dF.i18n.monthNames[m],
				mmmm: dF.i18n.monthNames[m + 12],
				yy:   String(y).slice(2),
				yyyy: y,
				h:    H % 12 || 12,
				hh:   pad(H % 12 || 12),
				H:    H,
				HH:   pad(H),
				M:    M,
				MM:   pad(M),
				s:    s,
				ss:   pad(s),
				l:    pad(L, 3),
				L:    pad(L > 99 ? Math.round(L / 10) : L),
				t:    H < 12 ? "a"  : "p",
				tt:   H < 12 ? "am" : "pm",
				T:    H < 12 ? "A"  : "P",
				TT:   H < 12 ? "AM" : "PM",
				Z:    utc ? "UTC" : (String(date).match(timezone) || [""]).pop().replace(timezoneClip, ""),
				o:    (o > 0 ? "-" : "+") + pad(Math.floor(Math.abs(o) / 60) * 100 + Math.abs(o) % 60, 4),
				S:    ["th", "st", "nd", "rd"][d % 10 > 3 ? 0 : (d % 100 - d % 10 != 10) * d % 10]
			};

		return mask.replace(token, function ($0) {
			return $0 in flags ? flags[$0] : $0.slice(1, $0.length - 1);
		});
	};
}();

// Some common format strings
dateFormat.masks = {
	"default":      "ddd mmm dd yyyy HH:MM:ss",
	shortDate:      "m/d/yy",
	mediumDate:     "mmm d, yyyy",
	longDate:       "mmmm d, yyyy",
	fullDate:       "dddd, mmmm d, yyyy",
	shortTime:      "h:MM TT",
	mediumTime:     "h:MM:ss TT",
	longTime:       "h:MM:ss TT Z",
	isoDate:        "yyyy-mm-dd",
	isoTime:        "HH:MM:ss",
	isoDateTime:    "yyyy-mm-dd'T'HH:MM:ss",
	isoUtcDateTime: "UTC:yyyy-mm-dd'T'HH:MM:ss'Z'"
};

// Internationalization strings
dateFormat.i18n = {
	dayNames: [
		"Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat",
		"Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"
	],
	monthNames: [
		"Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec",
		"January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"
	]
};

// For convenience...
Date.prototype.format = function (mask, utc) {
	return dateFormat(this, mask, utc);
};

		function JSONToCSVConvertor(JSONData, ReportTitle, ShowLabel) {
		  //If JSONData is not an object then JSON.parse will parse the JSON string in an Object
		  var arrData = typeof JSONData != 'object' ? JSON.parse(JSONData) : JSONData;
		
		  var CSV = '';
		  //Set Report title in first row or line
		
		  CSV += ReportTitle + '\r\n\n';
		
		  //This condition will generate the Label/Header
		  if (ShowLabel) {
			var row = "";
		
			//This loop will extract the label from 1st index of on array
			for (var index in arrData[0]) {
		
			  //Now convert each value to string and comma-seprated
			  row += index.trim() + ';';
			}
		
			row = row.slice(0, -1);
		
			//append Label row with line break
			CSV += row + '\r\n';
		  }
		
		  //1st loop is to extract each row
		  for (var i = 0; i < arrData.length; i++) {
			var row = "";
		
			//2nd loop will extract each column and convert it in string comma-seprated
			for (var index in arrData[i]) {
			  row += '' + arrData[i][index].trim() + ';';
			}
		
			row.slice(0, row.length - 1);
		
			//add a line break after each row
			CSV += row + '\r\n';
		  }
		
		  if (CSV == '') {
			alert("Invalid data");
			return;
		  }
		
		  //Generate a file name
		  var fileName = "MyReport_";
		  //this will remove the blank-spaces from the title and replace it with an underscore
		  fileName += ReportTitle.replace(/ /g, "_");
		
		  //Initialize file format you want csv or xls
		  var uri = 'data:text/csv;charset=utf-8,' + escape(CSV);
		
		  // Now the little tricky part.
		  // you can use either>> window.open(uri);
		  // but this will not work in some browsers
		  // or you will not get the correct file extension    
		
		  //this trick will generate a temp <a /> tag
		  var link = document.createElement("a");
		  link.href = uri;
		
		  //set the visibility hidden so it will not effect on your web-layout
		  link.style = "visibility:hidden";
		  link.download = fileName + ".csv";
		
		  //this part will append the anchor tag and remove it after automatic click
		  document.body.appendChild(link);
		  link.click();
		  document.body.removeChild(link);
		}
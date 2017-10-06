// This is the Database of Upcoming Events
// Please Edit with Care.
//
// 8 Fields (surrounded by brackets[]) are used for EACH event:
// 	["Recurring", "Month", "Day", "Year", "StartTime", "EndTime", "Name", "Description"]
// 	Each event field must be be surrounded by quotation marks followed by a comma ("",) EXCEPT the "Description" field.
//	The "Description" field is surrounded by quotation marks only ("").
//
// Each event has a comma after the closing bracket IF another event is below it on the next line down.
//	Note: The last event in this file should NOT have a comma after the closing bracket
//
// The Recurring field uses:
//	"D" = Daily; "W" = Weekly; "M" = Monthly; "Y" = Yearly; "F" = Floating Holiday
//
// One Time only events should leave the Recurring field blank
//	(ex. "")
//
// Daily events do NOT require that anything be in the Month Day and Year fields
//	Everything in the Month Day and Year fields will be ignored
//
// Weekly events should have the day of the week field set to 1 - 7
//	1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thurday, 6=Friday, 7=Saturday
//
// "F"loating events uses:
//	the Month field for the Month.
//	the Day field as the Cardinal Occurrence
//		1=1st, 2=2nd, 3=3rd, 4=4th, 5=5th, 6=6th occurrence of the day listed next
//	the Year field as the Day of the week the event/holiday falls on
//		1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thurday, 6=Friday, 7=Saturday
//	example: "F",	"1",	"3",	"2", = Floating holiday in January on the 3rd Monday of that month.
//
//	Note: Easter has it's own special formula so Please don't change anything related to Easter below
//
// "Y"early events are specific dates that never change - the Year field is ignored
//	example - Christmas is: "12","25","",

/*1 Abril dia no lectivo
1 dia del trabajor, 2 dia de la comunidad de madrid,  mayo 2013festivo
3 mayo dia no lectivo
25 junio último dia lectivo 
26,27,28 junio dia no lectivo*/


events = new Array(


	["Y",	"4",	"1",	"",	"0:00 AM",	"12:00 PM",	"Dia no lectivo",	"Este dia no hay clase"],
	["Y",	"5",	"1",	"",	"0:00 AM",	"12:59 PM",	"Dia del trabajador",	"Este dia no  habra clase"],
	["Y",	"5",	"2",	"",	"0:00 AM",	"12:59 PM",	"Dia de la comunidad de Madrid",	"Este dia no  habra clase"],
	["Y",	"5",	"3",	"",	"1:00 AM",	"12:59 PM",	"Dia no lectivo",	"Este dia no  habra clase"],
	["Y",	"6",	"25",	"",	"1:00 AM",	"12:59 PM",	"Último dia lectivo",	"Último dia de clase"],
	["Y",	"9",	"4",	"",	"1:00 AM",	"12:59 PM",	"Dia internacional del hacker",	"Este dia habra charlas sobre el fenomeno hacker y se izara una bandera pirata en su honor en el patio"]
	
// Por favor omita la coma final despues del último ] al menos que vayas a añadir algún dia adicciónal.
);

/* Preload images script */
var myimages=new Array()

function preloadimages(){
	for (i=0;i<preloadimages.arguments.length;i++){
		myimages[i]=new Image();
		myimages[i].src=preloadimages.arguments[i];
	}
}


/* The path of images to be preloaded inside parenthesis: (Extend list as desired.) */
preloadimages("Inicio/Inicio/images/PrevYrOff40x40.jpg","Inicio/Inicio/images/PrevYrOn40x40.jpg","Inicio/Inicio/images/PrevMoOff40x40.jpg","Inicio/Inicio/images/PrevMoOn40x40.jpg","Inicio/Inicio/images/NextYrOff40x40.jpg","Inicio/Inicio/images/NextYrOn40x40.jpg","Inicio/Inicio/images/NextMoOff40x40.jpg","Inicio/Inicio/images/NextMoOn40x40.jpg");


/***************************************************************************************
	JavaScript Calendar - Digital Christian Design
	//Script featured on and available at JavaScript Kit: http://www.javascriptkit.com
	// Functions
		changedate(): Moves to next or previous month or year, or current month depending on the button clicked.
		createCalendar(): Renders the calan
		der into the page with links for each to fill the date form filds above.
			
***************************************************************************************/

var thisDate = 1;							// Tracks current date being written in calendar
var wordMonth = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
var today = new Date();							// Date object to store the current date
var todaysDay = today.getDay() + 1;					// Stores the current day number 1-7
var todaysDate = today.getDate();					// Stores the current numeric date within the month
var todaysMonth = today.getUTCMonth() + 1;				// Stores the current month 1-12
var todaysYear = today.getFullYear();					// Stores the current year
var monthNum = todaysMonth;						// Tracks the current month being displayed
var yearNum = todaysYear;						// Tracks the current year being displayed
var firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));	// Object Storing the first day of the current month
var firstDay = firstDate.getUTCDay();					// Tracks the day number 1-7 of the first day of the current month
var lastDate = new Date(String(monthNum+1)+"/0/"+String(yearNum));	// Tracks the last date of the current month
var numbDays = 0;
var calendarString = "";
var eastermonth = 0;
var easterday = 0;


function changedate(buttonpressed) {
	if (buttonpressed == "prevyr") yearNum--;
	else if (buttonpressed == "nextyr") yearNum++;
	else if (buttonpressed == "prevmo") monthNum--;
	else if (buttonpressed == "nextmo") monthNum++;
	else  if (buttonpressed == "return") { 
		monthNum = todaysMonth;
		yearNum = todaysYear;
	}

	if (monthNum == 0) {
		monthNum = 12;
		yearNum--;
	}
	else if (monthNum == 13) {
		monthNum = 1;
		yearNum++
	}

    lastDate = new Date(yearNum,monthNum,0);
	numbDays = lastDate.getDate();
	firstDate = new Date(String(monthNum)+"/1/"+String(yearNum));
	firstDay = firstDate.getDay() + 1;
	createCalendar();
	return;
}


function easter(year) {
// feed in the year it returns the month and day of Easter using two GLOBAL variables: eastermonth and easterday
var a = year % 19;
var b = Math.floor(year/100);
var c = year % 100;
var d = Math.floor(b/4);
var e = b % 4;
var f = Math.floor((b+8) / 25);
var g = Math.floor((b-f+1) / 3);
var h = (19*a + b - d - g + 15) % 30;
var i = Math.floor(c/4);
var j = c % 4;
var k = (32 + 2*e + 2*i - h - j) % 7;
var m = Math.floor((a + 11*h + 22*k) / 451);
var month = Math.floor((h + k - 7*m + 114) / 31);
var day = ((h + k - 7*m +114) % 31) + 1;
eastermonth = month;
easterday = day;
}


function createCalendar() {
	calendarString = '';
	var daycounter = 0;
	calendarString += '<table width="200" border="1" cellpadding="0" cellspacing="1">';
	calendarString += '<tr>';
	calendarString += '<td align=\"center\" valign=\"center\"><a onMouseOver=\"document.PrevYr.src=\'Inicio\/Inicio\/images\/PrevYrOn40x40\.jpg\';\" onMouseOut=\"document.PrevYr.src=\'Inicio\/Inicio\/images\/PrevYrOff40x40\.jpg\';\" onClick=\"changedate(\'prevyr\')\"><img name=\"PrevYr\" src=\"Inicio\/Inicio\/images\/PrevYrOff40x40\.jpg\" width=\"20\" height=\"20\" border=\"0\" alt=\"Prev Yr\"\/><\/a><\/td>';
	calendarString += '<td align=\"center\" valign=\"center\"><a onMouseOver=\"document.PrevMo.src=\'Inicio\/Inicio\/images\/PrevMoOn40x40\.jpg\';\" onMouseOut=\"document.PrevMo.src=\'Inicio\/Inicio\/images\/PrevMoOff40x40\.jpg\';\" onClick=\"changedate(\'prevmo\')\"><img name=\"PrevMo\" src=\"Inicio\/Inicio\/images\/PrevMoOff40x40\.jpg\" width=\"20\" height=\"20\" border=\"0\" alt=\"Prev Mo\"\/><\/a><\/td>';
	calendarString += '<td bgcolor=\"#208ED8\" align=\"center\" valign=\"center\" width=\"60\" height=\"40\" colspan=\"3\"><b>' + wordMonth[monthNum-1] + '&nbsp;&nbsp;' + yearNum + '<\/b><\/td>';
	calendarString += '<td align=\"center\" valign=\"center\"><a onMouseOver=\"document.NextMo.src=\'Inicio\/Inicio\/images\/NextMoOn40x40\.jpg\';\" onMouseOut=\"document.NextMo.src=\'Inicio\/Inicio\/images\/NextMoOff40x40\.jpg\';\" onClick=\"changedate(\'nextmo\')\"><img name=\"NextMo\" src=\"Inicio\/Inicio\/images\/NextMoOff40x40\.jpg\" width=\"20\" height=\"20\" border=\"0\" alt=\"Next Mo\"\/><\/a><\/td>';
	calendarString += '<td align=\"center\" valign=\"center\"><a onMouseOver=\"document.NextYr.src=\'Inicio\/Inicio\/images\/NextYrOn40x40\.jpg\';\" onMouseOut=\"document.NextYr.src=\'Inicio\/Inicio\/images\/NextYrOff40x40\.jpg\';\" onClick=\"changedate(\'nextyr\')\"><img name=\"NextYr\" src=\"Inicio\/Inicio\/images\/NextYrOff40x40\.jpg\" width=\"20\" height=\"20\" border=\"0\" alt=\"Next Yr\"\/><\/a><\/td>';
	calendarString += '<\/tr>';
	calendarString += '<tr>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Dom<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Lun<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Mar<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Mie<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Jue<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Vie<\/td>';
	calendarString += '<td bgcolor=\"#99FFFF\" align=\"center\" valign=\"center\" width=\"20\" height=\"22\">Sab<\/td>';
	calendarString += '<\/tr>';

	thisDate == 1;

	for (var i = 1; i <= 6; i++) {
		calendarString += '<tr>';
		for (var x = 1; x <= 7; x++) {
			daycounter = (thisDate - firstDay)+1;
			thisDate++;
			if ((daycounter > numbDays) || (daycounter < 1)) {
				calendarString += '<td align=\"center\" bgcolor=\"#888888\" height=\"30\" width=\"20\">&nbsp;<\/td>';
			} else {
				if (checkevents(daycounter,monthNum,yearNum,i,x) || ((todaysDay == x) && (todaysDate == daycounter) && (todaysMonth == monthNum))){
					if ((todaysDay == x) && (todaysDate == daycounter) && (todaysMonth == monthNum)) {
						calendarString += '<td align=\"center\" bgcolor=\"#AAFFAA\" height=\"30\" width=\"20\"><a href=\"javascript:showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ')\">' + daycounter + '<\/a><\/td>';
					}
 					else	calendarString += '<td align=\"center\" bgcolor=\"#99FFFF\" height=\"30\" width=\"20\"><a href=\"javascript:showevents(' + daycounter + ',' + monthNum + ',' + yearNum + ',' + i + ',' + x + ')\">' + daycounter + '<\/a><\/td>';
				} else {
					calendarString += '<td align=\"center\" bgcolor=\"#DDFFFF\" height=\"30\" width=\"20\">' + daycounter + '<\/td>';
				}
			}
		}
		calendarString += '<\/tr>';
	}

	calendarString += '<tr><td colspan=\"7\" nowrap align=\"center\" valign=\"center\" bgcolor=\"#99FFFF\" width=\"200\" height=\"22\"><a href=\"javascript:changedate(\'return\')\"><b>Mostrar fecha actual<\/b><\/a><\/td><\/tr><\/table>';

	var object=document.getElementById('calendar');
	object.innerHTML= calendarString;
	thisDate = 1;
}


function checkevents(day,month,year,week,dayofweek) {
var numevents = 0;
var floater = 0;

	for (var i = 0; i < events.length; i++) {
		if (events[i][0] == "W") {
			if ((events[i][2] == dayofweek)) numevents++;
		}
		else if (events[i][0] == "Y") {
			if ((events[i][2] == day) && (events[i][1] == month)) numevents++;
		}
		else if (events[i][0] == "F") {
			if ((events[i][1] == 3) && (events[i][2] == 0) && (events[i][3] == 0) ) {
				easter(year);
				if (easterday == day && eastermonth == month) numevents++;
			} else {
				floater = floatingholiday(year,events[i][1],events[i][2],events[i][3]);
				if ((month == 5) && (events[i][1] == 5) && (events[i][2] == 4) && (events[i][3] == 2)) {
					if ((floater + 7 <= 31) && (day == floater + 7)) {
						numevents++;
					} else if ((floater + 7 > 31) && (day == floater)) numevents++;
				} else if ((events[i][1] == month) && (floater == day)) numevents++;
			}
		}
		else if ((events[i][2] == day) && (events[i][1] == month) && (events[i][3] == year)) {
			numevents++;
		}
	}

	if (numevents == 0) {
		return false;
	} else {
		return true;
	}
}


function showevents(day,month,year,week,dayofweek) {
var theevent = "";
var floater = 0;

	for (var i = 0; i < events.length; i++) {
		// First we'll process recurring events (if any):
		if (events[i][0] != "") {
			if (events[i][0] == "D") {
			}
			if (events[i][0] == "W") {
				if ((events[i][2] == dayofweek)) {
				theevent += "Evento de : \n" + month +'/'+ day +'/'+ year + '\n';
				theevent += events[i][6] + '\n';
				theevent += 'Hora comienzo: ' + events[i][4] + '\n';
				theevent += 'Hora final: ' + events[i][5] + '\n';
				theevent += 'Descripcion: ' + events[i][7] + '\n';
				theevent += '\n -------------- \n\n';
				document.forms.eventform.eventlist.value = theevent;
				}
			}
			if (events[i][0] == "M") {
			}
			if (events[i][0] == "Y") {
				if ((events[i][2] == day) && (events[i][1] == month)) {
				theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
				theevent += events[i][6] + '\n';
				theevent += 'Hora comienzo: ' + events[i][4] + '\n';
				theevent += 'Hora final: ' + events[i][5] + '\n';
				theevent += 'Descripcion: ' + events[i][7] + '\n';
				theevent += '\n -------------- \n\n';
				document.forms.eventform.eventlist.value = theevent;
				}
			}
			if (events[i][0] == "F") {
				if ((events[i][1] == 3) && (events[i][2] == 0) && (events[i][3] == 0) ) {
					if (easterday == day && eastermonth == month) {
						theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
						theevent += events[i][6] + '\n';
						theevent += 'Hora comienzo: ' + events[i][4] + '\n';
						theevent += 'Hora final: ' + events[i][5] + '\n';
						theevent += 'Descripcion: ' + events[i][7] + '\n';
						theevent += '\n -------------- \n\n';
						document.forms.eventform.eventlist.value = theevent;
					} 
				} else {
					floater = floatingholiday(year,events[i][1],events[i][2],events[i][3]);

					if ((month == 5) && (events[i][1] == 5) && (events[i][2] == 4) && (events[i][3] == 2)) {
						if ((floater + 7 <= 31) && (day == floater + 7)) {
							theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
							theevent += events[i][6] + '\n';
							theevent += 'Hora inicio: ' + events[i][4] + '\n';
							theevent += 'Hora final: ' + events[i][5] + '\n';
							theevent += 'Descripcion: ' + events[i][7] + '\n';
							theevent += '\n -------------- \n\n';
							document.forms.eventform.eventlist.value = theevent;
						} else if ((floater + 7 > 31) && (day == floater)) {
							theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
							theevent += events[i][6] + '\n';
							theevent += 'Hora inicio: ' + events[i][4] + '\n';
							theevent += 'Hora final: ' + events[i][5] + '\n';
							theevent += 'Descripcion: ' + events[i][7] + '\n';
							theevent += '\n -------------- \n\n';
							document.forms.eventform.eventlist.value = theevent;
						}
					} else if ((events[i][1] == month) && (floater == day)) {
						theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
						theevent += events[i][6] + '\n';
						theevent += 'Hora inicio: ' + events[i][4] + '\n';
						theevent += 'Hora final: ' + events[i][5] + '\n';
						theevent += 'Descripcion: ' + events[i][7] + '\n';
						theevent += '\n -------------- \n\n';
						document.forms.eventform.eventlist.value = theevent;
					}
				}
		}
		}
		// Now we'll process any One Time events happening on the matching month, day, year:
		else if ((events[i][2] == day) && (events[i][1] == month) && (events[i][3] == year)) {
			theevent += "Evento de: \n" + month +'/'+ day +'/'+ year + '\n';
			theevent += events[i][6] + '\n';
			theevent += 'Hora inicio: ' + events[i][4] + '\n';
			theevent += 'Hora final: ' + events[i][5] + '\n';
			theevent += 'Descripcion: ' + events[i][7] + '\n';
			theevent += '\n -------------- \n\n';
			document.forms.eventform.eventlist.value = theevent;
		}
	}
	if (theevent == "") document.forms.eventform.eventlist.value = 'No hay evento para mostrar.';
}


function floatingholiday(targetyr,targetmo,cardinaloccurrence,targetday) {
// Floating holidays/events of the events.js file uses:
//	the Month field for the Month (here it becomes the targetmo field)
//	the Day field as the Cardinal Occurrence  (here it becomes the cardinaloccurrence field)
//		1=1st, 2=2nd, 3=3rd, 4=4th, 5=5th, 6=6th occurrence of the day listed next
//	the Year field as the Day of the week the event/holiday falls on  (here it becomes the targetday field)
//		1=Sunday, 2=Monday, 3=Tuesday, 4=Wednesday, 5=Thurday, 6=Friday, 7=Saturday
//	example: "F",	"1",	"3",	"2", = Floating holiday in January on the 3rd Monday of that month.
//
// In our code below:
// 	targetyr is the active year
// 	targetmo is the active month (1-12)
// 	cardinaloccurrence is the xth occurrence of the targetday (1-6)
// 	targetday is the day of the week the floating holiday is on
//		0=Sun; 1=Mon; 2=Tue; 3=Wed; 4=Thu; 5=Fri; 6=Sat
//		Note: subtract 1 from the targetday field if the info comes from the events.js file
//
// Note:
//	If Memorial Day falls on the 22nd, 23rd, or 24th, then we add 7 to the dayofmonth to the result.
//
// Example: targetyr = 2052; targetmo = 5; cardinaloccurrence = 4; targetday = 1
//	This is the same as saying our floating holiday in the year 2052, is during May, on the 4th Monday
//
var firstdate = new Date(String(targetmo)+"/1/"+String(targetyr));	// Object Storing the first day of the current month.
var firstday = firstdate.getUTCDay();	// The first day (0-6) of the target month.
var dayofmonth = 0;	// zero out our calendar day variable.

	targetday = targetday - 1;

	if (targetday >= firstday) {
		cardinaloccurrence--;	// Subtract 1 from cardinal day.
		dayofmonth = (cardinaloccurrence * 7) + ((targetday - firstday)+1);
	} else {
		dayofmonth = (cardinaloccurrence * 7) + ((targetday - firstday)+1);
	}
return dayofmonth;
}




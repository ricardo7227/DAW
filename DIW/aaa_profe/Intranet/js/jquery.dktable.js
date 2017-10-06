/*
 * Dktable - jQuery plugin 0.2
 *
 * Copyright (c) 2009 Denis V. Kozlov (code.ninjia@gmail.com)
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 *
 */

(function($) {
	$.extend({
		
		dktable: new function() {
			
			this.defaults = {
				headers: [],
				sortable: [],
				columns: [],
                defaultSortable: {},
				numRows: [5,10,20,30,40],
				defaultNumRows: 10,
				url: false,
				urlOneRow: false,
				translates: {
					'reload':	'reload',
					'next'	:	'next',
					'prev'	:	'previous'
				},
				onDrawComplete: function(area) { /* after loading and constructing complete */}
			};
			
			this.affectedRows = [];
			
			var emptyBody = function(cols) {
				return '<tr><td style="height: 10px;" colspan="' + cols + '"></td></tr>';
			}
			
			function drawHeader(table) {
				var result = '<thead><tr>';
				for(var i=0; i < table.config.headers.length; i++) {
					
						var width = '';
						if (typeof table.config.columns[i].width == 'string') {
							width = table.config.columns[i].width;
						}
					
						if (isSortable(table, i+1)) {
							result += '<th width="' + width + '" sortIndex="' + parseInt(i+1) + '" sort="asc" class="sortable">'
							+ '<a href="#" onclick="return false;">'
							+ table.config.headers[i] 
							+ '</a>'
							+ '</th>';
						} else {
							result += '<th width="' + width + '">' + table.config.headers[i] + '</th>';
						}			
				}
				result += '</tr></thead>';
				
				return result;
			}
			
			function isSortable(table, col) {
   
                if (table.config.sortable.indexOf(col) !== -1) return true;

				return false;
			}
			
			function drawBody(table) {
				return '<tbody>' + emptyBody(table.config.columns.length) + '</tbody>';
			}
			
			function drawRowNumControl(table) {
				var result = '<select class="pagesize" disabled>';
				var selected;
				
				for(var i=0; i < table.config.numRows.length; i++) {
					var val = table.config.numRows[i];
					selected = '';
					if (val == table.config.defaultNumRows) 
						selected = 'selected';
					
					result += '<option ' + selected + ' value="' + val +
						'" label="' + val + '">' + val + '</option>';
				
				}
				
				result += '</select>';
				
				return result;
			}
			
			function drawPaggerButtons(table) {
				var result = '<a href="#" onclick="return false;" style="display:none;" class="prev">&larr; ' + table.config.translates.prev + '</a>'; 
				result += '<span class="pagedisplay">&nbsp;0/0&nbsp;</span>';
				result += '<a href="#" onclick="return false;" style="display:none;" class="next">' + table.config.translates.next + ' &rarr;</a>';
				
				return result;
			}
			
			function drawFoot(table) {
				var colspan = table.config.columns.length;
				var result = '<tfoot><tr><td colspan="' + colspan + '"><div class="navigator">';
				
				result += '<input style="font-size:13px;" type="button" class="reload" value="' + table.config.translates.reload + '"/>';
				result += drawRowNumControl(table) + ' ';
				result += drawPaggerButtons(table);
				result += '</div></td></tr></tfoot>';
				
				return result;
			}
			
			var populate = function(table) {
				var count = 0;
				var tBody = $("tbody", table);
				var tInnerBodyStr = '';

				table.affectedRows = [];
				
				if (table.response.items.length == 0) {
					tInnerBodyStr = emptyBody(table.config.columns.length);
				} else {
					
					
					$.each(table.response.items, function(i,row){
						table.affectedRows.push(i);	
						
						if ((count % 2) === 0) {
							tInnerBodyStr += '<tr row_id="' + i + '" class="even">';
						} else {
							tInnerBodyStr += '<tr row_id="' + i + '" class="odd">';
						}
						
						count++;
						
						tInnerBodyStr += constructRow(table.config.columns, row);
							
						tInnerBodyStr += '</tr>';
					});
				}
				
				$(tBody).html(tInnerBodyStr);		
			}
			
			function constructRow(colsConfig, row) {
				var result = '';
				
				$.each(colsConfig, function(j,colConf){
					result += '<td> ';
					result += constructCell(colConf, row[j]);
					result += ' </td>';
				});
				
				return result;
			}
			
			function constructCell(colConfig, value) {
				var result;
				
				if (value == null) value = '';
				
				// adding class if needed
				var styleClass = '';
				if (typeof colConfig.styleClass == 'string') {
					styleClass = 'class="' + colConfig.styleClass + '"';
				}
				
				var title = '';
				if (typeof colConfig.title == 'string') {
					title = 'title = "' + colConfig.title + '"';
				}
				
					
				// construction of inner cell HTML by type
				if (typeof colConfig.type == 'string') {
					
					if (colConfig.type == 'checkbox') {
						if (parseInt(value))
							result = '<input ' + styleClass + ' ' + title + ' type="checkbox" value=1 checked/>';
						else 
							result = '<input ' + styleClass + ' ' + title + ' type="checkbox" value=1 />';

					} else if (colConfig.type == 'additional') {
						if (typeof colConfig.data == 'string') 
							result = colConfig.data;
						else 
							result = '<span ' + styleClass + ' ' + title + '>' + value + '</span>';
						
					} else 
						result = '<span ' + styleClass + ' ' + title + '>' + value + '</span>';
					
				} else {
					result = '<span ' + styleClass + ' ' + title + '>' + value + '</span>';
				}
				
				return result;
			}
			
			function getPageSize(table) {
				var result = $("tfoot .pagesize", table);
				return $(result);
			}
			
			function getNextButton(table) {
				var result = $("tfoot .next", table);
				return $(result);
			}
			
			function getPrevButton(table) {
				var result = $("tfoot .prev", table);
				return $(result);
			}
			
			function getPageDisplay(table) {
				var result = $("tfoot .pagedisplay", table);
				return $(result);
			}
			
			function beforeRefresh(table) {
				// do nothing yet
			}
			
			function afterRefresh(table) {
				if (table.response.items.length == 0 && (table.request.page == 1)) {
				
					getPageSize(table).attr('disabled', true);
					
					elementHide(getNextButton(table));
					elementHide(getPrevButton(table));

					setPageDisplay(table, 0, 0);
				} else {
                    table.response.total = parseInt(table.response.total);
                    //table.request.rows = parseInt(table.request.rows);
                    
					getPageSize(table).removeAttr('disabled');
					
					if (table.response.total > table.request.rows * table.request.page) 
						elementShow(getNextButton(table));
					else elementHide(getNextButton(table));
						
					
					if(table.request.page > 1) elementShow(getPrevButton(table));
					else elementHide(getPrevButton(table));
					
					var totalPages = 
						((table.response.total + table.request.rows) 
							/ table.request.rows ) | 0;

                    if (totalPages * table.request.rows == (table.response.total + table.request.rows))
                        totalPages--;
					
					setPageDisplay(table, table.request.page, totalPages);
				}
			}
			
			function setPageDisplay(table, current, total) {
				getPageDisplay(table).text(' ' + current + '/' + total + ' ');
			}
			
			function elementShow(element) {
				element.css('display', 'inline');
			}
			
			function elementHide(element) {
				element.css('display', 'none');
			}
			
			function refresh(table) {
				beforeRefresh(table);

				$.getJSON(table.config.url, 
				table.request,
				function(response) {
					table.response = response;
					populate(table);
					afterRefresh(table);
					
					if (typeof table.config.onDrawComplete == 'function') 
						table.config.onDrawComplete.call(window, $(table));
				});
			}
			
			function redrawRow (table, row_id) {
				var specialRequest = new Object();
				
				for (var i in table.request) {
					specialRequest[i] = table.request[i];
				}
				
				specialRequest["row_id"] = row_id;
				
				$.getJSON(table.config.urlOneRow, 
					specialRequest,
					function(response) {
						if (typeof response != 'object') 
							return;
						
						var tInnerRowStr = constructRow(table.config.columns, response);
						var $tr = $("tr[row_id=" + row_id+"]", table);
						$tr.html(tInnerRowStr);
						
						if (typeof table.config.onDrawComplete == 'function') 
							table.config.onDrawComplete.call(window, $tr);
					}
				);	
			}

			function makeItSortable(table, th, sort) {
				$("thead .sortable" ,table).removeClass("headerSortDown")
					.removeClass("headerSortUp");

                if (typeof sort == 'string' && (sort == 'asc' || sort == 'desc')) {
                    if (sort == 'asc') {
                        $(th).addClass("headerSortUp");
                        $(th).attr("sort","asc");
                    } else {
                        $(th).addClass("headerSortDown");
                        $(th).attr("sort", "desc");
                    }
                } else {
                    if ($(th).attr("sort") == "asc") {
                        $(th).addClass("headerSortDown");
                        $(th).attr("sort", "desc");
                    } else {
                        $(th).addClass("headerSortUp");
                        $(th).attr("sort","asc");
                    }
                }
				
				table.request.sort = $(th).attr("sort");
				table.request.sortIndex = $(th).attr("sortIndex");
			}

            // sort column with rule (desc or asc)
            this.sortBy = function (sortIndex, sort) {
                return this.each(function() {

					var $this = $(this);
					var table = this;
                    var config = table.config;

					if ($this.attr("dktable") !== "1") {
						alert('Error: this container is not a dktable'); return false;
					}

                   
                    if (config.sortable.length !==0) {
                        if (
                            typeof sortIndex == 'number'
                            && typeof sort == 'string'
                            && sortIndex < config.headers.length
                            && (config.sortable.indexOf(sortIndex) !== -1)
                        ) {

                            $("thead th:eq(" + (sortIndex - 1) +
                                ")" ,table).each(function() {
                                makeItSortable(table,this, sort);
                            });

                        } else {
                            $("thead .sortable:eq(0)" ,table).each(function() {
                                makeItSortable(table,this);
                            });
                        }
					}

					return $this;
				});
            }
			
			/* refresh all data */
			this.refresh = function (data) {
				return this.each(function() {
					
					var $this = $(this);
					var table = this;

                    this.request.page = 1;
					this.request = $.extend( this.request, data );
					
					
					if ($this.attr("dktable") !== "1") {
						alert('Error: this container is not a dktable'); return false;
					}
					
					refresh(table);
                    return $this;
				});
			}

            /* refreash visible data */
            this.refreshVisible = function () {
				return this.each(function() {

					var $this = $(this);
					var table = this;

					if ($this.attr("dktable") !== "1") {
						alert('Error: this container is not a dktable'); return false;
					}

					refresh(table);
                    return $this;
				});
			}
			
			this.redrawRow = function (row_id) {
				return this.each(function() {
					
					var $this = $(this);
					var table = this;
					
					if ($this.attr("dktable") !== "1") {
						alert('Error: this container is not a dktable'); return false;
					}
					
					if (table.affectedRows.indexOf(row_id) === -1) {
						alert('Error: there is no such row in the table'); return false;
					}
					
					if (typeof table.config.urlOneRow != 'string') {
						table.config.urlOneRow = table.config.url;
					}
					
					redrawRow(table, row_id);
                    return $this;
				});
			}
			
			/* initialize table */	
			this.construct = function(settings) {
				return this.each(function() {
					
					var config, $this = $(this);
					var table = this;
					this.config = {};
					
					// populating config values
					config = $.extend(this.config, $.dktable.defaults, settings);
					// populating translate options
					config.translates = $.extend( 
							$.dktable.defaults.translates, settings.translates);
					
					// by default urlOneRow and url are equal
					if (typeof config.urlOneRow != 'string') {
						config.urlOneRow = config.url;
					}
					
					if (typeof config.url != 'string') {
						alert('Error: URL has to be specifyed'); return false;
					}
					
					if (typeof config.headers != 'object' || config.headers.length < 1) {
						alert('Error: HEADERS has to be specifyed and must not be empty'); return false;
					}
					
					if ($this.attr("dktable") == "1") {
						alert('Error: container already is dktable'); return false;
					}
					
					if (config.headers.length < config.columns.length) {
						// columns configuration array can't be longer than headers array
						alert('Error: headers.length < columns.length'); return false;
					} else if (config.headers.length > config.columns.length) {
						// default column type is TEXT
						var diff = config.headers.length - config.columns.length;
						for (var i=0; i < diff; i++) config.columns.push({type: 'text'});
					}
					
					// server response would be populated here
					this.response = {
						items: [],
						total: 0
					};
					// this data would be sent to the server
					this.request = {
						rows: this.config.defaultNumRows,
						page: 1
					};
					
					
					
					if (typeof settings.data == 'object')
						this.request = $.extend(this.request, settings.data);
					
					$this.attr("dktable" , "1");
					
					// заголовок
					var tHeadStr = drawHeader(table);
					// тело
					var tBodyStr = drawBody(table);
					// панель навигации
					var tFootStr = drawFoot(table);
					// применяем строку к объекту, получаем пустую таблицу
					$(this).html(tHeadStr + tBodyStr + tFootStr);
					
					getPageSize(table).change(function() {
						table.request.rows = $(this).children('option:selected').val();
						table.request.page = 1;
						refresh(table);
					});
					
					getNextButton(table).click(function() {
		
						table.request.page = table.request.page + 1;
						refresh(table);
					});
					
					getPrevButton(table).click(function() {
			
						table.request.page = table.request.page - 1;
						refresh(table);
					});


					if (config.sortable.length !==0) {
                        if (typeof config.defaultSortable == 'object'
                            && typeof config.defaultSortable.sortIndex == 'number'
                            && typeof config.defaultSortable.sort == 'string'
                            && (config.defaultSortable.sortIndex < config.headers.length)
                            && (config.sortable.indexOf(config.defaultSortable.sortIndex) !== -1)
                        ) {

                            $("thead th:eq(" + (config.defaultSortable.sortIndex - 1) +
                                ")" ,table).each(function() {
                                makeItSortable(table,this, config.defaultSortable.sort);
                            });

                        } else {
                            $("thead .sortable:eq(0)" ,table).each(function() {
                                makeItSortable(table,this);
                            });
                        }
					}
					
					$("thead .sortable" ,table).click(function() {
						makeItSortable(table, this);
						refresh(table);
					});
					
					$("tfoot .reload" , table).click(function() {
						table.request.page = 1;
						refresh(table);
					});
					
					refresh(table);
                    return $this;
				});
			}		
		}
	});

	$.fn.extend({
        dktable: $.dktable.construct,
        refresh: $.dktable.refresh,
        redrawRow: $.dktable.redrawRow,
        sortBy:   $.dktable.sortBy,
        refreshVisible: $.dktable.refreshVisible
	});
	

})(jQuery);

jQuery.fn.tableToCSV = function() {
    
    var clean_text = function(text){
        text = text.replace(/"/g, '""');
        return '"'+text+'"';
    };
    
	$(this).each(function(){
			var table = $(this);
			var caption = $(this).find('caption').text();
			var title = [];
			var rows = [];

			$(this).find('tr').each(function(){
            	var data = [];
				$(this).find('th').each(function(){
					if (!$(this).is(':last-child') && $(this).text() != 'Image') {
                    var text = clean_text($(this).text());
					title.push(text);
				    }
					});
				$(this).find('td').each(function(){
					if (!$(this).is(':last-child') && !$('img',this).length > 0) {					
					if($(this).closest('table').find('th').eq($(this).index()).text() == 'User Status'){
                          var text = clean_text($(this).find('.ok').text());
					}
					else if($(this).closest('table').find('th').eq($(this).index()).text() == 'Owner Status'){
                          var text = clean_text($(this).find('.ok').text());
					}
					else if($(this).closest('table').find('th').eq($(this).index()).text() == 'Status'){
                          var text = clean_text($(this).find('.ok').text());
					}					
					else{
					var text = clean_text($(this).text());
				    }
				    data.push(text);
				    } 
					});
				data = data.join(",");
				rows.push(data);
				});
			title = title.join(",");
			rows = rows.join("\n");

			var csv = title + rows;
			var uri = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csv);
			var download_link = document.createElement('a');
			download_link.href = uri;
			var ts = new Date().getTime();
			if(caption==""){
				download_link.download = ts+".csv";
			} else {
				download_link.download = caption+"-"+ts+".csv";
			}
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);
	});
    
};

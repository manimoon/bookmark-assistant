urlregexp = new RegExp("(http|ftp|https)://[\w-]+(\.[\w-]+)+([\w.,@?^=%&amp;:/~+#-]*[\w@?^=%&amp;/~+#-])?");

setContentHeading = function(heading){
	if($(".content-panel").find(".panel-heading").length<1) {
		$("<div></div>").addClass("panel-heading").appendTo(".content-panel");
	}
	$(".content-panel .panel-heading").html("<h2>"+heading+"</h2>");
};

setContentBody = function(body){
	if($(".content-panel").find(".panel-body").length<1) {
		$("<div></div>").addClass("panel-body").appendTo(".content-panel");
	}
	$(".content-panel .panel-body").html(body);
};


setContentFooter = function(footer){
	if($(".content-panel").find(".panel-footer").length<1) {
		$("<div></div>").addClass("panel-footer").appendTo(".content-panel");
	}
	$(".content-panel .panel-footer").html(footer);
};

setContent = function(heading,body,footer) {
	setContentHeading(heading);
	setContentBody(body);
	setContentFooter(footer);
};

loadMyLinks = function() {
	$.ajax({
		type:'GET',
		url:'loadlinks.php',
		dataType:'json',
		data:{},
		success:function(data){
			var container = $("<div></div>");
			for(var i in data) {
				var block=$("<div></div>");
				$("<h2>"+i+"</h2>").appendTo(block);
				var table = $("<table></table>");
				table.addClass("table");
				table.addClass("table-hover");
				table.addClass("table-bordered");
				for(var j in data[i]) {
					var row = $("<tr></tr>");
					$("<td class='col-md-4'>"+data[i][j]['title']+"</td>").appendTo(row);
					$("<td class='col-md-8'><a href='"+data[i][j]['url']+"'>"+data[i][j]['url']+"</a></td>").appendTo(row);
					table.append(row);
				}
				block.append(table);
				container.append(block);
			}
			setContent("My Bookmarks",null,null);
			$(".content-panel .panel-body").append(container);
		},
		error:function(x,y,z){
			console.log(JSON.stringify(x));
			console.log(JSON.stringify(y));
			console.log(JSON.stringify(z));
		}
	});
};

addLink = function(category,link,description){
	$.ajax({
		type:'POST',
		url:'addlink.php',
		data:{category:category,link:link,description:description},
		success:function(data){
			console.log(data);
		},
		error:function(x,y,z){
			console.log(JSON.stringify(x));
			console.log(JSON.stringify(y));
			console.log(JSON.stringify(z));
		}
	});
}

loadAddLinks = function() {
	$.get("addlinks.html",{},function(data){
		var dialog = $(data);
		dialog.modal();
		$("#addlinks-category").val("");
		$("#addlinks-link").val("");
		$("#addlinks-description").val("");
		
		$("#addlinks-add",dialog).click(function(){
			var category = $("#addlinks-category").val();
			var link = $("#addlinks-link").val();
			var description = $("#addlinks-description").val();
			
			if(!urlregexp.test(link)) {
				$("#addlinks-link").parent().addClass("has-error");
				return;
			}
			if(description.length<=0) {
				$("#addlinks-description").parent().addClass("has-error");
				return;
			}
			addLink(category,link,description);
			dialog.modal('hide');
		});
	});	
}

loadMyContacts = function() {

};

loadSearchResults = function(query){
	$.getJSON("search_complete.php",{query:query},function(obj){
		$("#search-result table").html("");
		for(var i in obj) {
			$("<tr><td>"+obj[i]['title']+"</td>"+
			"<td><a href='"+obj[i]['url']+"'>"+obj[i]['url']+"</a></td>"+
			"<td>"+obj[i]['category']+"</td></tr>").appendTo("#search-result table");
		}
	});
}

loadSearchPage = function() {
	$.get("search.php",function(data){
		setContent("Search",data,null);
		$("#search-input").bind("keyup",function(event){
			loadSearchResults($("#search-input").val());
		});
	});
};

$(function(){
	loadMyLinks();
	$(".nav li a").click(function(event){
		hash = event.target.hash;
		
		if(hash=="#AddLink") {
			loadAddLinks();
		} else if(hash=="#Search") {
			loadSearchPage();
		} else if(hash=="#MyLinks") {
			loadMyLinks();
		} else if(hash=="#MyContacts") {
			loadMyContacts();
		} else {
			console.log(hash)
		}
		event.preventDefault();
	});
});

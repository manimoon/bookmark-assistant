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

loadComments = function(comment_id,element){
	element.html("");
	$.ajax({
		type:'GET',
		dataType:'json',
		url:'loadcomments.php',
		data:{id:comment_id},
		async:true,
		success:function(obj){
			console.log(obj);
			for(var i in obj) {
				
				var sender = $("<sender></sender>");
				sender.html(obj[i]['username']+":");
				var comment_text = $("<div></div>")
				comment_text.html(obj[i]['comment_text']);
				
				var comment=$("<div class='comment'></div>");
				
				comment.append(sender);
				comment.append(comment_text);
				element.append(comment);
			}
		}
		
	});
};

postAndLoadComment = function(link_id,comment_text,element){
	$.ajax({
		type:'POST',
		url:'comment.php',
		dataType:'text',
		data:{link_id:link_id,comment_text:comment_text},
		success:function(data){
			loadComments(link_id,element);
		},
		async:true
	});	
};

loadLink = function(id) {
	$.get("link_dialog.php?seed="+Math.random(),{id:id},function(data){
		var dialog = $(data);
		dialog.modal();
		loadComments(id,$("#link-dialog-comments",dialog));
		$.get("getlikes.php",{id:id},function(data){
			$("#link-dialog-likes",dialog).html(data);
		});
		$(".close",dialog).click(function(){
			dialog.modal('hide');
		});
		$("#link-dialog-comment-button",dialog).click(function(){
			var comment = $("#link-dialog-textarea",dialog).val();
			$("#link-dialog-textarea",dialog).val("");
			postAndLoadComment(id,comment,$("#link-dialog-comments",dialog));
			//$("#link-dialog-comments",dialog).html("#link-dialog-textarea");
		});
		$("#link-dialog-like-button",dialog).click(function(){
			$.ajax({
				type:'GET',
				url:'like.php',
				data:{id:id},
				success:function(data){
					$.get("getlikes.php",{id:id},function(data){
						$("#link-dialog-likes",dialog).html(data);
					});
				}
			});
		});
		$("#link-dialog-share-button",dialog).click(function(){
			$("#link-dialog-share-options",dialog).removeClass("hidden");
		});
		$("#link-dialog-share-final-button",dialog).click(function(){
			alert($("#link-dialog-share-options input",dialog).val());
		});
	});
	
};

loadUserLinks = function(id,username){
	$.ajax({
		type:'GET',
		url:'loadlinks.php',
		dataType:'json',
		data:{id:id},
		success:function(data){
			var container = $("<div></div>");
			if(data['empty']=='true') {
				setContent(username,"<div class='alert alert-danger'>"+"The user did not add any links yet.</div>",null);
				return;
			}
			for(var i in data) {
				var block=$("<div></div>");
				$("<h2>"+i+"</h2>").appendTo(block);
				var table = $("<table></table>");
				table.addClass("table");
				table.addClass("table-hover");
				table.addClass("table-bordered");
				for(var j in data[i]) {
					var row = $("<tr link_id="+j+"></tr>");
					$("<td class='col-md-4'>"+data[i][j]['title']+"</td>").appendTo(row);
					$("<td class='col-md-8'><a href='"+data[i][j]['url']+"' target='_blank'>"+data[i][j]['url']+"</a></td>").appendTo(row);
					table.append(row);
					row.click(function(){
						loadLink($(this).attr('link_id'));
					});
				}
				block.append(table);
				container.append(block);
			}
			setContent(username,null,null);
			$(".content-panel .panel-body").append(container);
		},
		error:function(x,y,z){
			console.log(JSON.stringify(x));
			console.log(JSON.stringify(y));
			console.log(JSON.stringify(z));
		}
	});	
};

loadMyLinks = function() {
	$.ajax({
		type:'GET',
		url:'loadlinks.php',
		dataType:'json',
		data:{},
		success:function(data){
			var container = $("<div></div>");
			if(data['empty']=='true') {
				setContent("My Bookmarks","<div class='alert alert-danger'>"+"You did not add any links yet. Add links by clicking 'Add new Bookmark'."+"</div>",null);
				return;
			}
			for(var i in data) {
				var block=$("<div></div>");
				$("<h2>"+i+"</h2>").appendTo(block);
				var table = $("<table></table>");
				table.addClass("table");
				table.addClass("table-hover");
				table.addClass("table-bordered");
				for(var j in data[i]) {
					var row = $("<tr link_id="+j+"></tr>");
					$("<td class='col-md-4'>"+data[i][j]['title']+"</td>").appendTo(row);
					$("<td class='col-md-8'><a href='"+data[i][j]['url']+"' target='_blank'>"+data[i][j]['url']+"</a></td>").appendTo(row);
					table.append(row);
					row.click(function(){
						loadLink($(this).attr('link_id'));
					});
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
};

loadAddLinks = function() {
	
	$.get("addlinks_dialog.php?seed="+Math.random(),{'list':$("#TheSpecialPageElement").html()},function(data){
		var dialog = $(data);
		dialog.modal();
		$("#addlinks-category").val("");
		$("#addlinks-link").val("");
		$("#addlinks-description").val("");
		$("#addlinks-add",dialog).unbind();
		$("#addlinks-add",dialog).click(function(){
			$(".addlink-well").each(function(obj){
				category=$(".addlink-category",this).val();
				link=$(".addlink-link",this).val();
				desc=$(".addlink-desc",this).val();
				addLink(category,link,desc);
				loadMyLinks();
			});
			//addLink(category,link,description);
			dialog.modal('hide');
		});
	});	
}

loadProfile = function(username,id) {
	loadUserLinks(id,username);
}

loadPeopleSearchResults = function(query){
    $.getJSON("people_search_complete.php",{query:query},function(obj){
        var user = obj['user'];
        var contacts = obj['contacts'];
        var search_result = $("#people-search-result");
        var others= $("<div><h3>Others:</h3></div>");
        var friends=$("<div><h3>Friends:</h3></div>");
        search_result.html("");
		for(var i in user) {
			var row = $("<div class='row'></div>");
			var propic="";
			if(user[i]['profile_pic']=='data: ;base64,'  || user[i]['profile_pic']=='') {
				propic="anon.jpg";
			} else {
				propic=user[i]['profile_pic'];
			}
			$("<div></div>").addClass("person").addClass("col-md-3").html("<img src='"+propic+"' />").appendTo(row);
			$("<div></div>").addClass("col-md-4")
			.html("<table>\
				<tr><td>username</td><td>:</td><td>"+user[i]['username']+"</td></tr>\
				<tr><td>Name</td><td>:</td><td>"+user[i]['first_name']+" "+user[i]['last_name']+"</td></tr>\
				<tr><td><button class='addfriend btn btn-default' user='"+user[i]['user_id']+"'>Add Friend <span class='glyphicon glyphicon-plus'></span></button></td><td</td><td></td></tr>\
				</table>").appendTo(row);
			others.append(row);
		}
		$(".addfriend",others).click(function(){
			$.post("addfriend.php",{friend:$(this).attr("user")},function(data){
				console.log(data);
				loadPeopleSearchResults(query);
			});
		});
		console.log(contacts);
		for(var i in contacts) {
			var row = $("<div class='row'></div>");
			if(contacts[i]['profile_pic']=='data: ;base64,' || contacts[i]['profile_pic']=='') {
				propic="anon.jpg";
			} else {
				propic=contacts[i]['profile_pic'];
			}
			$("<div></div>").addClass("person").click(function(){
				loadProfile(contacts[i]['username'],contacts[i]['user_id']);
			}).addClass("col-md-3").html("<img src='"+propic+"' />").appendTo(row);
			$("<div></div>").addClass("col-md-4")
			.html("<table>\
				<tr><td>username</td><td>:</td><td>"+contacts[i]['username']+"</td></tr>\
				<tr><td>Name</td><td>:</td><td>"+contacts[i]['first_name']+" "+contacts[i]['last_name']+"</td></tr>\
				<tr><td>Friends <span class='glyphicon glyphicon-ok'></span></td><td</td><td></td></tr>\
				</table>").appendTo(row);
			friends.append(row);
		}
		search_result.append(others);
		search_result.append(friends);
    });
};

loadMyContacts = function() {
    $.get("people_search.php",function(data){
        setContent("People Search",data,null);
        $("#people-search-input").bind("keyup",function(event){
            loadPeopleSearchResults($("#people-search-input").val());
        });
        loadPeopleSearchResults('');
    });
};

loadSearchResults = function(query){
	$.getJSON("search_complete.php",{query:query},function(obj){
		$("#search-result table").html("");
		for(var i in obj) {
			$("<tr><td>"+obj[i]['title']+"</td>"+
			"<td><a href='"+obj[i]['url']+"' target='_blank'>"+obj[i]['url']+"</a></td>"+
			"<td>"+obj[i]['category']+"</td></tr>").appendTo("#search-result table");
		}
	});
};

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
			return;
		}
		event.preventDefault();
	});
	
	$("#open-notifications").click(function(event){
		$.get("notifications.php?seed="+Math.random(),{},function(data){
			var dialog = $(data);
			dialog.modal();
			$(".close",dialog).click(function(){
			dialog.modal('hide');
			});
		});
		event.preventDefault();
	});
});


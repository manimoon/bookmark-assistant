$(function(){
	setContentHeading = function(heading){
		if($(".content-panel").find(".panel-heading").length<1) {
			$("<div></div>").addClass("panel-heading").appendTo(".content-panel");
		}
		$(".content-panel .panel-heading").html(heading);
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
	

	$(".nav li a").click(function(event){
		hash = event.target.hash;
		
		if(hash=="#Search") {
			alert("searching...");
		} else if(hash=="#MyLinks") {
			alert(hash);
		} else if(hash=="#MyContacts") {
			//
		} else {
			console.log(hash)
		}
		event.preventDefault();
	});
});

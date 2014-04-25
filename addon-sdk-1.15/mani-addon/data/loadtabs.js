$(function(){
	for(var i in self.options) {
		var title=self.options[i].title;
		var url=self.options[i].url;

		var div=$("<div class='link'></div>");

		$("<div>title:<input value='"+title+"'/></div>").appendTo(div);
		$("<div>link:<input value='"+url+"' /></div>").appendTo(div);
		div.appendTo("#content");
	}
});

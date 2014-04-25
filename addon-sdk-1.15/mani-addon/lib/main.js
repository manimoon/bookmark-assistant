var widgets = require("sdk/widget");
var tabs = require("sdk/tabs");
var data = require("sdk/self").data;

var widget = widgets.Widget({
	id: "mozilla-link",
	label: "Social Bookmarking Service",
	contentURL: "http://www.mozilla.org/favicon.ico",
	onClick: listTabs
});



function listTabs() {
	openTabsList=[];
	for each (var tab in tabs) {
		openTabsList.push({"title":tab.title,"url":tab.url});
	}

	tabs.open({
	url:"http://bookmarks-manimoon.rhcloud.com/",
	onOpen: function(tab) {
		tab.on('ready',function(tab){
			tab.attach({
			contentScriptFile:[data.url('jquery.js'),data.url('loadtabs.js')],
			contentScriptOptions:openTabsList,
			contenScriptWhen:"end"
			});
		});
	}
});
}


var pageMod = require("sdk/page-mod");
var tabs = require("sdk/tabs");
var self=require("sdk/self");
 
// Create a page mod
// It will run a script whenever a ".org" URL is loaded
// The script replaces the page contents with a message
openTabsList=[];

pageMod.PageMod({
  include: "*",
  contentScriptFile: [self.data.url("jquery.js"), self.data.url("my-script.js")],
  onAttach:function(worker){
	openTabsList=[];
	listTabs();
	console.log(openTabsList);
	worker.port.emit("replacePage",openTabsList);
  }
});

function listTabs() {
        for each (var tab in tabs) {
                openTabsList.push({"title":tab.title,"url":tab.url});
        }
}

self.port.on("replacePage", function(obj) {
  $("#TheSpecialPageElement").html(JSON.stringify(obj));
});

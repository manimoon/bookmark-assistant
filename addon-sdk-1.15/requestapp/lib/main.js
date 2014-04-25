var Request = require("sdk/request").Request;
var quijote = Request({
  url: "http://localhost/~ratanraj/sourcerer/test.php",
  overrideMimeType: "text/plain; charset=latin1",
  onComplete: function (response) {
    console.log(response.text);
  }
});

quijote.get();


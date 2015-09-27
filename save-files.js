var fs = require('fs');
var request = require('request');
exports.saveImageOnServer = function (path,cb) {
	var download = function(uri, filename, callback){
		console.log(uri + " es la url");
		
  request.head(uri, function(err, res, body){
    console.log('content-type:', res.headers['content-type']);
    console.log('content-length:', res.headers['content-length']);

    request(uri).pipe(fs.createWriteStream(filename)).on('close', callback);
  });
};

var piecesUrl = path.split("/");
var nameFile = piecesUrl[piecesUrl.length-1];
download(path, 'photo/' + nameFile, function(){
  cb( "http://clo.cl/alice/telcc/photo/" + nameFile);
});


};







var request = require('request');
var token = "127742608:AAHRjMYj3UHadAZqV5FdOtnTGCOSY0FyU0Q";
exports.getImageFile = function (file_id,cb) {
			var options = {
			  url: 'https://api.telegram.org/bot' + token + '/getFile?file_id=' + file_id,
			}
			request(options, function (error, response, body) {
					  if (error && response.statusCode != 200) {
					  	console.log("error" + body);
					  	 cb(error);
					  }else{
					  	var info = JSON.parse(body);
					  	console.log(info);
					      return cb("https://api.telegram.org/file/bot127742608:AAHRjMYj3UHadAZqV5FdOtnTGCOSY0FyU0Q/"+info.result.file_path);
					  }
			})


};







var AliceBot = require('telegram-bot-bootstrap');
var JohnBot = require('node-telegram-bot-api');
var fs = require('fs');

var token = '127742608:AAHRjMYj3UHadAZqV5FdOtnTGCOSY0FyU0Q';

var Alice = new AliceBot(token); // Envia mensajes
var John = new JohnBot(token, {polling: true}); // Recibe mensajes

var Firebase = require("firebase");
var FSRoot = new Firebase('https://telegramcc.firebaseio.com');
var FSSendMessage = new Firebase('https://telegramcc.firebaseio.com/send-message');
var FSChatsId = new Firebase('https://telegramcc.firebaseio.com/telpdv');



 FSSendMessage.on('child_added', function (snapshot) {
                    var data = snapshot.val();
                    var key = snapshot.key();
                    //console.log(data) ; 
                    if(data.sent == "0"){
                        console.log(key);
                        
                        FSChatsId.on('child_added', function (snapshot) {
                                var dataChat = snapshot.val();
                                var keyChat = snapshot.key();
                                console.log(keyChat) ; 
                                Alice.sendMessage(keyChat, data.message, undefined, undefined, '');
                        });
                        var FSAux = new Firebase('https://telegramcc.firebaseio.com/send-message/'+key);
                        FSAux.set({ sent: '1'}, onComplete);
                    }
});




var onComplete = function(error) {
  if (error) {
    console.log('Synchronization failed');
  } else {
    console.log('Synchronization succeeded');
  }
};
/*
 3585272: 3
 133590769: 2
 136337440: 1
*/

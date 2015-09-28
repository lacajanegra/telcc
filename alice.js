var AliceBot = require('telegram-bot-bootstrap');
var JohnBot = require('node-telegram-bot-api');
var fs = require('fs');

var token = '127742608:AAHRjMYj3UHadAZqV5FdOtnTGCOSY0FyU0Q';

var Alice = new AliceBot(token); // Envia mensajes
var John = new JohnBot(token, {polling: true}); // Recibe mensajes

var Firebase = require("firebase");
var FSStock = new Firebase('https://telegramcc.firebaseio.com/stock');
var FSLocations = new Firebase('https://telegramcc.firebaseio.com/locations');
var FSImages = new Firebase('https://telegramcc.firebaseio.com/images');
var FSComment = new Firebase('https://telegramcc.firebaseio.com/comments');

 var requester = require("./telegram-request");
 var SaveFiles = require("./save-files");

var autoAssist = [];


John.on('message', function (msg) {
    console.log(">> mensaje " + msg.text + " recibido desde id:" + msg.chat.id);
   // console.log(msg);
    receiveMessage(msg);
});


function receiveMessage(msg){
    var chatId = msg.chat.id;
    var autoAssistPos = autoAssist.map(function(x) {return x.id; }).indexOf(chatId); //Comprobamos si ya esta siendo atendido
    var kb="";
    if (autoAssistPos == -1) { // primera vez que entra a autoatención
        autoAssist.push({"id":chatId, "node":"x"}); 
        kb = prepareKeyboard("x");
        Alice.sendMessage(chatId, "Hola " + msg.from.first_name +  " Bienvenido a GySTrade, elige una opción:", undefined, undefined, kb);
    }else{ // ya está en autoatención
        optionDispatcher(msg,autoAssist[autoAssistPos].node,autoAssistPos);
    }
}


function optionDispatcher(msg, actualNode,autoAssistPos){
    var chatId = msg.chat.id;
    if (actualNode=="x") {
        console.log("texto dice " +msg.text);
        if(msg.text == "Enviar Comentario"){
            console.log("entre a comentarios")
            autoAssist[autoAssistPos].node="Enviar Comentario";
            Alice.sendMessage(chatId, "Escribe comentario, por fa:");
        }
        if (msg.text == "Ingresar Stock") { 
            autoAssist[autoAssistPos].node="Ingresar Stock";
            console.log("texto dice ingresar stcok");
            Alice.sendMessage(chatId, "Ingresa el stock:");
        }else if(msg.text == "Enviar Comentario"){
        }else if(msg.text == "Marcar Ingreso"){
            autoAssist[autoAssistPos].node="Marcar Ingreso";
            Alice.sendMessage(chatId, "Comparte Ubicación, porfavor:");
        }else if(msg.text == "Ingresar Foto"){
            autoAssist[autoAssistPos].node="Ingresar Foto";
            Alice.sendMessage(chatId, "Envia foto, por fa:");
        };
    }else if(actualNode=="Ingresar Stock") {
        console.log("aca agrego el stock");
        addStock(chatId, msg.text);
        outAutoAssist(autoAssistPos,chatId);
    }else if(actualNode=="Marcar Ingreso") {
        if(typeof msg.location !== 'undefined' && msg.location){
            addLocation(chatId, msg.location.latitude, msg.location.longitude);
            outAutoAssist(autoAssistPos,chatId);
        }else{
            Alice.sendMessage(chatId, "Ubicación, porfavor:");
        }
    }else if(actualNode == "Ingresar Foto"){
        if(typeof msg.photo !== 'undefined' && msg.photo){
            requester.getImageFile(msg.photo[2].file_id,function cb(data){
            console.log("lista la data de foto " + data);
            SaveFiles.saveImageOnServer(data, function(data){
                console.log(">> url de la imagen subida: " + data);
                addImage(chatId, data);
                outAutoAssist(autoAssistPos,chatId);
            }); 
        });      
        }else{
            Alice.sendMessage(chatId, "Foto, porfavor:");
        }
    }else if(actualNode == "Enviar Comentario"){
        if(typeof msg.text !== 'undefined' && msg.text){
            addComment(chatId, msg.text);
            outAutoAssist(autoAssistPos,chatId);   
        }else{
            Alice.sendMessage(chatId, "Texto, porfavor:");
        };
    };
}

function addStock(chatId,stock){
    FSStock.push({"chatId":chatId, "stock":stock});
}
function addComment(chatId,comment){
    FSComment.push({"chatId":chatId, "comment":comment});
}
function addImage(chatId,img){
    FSImages.push({"chatId":chatId, "img":img});
}
function addLocation(chatId,latitude, longitude){
    FSLocations.push({"chatId":chatId, "lat":latitude, "lng":longitude});
}
function prepareKeyboard(node){
    if (node=="x") {
        var kb = {
        keyboard: [
            ['Ingresar Stock'],
            ['Marcar Ingreso'],
            ['Ingresar Foto'],
            ['Enviar Comentario'],
                    ],
            one_time_keyboard: true
        };
        return kb;
    }else{
        
    };
}
function outAutoAssist(autoAssistPos,chatId){
  autoAssist.splice(autoAssistPos, 1);
  Alice.sendMessage(chatId, "Finalizado, Gracias!");
}

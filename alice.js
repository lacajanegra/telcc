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
var FSRoot = new Firebase('https://telegramcc.firebaseio.com');
 var requester = require("./telegram-request");
 var SaveFiles = require("./save-files");

var autoAssist = [];

       

        

John.on('message', function (msg) {
    console.log(">> mensaje " + msg.text + " recibido desde id:" + msg.chat.id);
   // console.log(msg);
   console.log("Running");
    
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
            Alice.sendMessage(chatId, "Escribe comentario, por favor:");
        }
        else if (msg.text == "Ingresar Stock") { 
            autoAssist[autoAssistPos].node="Selecciona Producto (Stock)";
            console.log("texto dice ingresar stcok");
            var kb='';
            prepareKeyboard("stock",chatId,function(data){
                    console.log(data);
                    kb=data;    
                    Alice.sendMessage( chatId,data, undefined, undefined, kb);    
            });

            //Alice.sendMessage(chatId, "Ingresa el stock:");
        }else if (msg.text == "Ingresar Pedido") { 
            autoAssist[autoAssistPos].node="Selecciona Producto (Pedido)";
            console.log("texto dice ingresar stcok");
            var kb='';
            prepareKeyboard("stock",chatId,function(data){
                    console.log(data);
                    kb=data;    
                    Alice.sendMessage( chatId,data, undefined, undefined, kb);    
            });

            //Alice.sendMessage(chatId, "Ingresa el stock:");
        }else if (msg.text == "Ingresar Venta") { 
            autoAssist[autoAssistPos].node="Selecciona Producto (Venta)";
            console.log("texto dice ingresar Venta");
            var kb='';
            prepareKeyboard("stock",chatId,function(data){
                    console.log(data);
                    kb=data;    
                    Alice.sendMessage( chatId,data, undefined, undefined, kb);    
            });

            //Alice.sendMessage(chatId, "Ingresa el stock:");
        }else if(msg.text == "Enviar Comentario"){
        }else if(msg.text == "Marcar Ingreso"){
            autoAssist[autoAssistPos].node="Marcar Ingreso";
            Alice.sendMessage(chatId, "Comparte Ubicación, porfavor:");
        }else if(msg.text == "Ingresar Foto"){
            autoAssist[autoAssistPos].node="Ingresar Foto";
            Alice.sendMessage(chatId, "Envia foto, por favor:");
        };
    }else if(actualNode=="Ingresar Stock") {
        console.log("aca agrego el stock");
        if (addStock(chatId, msg.text)==1){
            console.log("Ingresar Stock: Hecho");
            outAutoAssist(autoAssistPos,chatId);
        }else{
            console.log("Aun no se ingresa stock");
        }
        
    }else if(actualNode=="Selecciona Producto (Stock)") {
        console.log("aca selecciona producto");
        if (addStock(chatId, msg.text)==1){
            console.log("Ingresar Stock: Hecho");
            outAutoAssist(autoAssistPos,chatId);
        }else{
            console.log("Aun no se ingresa stock");
        }
    }else if(actualNode=="Selecciona Producto (Venta)") {
        console.log("aca selecciona producto");
        if (addSale(chatId, msg.text)==1){
            console.log("Ingresar Venta: Hecho");
            outAutoAssist(autoAssistPos,chatId);
        }else{
            console.log("Aun no se ingresa stock");
        }
    }else if(actualNode=="Selecciona Producto (Pedido)") {
        console.log("aca selecciona producto");
        if (addOrder(chatId, msg.text)==1){
            console.log("Ingresar Pedido: Hecho");
            outAutoAssist(autoAssistPos,chatId);
        }else{
            console.log("Aun no se ingresa stock");
        }
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

function addStock(chatId,msg){
    var res = msg.split(":");
    if (formatValue(msg) == 1){
             var FSAux = new Firebase('https://telegramcc.firebaseio.com/telpdv/'+chatId);
                        FSAux.on('value', function (snapshot) {
                            var data = snapshot.val();
                            FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products/'+res[0]);
                            FSAux.update({ stock: res[1] });
                        });   



               delete FSAux;
               return 1;
    }else{
        console.log("error formato");
        Alice.sendMessage(chatId, "Error en el formato, intenta otra vez");
        return 0;
    }

    //FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products');
   // FSStock.push({"chatId":chatId, "stock":stock});
}
function addSale(chatId,msg){
    var res = msg.split(":");
     if (formatValue(msg) == 1){   
             var FSAux = new Firebase('https://telegramcc.firebaseio.com/telpdv/'+chatId);
                        FSAux.on('value', function (snapshot) {
                            var data = snapshot.val();
                            FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products/'+res[0]);
                            FSAux.update({ sales: res[1] });
                        });   



               delete FSAux;
               return 1;
       }else{
        console.log("error formato");
        Alice.sendMessage(chatId, "Error en el formato, intenta otra vez");
        return 0;
    }
    //FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products');
   // FSStock.push({"chatId":chatId, "stock":stock});
}
function addOrder(chatId,msg){
    var res = msg.split(":");
     if (formatValue(msg) == 1){  
                 var FSAux = new Firebase('https://telegramcc.firebaseio.com/telpdv/'+chatId);
                            FSAux.on('value', function (snapshot) {
                                var data = snapshot.val();
                                FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products/'+res[0]);
                                FSAux.update({ order: res[1] });
                            });   



                   delete FSAux;
                   return 1;
       }else{
        console.log("error formato");
        Alice.sendMessage(chatId, "Error en el formato, intenta otra vez");
        return 0;
    }
    //FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products');
   // FSStock.push({"chatId":chatId, "stock":stock});
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
function prepareKeyboard(node, chatId,cb){
    var kb, productsRet;
    if (node=="x") {
         kb = {
        keyboard: [
            ['Ingresar Stock'],
            ['Ingresar Venta'],
            ['Ingresar Pedido'],
            ['Marcar Ingreso'],
            ['Ingresar Foto'],
            ['Enviar Comentario'],
                    ],
            one_time_keyboard: true
        };
        return kb;
    }else if(node=="stock" || node=="sales" ){
        Alice.sendMessage( chatId,"Ingresa 'Código de producto':'Cantidad' \n Ej: 1:10 \n\n Los productos disponibles son:", undefined, undefined, kb);    

         kb = {
        keyboard: [
                    ],
            one_time_keyboard: true
        };
console.log(kb);   
        var FSAux = new Firebase('https://telegramcc.firebaseio.com/telpdv/'+chatId);
                FSAux.on('value', function (snapshot) {
                    var data = snapshot.val();

                    FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products');
                    FSAux.on('child_added', function (snapshot) {
                        var data = snapshot.val();
                        var key = snapshot.key();
                       kb.keyboard.push([key + " - " + data.name]);
                       productsRet = key + " - " + data.name;
                       //console.log(kb);   
                            cb (productsRet);     
    
                    });
                });   



       delete FSAux;
     
    };


}
function outAutoAssist(autoAssistPos,chatId){
  autoAssist.splice(autoAssistPos, 1);
  Alice.sendMessage(chatId, "Finalizado, Gracias!");
}



function addOrder2(chatId,msg){

    //var formatFlag = 1;
    formatValue(chatId,msg);
    //console.log(formatFlag);
      // return;
    //FSAux = new Firebase('https://telegramcc.firebaseio.com/pdv/'+String(data)+'/products');
   // FSStock.push({"chatId":chatId, "stock":stock});
}
function formatValue(msg){
    //console.log( msg);
    var res = msg.split(":");
    
    if (res.length != 2){
        console.log("error de formato");
        return 0;
    }else{
         if ((validar_num(res[0]) == 1) && (validar_num(res[1]) == 1)){
            console.log("formato válido");
            return 1;
         }else{
            return 0;
         }
        
    }
}


function validar_num(num){
    if(isNaN(num)){
         //console.log("no es numero");
        return 0;
    }else{
       //console.log("es numero");
        return 1;
    }
}

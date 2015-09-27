var TelegramBot = require('node-telegram-bot-api');
//contactcenter bot  134999044:AAGU9H89mCMp2XxjWsSIXvNjGrwMbW2-zng
//var token = 'd23bc90ed63c4fc65867d01c027a6eb6';
var token = '127742608:AAHRjMYj3UHadAZqV5FdOtnTGCOSY0FyU0Q'
// Setup polling way
var bot = new TelegramBot(token, {polling: true});
var promotors = [];
var autoAssist = [];

promotors.push(3585272);


var Firebase = require("firebase");
var FSStock = new Firebase('https://telegramcc.firebaseio.com/stock');
//promotors.push(40306810);

bot.getMe().then(function (me) {
  console.log('Hi my name is %s!', me.username);
});

bot.on('message', function (msg) {
 
    console.log(">> mensaje recibido desde id:" + msg.chat.id);
   receiveMessage(msg);
    //bot.sendMessage(chatId, "Bienvenido a GySTrade, elige una opción: \n \n 1) Ingresar Stock \n 2) Enviar comentario");
});

function receiveMessage(msg){
  var wMsg="";
    var chatId = msg.chat.id;
        console.log(msg);
    var autoAssistPos = autoAssist.map(function(x) {return x.id; }).indexOf(chatId); 
    if (autoAssistPos == -1) { // primera vez que entra a autoatención
      var kb = {
        keyboard: [
            ['one'],
            ['two', 'three'],
            ['four', 'five', 'six']
        ],
        one_time_keyboard: true
    };
        bot.sendMessage(chatId, "Hola " + msg.from.first_name +  " Bienvenido a GySTrade, elige una opción: \n \n 1) Ingresar Stock \n 2) Enviar comentario", undefined, undefined, kb);
        promotors.push(msg.chat.id);
        autoAssist.push({"id":chatId, "node":"x"}); 
    }else{ // ya estaba
         var objAutoAttention = [];
        console.log(autoAssist[autoAssistPos].node);
        objAutoAttention = getSunNode(autoAssist[autoAssistPos].node,msg); //traemos las opciones para el nodo actual
        console.log(objAutoAttention);
        var optionPos = objAutoAttention.map(function(x) {return x.option; }).indexOf(msg.text);
        if (optionPos == -1){
                console.log("opcion incorrecta");
          }else{
            console.log(objAutoAttention);
                console.log("opcion correcta");
                getSunNode(autoAssist[autoAssistPos].node).forEach(function(data){
                  console.log(data.description);
                        if (data.description == "send-stock"){
                          console.log("entre a snd stock");
                              sendStock(msg,autoAssistPos);
                        }
                        wMsg = wMsg + data.description + "\r\n";
                        if (data.end==1){
                          console.log("fin");
                          autoAssist.splice(autoAssistPos, 1);
                        }
                  });
                var flagOptionAssignAgent=0;
                autoAssist[autoAssistPos].node = autoAssist[autoAssistPos].node + msg.text;
                getSunNode(autoAssist[autoAssistPos].node);
                       

          };

    };


}




function getSunNode(actualNode){
              var ret = [];
              if (actualNode == 'x') {
                      ret[0] = {"id":"1","option":"1","description":"1. Ingresar Stock"};
                      ret[1] = {"id":"2","option":"2","description":"2. Enviar Comentario"};
                      return ret;
              }else if(actualNode == 'x1'){
                      ret[0] = {"id":"11","option":"3","description":"send-stock"};
                      //console.log("debo enviar este parametro");
                      return ret;
              }else if(actualNode == 'x2'){
                      ret[0] = {"id":"8","option":"1","description":"1. Quiénes pueden acceder al Crédito con Aval del estado?"};
                      ret[1] = {"id":"9","option":"2","description":"2. Cuáles son los requisitos para obtener el crédito?"};
                      ret[2] = {"id":"10","option":"3","description":"3. Volver"};
                      return ret;
              }else if(actualNode == 'x3'){
                      ret[0] = {"id":"11","option":"3","description":"assign-agent"};
                      return ret;
              }else if(actualNode == 'x11'){
                      ret[0] = {"id":"12","end":1,"option":"1","description":"a. Institución de Educación Superior, fundada por la Universidad Católica de Chile. Que busca contribuir a la misión social de la Universidad Católica, generando  labores de extensión educativa, mediante la capacitación, la educación media técnico-profesional y otros programas de suplencia.\r\n\r\n Gracias.\r\n\r\n\r\n\r\nSesión Finalizada"};
                      return ret;
              }else if(actualNode == 'x12'){
                      ret[0] = {"id":"13","end":1,"option":"2","description":"b. El Instituto Profesional Duoc UC cuenta con Acreditación por 7 años desde agosto 2010 hasta agosto 2017 en Docencia de Pregrado y Gestión Institucional. El Centro de Formación Técnico Duoc UC cuenta con Acreditación por 6 años desde noviembre 2011 hasta noviembre 2017 en Docencia de Pregrado y Gestión Institucional.\r\n\r\n Gracias.\r\n\r\n\r\n\r\nSesión Finalizada"};
                      return ret;
              }else if(actualNode == 'x21'){
                      ret[0] = {"id":"14","end":1,"option":"1","description":"a. Pueden postular tanto nuevos como antiguos de alguna carrera de pregrado.\r\n\r\n Gracias.\r\n\r\n\r\n\r\nSesión Finalizada"};
                      return ret;
              }else if(actualNode == 'x22'){
                      ret[0] = {"id":"15","end":1,"option":"2","description":"b. b. Ser chileno o extranjero con residencia definitiva en el país. Condiciones socio-económicas del grupo familiar que justifiquen el otorgamiento del beneficio. Matricularse en una carrera de pregrado en una institución de educación superior autónoma, acreditada y que participe del Sistema de Créditos con Garantía Estatal. No haber egresado de una carrera universitaria conducente al grado de licenciado, que haya sido financiada con el Fondo Solidario de Crédito Universitario y/o con este mismo crédito. Mérito académico. Las exigencias mínimas para los alumnos de primer año son: Promedio de notas de Enseñanza Media igual o superior a 5.27, o puntaje promedio de PSU, Lenguaje y Matemáticas, de 475 puntos. Se consideran válidas las PSU rendidas en el año de postulación o en los dos años anteriores (puntualmente para la postulación del Año. \r\n\r\n Gracias.\r\n\r\n\r\n\r\nSesión Finalizada"};
                      return ret;
              };



}

function sendStock(msg, autoAssistPos){
  FSStock.push({"num":msg.text});
  outAutoAssist(msg);
}
function outAutoAssist(msg, autoAssistPos){
  autoAssist.splice(autoAssistPos, 1);
}
    var mysql      = require('mysql');
    var connection = mysql.createConnection({
      	host     : 'cloc3nc0.ce6x8w9trdli.us-west-2.rds.amazonaws.com',
    	user     : 'cloadm',
    	password : 'clo12345',
    	database : 'inventarioEntel',
    	port: '3306'
    });
    var fs = require('fs');
    var Firebase = require("firebase");
    var FSref = new Firebase('https://inventarioentel.firebaseio.com/upload');

    // CONEXION A BASE DE DATOS *********************************************
    connection.connect(function(err) {
      if (err) {
        console.error('error connecting: ' + err.stack);
        return;
      }
      console.log('connected as id ' + connection.threadId);
    });
    // FIN CONEXION A BASE DE DATOS ******************************************

    //ESPERO ARCHIVO PARA IMPORTACIÓN ****************************************
    FSref.on('child_added', function(snapshot) { 
            var data = snapshot.val();
            console.log('comienza carga de ' + data.url);
            var arrayFromCsv = [];
            var $ = jQuery = require('jquery');
            require('./jquery.csv.js');
            var file = 'http://52.20.79.190/uploadFileCsv/uploads/test.csv'; // PATH ARCHIVO CARGADO
            fs.readFile(file, 'UTF-8', function(err, csv) {
                  var data = $.csv.toArrays(csv);
                  for(var i=0, len=data.length; i<len; i++) {
                    var aux = [];
                    var lineData;
                    lineData = data[i].toString();
                    prepare(lineData);
                  }
            });
    });
    //FIN ESPERO ARCHIVO PARA IMPORTACIÓN ************************************
    var cont =1;




    function imprimePos(data){
    cont = cont +1;
    console.log("voy en "+cont);
    }

    function prepare(lineData){
    	var res = lineData.split(";");
    	//var checked = '"' + res[0].trim() + '",' + res[1].trim() + ',"' +  res[2].trim() + ' ",' + ' " '  +res[3].trim() + ' ",' +  res[4].trim() + ' , ' + res[5].trim() + ',' +  res[6].trim() + ',' +  res[7].trim() + ',' +  res[8].trim() + ',"' +  res[9].trim() + ' "," ' +  res[10].trim() + ' ",' +  res[11].trim() +  ',' + res[12].trim() + ',' +  res[13].trim() +  ',"' + res[14].trim() + ' "," ' +  res[15].trim() +' " ';
    	var sql = "INSERT INTO equipos2 (fecha, semana,marca,segmento,stock_o_logistico,stock_pdv,stock_traslado,stock_total_pdv,stock_cadena,dos_pdv,dos_cadena,consumo,consumo_acum,dia_semana,t_h,modelo) VALUES ('" + res[0].trim() + "'," + res[1].trim() + ",'" +  res[2].trim() + "'," + "'" +res[3].trim() + "'," +  res[4].trim() + "," + res[5].trim() + "," +  res[6].trim() + "," +  res[7].trim() + "," +  res[8].trim() + ",'" +  res[9].trim() + "','" +  res[10].trim() + "'," +  res[11].trim() +  "," + res[12].trim() + "," +  res[13].trim() +  ",'" + res[14].trim() + "','" +  res[15].trim() +"')";
    	connection.query(sql,imprimePos);

    }

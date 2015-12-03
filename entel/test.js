var mysql      = require('mysql');
var connection = mysql.createConnection({
  	host     : 'dbaseclo.cevi1pjzmkcs.us-east-1.rds.amazonaws.com',
	user     : 'cloMaestro',
	password : '142478clo',
	database : 'inventarioEntel',
	port: '3306'
});
var cont =1;
	connection.connect(function(err) {
  if (err) {
  	console.log("sdasdasadsasdads");
    console.error('error connecting: ' + err.stack);
    return;
  }

  console.log('connected as id ' + connection.threadId);
});

var arrayFromCsv = [];
 
var fs = require('fs');
    var $ = jQuery = require('jquery');
    require('./jquery.csv.js');

    var file = '2semanas.csv';
console.log("estoy")
    fs.readFile(file, 'UTF-8', function(err, csv) {
    	
      var data = $.csv.toArrays(csv);
      for(var i=0, len=data.length; i<len; i++) {
      	//console.log(data[i] + "------- ");
      	var aux = [];
      	var lineData;
      	//console.log("agregando")
      	//aux = aux.replace(/;/g , ",");
      	lineData = data[i].toString();
      	//lineData = lineData.replace(/;/g , ",");
      	prepare(lineData);
      	//console.log(aux);
      	//arrayFromCsv.push([[aux]]);
      	//console.log(arrayFromCsv)
      	//delete(aux);
      	//console.log(lineData);

        //console.log(data[i]);
      }
      //console.log("termine")
    });

function imprimePos(data){
cont = cont +1;
console.log("voy en "+cont);
}
function prepare(lineData){


	var res = lineData.split(";");
	//var checked = '"' + res[0].trim() + '",' + res[1].trim() + ',"' +  res[2].trim() + ' ",' + ' " '  +res[3].trim() + ' ",' +  res[4].trim() + ' , ' + res[5].trim() + ',' +  res[6].trim() + ',' +  res[7].trim() + ',' +  res[8].trim() + ',"' +  res[9].trim() + ' "," ' +  res[10].trim() + ' ",' +  res[11].trim() +  ',' + res[12].trim() + ',' +  res[13].trim() +  ',"' + res[14].trim() + ' "," ' +  res[15].trim() +' " ';
	var sql = "INSERT INTO equipos2 (fecha, semana,marca,segmento,stock_o_logistico,stock_pdv,stock_traslado,stock_total_pdv,stock_cadena,dos_pdv,dos_cadena,consumo,consumo_acum,dia_semana,t_h,modelo) VALUES ('" + res[0].trim() + "'," + res[1].trim() + ",'" +  res[2].trim() + "'," + "'" +res[3].trim() + "'," +  res[4].trim() + "," + res[5].trim() + "," +  res[6].trim() + "," +  res[7].trim() + "," +  res[8].trim() + ",'" +  res[9].trim() + "','" +  res[10].trim() + "'," +  res[11].trim() +  "," + res[12].trim() + "," +  res[13].trim() +  ",'" + res[14].trim() + "','" +  res[15].trim() +"')";
	connection.query(sql,imprimePos);

	//console.log(checked)
	//return checked;
	//process.exit();
}

function insertData(arrayFromCsv){
	connection.connect(function(err) {
  if (err) {
  	console.log("sdasdasadsasdads");
    console.error('error connecting: ' + err.stack);
    return;
  }

  console.log('connected as id ' + connection.threadId);
});
//console.log(arrayFromCsv);
var val= ['2015-11-11 00:00:00',46,'Sony Ericsson','Smarthphones y Masivos',0,0,0,0,0,'0,0','0,0',21,68,3,'Terminales','SON XP M4'];
var sql = "INSERT INTO equipos2 (fecha, semana,marca,segmento,stock_o_logistico,stock_pdv,stock_traslado,stock_total_pdv,stock_cadena,dos_pdv,dos_cadena,consumo,consumo_acum,dia_semana,t_h,modelo) VALUES (" + val + ")" ;
console.log(sql);
var values = [
	
    ['2015-11-11 00:00:00',46,'Sony Ericsson','Smarthphones y Masivos',0,0,0,0,0,'0,0','0,0',21,68,3,'Terminales','SON XP M4'],
    ['2015-11-11 00:00:00',46,'Sony Ericsson','Smarthphones y Masivos',0,0,0,0,0,'0,0','0,0',21,68,3,'Terminales','SON XP M4']
]; 

//console.log([values]);
//console.log(arrayFromCsv);

//var sql = "INSERT INTO equipos2 (id,modelo,consumo) VALUES ?";
//var values = [
//    [436,'SONY XPERIA M4 AQUA BLACK','Sony Ericsson'],
 //   [106,'SONY XPERIA M4 AQUA BLACK','Sony Ericsson'],

//]; 
var arrayaux = '\'' + arrayFromCsv.join('\',\'') + '\'';
connection.query(sql, function(err) {
	if (err) {
		console.log(err);
	}else{
    	console.log('hecho');
	};


    connection.end();
});


}



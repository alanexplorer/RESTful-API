<?php

require 'Slim/Slim.php';
require_once('class/statistic.php');
require_once('class/portal.php');
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();
$app->response()->header('Content-Type', 'application/json;charset=utf-8');

$app->get('/', function () {
  echo "Bem-vindo ao Servidor";
});

$app->get('/data/:id','getDataID');
$app->get('/data','getData');
$app->get('/:ano/:codIBGE','getPortal');
$app->post('/data','addData');
$app->put('/data/:id','saveData');
$app->delete('/data/:id','deleteData');

$app->run();

function getDataID($id)
{
  $statistic = new Statistic();
  echo json_encode($statistic->dataID($id));
}


function getData(){

  $statistic = new Statistic();
  echo json_encode($statistic->data());
}

function getPortal($ano, $codIBGE){

  $statistic = new Statistic();

  if($statistic->exist($ano, $codIBGE)){

    getDataID($statistic->consulta($ano, $codIBGE));

  }else {

    $portal = new Portal($ano, $codIBGE);

    $portal->gerar();


    $statistic->setAno($ano);
    $statistic->setCod($codIBGE);
    $statistic->setPer($portal->lastId());
    $statistic->setMedia($portal->media());
    $statistic->setMediana($portal->mediana());
    $statistic->setMaximo($portal->maximo());
    $statistic->setMinimo($portal->minimo());
    $statistic->setDesvio($portal->desvio());
    $statistic->setQ1($portal->q1());
    $statistic->setQ3($portal->q3());

    $statistic->add();

    getDataID($statistic->getConn());
  }
}

function addData(){

  $request = \Slim\Slim::getInstance()->request();
  $data = json_decode($request->getBody(), true);
  $statistic = new Statistic();

  $statistic->setAno($data['AnoReferencia']);
  $statistic->setCod($data['CodigoMunicipio']);
  $statistic->setPer($data['idPeriodo']);
  $statistic->setMedia($data['Media']);
  $statistic->setMediana($data['Mediana']);
  $statistic->setMaximo($data['Maximo']);
  $statistic->setMinimo($data['Minimo']);
  $statistic->setDesvio($data['Desvio']);
  $statistic->setQ1($data['Q1']);
  $statistic->setQ3($data['Q3']);

  $statistic->add();
  return $data;


}

function saveData($id){

  $request = \Slim\Slim::getInstance()->request();
  $data = json_decode($request->getBody(), true);
  $statistic = new Statistic();

  $statistic->setMedia($data['Media']);
  $statistic->setMediana($data['Mediana']);
  $statistic->setMaximo($data['Maximo']);
  $statistic->setMinimo($data['Minimo']);
  $statistic->setDesvio($data['Desvio']);
  $statistic->setQ1($data['Q1']);
  $statistic->setQ3($data['Q3']);
  
  $statistic->update($id);

  getDataID($id);
}

function deleteData($id){

  $statistic = new Statistic();
  $statistic->del($id);

}

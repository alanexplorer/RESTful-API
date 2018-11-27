<?php

class Portal{

  private $ano;
  private $codIBGE;
  private $periodo = array();

  public function getAno(){
    return $this->ano;
  }

  public function setAno($value){
    $this->ano=$value;
  }

  public function getCodIBGE(){
    return $this->codIBGE;
  }

  public function setCodIBGE($value){
    $this->codIBGE=$value;
  }

  public function setPeriodo($value){
    array_push($this->periodo, $value);

  }

  public function getPeriodo(){
    print_r($this->periodo);

  }

  public function __construct($ano, $codIBGE){

    $this->ano = $ano;
    $this->codIBGE = $codIBGE;

    $database = new Database();
    $db = $database->dbConnection();
    $this->conn = $db;

  }
  public function runQuery($sql){

    $stmt = $this->conn->prepare($sql);
    return $stmt;
  }

  public function lastId(){

    return $this->conn->lastInsertId();
  }

  public function gerar(){

    $ano = $this->getAno()*100;
    $ano ++;

    $cod = $this->getCodIBGE();

    for ($i = $ano; $i <= ($ano+11); $i++) {

        $arquivo = file_get_contents("http://www.transparencia.gov.br/api-de-dados/bolsa-familia-por-municipio?mesAno="
        .$i."&codigoIbge=".$cod."&pagina=1");
        $json = json_decode($arquivo, true);
        $this->setPeriodo($json[0]['valor']);
      }

    try
    {
      $stmt = $this->conn->prepare("INSERT INTO Periodo(JANEIRO, FEVEREIRO, MARCO, ABRIL, MAIO, JUNHO, JULHO, AGOSTO, SETEMBRO, OUTUBRO, NOVEMBRO, DEZEMBRO)
      VALUES (:jan,:fev, :mar, :abr,:mai,:jun,:jul,:ago,:sete, :out, :nov, :dez)");


      $stmt->bindValue(":jan", $this->periodo[0]);
      $stmt->bindValue(":fev", $this->periodo[1]);
      $stmt->bindValue(":mar", $this->periodo[2]);
      $stmt->bindValue(":abr", $this->periodo[3]);
      $stmt->bindValue(":mai", $this->periodo[4]);
      $stmt->bindValue(":jun", $this->periodo[5]);
      $stmt->bindValue(":jul", $this->periodo[6]);
      $stmt->bindValue(":ago", $this->periodo[7]);
      $stmt->bindValue(":sete", $this->periodo[8]);
      $stmt->bindValue(":out", $this->periodo[9]);
      $stmt->bindValue(":nov", $this->periodo[10]);
      $stmt->bindValue(":dez", $this->periodo[11]);

      $stmt->execute();

    }
    catch(PDOException $e){
      echo $e->getMessage();
    }
  }

  public function media(){

    $media = array_sum($this->periodo);

    return $media/12;

  }

  public function mediana(){

    $mediana = $this->periodo[5] + $this->periodo[6];

    return $mediana/2;

  }

  public function maximo(){

    $maximo = max($this->periodo);

    return $maximo;

  }

  public function minimo(){

    $minimo = min($this->periodo);

    return $minimo;

  }

  public function desvio(){

    $mean = (array_sum($this->periodo)/2);
    $n = 12;
    $sample = $this->periodo;

    foreach ($sample as &$value) {
      $value = pow(($value-$mean), 2);
    }

    $SumSample = array_sum($sample);

    $variance = $SumSample/11;

    $standardDeviation = sqrt($variance);

    return $standardDeviation;

  }


}
 ?>

<?php

require_once('class/conection.php');

class Statistic{
	private $conn;
	private $AnoRef;
	private $CodMun;
	private $Per;
	private $Media;
	private $Mediana;
	private $Maximo;
	private $Minimo;
	private $Desvio;

	public function getConn(){

		return $this->conn->lastInsertId();
	}

	public function getAno(){
		return $this->AnoRef;
	}

	public function setAno($value){
		$this->AnoRef=$value;
	}

	public function getCod(){
		return $this->CodMun;
	}

	public function setCod($value){
		$this->CodMun=$value;
	}

	public function getPer(){
		return $this->Per;
	}

	public function setPer($value){
		$this->Per=$value;
	}

	public function getMedia(){
		return $this->Media;
	}

	public function setMedia($value){
		$this->Media=$value;
	}

	public function getMediana(){
		return $this->Mediana;
	}

	public function setMediana($value){
		$this->Mediana=$value;
	}

	public function getMaximo(){
		return $this->Maximo;
	}

	public function setMaximo($value){
		$this->Maximo=$value;
	}

	public function getMinimo(){
		return $this->Minimo;
	}

	public function setMinimo($value){
		$this->Minimo=$value;
	}

	public function getDesvio(){
		return $this->Desvio;
	}

	public function setDesvio($value){
		$this->Desvio=$value;
	}

	public function __construct()
	{
		$database = new Database();
		$db = $database->dbConnection();
		$this->conn = $db;
    }

	public function runQuery($sql)
	{
		$stmt = $this->conn->prepare($sql);
		return $stmt;
	}

	public function exist($ano, $codIBGE){
		try{

			$stmt = $this->conn->prepare("SELECT Id, AnoReferencia, CodigoMunicipio FROM Estatistica WHERE AnoReferencia = :AnoRef
				AND CodigoMunicipio = :codIBGE");
			$stmt->bindParam("AnoRef",$ano);
			$stmt->bindParam("codIBGE",$codIBGE);
			$stmt->execute();
			$row=$stmt->fetch();

			if($row){
				return true;
			}else{
				return false;
			}

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function consulta($ano, $codIBGE){

		$stmt = $this->conn->prepare("SELECT Id FROM Estatistica WHERE AnoReferencia = :AnoRef AND CodigoMunicipio = :codIBGE");
		$stmt->bindParam("AnoRef",$ano);
		$stmt->bindParam("codIBGE",$codIBGE);
		$stmt->execute();
		$row=$stmt->fetch(PDO::FETCH_ASSOC);

		return $row['Id'];
	}

	public function add(){
		try
		{
			$stmt = $this->conn->prepare("INSERT INTO Estatistica(AnoReferencia, CodigoMunicipio, idPeriodo, Media, Mediana, Maximo, Minimo, Desvio)
			VALUES (:AnoRef,:CodMun, :Per, :Media,:Mediana,:Maximo,:Minimo,:Desvio)");


			$stmt->bindValue(":AnoRef", $this->getAno());
			$stmt->bindValue(":CodMun", $this->getCod());
			$stmt->bindValue(":Per", $this->getPer());
			$stmt->bindValue(":Media", $this->getMedia());
			$stmt->bindValue(":Mediana", $this->getMediana());
			$stmt->bindValue(":Maximo", $this->getMaximo());
			$stmt->bindValue(":Minimo", $this->getMinimo());
			$stmt->bindValue(":Desvio", $this->getDesvio());

			$stmt->execute();

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function update($id){

		try
		{
				$stmt = $this->conn->prepare("UPDATE Estatistica SET Media=:Media, Mediana=:Mediana, Maximo=:Maximo, Minimo=:Minimo, Desvio=:Desvio WHERE Id=:id");
				$stmt->bindParam("id",$id);
				$stmt->bindValue(":Media",$this->getMedia());
				$stmt->bindValue(":Mediana",$this->getMediana());
				$stmt->bindValue(":Maximo",$this->getMaximo());
				$stmt->bindValue(":Minimo",$this->getMinimo());
				$stmt->bindValue(":Desvio",$this->getDesvio());
				$stmt->execute();

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function data(){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM Estatistica, Periodo WHERE Estatistica.idPeriodo=Periodo.idPeriodo");
		  $stmt->execute();
		  $data = $stmt->fetchAll(PDO::FETCH_OBJ);

			return $data;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function dataID($id){
		try{
			$stmt = $this->conn->prepare("SELECT * FROM Estatistica, Periodo WHERE Estatistica.idPeriodo=Periodo.idPeriodo AND Estatistica.Id=:id");
			$stmt->bindParam("id",$id);
		  $stmt->execute();
		  $data = $stmt->fetchObject();

			return $data;
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}

	public function del($id){
		try{
			$stmt = $this->conn->prepare("DELETE FROM Estatistica WHERE Id=:id");
			$stmt->bindParam("id",$id);
			$stmt->execute();

		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>

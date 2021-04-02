<?php

define('DB_SERVEUR','mysql:host=localhost;dbname=projet5');
define('DB_LOGIN','root');
define('DB_PASSWORD','');
define('DB_NAME', 'projet5');

class Model {

	private function PDOConnect(){
		try
		  {
		    $oPDO = new PDO(DB_SERVEUR, DB_LOGIN, DB_PASSWORD);
		  }
		  catch (PDOException $e)
		  {
		    die($e);
		  }
		 
		  $oPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		 
		  return $oPDO;
		}

	function get_next_id($tableName){
		
		$query = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = :dbname AND TABLE_NAME = :dbtable";
		$params = ["dbname" => DB_NAME, "dbtable" => $tableName];
		$result = $this->get_from_DB($query,$params);
		return $result['AUTO_INCREMENT'];
		
	}


	function get_from_DB($query, $params = [], $return = true ,$multi = false) {
	$oPDO = $this->PDOConnect();
		 try
		    {
		    	$oPDOStatement = $oPDO->prepare(
		          $query
		     	);

			    foreach ($params as $key => &$value) {
			    	$oPDOStatement->bindParam(':'.$key, $value);
			    }

			    
			    $oPDOStatement->execute();

			    if($return){
				    if($multi) {
				    	while($bis = $oPDOStatement->fetch(PDO::FETCH_ASSOC)){
					       	$row[] = $bis;
					    }
				    }
				    else {
				    	 $row = $oPDOStatement->fetch(PDO::FETCH_ASSOC);
				    }

				 	return $row;
				}
				else {
					return ["lastInsertId" => $oPDO->lastInsertId(), "rowCount" => $oPDOStatement->rowCount()];
				}
		    }
		catch (PDOException $oPdoException)
			{
		      return $aListeErreurs[] = 'Une erreur est survenue et a empêché l\'enregistrement de votre message';
		    }

}

}
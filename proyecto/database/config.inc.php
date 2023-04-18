<?php 

class Conect_MySql {   
     var $obj = array ( "dbname"	=>	"proyecto",
                       "dbuser"		=>	"root"		,
                       "dbpwd"		=>	""		,
                       "dbhost"		=>	"localhost"	);


     var $q_id	="";
     var $ExeBit	="";
     var $db_connect_id = "";
     var $query_count   = 0;
    private function connect(){
		$this->db_connect_id = mysqli_connect($this->obj['dbhost'],$this->obj['dbuser'],$this->obj['dbpwd'],$this->obj['dbname']);
             if (!$this->db_connect_id)
              {
                echo (" Error no se puede conectar al servidor:".mysqli_connect_error());
    	  }
  }

function execute($query) {       
        $this->q_id = mysqli_query($this->db_connect_id,$query);        
        if(!$this->q_id ) {
            $error1 = mysqli_error($this->db_connect_id);
            die ("ERROR: error DB.<br> No Se Puede Ejecutar La Consulta:<br> $query <br>MySql Tipo De Error: $error1");
            exit;
        }         
	$this->query_count++; 
	return $this->q_id;    
    }

public function close_db(){
        return mysqli_close($this->db_connect_id);
    }

public function more_result() {
		return mysqli_more_results($this->db_connect_id);
	}
public function next_result() {
		return mysqli_next_result($this->db_connect_id);
	}

  public function __construct(){
        $this->connect();
    }
  
}
?>
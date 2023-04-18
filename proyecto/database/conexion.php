<?php 

class Database{
    private $hostname = "localhost";
    private $database = "proyecto";
    private $username = "root";
    private $password = "";
    private $charset = "utf8";

    function conectar(){
        try{

        $conexion = "mysql:host=". $this -> hostname. "; dbname=". $this -> database.
        "; charset=". $this-> charset;
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false
        ];

        $pdo = new PDO($conexion, $this->username, $this ->password, $options);

        return $pdo;
        } catch(PDOException $e){
        echo 'error de conexion'. $e->getMessage();
        exit;
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

}
?>
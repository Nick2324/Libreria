<?php


namespace Manejadores;


abstract class Manejador{
    
    protected $conexion;
    protected $manejable;
            
    function __construct(){}

    function __destruct(){}
    
    public function abrirConexion(){
        $this->conexion = mysql_connect("localhost", "nicolas", "123456");
        mysql_select_db("Libreria");
    }
    
    public function cerrarConexion(){
        mysql_close($this->conexion);
    }

    public abstract function construirManejable($partes);
    
    public function generarId($tabla){
        $this->abrirConexion();
        $query = mysql_query("SELECT COUNT(*) FROM `$tabla`");
        $this->cerrarConexion();
        return mysql_fetch_array($query)[0];
    }
    
    public function getManejable(){
        return $this->manejable;
    }

    public function update($tabla,$av){
        $this->abrirConexion();
        $query = "UPDATE `$tabla` SET ";
        for($i=1;$i<count($av[0]);$i++){
                if($av[1][$i]!=null){
                    if(substr_count($av[0][$i],"f_")>0)
                        $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATE) ";
                    else if(substr_count($av[0][$i],"dt_")>0)
                            $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATETIME) ";
                    else
                        $query = $query." ".$av[0][$i]."="."'".$av[1][$i]."' ";
                    $query = $query.",";
                }
            }
        $query = substr($query,0,-1);
        $query = $query." WHERE ".$av[0][0]."='".$av[1][0]."'";
        #echo $query."<br>";
        $resultado = mysql_query($query);
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function select($tabla,$av){
        $this->abrirConexion();
        $query = "SELECT * FROM `$tabla`";
        $vacio = true;
        for($i=0;$i<count($av[0]);$i++)
            if($av[1][$i]!=null){
                $vacio = false;
                break;
            }
        if(!$vacio){
            $query = $query." WHERE ";
            for($i=0;$i<count($av[0]);$i++){
                if($av[1][$i]!=null){
                    if(substr_count($av[0][$i],"f_")>0)
                        $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATE) ";
                    else if(substr_count($av[0][$i],"dt_")>0)
                        $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATETIME) ";
                    else
                        $query = $query." ".$av[0][$i]."="."'".$av[1][$i]."' ";
                    $query = $query."AND";
                }
            }
            $query = substr($query,0,-3);
        }
        #echo $query."<br>";
        $resultado = mysql_query($query);
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function delete($tabla,$av){
        $this->abrirConexion();
        $query = "DELETE FROM `$tabla` WHERE ";
        for($i=0;$i<count($av[0]);$i++){
            if($av[1][$i]!=null){
                    if(substr_count($av[0][$i],"f_")>0)
                        $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATE) ";
                    else if(substr_count($av[0][$i],"dt_")>0)
                        $query = $query." ".$av[0][$i]."="."CAST('".$av[1][$i]."' AS DATETIME) ";
                    else
                        $query = $query." ".$av[0][$i]."="."'".$av[1][$i]."' ";
                    $query = $query."AND";
                }
        }
        $query = substr($query,0,-3);
        #echo "<br>".$query."<br>";
        $resultado = mysql_query($query);
        $this->cerrarConexion();
        return $resultado;
    }
    
    public function insert($tabla,$av){
        $this->abrirConexion();
        $query = "INSERT INTO `$tabla` (";
        for($i=0;$i<count($av[0]);$i++)
            if($av[1][$i]!=null)
                $query = $query.$av[0][$i].",";
        $query = substr($query,0,-1).") VALUES (";
        for($i=0;$i<count($av[1]);$i++)
            if($av[1][$i]!=null){
                if(substr_count($av[0][$i],"f_")>0)
                    $query = $query."CAST('".$av[1][$i]."' AS DATE),";
                else if(substr_count($av[0][$i],"dt_")>0)
                    $query = $query."CAST('".$av[1][$i]."' AS DATETIME),";
                else
                    $query = $query."'".$av[1][$i]."',";
            }
        $query = substr($query,0,-1).")";
        #echo $query."<br>";
        $resultado = mysql_query($query);
        $this->cerrarConexion();
        return $resultado;
    }
}
?>
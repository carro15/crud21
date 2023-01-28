<?php
include "config.php";
class Clientes
{
    private $pdo;

    public $idclientes;
    public $nombre;
    public $direccion;
    

    public function __construct()
    {
        try {
            $this->pdo = Conexion::Conectar();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function Mostrarclientes()
    {
        try {
            $sql = "SELECT * FROM tb_clientes order by idclientes desc";
            $result = $this->pdo->query($sql);
            return $result->fetchAll();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function RegistrarClientes($data)
    {
        try {
            $sql = $this->pdo->prepare("INSERT INTO tb_clientes(nombre,direccion) VALUES(?,?)");
            $sql->execute(
                array(
                    $data->nombre,
                    $data->direccion,
           
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function eliminarclientes($data)
    {
        try {
            $sql = $this->pdo->prepare("DELETE FROM tb_clientes where idclientes = ?");
            $sql->execute(
                array(
                    $data->idclientes
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function Editarclientes($data)
    {
        try {
            $sql = $this->pdo->prepare("UPDATE tb_clientes SET nombre=?,direccion=? where idclientes=?");
            $sql->execute(
                array(
                    $data->nombre,
                    $data->direccion,
                    $data->idclientes,
                )
            );

            return true;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
}
<?php

    class ConsultaDatabase
    {
        public static function Usuarios()
        {
            $con = Connection::GetConn();

            $sql = "SELECT * FROM usuario ORDER BY idUsuario DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while($row = $sql->fetchObject('ConsultaDatabase')){
                $resultado[] = $row;
            }
            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum resultado");
            }

            return $resultado;
        }

        public static function InsumoseMedicamentos()
        {
            $con = Connection::GetConn();

            $sql = "SELECT * FROM estoque ORDER BY idProduto DESC";
            $sql = $con->prepare($sql);
            $sql->execute();

            $resultado = array();

            while($row = $sql->fetchObject('ConsultaDatabase')){
                $resultado[] = $row;
            }
            if(!$resultado){
                throw new Exception("Não foi encontrado nenhum resultado");
            }

            return $resultado;
        }
    }
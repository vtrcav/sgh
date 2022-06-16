<?php

    class IMedicamentos
    {

        public static function inserir($dadosProduto)
        {
            
            $con = Connection::getConn();

            $sql = $con->prepare('INSERT INTO est_imed (nomeProduto, nomeQuimico, laboratorio, ffarmaceutica, apresentacao, grupo, subgrupo, estoque, qtdeminima) VALUES (:nomeProduto, :nomeQuimico, :laboratorio,
            :ffarmaceutica, :apresentacao, :grupo, :subgrupo, :estoque, :qtdeminima)');

            $sql->bindValue(':nomeProduto', $dadosProduto['nomeProduto']);
            $sql->bindValue(':nomeQuimico', $dadosProduto['nomeQuimico']);
            $sql->bindValue(':laboratorio'. $dadosProduto['laboratorio']);
            $sql->bindValue(':ffarmaceutica'. $dadosProduto['ffarmaceutica']);
            $sql->bindValue(':apresentacao'. $dadosProduto['apresentacao']);
            $sql->bindValue(':grupo'. $dadosProduto['grupo']);
            $sql->bindValue(':subgrupo'. $dadosProduto['subgrupo']);
            $sql->bindValue(':estoque'. $dadosProduto['estoque']);
            $sql->bindValue(':qtdeminima'. $dadosProduto['qtdeminima']);
        
            $res = $sql->execute();

            if($res = 0){
                throw new Exception ("Falha ao cadastrar insumo/medicamento");
                return false;
            }

            return true;
           

        }

        public static function listar()
        {
            $con = Connection::GetConn();

            $sql = "SELECT * FROM est_imed ORDER BY id DESC";
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

        public static function editar($idPaciente)
        {         
            
            $con = Connection::getConn();

            $sql = 'SELECT * FROM est_imed WHERE idProduto = :id';
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPaciente, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Insumos/Medicamentos');

            if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco de dados");
			}
			return $resultado;
		}

        public static function atualizar($dadosPaciente)
        {
            
            
            $con = Connection::getConn();

            $sql = $con->prepare('UPDATE est_imed SET nomeProduto = :nomeProduto, nomeQuimico = :nomeQuimico, laboratorio = :laboratorio, ffarmaceutica = :ffarmaceutica, apresentacao = :apresentacao, grupo = :grupo, subgrupo = :subgrupo, telefone = :telefone, cep = :cep, endereco = :endereco, bairro = :bairro, cidade = :cidade, uf = :uf WHERE idPaciente = :id');

            $sql->bindValue(':nomeProduto', $dadosProduto['nomeProduto']);
            $sql->bindValue(':nomeQuimico', $dadosProduto['nomeQuimico']);
            $sql->bindValue(':laboratorio', $dadosProduto['laboratorio']);
            $sql->bindValue(':ffarmaceutica', $dadosProduto['ffarmaceutica']);
            $sql->bindValue(':apresentacao', $dadosProduto['apresentacao']);
            $sql->bindValue(':grupo', $dadosProduto['grupo']);
            $sql->bindValue(':subgrupo', $dadosProduto['subgrupo']);
            $sql->bindValue(':estoque', $dadosProduto['estoque']);
            $sql->bindValue(':qtdeminima', $dadosProduto['qtdeminima']);
        
            $res = $sql->execute();

            if($res == 0){
                throw new Exception ("Falha ao editar paciente");
                return false;
            }

            return true; 
           

        }

        public static function remover($idPaciente)
        {
            $con = Connection::getConn();

            $sql = 'DELETE FROM pacientes WHERE idPaciente = :id';
            $sql = $con->prepare($sql);        
            $sql->bindValue(':id', $idPaciente);

            $res = $sql->execute();

        }

    }
<?php

    class Pacientes
    {
        public static function inserir($dadosPaciente)
        {
            
            $con = Connection::getConn();

            $sql = $con->prepare('INSERT INTO pacientes (prontuario, nomeCompleto, nomeMae, cpf, cns, dnasc, dtadmissao, telefone, cep, endereco, bairro, cidade, uf) VALUES (:prontuario, :nomeCompleto, :nomeMae,
            :cpf, :cns, :dnasc, :dtadmissao, :telefone, :cep, :endereco, :bairro, :cidade, :uf)');

            $sql->bindValue(':prontuario', $dadosPaciente['prontuario']);
            $sql->bindValue(':nomeCompleto', $dadosPaciente['nomeCompleto']);
            $sql->bindValue(':nomeMae', $dadosPaciente['nomeMae']);
            $sql->bindValue(':cpf', $dadosPaciente['cpf']);
            $sql->bindValue(':cns', $dadosPaciente['cns']);
            $sql->bindValue(':dnasc', $dadosPaciente['dnasc']);
            $sql->bindValue(':dtadmissao', $dadosPaciente['dtadmissao']);
            $sql->bindValue(':telefone', $dadosPaciente['telefone']);
            $sql->bindValue(':cep', $dadosPaciente['cep']);
            $sql->bindValue(':endereco', $dadosPaciente['endereco']);
            $sql->bindValue(':bairro', $dadosPaciente['bairro']);
            $sql->bindValue(':cidade', $dadosPaciente['cidade']);
            $sql->bindValue(':uf', $dadosPaciente['uf']);
        
            $res = $sql->execute();

            if($res = 0){
                throw new Exception ("Falha ao cadastrar paciente");
                return false;
            }

            return true;
           

        }

        public static function listar()
        {
            $con = Connection::GetConn();

            $sql = "SELECT * FROM pacientes ORDER BY idPaciente DESC";
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

            $sql = 'SELECT * FROM pacientes WHERE idPaciente = :id';
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idPaciente, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject('Pacientes');

            if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco de dados");
			}
			return $resultado;
		}

        public static function atualizar($dadosPaciente)
        {
            
            
            $con = Connection::getConn();

            $sql = $con->prepare('UPDATE pacientes SET prontuario = :prontuario, nomeCompleto = :nomeCompleto, nomeMae = :nomeMae, cpf = :cpf, cns = :cns, dnasc = :dnasc, dtadmissao = :dtadmissao, telefone = :telefone, cep = :cep, endereco = :endereco, bairro = :bairro, cidade = :cidade, uf = :uf WHERE idPaciente = :id');

            $sql->bindValue(':id', $dadosPaciente['idPaciente']);
            $sql->bindValue(':prontuario', $dadosPaciente['prontuario']);
            $sql->bindValue(':nomeCompleto', $dadosPaciente['nomeCompleto']);
            $sql->bindValue(':nomeMae', $dadosPaciente['nomeMae']);
            $sql->bindValue(':cpf', $dadosPaciente['cpf']);
            $sql->bindValue(':cns', $dadosPaciente['cns']);
            $sql->bindValue(':dnasc', $dadosPaciente['dnasc']);
            $sql->bindValue(':dtadmissao', $dadosPaciente['dtadmissao']);
            $sql->bindValue(':telefone', $dadosPaciente['telefone']);
            $sql->bindValue(':cep', $dadosPaciente['cep']);
            $sql->bindValue(':endereco', $dadosPaciente['endereco']);
            $sql->bindValue(':bairro', $dadosPaciente['bairro']);
            $sql->bindValue(':cidade', $dadosPaciente['cidade']);
            $sql->bindValue(':uf', $dadosPaciente['uf']);
        
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
?>
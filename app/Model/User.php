<?php

    class User
    {
        private $id;
        private $name;
        private $email;
        private $password;
        private $hash;
        
        
            public function validateLogin()
            {
                $conn = Connection::getConn();
                $sql = 'SELECT * FROM usuario WHERE Email = :email';

                $stmt = $conn->prepare($sql);
                $stmt->bindValue(':email', $this->email);
                $stmt->execute();

                if ($stmt->rowCount()){
                    $result = $stmt->fetch();

                    if (password_verify($this->password, $result['Senha'])){
                        $_SESSION['usr'] = array(
                            'id_user' => $result['IdUsuario'],
                            'name_user'=> $result['Nome'],
                            'lastname_user'=> $result['Sobrenome'],
                            'permitions'=> $result['Permissoes'],
                            'level_user'=> $result['NivelUsuario']);      
                        return true;
                    }
                }

                throw new \Exception('E-mail ou senha inválidos');

            }


            public static function inserir($dadosUsuario)
            {
            
            /* var_dump($dadosUsuario);  */   
            $hash = password_hash($dadosUsuario['senhadigitada'], PASSWORD_DEFAULT);

            $con = Connection::getConn();

            $sql = $con->prepare('INSERT INTO usuario (Nome, Sobrenome, Email, NivelUsuario, Senha) VALUES (:Nome, :Sobrenome, :Email,
            :NivelUsuario, :Senha)');

            $sql->bindValue(':Nome', $dadosUsuario['nome']);
            $sql->bindValue(':Sobrenome', $dadosUsuario['sobrenome']);
            $sql->bindValue(':Email', $dadosUsuario['email']);
            $sql->bindValue(':NivelUsuario', $dadosUsuario['nivelUsuario']);
            $sql->bindValue(':Senha', $hash);

            $res = $sql->execute();

            if($res = 0){
                throw new Exception ("Falha ao cadastrar paciente");
                return false;
            } 

            return true;
           

            }


            public static function editar($idUser)
            {         
            
            $con = Connection::getConn();

            $sql = 'SELECT * FROM usuario WHERE IdUsuario = :id';
            $sql = $con->prepare($sql);
            $sql->bindValue(':id', $idUser, PDO::PARAM_INT);
            $sql->execute();

            $resultado = $sql->fetchObject();

            if (!$resultado) {
				throw new Exception("Não foi encontrado nenhum registro no banco de dados");
			}
			return $resultado;
		    }


            public static function atualizar($dadosUsuario)
            {
            
            
            $con = Connection::getConn();

            $sql = $con->prepare('UPDATE usuario SET Nome = :nome, Sobrenome = :sobrenome, Email = :email, NivelUsuario = :nivelUsuario WHERE IdUsuario = :id');

            $sql->bindValue(':Nome', $dadosUsuario['nome']);
            $sql->bindValue(':Sobrenome', $dadosUsuario['sobrenome']);
            $sql->bindValue(':Email', $dadosUsuario['email']);
            $sql->bindValue(':NivelUsuario', $dadosUsuario['nivelUsuario']);
            $sql->bindValue(':id', $dadosUsuario['IdUsuario']);
        
            $res = $sql->execute();

            if($res == 0){
                throw new Exception ("Falha ao editar usuário");
                return false;
            }

            return true; 
           

            }


            public static function remover($idUser)
            {
            $con = Connection::getConn();

            $sql = 'DELETE FROM usuario WHERE IdUsuario = :id';
            $sql = $con->prepare($sql);        
            $sql->bindValue(':id', $idUser);

            $res = $sql->execute();

            }


            public function setEmail($email)
            {
                $this->email = $email;
            }
            public function setName($name)
            {
                $this->name = $name;
            }
            public function setPassword($password)
            {
                $this->password = $password;
            }
            public function getName()
            {
                return $this->name;
            }
            public function getEmail()
            {
                return $this->email;
            }
            public function getPassword()
            {
                return $this->password;
            }
    }
?>
<?php

    class User
    {
        private $id;
        private $name;
        private $email;
        private $password;

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
                            'permitions'=> $result['Permissoes'],
                            'level_user'=> $result['NivelUsuario']);      
                        return true;
                    }
                }

                throw new \Exception('E-mail ou senha inválidos');

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
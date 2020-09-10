<?php

namespace app\models;
use PDO;
use PDOException;

class UserModel extends _Model
{

    public function is($type, $data)
    {

        $auth = [ "id", "email", "name" ];
        if (!in_array($type, $auth)) {
            return [ "code"=>2, "msg"=>"auth failed...", "data"=>$type ];
        }

        try {

            $stmt = $this->pdo->prepare("SELECT idx FROM `users` WHERE {$type} = :data ");
            $stmt->bindValue(":data", $data, PDO::PARAM_STR);
            if ($stmt->execute()) {
                $row = $stmt->fetch();
                return [ "code"=>1, "msg"=>"success!", "data"=>$row ];
            }


        } catch (PDOException $e) {
            return [ "code"=>2, "msg"=>"is failed...", "data"=> $e->getMessage() ];
        }

    }

    public function get($payload)
    {
        $_return = [];
        $page = $payload->page;
        $offset = ($page - 1) * $payload->limit;
        
        $where = "";
        
        // 레벨 구현해야 한다
        switch ($payload->auth) {
            case "user":
                $where = "";
                break;
            default:
                break;
        }

        try {

            $stmt = $this->pdo->prepare("
                SELECT * FROM `users` ORDER BY idx LIMIT :limit OFFSET :offset
            ");

            $stmt->bindValue(":limit", $payload->limit, PDO::PARAM_INT);
            $stmt->bindValue(":offset", $offset, PDO::PARAM_INT);

            if ($stmt->execute()) {
                while ($row = $stmt->fetchObject()) {
                    $_return[] = $row;
                }
            }

            return [ "code"=>1, "msg"=>"success!", "data"=>$_return ];

        } catch(PDOException $e) {
            return [ "code" => 2, "msg" => "PDOException...", "data" => $e->getMessage() ];
        }
    }

    public function check($payload)
    {
        return $this->is($payload->type, $payload->data);
    }

    public function create($payload)
    {

        try {
            
            $this->pdo->beginTransaction();

            if ($this->pdo->inTransaction())
            {

                $isID = $this->is("id", $payload->id);
                if ($isID['code'] != 1) {
                    return [ "code"=>2, "msg"=>"is method exception....", "data"=>$isID['data']];
                }
                if ($isID['data']) {
                    return [ "code"=>2, "msg"=>"중복 아이디입니다.", "data"=>""];
                }

                $isEmail = $this->is("email", $payload->email);
                if ($isEmail['code'] != 1) {
                    return [ "code"=>2, "msg"=>"is method exception....", "data"=>$isEmail['data']];
                }
                if ($isEmail['data']) {
                    return [ "code"=>3, "msg"=>"중복 이메일입니다.", "data"=>""];
                }

                // 비밀번호 해시
                $hashed = base64_encode(hash('sha256', $payload->password, true));
                $token = GenerateString(21);

                $stmt = $this->pdo->prepare("INSERT INTO `users` 
                                                        SET `id` = :id, 
                                                        `name` = :name,  
                                                        `password` = :password,
                                                        `email` = :email,
                                                        `token` = :token 
                                                        ");

                $success = $stmt->execute([
                    ':id' => $payload->id,
                    ":name" => $payload->name,
                    ":password" => $hashed,
                    ':email' => $payload->email,
                    ":token" => $token
                ]);

                if (!$success) {
                    throw new PDOException($success);
                }

                $this->pdo->commit();

            }

            return ["code"=>1, "msg"=>"success!", "data"=>""];

        } catch(PDOException $e) {
            $this->pdo->rollback();
            return ["code"=> 3, "msg"=>"pdo exception...", "data"=>$e ];
        }

    }

}
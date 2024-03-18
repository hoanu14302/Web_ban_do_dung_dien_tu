<?php
class dongsp
{
    private $id;
    private $tendong;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function gettendong()
    {
        return $this->tendong;
    }

    public function settendong($value)
    {
        $this->tendong = $value;
    }

    // Lấy danh sách
    public function laydongsp()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM dongsp";
            $cmd = $dbcon->prepare($sql);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }


    // Lấy danh mục theo id
    public function laydongsptheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT tendong FROM dongsp WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $cmd->execute();
            $result = $cmd->fetch();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Thêm mới
    public function themdongsp($dongsp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO dongsp(tendong) VALUES(:tendong)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tendong", $dongsp->tendong);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Xóa 
    public function xoadongsp($dongsp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM dongsp WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $dongsp->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suadongsp($dongsp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE dongsp SET tendong=:tendong WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tendong", $dongsp->tendong);
            $cmd->bindValue(":id", $dongsp->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

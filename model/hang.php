<?php
class HANG
{
    private $id;
    private $tenhang;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function gettenhang()
    {
        return $this->tenhang;
    }

    public function settenhang($value)
    {
        $this->tenhang = $value;
    }

    // Lấy danh sách
    public function layhang()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM hang";
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
    public function layhangtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT tenhang FROM hang WHERE id=:id";
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
    public function themhang($hang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO hang(tenhang) VALUES(:tenhang)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenhang", $hang->tenhang);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Xóa 
    public function xoahang($hang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM hang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $hang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suahang($hang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE hang SET tenhang=:tenhang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tenhang", $hang->tenhang);
            $cmd->bindValue(":id", $hang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

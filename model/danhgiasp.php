<?php
class danhgiasp
{
    private $id;
    private $id_sp;
    private $id_kh;
    private $sosaodanhgia;
    private $nhanxet;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getid_sp()
    {
        return $this->id_sp;
    }

    public function setid_sp($value)
    {
        $this->id_sp = $value;
    }

    public function getid_kh()
    {
        return $this->id_kh;
    }

    public function setid_kh($value)
    {
        $this->id_kh = $value;
    }

    public function getsosaodanhgia()
    {
        return $this->sosaodanhgia;
    }

    public function setsosaodanhgia($value)
    {
        $this->sosaodanhgia = $value;
    }

    public function getnhanxet()
    {
        return $this->nhanxet;
    }

    public function setnhanxet($value)
    {
        $this-> nhanxet= $value;
    }

    // Lấy danh sách
    public function laydanhgiasp()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM danhgiasp";
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
    public function laydanhgiasptheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT tentbdt FROM danhgiasp WHERE id=:id";
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
    public function themdanhgiasp($danhgiasp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO danhgiasp(tentbdt) VALUES(:tentbdt)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tentbdt", $danhgiasp->tentbdt);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Xóa 
    public function xoadanhgiasp($danhgiasp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM danhgiasp WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $danhgiasp->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suadanhgiasp($danhgiasp)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE danhgiasp SET tentbdt=:tentbdt WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tentbdt", $danhgiasp->tentbdt);
            $cmd->bindValue(":id", $danhgiasp->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

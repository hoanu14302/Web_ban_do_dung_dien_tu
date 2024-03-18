<?php
class DONHANG
{
    private $id;
    private $khachhang_id;
    private $ngay;
    private $tongtien;
    private $ghichu;

    public function getid()
    {
        return $this->id;
    }

    public function setid($value)
    {
        $this->id = $value;
    }

    public function getkhachhang_id()
    {
        return $this->khachhang_id;
    }

    public function setkhachhang_id($value)
    {
        $this->khachhang_id = $value;
    }
    public function getngay()
    {
        return $this->ngay;
    }

    public function setngay($value)
    {
        $this->ngay = $value;
    }
    public function gettongtien()
    {
        return $this->tongtien;
    }

    public function settongtien($value)
    {
        $this->tongtien = $value;
    }
    public function getghichu()
    {
        return $this->ghichu;
    }

    public function setghichu($value)
    {
        $this->ghichu = $value;
    }

    // Lấy danh sách
    public function laydonhang()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM donhang";
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
    public function laydonhangtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM donhang WHERE id=:id";
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
    public function themdonhang($donhang)
    {
        $dbcon = DATABASE::connect();
        try {
            $tongtien = tinhtiengiohang(); // Lấy tổng tiền từ hàm tinhtiengiohang
            $sql = "INSERT INTO donhang(khachhang_id,ngay,tongtien,ghichu) VALUES(:khachhang_id,:ngay,:tongtien,:ghichu)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":khachhang_id", $donhang->khachhang_id);
            $cmd->bindValue(":ngay", $donhang->ngay);
            $cmd->bindValue(":tongtien",$tongtien);
            $cmd->bindValue(":ghichu", $donhang->ghichu);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Xóa 
    public function xoadonhang($donhang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM donhang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $donhang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suadonhang($donhang)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE donhang SET tendonhang=:tendonhang WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tendonhang", $donhang->tendonhang);
            $cmd->bindValue(":id", $donhang->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

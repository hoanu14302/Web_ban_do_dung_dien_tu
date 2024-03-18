<?php
class SANPHAM
{
    // khai báo các thuộc tính
    private $id;
    private $tensanpham;
    private $danhmuc_id;
    private $hang_id; //mới thêm
    private $mota;
    private $giagoc;
    private $giaban;
    private $soluongton;
    private $hinhanh;
    private $luotxem;
    private $luotmua;
    private $thongsokythuat; //mới thêm
    private $phankhuc; //mới thêm
    private $tendong_id; //new

    public function gettendong_id()
    {
        return $this->tendong_id;
    }
    public function settendong_id($value)
    {
        $this->hang_id = $value;
    }

    public function gethang_id()
    {
        return $this->hang_id;
    }
    public function sethang_id($value)
    {
        $this->hang_id = $value;
    }

    public function getthongsokythuat()
    {
        return $this->thongsokythuat;
    }
    public function setthongsokythuat($value)
    {
        $this->thongsokythuat = $value;
    }


    public function getphankhuc()
    {
        return $this->phankhuc;
    }
    public function setphankhuc($value)
    {
        $this->phankhuc = $value;
    }    
    
    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }
    public function gettensanpham()
    {
        return $this->tensanpham;
    }
    public function settensanpham($value)
    {
        $this->tensanpham = $value;
    }
    public function getmota()
    {
        return $this->mota;
    }
    public function setmota($value)
    {
        $this->mota = $value;
    }
    public function getgiagoc()
    {
        return $this->giagoc;
    }
    public function setgiagoc($value)
    {
        $this->giagoc = $value;
    }
    public function getgiaban()
    {
        return $this->giaban;
    }
    public function setgiaban($value)
    {
        $this->giaban = $value;
    }
    public function getsoluongton()
    {
        return $this->soluongton;
    }
    public function setsoluongton($value)
    {
        $this->soluongton = $value;
    }
    public function gethinhanh()
    {
        return $this->hinhanh;
    }
    public function sethinhanh($value)
    {
        $this->hinhanh = $value;
    }
    public function getdanhmuc_id()
    {
        return $this->danhmuc_id;
    }
    public function setdanhmuc_id($value)
    {
        $this->danhmuc_id = $value;
    }
    public function getluotxem()
    {
        return $this->luotxem;
    }
    public function setluotxem($value)
    {
        $this->luotxem = $value;
    }
    public function getluotmua()
    {
        return $this->luotmua;
    }
    public function setluotmua($value)
    {
        $this->luotmua = $value;
    }

    // Lấy danh sách
    public function laysanpham()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham ORDER BY id DESC ";
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
    // Tìm kiếm 
    public function timkiemsanpham($search)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham where tensanpham like '%$search%'  ";
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

    // Lấy danh sách mặt hàng thuộc 1 danh mục
    public function laysanphamtheodanhmuc($danhmuc_id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham WHERE danhmuc_id=:madm";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":madm", $danhmuc_id);
            $cmd->execute();
            $result = $cmd->fetchAll();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy mặt hàng theo id
    public function laysanphamtheoid($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham WHERE id=:id";
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
    // Cập nhật lượt xem
    public function tangluotxem($id)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET luotxem=luotxem+1 WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật số lượng
    public function giamsoluong($id, $soluongmua)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET soluongton=soluongton-:soluongmua WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":soluongmua", $soluongmua);
            $cmd->bindValue(":id", $id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // Lấy mặt hàng xem nhiều
    public function laysanphamxemnhieu()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham ORDER BY luotxem DESC LIMIT 3";
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

    // Lấy mặt hàng mua nhiều
    public function laysanphammuanhieu()
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "SELECT * FROM sanpham ORDER BY luotmua DESC LIMIT 3";
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
    // Thêm mới
    public function themsanpham($sanpham)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "INSERT INTO 
sanpham(tensanpham,danhmuc_id,mota,giagoc,giaban,soluongton,hinhanh,luotxem,luotmua) 
VALUES(:tensanpham,:danhmuc_id,:mota,:giagoc,:giaban,:soluongton,:hinhanh,0,0)";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensanpham", $sanpham->tensanpham);
            $cmd->bindValue(":danhmuc_id", $sanpham->danhmuc_id);
            $cmd->bindValue(":mota", $sanpham->mota);
            $cmd->bindValue(":giagoc", $sanpham->giagoc);
            $cmd->bindValue(":giaban", $sanpham->giaban);
            $cmd->bindValue(":soluongton", $sanpham->soluongton);
            $cmd->bindValue(":hinhanh", $sanpham->hinhanh);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Xóa 
    public function xoasanpham($sanpham)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "DELETE FROM sanpham WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":id", $sanpham->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật 
    public function suasanpham($sanpham)
    {
        $dbcon = DATABASE::connect();
        try {
            $sql = "UPDATE sanpham SET tensanpham=:tensanpham,
            danhmuc_id=:danhmuc_id,
            mota=:mota,
            giagoc=:giagoc,
            giaban=:giaban,
            soluongton=:soluongton,
            hinhanh=:hinhanh,
            luotxem=:luotxem,
            luotmua=:luotmua
            WHERE id=:id";
            $cmd = $dbcon->prepare($sql);
            $cmd->bindValue(":tensanpham", $sanpham->tensanpham);
            $cmd->bindValue(":mota", $sanpham->mota);
            $cmd->bindValue(":giagoc", $sanpham->giagoc);
            $cmd->bindValue(":giaban", $sanpham->giaban);
            $cmd->bindValue(":soluongton", $sanpham->soluongton);
            $cmd->bindValue(":danhmuc_id", $sanpham->danhmuc_id);
            $cmd->bindValue(":hinhanh", $sanpham->hinhanh);
            $cmd->bindValue(":luotxem", $sanpham->luotxem);
            $cmd->bindValue(":luotmua", $sanpham->luotmua); 
            $cmd->bindValue(":id", $sanpham->id);
            $result = $cmd->execute();
            return $result;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
}

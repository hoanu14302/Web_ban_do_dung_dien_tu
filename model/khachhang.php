<?php
class KHACHHANG
{
    private $id;
    private $taikhoankh;
    private $sodienthoai;
    private $matkhau;
    private $hoten;
    
    
    private $hinhanh;
    private $diachi;

    public function getid()
    {
        return $this->id;
    }
    public function setid($value)
    {
        $this->id = $value;
    }
    public function gettaikhoankh()
    {
        return $this->taikhoankh;
    }
    public function settaikhoankh($value)
    {
        $this->taikhoankh = $value;
    }
    public function getsodienthoai()
    {
        return $this->sodienthoai;
    }
    public function setsodienthoai($value)
    {
        $this->sodienthoai = $value;
    }
    public function getmatkhau()
    {
        return $this->matkhau;
    }
    public function setmatkhau($value)
    {
        $this->matkhau = $value;
    }
    public function gethoten()
    {
        return $this->hoten;
    }
    public function sethoten($value)
    {
        $this->hoten = $value;
    }
   
    public function gethinhanh()
    {
        return $this->hinhanh;
    }
    public function sethinhanh($value)
    {
        $this->hinhanh = $value;
    }
    public function getdiachi()
    {
        return $this->diachi;
    }
    public function setdiachi($value)
    {
        $this->diachi = $value;
    }
    // khai báo các thuộc tính (SV tự viết)

    public function kiemtrakhachhanghople($taikhoankh, $matkhau)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khachhang WHERE taikhoankh=:taikhoankh AND matkhau=:matkhau AND trangthai=1";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":taikhoankh", $taikhoankh);
            $cmd->bindValue(":matkhau", md5($matkhau));
            $cmd->execute();
            $valid = ($cmd->rowCount() == 1);
            $cmd->closeCursor();
            return $valid;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy thông tin người dùng có $taikhoankh
    public function laythongtinkhachhang($taikhoankh)
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khachhang WHERE taikhoankh=:taikhoankh";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(":taikhoankh", $taikhoankh);
            $cmd->execute();
            $ketqua = $cmd->fetch();
            $cmd->closeCursor();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }

    // lấy tất cả ng dùng
    public function laydanhsachkhachhang()
    {
        $db = DATABASE::connect();
        try {
            $sql = "SELECT * FROM khachhang";
            $cmd = $db->prepare($sql);
            $cmd->execute();
            $ketqua = $cmd->fetchAll();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    
    // Thêm ng dùng mới, trả về khóa của dòng mới thêm
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function themkhachhang($khachhang)
    {
        $db = DATABASE::connect();
        try {
            $sql = "INSERT INTO khachhang(taikhoankh,sodienthoai,matkhau,hoten,hinhanh,diachi) 
VALUES(:taikhoankh,:sodienthoai,:matkhau,:hoten,:hinhanh,:diachi)";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':taikhoankh', $khachhang->taikhoankh);
            $cmd->bindValue(':matkhau', md5($khachhang->matkhau));
            $cmd->bindValue(':sodienthoai', $khachhang->sodienthoai);
            $cmd->bindValue(':hoten', $khachhang->hoten);
 
            $cmd->bindValue(':hinhanh', $khachhang->hinhanh);
            $cmd->bindValue(':diachi', $khachhang->diachi);
            $cmd->execute();
            $id = $db->lastInsertId();
            return $id;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Cập nhật thông tin ng dùng: họ tên, số đt, taikhoankh, ảnh đại diện 
    // (SV nên truyền tham số là 1 đối tượng kiểu người dùng, không nên truyền nhiều tham số rời rạc như thế này)
    public function capnhatkhachhang($id, $taikhoankh, $sodt, $hoten, $hinhanh, $diachi)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE khachhang set hoten=:hoten, taikhoankh=:taikhoankh,sodienthoai=:sodt, hinhanh=:hinhanh, diachi=:diachi where id=:id";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':id', $id);
            $cmd->bindValue(':taikhoankh', $taikhoankh);
            $cmd->bindValue(':sodt', $sodt);
            $cmd->bindValue(':hoten', $hoten);
            $cmd->bindValue(':hinhanh', $hinhanh);
            $cmd->bindValue(':diachi', $diachi);
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi mật khẩu
    public function doimatkhau($taikhoankh, $matkhau)
    {
        $db = DATABASE::connect();
        try {
            $sql = "UPDATE khachhang set matkhau=:matkhau where taikhoankh=:taikhoankh";
            $cmd = $db->prepare($sql);
            $cmd->bindValue(':taikhoankh', $taikhoankh);
            $cmd->bindValue(':matkhau', md5($matkhau));
            $ketqua = $cmd->execute();
            return $ketqua;
        } catch (PDOException $e) {
            $error_message = $e->getMessage();
            echo "<p>Lỗi truy vấn: $error_message</p>";
            exit();
        }
    }
    // Đổi quyền (loại người dùng: 1 quản trị, 2 nhân viên. Không cần nâng cấp quyền đối với loại người dùng 3 khách hàng)
    // public function doiloaiquyenquyenkhachhang($taikhoankh, $loaiquyenquyen)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE khachhang set loaiquyenquyen=:loaiquyenquyen where taikhoankh=:taikhoankh";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':taikhoankh', $taikhoankh);
    //         $cmd->bindValue(':loaiquyenquyen', $loaiquyenquyen);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
    // Đổi trạng thái (0 khóa, 1 kích hoạt)
    // public function doitrangthai($id, $trangthai)
    // {
    //     $db = DATABASE::connect();
    //     try {
    //         $sql = "UPDATE khachhang set trangthai=:trangthai where id=:id";
    //         $cmd = $db->prepare($sql);
    //         $cmd->bindValue(':id', $id);
    //         $cmd->bindValue(':trangthai', $trangthai);
    //         $ketqua = $cmd->execute();
    //         return $ketqua;
    //     } catch (PDOException $e) {
    //         $error_message = $e->getMessage();
    //         echo "<p>Lỗi truy vấn: $error_message</p>";
    //         exit();
    //     }
    // }
}

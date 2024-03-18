<?php
if (!isset($_SESSION["khachhang"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/khachhang.php");
require("../../model/quyen.php");

// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {   // mặc định là xem danh sách
    $action = "xem";
}

$pq = new QUYEN();
$nd = new KHACHHANG();

switch ($action) {
    case "xem":
        $quyen = $pq->layquyen();
        $khachhang = $nd->laydanhsachkhachhang();
        include("main.php");
        break;
    case "them":
        $quyen = $pq->layquyen();

        include("add.php");
        break;
    case "xulythem":
        //xử lý load ảnh
        $hinhanh = basename($_FILES["fileanh"]["name"]); // đường dẫn ảnh lưu trong db
        $duongdan = "../../img/users/" . $hinhanh; //nơi lưu file upload
        move_uploaded_file($_FILES["fileanh"]["tmp_name"], $duongdan);
        //xử lý thêm mặt hàng
        $khachhangmoi = new khachhang();
        $khachhangmoi->settaikhoankh($_POST["txtemail"]);
        $khachhangmoi->setsodienthoai($_POST["txtsodienthoai"]);
        $khachhangmoi->setmatkhau($_POST["txtmatkhau"]);
        $khachhangmoi->sethoten($_POST["txthoten"]);
        // $khachhangmoi->setloai($_POST["optquyen"]);
        // $khachhangmoi->settrangthai($_POST["txttrangthai"]);
        $khachhangmoi->sethinhanh($hinhanh);
        // thêm
        $nd->themkhachhang($khachhangmoi);
        // load người dùng
        $quyen = $pq->layquyen();
        $khachhang = $nd->laydanhsachkhachhang();
        include("main.php");
        break;
    // case "khoa":
    //     if (isset($_REQUEST["id"]))
    //         $id = $_REQUEST["id"];
    //     if (isset($_REQUEST["trangthai"]))
    //         $trangthai = $_REQUEST["trangthai"];
    //     else
    //         $trangthai = "1";
    //     if ($trangthai == "1") {
    //         $trangthai = 0;
    //         $nd->doitrangthai($id, $trangthai);
    //     } else {
    //         $trangthai = 1;
    //         $nd->doitrangthai($id, $trangthai);
    //     }
    //     // load người dùng
    //     $quyen = $pq->layquyen();
    //     $khachhang = $nd->laydanhsachkhachhang();
    //     include("main.php");
    //     break;
    // default:
    //     break;
}

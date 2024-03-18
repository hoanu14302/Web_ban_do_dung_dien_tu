<?php
if (!isset($_SESSION["khachhang"]))
    header("location:../index.php");

require("../../model/database.php");
require("../../model/khachhang.php");
require("../../model/quyen.php");
require("../../model/donhang.php");
require("../../model/sanpham.php");
require("../../model/detail_donhang.php");
// Xét xem có thao tác nào được chọn
if (isset($_REQUEST["action"])) {
    $action = $_REQUEST["action"];
} else {   // mặc định là xem danh sách
    $action = "xem";
}

$dh = new DONHANG();
$nd = new KHACHHANG();
$mh = new SANPHAM();
$dhct = new DONHANGCT();
switch ($action) {
    case "xem":
        $donhang = $dh->laydonhang();
        $khachhang = $nd->laydanhsachkhachhang();

        include("main.php");
        break;
    case "chitiet":
        if (isset($_GET["id"])) {
            $id_dh = $_GET["id"];
            // tăng lượt xem lên 1
            $donhanghh = $dh->laydonhangtheoid($id_dh);
            $donhangct = $dhct->laydonhangct();
            $sanpham = $mh->laysanpham();
            include("detail.php");
        }
        break;

    default:
        break;
}

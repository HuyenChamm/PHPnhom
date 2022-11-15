<?php
    $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
    or die('Không thể kết nối tới database' . mysqli_connect_error());
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            border-collapse: collapse;
            width: 500px;
            margin: auto;
        }

        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        td:nth-child(3) {
            text-align: center;
        }

        tr:nth-child(1) {
            color: red;
        }

        tr:nth-child(even) {
            /* nth-child : Lựa chọn phần tử chẵn (Even) lẻ (Odd) */
            background-color: lightpink;
        }

        h3 {
            text-align: center;
            text-transform: uppercase;
        }

        img {
            width: 100px;
            height: 100px;
        }
    </style>
</head>

<body>
    <div>
        <form action="" method="post">
            <table>
                <tr>
                    <td colspan="2">
                        <h3> Thêm sữa mới</h3>
                    </td>
                </tr>
                <tr>
                    <td>Mã sữa</td>
                    <td><input type="text" name="id"></td>
                </tr>
                <tr>
                    <td>Tên sữa</td>
                    <td><input type="text" name="name"></td>
                </tr>
                <tr>
                    <td>Hãng sữa</td>
                    <td> <select name="brand">
                            <option value="">
                                Chọn hãng sữa
                            </option>
                            <?php
                            $sql = 'SELECT * FROM hang_sua';
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) != 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $brand = $row['Ten_hang_sua'];
                                    $idbrand = $row['Ma_hang_sua'];
                                    echo "<option value='$idbrand'>
                                        $brand
                                        </option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Loại sữa</td>
                    <td> <select name="kind">
                            <option value="">
                                Chọn loại
                            </option>
                            <?php
                            $sql = 'SELECT * FROM loai_sua';
                            $result = mysqli_query($conn, $sql);
                            if (mysqli_num_rows($result) != 0) {
                                while ($row = mysqli_fetch_array($result)) {
                                    $kind = $row['Ten_loai'];
                                    $idkind = $row['Ma_loai_sua'];
                                    echo "<option value='$idkind'>
                                        $kind
                                        </option>";
                                }
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Trọng lượng</td>
                    <td><input type="text" name="trongluong"></td>
                </tr>
                <tr>
                    <td>Đơn giá</td>
                    <td><input type="text" name="price"></td>
                </tr>
                <tr>
                    <td>Thành phần dinh dưỡng:</td>
                    <td><input type="text" name="tpdd"></td>
                </tr>
                <tr>
                    <td>Lợi ích</td>
                    <td><input type="text" name="loiich"></td>
                </tr>
                <tr>
                    <td>Hình ảnh:</td>
                    <td> <input type="file" name="img"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit" name="add">Thêm mới</button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        ?>
    </div>
</body>
<?php


if (isset($_POST['add']) && isset($_POST['id'])) {
    $img = $_POST['img'];
    $id = $_POST['id'];
    $name = $_POST['name'];
    $brand = $_POST['brand'];
    $kind = $_POST['kind'];
    $trongluong = $_POST['trongluong'];
    $price = $_POST['price'];
    $tpdd = $_POST['tpdd'];
    $loiich = $_POST['loiich'];
    $sql = "SELECT * FROM sua WHERE Ma_sua='$id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {

        $sql = "INSERT INTO sua(Ma_sua, Ten_sua, Ma_hang_sua, Ma_loai_sua, Trong_luong, Don_gia, TP_Dinh_Duong, Loi_ich, Hinh) 
                VALUES ('$id','$name','$idbrand','$idkind','$trongluong','$price','$tpdd','$loiich','$img')";
        $result = mysqli_query($conn, $sql);
        echo "
                <table>
                    <tr><td>Thêm mới thành công ! Kết quả thêm mới</td></tr>
                    <tr>
                        <td colspan = '2' id= 'title'><h2>$name - $brand</h2></td>
                    </tr>
                    <tr>
                        <td> <img src='$img'></td>
                        <td>
                            <p>Thành phần dinh dưỡng</p>
                            <p>$tpdd</p>
                            <p>Lợi ich:</p>
                            <p>$loiich</p>
                            <p>Trọng lượng : $trongluong gram  - Đơn giá : $price VNĐ</p>
                        </td>
                    </tr>
                </table>
                ";
        echo "</table>";
    } else
        echo "<script>alert('Trùng mã sữa')</script>";
}


?>

</html>
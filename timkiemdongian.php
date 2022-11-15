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
        <form action="" method="get">
            <table>
                <tr>
                    <td colspan="3">
                        <h3>Tìm kiếm thông tin sữa</h3>
                    </td>
                </tr>
                <tr>
                    <td>Tên sữa:</td>
                    <td><input type="text" name="search"></td>
                    <td><button type="submit" name="searchbtn">Tìm kiếm</button></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
    if (isset($_REQUEST['searchbtn'])) {
        $search = ($_GET['search']);
        if (empty($search)) {
            echo "Yeu cau nhap du lieu vao o trong";
        } else {
            // Dùng câu lênh like trong sql và sứ dụng toán tử % của php để tìm kiếm dữ liệu chính xác hơn.
            $sql = "select * from sua where Ten_sua like '%$search%'";

            // 1. Ket noi CSDL
            $conn = mysqli_connect('localhost', 'root', '', 'qlbansua')
                or die('Không thể kết nối tới database' . mysqli_connect_error());
            $result = mysqli_query($conn, $sql);
            $slkq = mysqli_num_rows($result);
            // Nếu có kết quả thì hiển thị, ngược lại thì thông báo không tìm thấy kết quả
            // 4.Xu ly du lieu tra ve
            echo "<table>";
            // echo "<tr>";
            echo "<td colspan='2'><h3> Có $slkq sản phẩm được tìm thấy</h3></td>";
            // echo "</tr>";
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    $Name = $row['Ten_sua'];
                    $TrongLuong = $row['Trong_luong'];
                    $DonGia = $row['Don_gia'];
                    $Hinh = $row['Hinh'];
                    $file = " './img/$Hinh'";
                    if ((file_exists($file))) {
                        $Hinh = 'loi.jpg';
                    }
                    $TPDD = $row['TP_Dinh_Duong'];
                    $Loiich = $row['Loi_ich'];

                    echo "
                <table>
                    
                    <tr>
                        <td colspan = '2' id= 'title'><h2>$Name</h2></td>
                    </tr>
                    <tr>
                        <td> <img src='./img/$Hinh'></td>
                        <td>
                            <p>Thành phần dinh dưỡng</p>
                            <p>$TPDD</p>
                            <p>Lợi ich:</p>
                            <p>$Loiich</p>
                            <p>Trọng lượng : $TrongLuong gram  - Đơn giá : $DonGia VNĐ</p>
                        </td>
                    </tr>
                </table>
                ";
                }
            }
            echo "</table>";
        }
    }


    ?>
</body>

</html>
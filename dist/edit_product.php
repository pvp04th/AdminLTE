<?php
$pro_id = $_GET['pro_id'];
require '../connect.php';
$sql = "SELECT * FROM products WHERE pro_id ='$pro_id'";
$result = $con->query($sql);
$row = mysqli_fetch_array($result);

if (isset($_POST['save'])) {
    $pro_name = $_POST['pro_name'];
    $pro_price = $_POST['pro_price'];
    $pro_amount = $_POST['pro_amount'];
    $pro_status = $_POST['pro_status'];
    $filename = $_FILES['image']['name'];
    $tmp_name = $_FILES['image']['tmp_name'];
    $upload_dir = 'assets/product_img/';

    // ตรวจสอบข้อมูลครบถ้วน
    if (empty($pro_id) || empty($pro_name) || empty($pro_price) || empty($pro_amount) || empty($pro_status)) {
        echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน'); history.back();</script>";
        exit;
    }

    // ถ้ามีไฟล์รูปใหม่ถูกอัพโหลด
    if (!empty($filename) && $_FILES['image']['error'] == 0) {
        // ลบไฟล์รูปเก่า ถ้ามี
        if (!empty($row['image']) && file_exists($upload_dir . $row['image'])) {
            unlink($upload_dir . $row['image']);
        }
        // ย้ายไฟล์รูปใหม่
        move_uploaded_file($tmp_name, $upload_dir . $filename);

        // อัพเดตข้อมูลรวมรูปภาพ
        $sql = "UPDATE products SET 
                pro_name='$pro_name',
                pro_price='$pro_price',
                pro_amount='$pro_amount',
                pro_status='$pro_status',
                image='$filename'
                WHERE pro_id='$pro_id'";
    } else {
        // อัพเดตข้อมูลไม่เปลี่ยนรูปภาพ
        $sql = "UPDATE products SET 
                pro_name='$pro_name',
                pro_price='$pro_price',
                pro_amount='$pro_amount',
                pro_status='$pro_status'
                WHERE pro_id='$pro_id'";
    }

    if ($con->query($sql)) {
        echo "<script>alert('อัปเดตข้อมูลสินค้าสำเร็จ ✅'); window.location.href='index.php?page=product';</script>";
    } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการอัปเดตข้อมูล ❌'); history.back();</script>";
    }
}
?>


<!--begin::App Content Header-->
<div class="app-content-header">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">EDIT_Product</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">add_user</li>
                </ol>
            </div>
        </div>
        <!--end::Row-->
    </div>
    <!--end::Container-->
</div>
<!--end::App Content Header-->
<!--begin::App Content-->
<div class="app-content">
    <!--begin::Container-->
    <div class="container-fluid">
        <!--begin::Row-->
        <div class="row g-4">

            <!--begin::Col-->
            <div class="col-md-12">
                <!--begin::Quick Example-->
                <div class="card card-primary card-outline mb-4">
                    <!--begin::Header-->
                    <div class="card-header bg-primary text-white">
                        <div class="card-title">Add_user</div>
                    </div>
                    <!--end::Header-->
                    <!--begin::Form-->
                    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" enctype="multipart/form-data">
                        <!--begin::Body-->
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">PRO_ID</label>
                                <input type="text" class="form-control" name="pro_id" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" value="<?php echo $row['pro_id'] ?>" readonly />
                                <div id="emailHelp" class="form-text">
                                    username ต้องไม่ซ้ำกับคนอื่น
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">PRODUCT NAME</label>
                                <input type="text" class="form-control" name="pro_name" id="exampleInputPassword1"
                                    value="<?php echo $row['pro_name'] ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">PRICE</label>
                                <input type="text" class="form-control" name="pro_price" id="exampleInputPassword1"
                                    value="<?php echo $row['pro_price'] ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">AMOUNT</label>
                                <input type="text" class="form-control" name="pro_amount" id="exampleInputPassword1"
                                    value="<?php echo $row['pro_amount'] ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">SATATUS</label>
                                <input type="text" class="form-control" name="pro_status" id="exampleInputPassword1"
                                    value="<?php echo $row['pro_status'] ?>" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รูปภาพเดิม</label>
                                <img src="assets/product_img/<?php echo htmlspecialchars($row['image']); ?>"
                                    width="250px" height="250px" alt="รูปภาพเดิม" class="mb-3" />
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">รูปภาพใหม่</label>
                                <input type="file" name="image" class="form-control" id="exampleInputPassword1" />
                            </div>

                        </div>
                        <!--end::Body-->
                        <!--begin::Footer-->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary" name="save">Save</button>
                        </div>
                        <!--end::Footer-->
                    </form>
                    <!--end::Form-->
                </div>
            </div>
            <!--end::Horizontal Form-->
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</div>
<!--end::Container-->
</div>
<!--end::App Content-->
<?php
require '../connect.php';
if (isset($_POST['save'])) {
  $pro_id = $_POST['pro_id'];
  $pro_name = $_POST['pro_name'];
  $pro_price = $_POST['pro_price'];
  $pro_amount = $_POST['pro_amount'];
  $pro_status = $_POST['pro_status'];
  $image = $_FILES['image']['name'];

  if (empty($pro_id) ||  empty($pro_name) || empty($pro_price) || empty($pro_amount) || empty($pro_status)) {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');history.back();</script>";
  } else {
    $result = $con->query("SELECT pro_id FROM products WHERE pro_id = '$pro_id'");
    $exit_username = mysqli_fetch_array($result);
    if ($exit_username) {
      echo "<script>alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนชื่อผู้ใช้');history.back();</script>";
    } else {
      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/product_img/' . $image);
      $sql = "INSERT INTO products (pro_id, pro_name, pro_price, pro_amount, pro_status,image) 
      VALUES ('$pro_id', '$pro_name', '$pro_price', '$pro_amount', '$pro_status','$image')";
      if ($con->query($sql)) {
        echo "<script>window.lacation.href='index.php?page=products'</script>";
      } else {
        echo "<script>alert('เกิดข้อผิดพลาดในการบันทึกข้อมูล');history.back();</script>";
      }
    }
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
        <h3 class="mb-0">ADD PRODUCTS </h3>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">product</li>
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
          <div class="card-header">
            <div class="card-title">Add products</div>
          </div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"enctype="multipart/form-data">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">PRO_ID </label>
                <input type="text" class="form-control" name="pro_id" id="exampleInputEmail1" aria-describedby="emailHelp" />
                <div id="emailHelp" class="form-text">
                  รหัสสินค้าต้องไม่ซ้ำกัน 
                </div>
                
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">PRODUCT NAME </label>
                <input type="text" name="pro_name" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">PRICE</label>
                <input type="text" name="pro_price" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">AMOUNT</label>
                <input type="text" name="pro_amount" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">STATUS </label>
                <input type="text" name="pro_status" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Image </label>
                <input type="file" name="image" class="form-control" id="exampleInputPassword1" />
              </div>
            </div>
            <!--end::Body-->
            <!--begin::Footer-->
            <div class="card-footer">
              <button type="submit" class="btn btn-success" name="save">บันทึกข้อมูล</button>
            </div>
            <!--end::Footer-->
          </form>
          <!--end::Form-->
        </div>
        <!--end::Quick Example-->
      </div>
    </div>
    <!--end::Row-->
  </div>
  <!--end::Container-->
</div>
<!--end::App Content-->
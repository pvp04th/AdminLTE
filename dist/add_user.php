<?php
require '../connect.php';
if (isset($_POST['save'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $fullname = $_POST['fullname'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];
  $image = $_FILES['image']['name'];
  if (empty($username) ||  empty($password) || empty($fullname) || empty($phone) || empty($email)) {
    echo "<script>alert('กรุณากรอกข้อมูลให้ครบถ้วน');history.back();</script>";
  } else {
    $result = $con->query("SELECT username FROM user WHERE username = '$username'");
    $exit_username = mysqli_fetch_array($result);
    if ($exit_username) {
      echo "<script>alert('ชื่อผู้ใช้ซ้ำ กรุณาเปลี่ยนชื่อผู้ใช้');history.back();</script>";
    } else {
      move_uploaded_file($_FILES['image']['tmp_name'], 'assets/user_img/' . $image);
      $sql = "INSERT INTO user (username, password, fullname, phone, email,image) 
      VALUES ('$username', '$password', '$fullname', '$phone', '$email','$image')";
      if ($con->query($sql)) {
        echo "<script>window.lacation.href='index.php?page=user'</script>";
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
        <h3 class="mb-0">Add User </h3>
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
          <div class="card-header">
            <div class="card-title">ADD USER</div>
          </div>
          <!--end::Header-->
          <!--begin::Form-->
          <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post"enctype="multipart/form-data">
            <!--begin::Body-->
            <div class="card-body">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username </label>
                <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" />
                <div id="emailHelp" class="form-text">
                  ชื่อผู้ใช้จะต้องไม่ซ้ำกัน (Username must be unique.)
                </div>
                
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Password </label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">ชื่อ-นามสกุล </label>
                <input type="text" name="fullname" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">เบอร์โทรศัพท์ </label>
                <input type="phone" name="phone" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email </label>
                <input type="text" name="email" class="form-control" id="exampleInputPassword1" />
              </div>
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Image </label>
                <input type="file" name="image" class="form-control" id="exampleInputPassword1" />
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
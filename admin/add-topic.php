<?php
    session_start();
    include('../database/conn.php');
    require_once('../functions.php');

    if(!isset($_SESSION['admin'])){
        redirect('login.php');
    }

    if(isset($_POST['add'])){
        $name = $_POST['name'];
        $status = $_POST['status'];
        $categoryID = $_POST['category'];
        $admin = $_SESSION['admin'];

        $sql = "SELECT name FROM topics WHERE name='$name' AND categoryID=$categoryID";
        $result = $conn->query($sql);
        if($result->num_rows > 0){
            set_flash_session('error','Chủ đề này đã tồn tại.');
        }
        else{
            $sql = "INSERT INTO Topics(name,is_active,categoryID,adminID) VALUES ('$name','$status','$categoryID','$admin')";

            if($conn->query($sql) === TRUE){
                set_flash_session('mess_flash','Chủ đề ' . $name . ' đã được thêm.');
                redirect('add-topic.php');
            } else {
                set_flash_session('error','Không thể thêm chủ đề này.');
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm chủ đề | Quản trị viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/style.css">
    <link rel="shortcut icon" href="../public/images/logo.png" type="image/x-icon">
</head>
<body class="ad-bg">
    <?php include('components/header.php'); ?>
    <main class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-3 sidebar">
                <?php include('components/sidebar.php'); ?>
            </div>
            <div class="col-lg-10 col-md-9">
                <article class="ad-article">
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="border-bottom pt-3">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="topic.php">Chủ đề</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Thêm chủ đề</li>
                        </ol>
                    </nav>
                    <div class="mt-4">
                        <?php
                            $mess = get_flash_session('mess_flash');
                            if(isset($mess)){
                        ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Thành công!</strong> <?= $mess ?>
                        </div>
                        <?php        
                            }
                        ?>
                        <?php
                            $error = get_flash_session('error');
                            if(isset($error)){
                        ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Thất bại!</strong> <?= $error ?>
                        </div>
                        <?php        
                            }
                        ?>
                        <form method="POST">
                            <div class="col-lg-6 col-12 m-auto">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên chủ đề</label>
                                    <input type="text" class="form-control" id="name" name="name" aria-describedby="name" placeholder="Nhập tên chủ đề" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Thuộc chuyên mục</label>
                                    <select class="form-select" name="category">
                                    <?php
                                        $sql = "SELECT id, name FROM categories WHERE is_active = 1";
                                        $result = $conn->query($sql);
                                        if($result->num_rows > 0){
                                            while($row = $result->fetch_assoc()){
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php            
                                            }
                                        }
                                    ?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-select" name="status">
                                        <option value="1">Hoạt động</option>
                                        <option value="-1">Tắt</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block" name="add">Lưu</button>
                            </div>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </main>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>
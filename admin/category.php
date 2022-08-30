<?php
    session_start();
    include('../database/conn.php');
    require_once('../functions.php');
    require_once('../pagination.php');

    if(!isset($_SESSION['admin'])){
        redirect('login.php');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT is_active FROM categories WHERE id='$id'";
        $result = $conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        $status = $row['is_active'];
        if($status == 1){
            $sql="UPDATE categories SET is_active=-1 WHERE id='$id'";
            mysqli_query($conn,$sql);
            redirect('categories.php');
        }
        else{
            $sql="UPDATE categories SET is_active=1 WHERE id='$id'";
            mysqli_query($conn,$sql);
            redirect('categories.php');
        }
    }

    $query = "SELECT id FROM categories";
    $results_per_page = 10;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chuyên mục | Quản trị viên</title>
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
                    <h2 class="heading">Chuyên mục</h2>
                    <div class="row">
                        <div class="col-lg-6 col-12 mb-3">
                            <form class="d-flex" method="GET">
                                <input class="form-control me-2" name="search" type="text" placeholder="Tìm kiếm tên chuyên đề..." required>
                                <button type="submit" class="btn btn-secondary"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <div class="col-lg-6 col-12 d-flex justify-content-end">
                            <a href="add-category.php">
                                <button type="button" class="btn btn-primary">
                                    Thêm chuyên mục
                                </button>
                            </a>
                        </div>
                    </div>
                    <?php
                        if(isset($_REQUEST['search'])){
                        ?>
                        <table class="table table-sm table-striped table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên chuyên mục</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $search = $_GET['search'];
                                $sql = "SELECT id,name,is_active FROM categories WHERE name LIKE '%$search%'";
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <th scope="row"><?= $row['id'] ?></th>
                                    <td><?= $row['name'] ?></td>
                                    <?php
                                        if($row['is_active']==1){
                                    ?>
                                    <td>
                                        <a href="category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-primary">ON</a>
                                        <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">Chi tiết</a>
                                    </td>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <td>
                                        <a href="category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-danger">OFF</a>
                                        <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">Chi tiết</a>
                                    </td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            <?php
                                    }
                                }
                                else {
                            ?>
                                <td colspan="3" class="d-flex justify-content-center">No data available</td>
                            <?php        
                                }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        }
                        else {
                        ?>
                        <table class="table table-sm table-striped table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên chuyên mục</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $search = $_GET['search'];
                                $sql = "SELECT id,name,is_active FROM categories LIMIT " . first_page($results_per_page) . ',' . $results_per_page;
                                $result = $conn->query($sql);
                                if($result->num_rows > 0){
                                    while($row = $result->fetch_assoc()){
                            ?>
                                <tr>
                                    <th scope="row"><?= $row['id'] ?></th>
                                    <td><?= $row['name'] ?></td>
                                    <?php
                                        if($row['is_active']==1){
                                    ?>
                                    <td>
                                        <a href="category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-primary">ON</a>
                                        <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">Chi tiết</a>
                                    </td>
                                    <?php
                                        }
                                        else{
                                    ?>
                                    <td>
                                        <a href="category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-danger">OFF</a>
                                        <a href="edit-category.php?id=<?= $row['id'] ?>" type="button" class="btn btn-sm btn-success">Chi tiết</a>
                                    </td>
                                    <?php
                                        }
                                    ?>
                                </tr>
                            <?php
                                    }
                                }
                                else {
                            ?>
                                <td colspan="3" class="d-flex justify-content-center">No data available</td>
                            <?php        
                                }
                            ?>
                            </tbody>
                        </table>
                        <?php
                        if(num_pages($query,$results_per_page) > 1){
                        ?>
                        <ul class="pagination d-flex justify-content-center">
                        <?php
                                for($page = 1; $page <= num_pages($query,$results_per_page); $page++){
                            ?>
                            <li class="page-item"><a class="page-link" href="category.php?page=<?= $page ?>"><?= $page ?></a></li>
                            <?php
                                }
                            ?>
                        </ul>
                        <?php
                            }
                        ?>
                    <?php
                    }
                    ?>
                </article>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="../public/js/main.js"></script>
</body>
</html>
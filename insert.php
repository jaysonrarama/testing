<?php
    include('db/conn.php');

    if(!empty($_FILES) && !empty($_FILES['Mimage'])){
        if($_FILES['Mimage']['error'] === 0 && $_FILES['Mimage']['size'] !== 0){
            $originalName = $_FILES['Mimage']['name'];
            $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            $baseName = preg_replace('/[^a-zA-Z0-9-_\.]/','', pathinfo($originalName, PATHINFO_FILENAME));
            $newFileName = $baseName . '_' . time() . '.'. $extension; 

            $allowedExtension = ['jpg','jpeg','png','gif','webp'];

            if(in_array($extension, $allowedExtension)){
                move_uploaded_file($_FILES['Mimage']['tmp_name'], 'image/'. $newFileName);
                echo "File uploaded as: " . $newFileName;
            
            }else{
                echo "Unsupported File";
            }
        }
    }


    if(!empty($_POST) && !empty($newFileName)){
        $name = (string)($_POST['Mname'] ?? '');
        $desc = (string)($_POST['Mdescription'] ?? '');
        $price = (int)($_POST['Mprice'] ?? '');

        $stmt = $pdo->prepare("INSERT INTO tbl_menu(`m_image`,`m_name`,`m_desc`,`m_price`) VALUES (:mImg, :mName, :mDesc, :mPrice)");
        $stmt->bindValue('mImg', $newFileName);
        $stmt->bindValue('mName', $name);
        $stmt->bindValue('mDesc', $desc);
        $stmt->bindValue('mPrice', $price);

        $stmt->execute();
        echo 'Menu Item Saved';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <title>Insert Menu Item</title>
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#">Insert</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4>Add Menu Item</h4>
        </div>

        <div class="card-body">
            <form action="insert.php" method="POST" enctype="multipart/form-data">

                <div class="mb-3">
                    <label class="form-label">Food Name</label>
                    <input type="text" name="Mname" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea name="Mdescription" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Price (₱)</label>
                    <input type="number" name="Mprice" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Image</label>
                    <input type="file" name="Mimage" class="form-control" required>
                </div>

                <button type="submit" name="submit" class="btn btn-success">Add Item</button>

            </form>
        </div>
    </div>
</div>
</body>
</html>
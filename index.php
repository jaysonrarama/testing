<?php
    require 'db/conn.php';
    
    $stmt = $pdo->prepare("SELECT * FROM `tbl_menu`");
    $stmt->execute();

    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <title>Document</title>
</head>
<body>
<header>
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <div class="row justify-content-center ">
            <a class="navbar-brand" href="#">Sushi Bar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
        </div>
</div>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="insert.php">Insert</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h2 class="text-center mb-4"> Menu</h2>
        
        <div class="row">
             <?php foreach ($results as $result): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="image/<?php echo $result['m_image'] ?>" class="card-img-top" alt="">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $result['m_name']?></h5>
                        <p class="card-text"><?php echo $result['m_desc']?></p>
                        <p class="text-succes fw-bold"><?php echo $result['m_price']?></p>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="update.php?id=<?php echo $result['id'] ?>" class="btn btn-warning btn-sm">
                                Edit
                            </a>


                        <form action="delete.php" method="POST">
                            <input type="hidden" name="id" value="<?php echo $result['id']?>">
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        </div>
                    </div>
                </div>
            </div><?php endforeach; ?>
        </div>
    </div>
    
</body>
</html>
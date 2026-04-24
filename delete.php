<?php


require 'db/conn.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['id']) && !empty($_POST['id'])){
        $id = $_POST['id'];

        try{
            $stmt = $pdo->prepare("DELETE FROM `tbl_menu` WHERE id = :id");
            $stmt->bindValue('id', $id, PDO::PARAM_INT);

            if($stmt->execute()){
                header("Location:index.php");
                exit;
            }else{
                echo "Deletion Failed";
            }
        }catch(PDOException $e){
            echo "Error".$e->getMessage();
        }
    }

}
?>
<?php
// Include config file
require_once "config.php";
 $link = $mysqli;
// Define variables and initialize with empty values
$name = $description = $category = "";
$name_err = $_err = $category_err = "";
 
// Processing form data when form is submitted
if(isset($_POST["item_ID"]) && !empty($_POST["item_ID"])){
    // Get hidden input value
    $id = $_POST["item_ID"];
    
    // Validate name
    $input_name = trim($_POST["itemTitle"]);
    if(empty($input_name)){
        $name_err = "Please enter a name.";
    } else{
        $name = $input_name;
    }
    
    // Validate description description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        $description_err = "Please enter a description.";     
    } else{
        $description = $input_description;
    }
    
    // Validate salary
    $input_category = trim($_POST["category"]);
    if(empty($input_category)){
        $category_err = "Please enter the category.";
    } else{
        $category = $input_category;
    }
    
    // Check input errors before inserting in database
    if(empty($name_err) && empty($description_err) && empty($category_err)){
        // Prepare an update statement
        $sql = "UPDATE items SET itemTitle=?, description=?, category=? WHERE item_ID=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_description, $param_category, $param_id);
            
            // Set parameters
            $param_name = $name;
            $param_description = $description;
            $param_category = $category;
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Records updated successfully. Redirect to landing page
                header("location: seller_marketplace.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
} else{
    // Check existence of id parameter before processing further
    if(isset($_GET["item_ID"]) && !empty(trim($_GET["item_ID"]))){
        // Get URL parameter
        $id =  trim($_GET["item_ID"]);
        
        // Prepare a select statement
        $sql = "SELECT * FROM items WHERE item_ID = ?";
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            // Set parameters
            $param_id = $id;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                    /* Fetch result row as an associative array. Since the result set
                    contains only one row, we don't need to use while loop */
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    // Retrieve individual field value
                    $name = $row["itemTitle"];
                    $description = $row["description"];
                    $category = $row["category"];
                } else{
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: error.php");
                    exit();
                }
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
        
        // Close connection
        mysqli_close($link);
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the item record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['PHP_SELF'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="itemTitle" class="form-control <?php echo (!empty($name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $name; ?>">
                            <span class="invalid-feedback"><?php echo $name_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" class="form-control <?php echo (!empty($description_err)) ? 'is-invalid' : ''; ?>"><?php echo $description; ?></textarea>
                            <span class="invalid-feedback"><?php echo $description_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Category</label>
                            <input type="text" name="category" class="form-control <?php echo (!empty($category_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $category; ?>">
                            <span class="invalid-feedback"><?php echo $category_err;?></span>
                        </div>
                        <input type="hidden" name="item_ID" value="<?php echo $_GET["item_ID"]; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="seller_marketplace.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
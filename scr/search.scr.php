<?php
  require "dbh.scr.php";
  if(isset($_REQUEST["term"])){
    // Prepare a select statement
    $sql = "SELECT * FROM hjuma_challenges WHERE challenge_title LIKE ?";

    if($stmt = mysqli_prepare($conn, $sql)){
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "s", $param_term);

        // Set parameters
        $param_term = '%' . $_REQUEST["term"] . '%';

        // Attempt to execute the prepared statement
        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            // Check number of rows in the result set
            if(mysqli_num_rows($result) > 0){
                // Fetch result rows as an associative array
                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
?>
                  <p><b><a href="challenge_info?c=<?php echo $row['challenge_id']; ?>"><?php echo $row['challenge_title']; ?></a></b></p>
<?php
                }
            } else{
                echo "<div class='no-matches'><b>No matches found</b></div>";
            }
        } else{
            echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
        }
    }
}

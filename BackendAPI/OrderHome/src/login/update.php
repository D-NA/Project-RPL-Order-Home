<?php

    include 'config.php';

      $postdata = file_get_contents("php://input");
      $username="";
      $password="";
      $user_status="";
      $user_id="";
      if (isset($postdata)) {
          $request = json_decode($postdata);
          $username = $request->username;
          $password = $request->password;
          $user_status = $request->user_status;
          $user_id = $request->user_id;
      }
  $sql = mysqli_query($conn,"UPDATE user SET username = '$username', password = '$password', user_status = '$user_status' WHERE user_id = {$user_id}");
    if($sql){
      $data =array(
          'message' => "Data have been updated",
          'data' => $request,
          'status' => "200"
      );}
 else {
    echo "Error" .$sql.' '.$conn->connect_error;
    $data =array(
        'message' => "Error while updating record :",
        'status' => "404"
    );
  }
  echo json_encode($data);

?>

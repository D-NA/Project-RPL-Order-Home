<?php

    include 'config.php';

      $postdata = file_get_contents("php://input");
      $username="";
      $password="";
      $user_status="";
      $name="";
      $phone_number="";
      $email="";

      if (isset($postdata)) {
          $request = json_decode($postdata);
          $username = $request->username;
          $password = $request->password;
          $user_status = $request->user_status;
          $name= $request->name;
          $phone_number=$request->phone_number;
          $email=$request->email;
      }
      $encrypt_password = md5($password);
      $sql = mysqli_query($conn,"INSERT INTO user ( username, password, user_status, name, phone_number, email)
      VALUES ('$username','$encrypt_password', '$user_status','$name','$phone_number','$email')");

  if($sql){
      $data =array(
          'message' => "Data have been recorded",
          'data' => $request,
          'status' => "200"
      );}
 else {
    echo "Error" .$sql.' '.$conn->connect_error;
    $data =array(
        'message' => "ERROR",
        'status' => "404"
    );
  }
  echo json_encode($data);

?>

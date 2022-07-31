<?php
class crud{
    private $connection;
    function __construct()
    {
        $this->connection=new mysqli('localhost','root','','phpBatch04');
    }
    function insert($name,$email,$department,$gender,$phone){
        
        

        if(empty($name)){
          echo "Name Field is Empty";
        }
        if(empty($email)){
          echo "Email Field is Empty";
        }
        else{
          $check = $this->check($email);
          if($check==TRUE){
            echo '<h6 class="text-center mt-3 text-secondary"><i class="fa-solid fa-circle-exclamation text-danger"></i>This Mail already Exist<i class="fa-solid fa-circle-exclamation text-danger"></i></h6>';
          }
          else{
            $sql=$this->connection->query("INSERT INTO  tbl_student(name,email,department,gender,phone) 
        VALUES('$name','$email','$department','$gender','$phone')");

            if($sql) {
              echo "Success";
            }
            else{
              echo "Something Wrong";
            }
          }
        }
            

    }  
    function show(){
      $table_data= $this->connection->query("SELECT *FROM tbl_student");
      return $table_data;
        
    } 
    function delete($id){
        $sql=$this->connection->query("DELETE FROM tbl_student where student_id='$id' ");
        if($sql){
          header("location:index.php");
          return true;
        }
        else{
          return false;
        }
    }
    function update($data,$id){
      $name = $data['name'];
      $email = $data['email'];
      $department = $data['department'];
      $gender = $data['gender'];
      $phone = $data['phone'];

    $result = $this->connection->query("UPDATE tbl_student SET name='$name', email='$email',department='$department', gender='$gender', phone='$phone' WHERE student_id='$id'");

    if ($result) {
      header("location: index.php");
    }
  }
  function check($email){
    $result = $this->connection->query("SELECT *FROM tbl_student WHERE email='$email'");
    if($result->num_rows>0){
      return true;
    }
    else{
      return false;
    }
  }
        

}
 ?>
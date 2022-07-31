<?php 
    include"class.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- bootstreap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- font awasm -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <?php
        $cd=new crud();




          if(isset($_GET["did"])){
            $id = $_GET["did"];
            $cd->delete($id);
          }

          if(isset($_GET["updateId"])){
            $id = $_GET['updateId'];
            if ($m->update($_GET,$id)) {
              echo '<span class="alert alert-success">Data Updated</span>';
            }
            else{
              echo '<span class="alert alert-danger">Data Not Updated</span>';
            }
          }
         
    ?>
      <div class="row">
        <div class="col-md-6 offset-md-3 mt-3">
          
            <h2 class="text-center text-success">Student Registration Form</h2>

                <?php
                  if(isset($_POST["submit"])){
                    $name=$_POST["name"];
                    $email=$_POST["email"];
                    $department=$_POST["department"];
                    $gender=$_POST["gender"];
                    $phone=$_POST["phone"];

                    $cd->insert($name,$email,$department,$gender,$phone);
                  }
                ?>
            <form class="form-horizontal" action="" method="POST">
              <div class="form-group mb-3">
                <label class="control-label" for="name">Name:</label>
                  <input type="text" id="name" class="form-control" placeholder="Enter Your Name" name="name"required>
              </div>   

              <div class="form-group  mb-3">
                <label class="control-label" for="email">Email:</label>
                  <input type="email" id="email" class="form-control" placeholder="Enter Your Email" name="email" required>
              </div> 

              <div class="form-group  mb-3">
                <label class="control-label" for="department">Department</label>
                <select class="form-control text-center" name="department" id="department">
                  <option value="CSE">------ Select Department--------</option>
                  <option value="CSE"> CSE</option>
                  <option value="BBA">BBA</option>
                  <option value="BSME">BSME</option>
                  <option value="BSEEE">BSEEE</option>
                </select>
              </div>
              
              <div class="form-group  mb-3">
                <div class="form-check" required>
                    <input class="form-check-input" type="radio" name="gender" id="male"  value="Male" required>
                    <label class="form-check-label" for="male">
                        Male
                    </label>
                    </div>
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="Female" required>
                    <label class="form-check-label" for="female">
                        Female
                    </label>
                </div>
              </div> 
              


              <div class="form-group  mb-3">
                  <label for="phone">Phone</label>
                  <input id="phone" type="text" name="phone" class="form-control" placeholder="Enter Your Phone" required>
              </div>

              <div class="form-group">        
                  <button type="submit" class="btn btn-primary form-control" name="submit">Submit</button>
              </div>
              
            </form>
        </div>
      </div>


<div class="row">
  <div class="col-md-8 offset-md-2 mt-5">
    <table class="table table-dark">
      <tr>
        <th>Serial No.</th>
        <th>Name</th>
        <th>Email</th>
        <th>Department</th>
        <th>Gender</th>
        <th>Phone</th>
        <th>Action</th>
      </tr>
      <?php
      $table_view=$cd->show();
      $sl = 1;
      while($data=$table_view->fetch_assoc()){
        echo '        
        <tr>
            <th>'.$sl.'</th>
            <th>'.$data["name"].'</th>
            <th>'.$data["email"].'</th>
            <th>'.$data["department"].'</th>
            <th>'.$data["gender"].'</th>
            <th>'.$data["phone"].'</th>
            
            <th>

            <a href="" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#edit'.$data['student_id'].'"><i class="fa-solid fa-edit"></i> </a>
            <a href="index.php?did='.$data["student_id"].'" class="btn btn-danger"><i class="fa-solid fa-trash"></i> </a>

        </tr>';
        $sl++;
?>
<!--Update Modal -->
<div class="modal fade" id="edit<?php echo $data['student_id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title text-center" id="exampleModalLabel">Update Student Information</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      
        <form action="GET">

            <div class="form-group mb-3">
              <input type="text" placeholder="User Name" class="form-control" name="name" value="<?php echo $data['name'] ?>">
            </div>

            <div class="form-group mb-3">
              <input type="email" placeholder="User Email" class="form-control" name="email" value="<?php echo $data['email'] ?>">
            </div>

            <div class="form-group mb-3">
                  <label class="control-label" for="department"></label>
                  <select class="form-control text-center" name="department" id="department">
                    <option value="">------ Select Department--------</option>
                    <option value="CSE"> CSE</option>
                    <option value="BBA">BBA</option>
                    <option value="BSME">BSME</option>
                    <option value="BSEEE">BSEEE</option>
                  </select>
            </div>

            <div class="form-group  mb-3">
                <div class="form-check" required>
                    <input class="form-check-input" type="radio" name="gender" id="male1"  value="Male" required>
                    <label class="form-check-label" for="male1">Male</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="gender" id="female1" value="Female" required>
                    <label class="form-check-label" for="female1">Female</label>
                </div>
            </div>

            <div class="form-group mb-3">
              <input type="text" placeholder="User Phone" class="form-control" name="phone" value="<?php echo $data['phone'] ?>">
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
        <button type="button" name="updateId" value="<?php echo $data['student_id']; ?>" class="btn btn-success">Update</button>
      </div>
    </div>
  </div>
</div>
    <?php
      }
      
       ?>
    </table>
  </div>
</div>


</body>
</html>




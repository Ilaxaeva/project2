<?php 

include 'header.php';
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Istifadəcilər</h1>
                    
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                      
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>id</th>
                                            <th>Ad</th>
                                            <th>Mail</th>
                                            <th>Qeydiyyat tarixi</th>
                                            <th>Status</th>
                                            <th>Fəaliyət</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        <?php 
                                        

$user_check=$db->prepare("SELECT * from user");
$user_check->execute();
;
while($user_count=$user_check->fetch(PDO::FETCH_ASSOC)){?>
     <tr>
                                            <td><?php echo $user_count['id'] ?></td>
                                            <td><?php echo $user_count['name'] ?></td>
                                            <td><?php echo $user_count['email'] ?></td>
                                            <td><?php echo $user_count['date'] ?></td>
                                            <td><?php echo $user_count['status'] ?></td>
                                            <td> <a  href="core/funksiya.php?sil=<?php echo $user_count['id']?>" onclick="return confirm('Silmeye eminsiniz ?')"  style="color:red"><i class="fal fa-trash-alt"></i> Sil</a></td>
                                      
                                        </tr>
<?php } ?>
                                       
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <?php
           
           
           include "footer.php";
           
           ?>
    <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <?php echo $this->breadcrumbs->show(); ?>
      <!-- <ol class="breadcrumb">
        <li class="breadcrumb-item">ระบบสหกิจ</li>
        <li class="breadcrumb-item"><a href="#"><?php echo strToLevel($user->login_type);?></a></li>
        <li class="breadcrumb-item active">ประกาศผลสอบวัดผลสหกิจ</li>
      </ol> -->

      <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            ประกาศผลสอบวัดผลสหกิจ
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">วันที่</th>
                                                <th scope="col">รอบการสอบ</th>
                                                <th scope="col">ผลการสอบ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           <?php foreach($data as $row) { ?>
                                            <tr>
                                                <th scope="row"><?php echo thaiDate($row['coop_test']['test_date']); ?> </th>
                                                <td>การสอบครั้งที่ <?php echo $row['coop_test']['name']; ?></td>
                                                <td>
                                                <?php 
                                                if($row['test_result']['coop_test_status'] == '1') {
                                                    echo '<span class="btn btn-success">สอบผ่าน</span>';
                                                } else if($row['test_result']['coop_test_status'] == '2') {
                                                    echo '<span class="btn btn-warning">สอบตก</span>';
                                                } else {
                                                    echo '<span class="btn btn-info">รอผลการสอบ</span>';                                                    
                                                }
                                                ?>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            
                            



                        </div>

                        
                    </div>
                </div>  
            </div>  
        </div>
      </div>
      <!-- /.conainer-fluid -->
    </main>


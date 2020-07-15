
  
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url('Coop_student/main');?>"><i class="icon-home"></i> หน้าแรก <span class="badge badge-primary"></span></a>
          </li>

          <li class="nav-title">
            <h4>นิสิตฝึกสหกิจ</h4>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-address-book-o"></i> ข้อมูลทั่วไป</a>
            <ul class="nav-dropdown-items">
              <li class="nav-item">
                <?php echo anchor('Coop_student/Coop_detail/index', '<i class="fa fa-user-o"></i> ข้อมูลนิสิต', 'class="nav-link"');?>  
              </li>
              <li class="nav-item">
              <?php echo anchor('Coop_student/Daily_activity/lists', '<i class="fa fa-edit "></i> การฝึกงานแต่ละวัน', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
                <?php echo anchor('Coop_student/Workplace/', '<i class="fa fa-address-book-o"></i> แจ้งพิกัดงาน', 'class="nav-link"');?>  
              </li>
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S003</a>          
            <ul class="nav-dropdown-items">
              <li class="nav-item">
              <?php echo anchor('Coop_student/Permit_form/', '<i class="fa fa-download"></i> แบบอนุญาตให้นิสิตไปปฏิบัติงานสหกิจศึกษา ', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
              <?php echo anchor('Coop_student/Upload_document/?code=IN-S003', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S004</a>
            <ul class="nav-dropdown-items">
            <li class="nav-item">
            <?php echo anchor('Coop_student/IN_S004/', '<i class="fa fa-file"></i> แบบแจ้งรายละเอียดการปฏิบัติงาน และแผนที่ตั้งสถานประกอบการ ', 'class="nav-link"');?>
          
            </li>
            <li class="nav-item">
              <?php echo anchor('Coop_student/Upload_document/?code=IN-S004', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
            </li>
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S005</a>
            
            <ul class="nav-dropdown-items">
              <li class="nav-item">
              <?php echo anchor('Coop_student/IN_S005/', '<i class="fa fa-file"></i> แบบแจ้งแผนปฏิบัติงานสหกิจศึกษา ', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
                <?php echo anchor('Coop_student/Upload_document/?code=IN-S005', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S006</a>
            <ul class="nav-dropdown-items">
              <li class="nav-item">
                <?php echo anchor('Coop_student/IN_S006/form', '<i class="fa fa-download"></i> แบบแจ้งโครงร่างรายงานการปฏิบัติงาน', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
                <?php echo anchor('Coop_student/Upload_document/?code=IN-S006', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
              </li>
              
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S007</a>
            <ul class="nav-dropdown-items">
              <li class="nav-item">
                <?php echo anchor('Coop_student/IN_S007/', '<i class="fa fa-download"></i> แบบคำร้องทั่วไป', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
                <?php echo anchor('Coop_student/Upload_document/?code=IN-S007', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
              </li>
            </ul>
          </li>
          <li class="nav-item nav-dropdown">
            <a class="nav-link nav-dropdown-toggle" href="#"><i class="fa fa-file-text-o"></i> IN-S008</a>
            <ul class="nav-dropdown-items">
              <li class="nav-item nav-dropdown">
               <?php echo anchor('Coop_student/Assessment_company/form', '<i class="fa fa-file-o"></i> แบบประเมินสถานประกอบการที่ให้ความอนุเคราะห์รับนักศึกษาฝึกงาน', 'class="nav-link"');?>
              </li>
              <li class="nav-item">
                <?php echo anchor('Coop_student/Upload_document/?code=IN-S008', '<i class="fa fa-upload"></i> อัพโหลดเอกสาร', 'class="nav-link"');?>
              </li>
            </ul>
          </li>
          <li class="nav-item">
                <?php echo anchor('Coop_student/Coop_detail/Oral_exam', '<i class="fa fa-inbox"></i> การสอบ', 'class="nav-link"');?>
          </li>
          <li class="nav-item nav-dropdown" >
          <a class="nav-link" href="https://forms.gle/NLsLXX4ZXxNScnbi7"><i class="fa fa-bug"></i> <font color="orange"> แจ้งปัญหาการใช้งาน  </a></font>
        </li>  
        </ul>
      </nav>
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>

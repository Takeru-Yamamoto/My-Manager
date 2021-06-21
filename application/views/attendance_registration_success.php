<p class="menu-title">Attendance Menu</p>
<div class="text">
    <P>Congratulations!</P>
    <p>Your Attendance Data has been successfully registered in the database!</p>
    <p>By the way, this is the data registered in the database</p>
    <p>Date:<?php echo $date; ?></p>
    <p>Work Start Time:<?php echo $start_w; ?></p>
    <p>Work End Time:<?php echo $end_w; ?></p>
    <p>Break Start Time:<?php echo $start_b; ?></p>
    <p>Break End Time:<?php echo $end_b; ?></p>
</div>
<?php $this->load->helper('url'); ?>
<?php echo anchor('attendance/index', 'Return Attendance Menu', array('class' => 'anchor2')) ?>
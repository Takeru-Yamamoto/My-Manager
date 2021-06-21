<p class="menu-title">Task Menu</p>
<div class="text">
    <P>Congratulations!</P>
    <p>Your Task Data has been successfully edited in the database!</p>
    <p>By the way, this is the data edited in the database</p>
    <p>Date:<?php echo $date; ?></p>
    <p>Task Genre:<?php echo $genre; ?></p>
    <p>Task Content:<?php echo $task_c; ?></p>
</div>
<?php $this->load->helper('url'); ?>
<?php echo anchor('task/index', 'Return Task Menu', array('class' => 'anchor2')) ?>
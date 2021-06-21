<?php
list($todays, $thisweek, $thismonth) = $data;
$todays = $todays[0];
$thisweek = $thisweek[0];
$thismonth = $thismonth[0];
?>
<p class="menu-title">Task Menu</p>
<div class="both_ends">
    <?php echo anchor('task/registration', 'New addition Task', array('class' => 'anchor2')); ?>
    <?php echo anchor('task/edit_and_delete', 'Edit & Delete Task', array('class' => 'anchor2')); ?>
</div>
<div class="menu2">
    <p class="heading">Today's Task</p>
    <p class="tdt"><?php echo $todays["task_c"]; ?></p>
    <p class="heading">This Week's Task</p>
    <p class="tdt"><?php echo $thisweek["task_c"]; ?></p>
    <p class="heading">This Month's Task</p>
    <p class="tdt"><?php echo $thismonth["task_c"]; ?></p>
</div>
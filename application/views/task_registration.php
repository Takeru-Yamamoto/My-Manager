<p class="menu-title">Task Menu</p>
<?php echo anchor('task/index', 'Return Task Menu', array('class' => 'anchor2')) ?>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>

<?php echo form_open("task/create", array('class' => 'form1')); ?>
<div class="form1-element">
    <div class="form1-element1">
        <p>Date</p><input type="date" name="date">
    </div>
    <div class="form1-element1">
        <p>Task Genre</p><select name="genre"><option value="" selected>Please Select</option><option value="day">Day's</option><option value="week">Week's</option><option value="month">Month's</option></select>
    </div>
    <div class="form1-element1">
        <p>Task Content</p><textarea rows="5" cols="75" name="task_c"></textarea>
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Registration</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
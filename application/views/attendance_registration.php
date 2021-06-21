<p class="menu-title">Attendance Menu</p>
<?php echo anchor('attendance/index', 'Return Attendance Menu', array('class' => 'anchor2')) ?>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("attendance/create", array('class' => 'form1')); ?>
<div class="form1-element">
    <div class="form1-element1">
        <p>Date</p><input type="date" name="date" value="<?php echo set_value('date'); ?>">
    </div>
    <div class="form1-element1">
        <p>Work Start Time</p><input type="time" step="1" name="start_w" value="<?php echo set_value('start_w'); ?>">
    </div>
    <div class="form1-element1">
        <p>Work End Time</p><input type="time" step="1" name="end_w" value="<?php echo set_value('end_w'); ?>">
    </div>
    <div class="form1-element1">
        <p>Break Start Time</p><input type="time" step="1" name="start_b" value="<?php echo set_value('start_b'); ?>">
    </div>
    <div class="form1-element1">
        <p>Break End Time</p><input type="time" step="1" name="end_b" value="<?php echo set_value('end_b'); ?>">
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Registration</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
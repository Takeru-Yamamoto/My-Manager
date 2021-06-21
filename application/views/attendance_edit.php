<p class="menu-title">Attendance Menu</p>
<p class="ba">Before</p>
<div class="menu2">
    <table>
        <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Work Start Time</td>
            <td class="td_title">Work End Time</td>
            <td class="td_title">Break Start Time</td>
            <td class="td_title">Break End Time</td>
        </tr>
        <tr class="table_cell">
            <td><?php echo $date; ?></td>
            <td><?php echo $start_w; ?></td>
            <td><?php echo $end_w; ?></td>
            <td><?php echo $start_b; ?></td>
            <td><?php echo $end_b; ?></td>
        </tr>
    </table>
</div>
<p class="ba">After</p>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("attendance/edit", array('class' => 'form1')); ?>
<div class="form1-element">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form1-element1">
        <p>Date</p><input type="date" name="date" value="<?php echo $date; ?>" readonly>
    </div>
    <div class="form1-element1">
        <p>Work Start Time</p><input type="time" step="1" name="start_w" value="<?php echo $start_w; ?>">
    </div>
    <div class="form1-element1">
        <p>Work End Time</p><input type="time" step="1" name="end_w" value="<?php echo $end_w; ?>">
    </div>
    <div class="form1-element1">
        <p>Break Start Time</p><input type="time" step="1" name="start_b" value="<?php echo $start_b; ?>">
    </div>
    <div class="form1-element1">
        <p>Break End Time</p><input type="time" step="1" name="end_b" value="<?php echo $end_b; ?>">
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Edit</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
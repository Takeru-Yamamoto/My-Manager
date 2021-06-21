<p class="menu-title">Payroll Menu</p>
<?php echo anchor('attendance/index', 'Return Attendance Menu', array('class' => 'anchor2')) ?>
<div class="menu2">
    <p class="heading">Real Payroll</p>
    <p class="tdt"><?php echo $rpr; ?></p>
    <p class="heading">Molded Payroll (One Hour Break & 19:00 Leave & No Overtime)</p>
    <p class="tdt"><?php echo $mpr; ?></p>
    <p class="heading">Standard Payroll</p>
    <p class="tdt"><?php echo $spr; ?></p>
    <?php $this->load->helper('form'); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open("attendance/payroll_update", array('class' => 'form1')); ?>
        <div class="form1-element1">
            <p>Hourly Pay Update</p><input type="number" name="payroll" value="<?php echo $payroll ?>">
        </div>
        <?php $data = array(
            'type' => 'submit',
            'class' => 'button1',
            'content' => '<span>Update</span>'
        );
        echo form_button($data); ?>
    <?php echo form_close(); ?>
</div>
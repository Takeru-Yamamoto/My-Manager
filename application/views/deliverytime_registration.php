<p class="menu-title">Delivery Time Menu</p>
<?php echo anchor('deliverytime/index', 'Return Deliverytime Menu', array('class' => 'anchor2')) ?>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("deliverytime/create", array('class' => 'form1')); ?>
<div class="form1-element">
    <div class="form1-element1">
        <p>Delivery Time</p><input type="date" name="date" value="<?php echo set_value('date'); ?>">
    </div>
    <div class="form1-element1">
        <p>Content</p><textarea rows="5" cols="75" name="content"></textarea>
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Registration</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
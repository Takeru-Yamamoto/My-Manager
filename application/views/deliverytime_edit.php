<p class="menu-title">Delivery Time Menu</p>
<p class="ba">Before</p>
<div class="menu2">
    <table>
        <tr class="table_title">
            <td class="td_title">Delivery Time</td>
            <td class="td_title">Content</td>
        </tr>
        <tr class="table_cell">
            <td><?php echo $date; ?></td>
            <td><?php echo $content; ?></td>
        </tr>
    </table>
</div>
<p class="ba">After</p>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("deliverytime/edit", array('class' => 'form1')); ?>
<div class="form1-element">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form1-element1">
        <p>Delivery Time</p><input type="date" name="date" value="<?php echo $date; ?>">
    </div>
    <div class="form1-element1">
        <p>Content</p><textarea rows="5" cols="75" name="content"><?php echo $content; ?></textarea>
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Edit</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
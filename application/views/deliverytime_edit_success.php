<p class="menu-title">Delivery Time Menu</p>
<div class="text">
    <P>Congratulations!</P>
    <p>Your Delivery Time Data has been successfully edited in the database!</p>
    <p>By the way, this is the data edited in the database</p>
    <p>Delivery Time:<?php echo $date; ?></p>
    <p>Content:<?php echo $content; ?></p>
</div>
<?php $this->load->helper('url'); ?>
<?php echo anchor('deliverytime/index', 'Return Deliverytime Menu', array('class' => 'anchor2')) ?>
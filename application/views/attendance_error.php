<p class="menu-title">Main Menu</p>
<div class="text">
    <P>Hey, there's an error! Don't do strange things!</P>
    <p>Perhaps the cause of the error is one of the following.</p><br>
    <p>:Database connection error.</p>
    <p>:You have already gone to work, but you tried to go to work further.</p>
    <p>:You tried to leave the office even though the break wasn't over yet.</p>
    <p>:You haven't come to work yet, but you tried to leave.</p>
    <p>:You haven't started taking a break yet, but you tried to end it.</p>
    <p>:You tried to take breaks many times in the same day.</p>
    <p>:You started to take a break outside of working hours, or you ended the break outside of working hours.</p><br>
    <p>I'm sorry if it's different.</p>
    <p>Anyway, do your best today as well.</p>
</div>
<?php $this->load->helper('url'); ?>
<?php echo anchor('welcome/index', 'Return Main Menu', array('class' => 'anchor2')) ?>
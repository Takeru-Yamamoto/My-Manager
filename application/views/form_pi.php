<p>Form Personal Information</p>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("User/inputdb") ?>
<p>First Name</p><input type="text" name="firstname" value="<?php echo set_value('firstname'); ?>">
<p>Family Name</p><input type="text" name="familyname" value="<?php echo set_value('familyname'); ?>">
<p>Sex</p>
<p>Man<input type="checkbox" name="sex" value="Man"></p>
<p>Woman<input type="checkbox" name="sex" value="Woman"></p>
<p>Other<input type="checkbox" name="sex" value="other"></p>
<p>Address</p><input type="textarea" name="address" value="<?php echo set_value('address'); ?>">
<p>Telephone Number(without hyphen)</p><input type="tel" name="telephonenumber" minlength="10" maxlength="11" value="<?php echo set_value('telephonenumber'); ?>">
<p>E-Mail Address</p>
<input type="email" name="emailaddress" value="<?php echo set_value('emailaddress'); ?>">
<p><?php echo form_submit('submit', "Submit"); ?></p>
<?php echo form_close(); ?>
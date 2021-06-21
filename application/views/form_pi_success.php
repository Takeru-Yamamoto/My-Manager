<P>Congratulations!</P>
<p>Your personal information has been successfully registered in the database!</p>
<p>By the way, this is the data registered in the database</p>
<p>First name:<?php echo $firstname;?></p>
<p>Family name:<?php echo $familyname ;?></p>
<p>Sex:<?php echo $sex ;?></p>
<p>Address:<?php echo $address ;?></p>
<p>Telephone Number:<?php echo $telephonenumber ;?></p>
<p>E-Mail Address:<?php echo $emailaddress ;?></p>
<?php $this->load->helper('url');?>
<?php echo anchor('welcome/index','Returns to the input screen')?>
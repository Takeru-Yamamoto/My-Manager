<p class="menu-title">Delivery Time Menu</p>
<?php echo anchor('deliverytime/index', 'Return Delivery Time Menu', array('class' => 'anchor2')) ?>
<div class="menu2">
    <p class="heading">My All Delidery Time </p>
    <table>
        <tr class="table_title">
            <td class="td_title">Delivery Time</td>
            <td class="td_title">Content</td>
            <td class="td_title">Edit Row Data</td>
            <td class="td_title">Delete Row Data</td>
        </tr>
        <?php if($data == null){?>
            <tr class="table_cell">
            <td id= "0" hidden>0</td>
            <td class="function2_td_cd">There Are No deliverytime.</td>
            <td class="td_cd">Don't eat anything that doesn't work.</td>
            <td class="function"><a class="button3_stopping" onclick="alert3()">Edit</a></td>
            <td class="function"><a class="button3_stopping" onclick="alert4()">Delete</a></td>
            </tr>
        <?php }?>
        <?php foreach ($data as $row) { ?>
            <tr class="table_cell">
            <td id= "<?php echo $row['id'];?>" hidden><?php echo $row['id'];?></td>
            <td class="function2_td_cd"><?php echo $row['date'];?></td>
            <td class="td_cd"><?php echo $row['content'];?></td>
            <td class="function"><a href="http://localhost/My_Manager/deliverytime/edit_input/<?php echo $row['id'];?>/" class="button3-1">Edit</a></td>
            <td class="function"><a onclick="alert_delete_deliverytime(<?php echo $row['id'];?>,'<?php echo $row['date'];?>')" class="button3-2">Delete</a></td>
            </tr>
        <?php } ?>
    </table>
</div>
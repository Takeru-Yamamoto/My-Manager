<?php
list($mostrecent, $thisweek, $thismonth) = $data;
$mostrecent = $mostrecent[0];
$ymd = date("Y-m-d");
$swd = date("w", strtotime($ymd));
$tw_s = date('Y-m-d', strtotime("-{$swd} day", strtotime($ymd)));
$lwd = 6 - $swd;
$tw_e = date('Y-m-d', strtotime("+{$lwd} day", strtotime($ymd)));
?>
<p class="menu-title">Delivery Time Menu</p>
<div class="both_ends">
    <?php echo anchor('deliverytime/registration', 'New addition DeliveryTime', array('class' => 'anchor2')); ?>
    <?php echo anchor('deliverytime/edit_and_delete', 'Edit & Delete DeliveryTime', array('class' => 'anchor2')); ?>
</div>
<div class="menu2">
    <p class="heading">Most Recent Delivery Time</p>
    <p class="tdt">Delivery Time:<?php echo $mostrecent["min(date)"]; ?></p>
    <p class="tdt">Content:<?php echo $mostrecent["content"]; ?></p>
    <p class="heading">This Week's Delivery Time Content</p>
    <table>
    <?php foreach ($thisweek as $row) { ?>
            <tr class="table_cell">
                <td class="function2_td_cd_dt"><?php echo $row["date"]; ?></td>
                <td class="td_cd"><?php echo $row["content"]; ?></td>
            </tr>
        <?php } ?>
    </table>
    <p class="heading">This Month's Delivery Time Content</p>
    <table>
    <?php foreach ($thismonth as $row) { ?>
        <tr class="table_cell">
                <td class="function2_td_cd_dt"><?php echo $row["date"]; ?></td>
                <td class="td_cd"><?php echo $row["content"]; ?></td>
            </tr>
        <?php } ?>
    </table>
</div>
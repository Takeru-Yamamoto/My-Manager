<?php
$now = date('Y/m/d H:i:s');
$year = date("Y");
$month = date("m");
$day = date("d");
$ymd = date("Y/m/d");
$hour = date("h");
$minute = date("i");
$second = date("s");
$month_dates = date('t', mktime($hour, $minute, $second, $month, $day, $year));
list($todays, $thisweek, $thismonth) = $data;
function getWeekNum($date) {
    $time = strtotime($date);
    return 1 + date('W', $time + 86400) - date('W', strtotime(date('Y-m', $time)) + 86400);
  }
?>
<p class="menu-title">Task Menu</p>
<?php echo anchor('task/index', 'Return Task Menu', array('class' => 'anchor2')) ?>
<div class="menu2">
    <p class="heading"><?php echo $year . ':' . date("F", strtotime($ymd)); ?> </p>
    <p class="heading">Day's Task</p>
    <table>
        <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Task Content</td>
            <td class="td_title">Edit Row Data</td>
            <td class="td_title">Delete Row Data</td>
        </tr>
        <?php for ($i = 1; $i <= $month_dates; $i++) { ?>
            <?php if ($i < 10) { ?>
                <tr class="table_cell" id="tr_tm<?php echo $i; ?>">
                    <td class="function2" id="tm<?php echo $i; ?>"><?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?></td>
                    <td>No Content</td>
                    <td class="function"><a class="button3_stopping" onclick="alert1('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Edit</a></td>
                    <td class="function"><a class="button3_stopping" onclick="alert2('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Delete</a></td>
                </tr>
            <?php } else { ?>
                <tr class="table_cell" id="tr_tm<?php echo $i; ?>">
                    <td class="function2" id="tm<?php echo $i; ?>"><?php echo $year; ?>-<?php echo $month; ?>-<?php echo $i; ?></td>
                    <td>No Content</td>
                    <td class="function"><a class="button3_stopping" onclick="alert1('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Edit</a></td>
                    <td class="function"><a class="button3_stopping" onclick="alert2('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Delete</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <?php foreach ($todays as $row) { ?>
        <script>
            data_input_month2(
                <?php echo $month_dates; ?>,
                "<?php echo $row["id"]; ?>",
                "<?php echo $row["date"]; ?>",
                "<?php echo $row["task_c"]; ?>"
            );
        </script>
    <?php } ?>
    <p class="heading">Week's Task</p>
    <table>
    <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Task Content</td>
            <td class="td_title">Edit Row Data</td>
            <td class="td_title">Delete Row Data</td>
        </tr>
    <?php foreach ($thisweek as $row) {?>
        <tr class="table_cell">
        <td class="function2_td_cd" id="tm<?php echo $row['id'];?>">The <?php echo getweeknum($row['date']);?> Week</td>
        <td class="td_cd"><?php echo $row['task_c'];?></td>
        <td class="function"><a href="http://localhost/My_Manager/task/edit_input/<?php echo $row['id'];?>/" class="button3-1">Edit</a></td>
        <td class="function"><a onclick="alert_delete_task(<?php echo $row['id'];?>,'<?php echo $row['date'];?>')" class="button3-2">Delete</a></td>
        </tr>
    <?php }?>
    </table>
    <p class="heading">Month's Task</p>
    <table>
    <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Task Content</td>
            <td class="td_title">Edit Row Data</td>
            <td class="td_title">Delete Row Data</td>
        </tr>
    <?php foreach ($thismonth as $row) {?>
        <tr class="table_cell">
        <td class="function2_td_cd" id="tm<?php echo $row['id'];?>"><?php echo date("F", strtotime($ymd));?></td>
        <td class="td_cd"><?php echo $row['task_c'];?></td>
        <td class="function"><a href="http://localhost/My_Manager/task/edit_input/<?php echo $row['id'];?>/" class="button3-1">Edit</a></td>
        <td class="function"><a onclick="alert_delete_task(<?php echo $row['id'];?>,'<?php echo $row['date'];?>')" class="button3-2">Delete</a></td>
        </tr>
    <?php }?>
    </table>
</div>
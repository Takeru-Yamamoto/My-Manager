<?php
$ym = $data["page_sort"];
unset($data["page_sort"]);
preg_match("@([0-9]{4,})-([0-9]{1,2})@",$ym,$ym_sep);
$year = $ym_sep[1];
$month = $ym_sep[2];
$day = "01";
$hour = date("h");
$minute = date("i");
$second = date("s");
$month_dates = date('t', mktime($hour, $minute, $second, $month, $day, $year));
?>
<p class="menu-title">Attendance Menu</p>
<div class="both_ends">
    <?php echo anchor('attendance/registration', 'New addition Attendance', array('class' => 'anchor2')); ?>
    <?php echo anchor('attendance/payroll', 'Go To Payroll Menu', array('class' => 'anchor2')); ?>
</div>
<div class="menu2">
    <p class="heading"><?php echo $ym; ?> </p>
    <table>
        <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Work Start Time</td>
            <td class="td_title">Work End Time</td>
            <td class="td_title">Break Start Time</td>
            <td class="td_title">Break End Time</td>
            <td class="td_title">Working Time</td>
            <td class="td_title">Break Time</td>
            <td class="td_title">Edit Row Data</td>
            <td class="td_title">Delete Row Data</td>
        </tr>
        <?php for ($i = 1; $i <= $month_dates; $i++) { ?>
            <?php if ($i < 10) { ?>
                <tr class="table_cell" id="tr<?php echo $i; ?>">
                    <td id="<?php echo $i; ?>"><?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?></td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td class="function"><a class="button3_stopping" onclick="alert1('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Edit</a></td>
                    <td class="function"><a class="button3_stopping" onclick="alert2('<?php echo $year; ?>-<?php echo $month; ?>-0<?php echo $i; ?>')">Delete</a></td>
                </tr>
            <?php } else { ?>
                <tr class="table_cell" id="tr<?php echo $i; ?>">
                    <td id="<?php echo $i; ?>"><?php echo $year; ?>-<?php echo $month; ?>-<?php echo $i; ?></td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td>00:00:00</td>
                    <td class="function"><a class="button3_stopping" onclick="alert1('<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $i; ?>')">Edit</a></td>
                    <td class="function"><a class="button3_stopping" onclick="alert2('<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $i; ?>')">Delete</a></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
    <?php foreach ($data as $row) { ?>
        <script>
            data_input(
                "<?php echo $row["id"]; ?>",
                "<?php echo $row["date"]; ?>",
                "<?php echo $row["start_w"]; ?>",
                "<?php echo $row["end_w"]; ?>",
                "<?php echo $row["start_b"]; ?>",
                "<?php echo $row["end_b"]; ?>",
                <?php echo $month_dates; ?>
            );
        </script>
    <?php } ?>
    <?php foreach ($data as $row) { ?>
        <script>
            calculation(
                "<?php echo $row["id"]; ?>",
                "<?php echo $row["date"]; ?>",
                "<?php echo $row["start_w"]; ?>",
                "<?php echo $row["end_w"]; ?>",
                "<?php echo $row["start_b"]; ?>",
                "<?php echo $row["end_b"]; ?>",
            );
        </script>
    <?php } ?>
    <?php $this->load->helper('form'); ?>
    <?php echo validation_errors(); ?>
    <?php echo form_open("attendance/page_sort", array('class' => 'form1')); ?>
    <div class="form1-element">
        <div class="form1-element1">
            <p>Sort</p><input type="month" name="page_sort">
        </div>
        <?php $data = array(
            'type' => 'submit',
            'class' => 'button1',
            'content' => '<span>Sort</span>'
        );
        echo form_button($data); ?>
    </div>
    <?php echo form_close(); ?>
</div>
<?php
$date = date("Y-m-d");
$sql = "select * from attendance where date='" . $date . "';";
$res = $this->db->query($sql)->row_array();
if (!isset($res)) {
    $res = array(
        'date' => '0000-00-00',
        'start_w' => '00:00:00',
        'end_w' => '00:00:00',
        'start_b' => '00:00:00',
        'end_b' => '00:00:00',
    );
}
?>

<p class="menu-title">Main Menu</p>
<div class="menu1">
    <table>
        <tr class="table_title">
            <td>Date</td>
            <td>Work Start Time</td>
            <td>Work End Time</td>
            <td>Break Start Time</td>
            <td>Break End Time</td>
        </tr>
        <tr class="table_cell">
            <td><?php echo $res["date"]; ?></td>
            <td><?php echo $res["start_w"]; ?></td>
            <td><?php echo $res["end_w"]; ?></td>
            <td><?php echo $res["start_b"]; ?></td>
            <td><?php echo $res["end_b"]; ?></td>
        </tr>
    </table>

    <div class="button2">
    <?php echo anchor('Attendance/work_start', 'Work Start', array('class' => 'button2-1')) ?>
        <?php echo anchor('Attendance/work_end', 'Work End', array('class' => 'button2-2')) ?>
        <?php echo anchor('Attendance/break_start', 'Break Start', array('class' => 'button2-3')) ?>
        <?php echo anchor('Attendance/break_end', 'Break End', array('class' => 'button2-4')) ?>
    </div>
    <div class="menu-element1-1">
        <p class="expandation1">The Attendance Menu manages attendance and departure,<br> as well as the start and end of break.</p>
        <?php echo anchor('Attendance/index', 'Go to Attendance Menu', array('class' => 'anchor1')) ?>
    </div>

    <div class="menu-element1-2">
        <p class="expandation1">The Task Menu manages tasks for the day, week, and month.</p>
        <?php echo anchor('Task/index', 'Go to Task Menu', array('class' => 'anchor1')) ?>
    </div>

    <div class="menu-element1-3">
        <p class="expandation1">The Delivery Time Menu manages the content of the work <br>you are currently in charge of and the deadline.</p>
        <?php echo anchor('DeliveryTime/index', 'Go to Delivery Time Menu', array('class' => 'anchor1')) ?>
    </div>

</div>
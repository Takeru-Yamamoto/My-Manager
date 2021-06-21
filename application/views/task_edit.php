<p class="menu-title">Task Menu</p>
<p class="ba">Before</p>
<div class="menu2">
    <table>
        <tr class="table_title">
            <td class="td_title">Date</td>
            <td class="td_title">Task Genre</td>
            <td class="td_title">Task Content</td>
        </tr>
        <tr class="table_cell">
            <td><?php echo $date; ?></td>
            <td><?php echo $genre; ?></td>
            <td><?php echo $task_c; ?></td>
        </tr>
    </table>
</div>
<p class="ba">After</p>
<?php $this->load->helper('form'); ?>
<?php echo validation_errors(); ?>
<?php echo form_open("task/edit", array('class' => 'form1')); ?>
<div class="form1-element">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form1-element1">
        <p>Date</p><input type="date" name="date" value="<?php echo $date; ?>" readonly>
    </div>
    <?php if ($genre == "day") { ?>
        <div class="form1-element1">
            <p>Task Genre</p><select name="genre">
                <option value="day" selected>Day's</option>
                <option value="week">Week's</option>
                <option value="month">Month's</option>
            </select>
        </div>
    <?php } elseif ($genre == "week") { ?>
        <div class="form1-element1">
            <p>Task Genre</p><select name="genre">
                <option value="day">Day's</option>
                <option value="week" selected>Week's</option>
                <option value="month">Month's</option>
            </select>
        </div>
    <?php } elseif ($genre == "month") { ?>
        <div class="form1-element1">
            <p>Task Genre</p><select name="genre">
                <option value="day">Day's</option>
                <option value="week">Week's</option>
                <option value="month" selected>Month's</option>
            </select>
        </div>
    <?php } else { ?>
        <div class="form1-element1">
            <p>Task Genre</p><select name="genre">
                <option value="day">Day's</option>
                <option value="week">Week's</option>
                <option value="month">Month's</option>
            </select>
        </div>
    <?php } ?>
    <div class="form1-element1">
        <p>Task Content</p><textarea rows="5" cols="75" name="task_c"><?php echo $task_c; ?></textarea>
    </div>
    <?php $data = array(
        'type' => 'submit',
        'class' => 'button1',
        'content' => '<span>Edit</span>'
    );
    echo form_button($data); ?>
</div>
<?php echo form_close(); ?>
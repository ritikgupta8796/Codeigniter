<?php
// print_R($data);die;
$i = 1;
foreach ($data as $keys => $data_show) {
?>
    <tr>
        <td><?php  echo $i + (($page_no - 1) * $select_record); ?></td>
        <td onclick="Edituser(<?php echo $data_show['Sno']?>)" style='cursor: pointer;'><?php echo $data_show['Name'] ?></td>
        <td><?php echo $data_show['Email'] ?></td>
        <td><?php echo $data_show['Phone'] ?></td>
        <td style="padding: 7px 1px 0 0;">
        <button class="btn btn-sm " style="color: red;"  onclick="Delete(<?php echo $data_show['Sno']?>)"><i class="fas fa-trash-alt">Delete</i></button>&nbsp;
        <button class="btn btn-sm " style="color: #7386d5;" onclick="Edituser(<?php echo $data_show['Sno']?>)">  <i class="fas fa-edit"> </i>Edit</button></td>
<?php
    $i++;
}


?>
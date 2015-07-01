<?php
$students = $students->toArray();
for($i=0; $i<count($students); $i++) {
	$students[$i]['full_name'] = $students[$i]['first_name']." ".$students[$i]['last_name'];
}
echo json_encode($students);


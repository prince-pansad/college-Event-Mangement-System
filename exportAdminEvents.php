<?php
include_once 'classes/db1.php';


$filename = 'AllEventDetails.csv';

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$output = fopen('php://output', 'w');

fputcsv($output, array('Event_name', 'No. of Participents', 'Price', 'Student Co-ordinator', 'Staff Co-ordinator', 'Date', 'Time','Location'));

$result = mysqli_query($conn,"SELECT * FROM staff_coordinator s ,event_info ef ,student_coordinator st,events e where e.event_id= ef.event_id and e.event_id= s.event_id and e.event_id= st.event_id");

if (mysqli_num_rows($result) > 0) {
	while($row = mysqli_fetch_array($result)) {
		fputcsv($output, array($row['event_title'], $row['participents'], $row['event_price'], $row['st_name'], $row['name'], $row['Date'], $row['time'],$row['location']));
        }
}
fclose($output);
?>

<?php                
require '../koneksi.php'; 
$event_name = $_POST['event_name'];
$event_location = $_POST['event_location'];
$username = $_POST['username'];
$event_start_date = date("y-m-d", strtotime($_POST['event_start_date'])); 
$event_end_date = date("y-m-d", strtotime($_POST['event_end_date'])); 
			
$insert_query = "insert into `schedule`(`event_name`,`event_location`,`event_start_date`,`event_end_date`,`username`) values ('".$event_name."','".$event_location."','".$event_start_date."','".$event_end_date."','".$username."')";             
if(mysqli_query($koneksi, $insert_query))
{
	$data = array(
                'status' => true,
                'msg' => 'Event added successfully!'
            );
}
else
{
	$data = array(
                'status' => false,
                'msg' => 'Sorry, Event not added.'				
            );
}
echo json_encode($data);	
?>

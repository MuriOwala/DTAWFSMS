<?php
require('dbconn.php');

$animalid=$_GET['id1'];
$phoneno=$_GET['id2'];

$sql="select Category from LMS.user where PhoneNo='$phoneno'";
$result=$conn->query($sql);
$row=$result->fetch_assoc();

$category=$row['Category'];



if($category == 'GENARAL MEMBER' || $category == 'RESCUER' )
{$sql1="update LMS.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 60 day),Renewals_left=1 where AnimalId='$animalid' and PhoneNo='$phoneno'";
 
if($conn->query($sql1) === TRUE)
{$sql3="update LMS.animal set Availability=Availability-1 where AnimalId='$animalid'";
 $result=$conn->query($sql3);
 $sql5="insert into LMS.message (PhoneNo,Msg,Date,Time) values ('$phoneno','Your request for issue of AnimalId: $animalid  has been accepted',curdate(),curtime())";
 $result=$conn->query($sql5);
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:0.01; url=issue_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:1; url=issue_requests.php", true, 303);

}
}
else
{$sql2="update LMS.record set Date_of_Issue=curdate(),Due_Date=date_add(curdate(),interval 180 day),Renewals_left=1 where AnimalId='$animalid' and PhoneNo='$phoneno'";

if($conn->query($sql2) === TRUE)
{$sql4="update LMS.animal set Availability=Availability-1 where AnimalId='$animalid'";
 $result=$conn->query($sql4);
 $sql6="insert into LMS.message (PhoneNo,Msg,Date,Time) values ('$phoneno','Your request for issue of AnimalId: $animalid has been accepted',curdate(),curtime())";
 $result=$conn->query($sql6);
echo "<script type='text/javascript'>alert('Success')</script>";
header( "Refresh:1; url=issue_requests.php", true, 303);
}
else
{
	echo "<script type='text/javascript'>alert('Error')</script>";
    header( "Refresh:1; url=issue_requests.php", true, 303);

}
}



?>
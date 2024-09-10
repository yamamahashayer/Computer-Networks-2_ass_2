<?php
function getSnmp($ip,$cmName,$id,$column){
    $columnArr=array();
     for($i=1;$i<=$column;$i++) {
         $columnArr[$i - 1] = snmp2_walk($ip, $cmName, $id . "." . "$i");
     }
     return $columnArr;
}

function setSnmp($name, $location, $contact,$type) {
    if($type=="name")
        snmp2_set("127.0.0.1", "public", '.1.3.6.1.2.1.1.5.0', 's', $name);
    elseif ($type=="loc")
        snmp2_set("127.0.0.1", "public", ".1.3.6.1.2.1.1.6.0", 's', $location);
    elseif($type=="cont")
        snmp2_set("127.0.0.1", "public", ".1.3.6.1.2.1.1.4.0", 's', $contact);

}


$ip = "127.0.0.1";
$cmName = "public";
if (isset($_POST['type'])) {
    $type = $_POST['type'];
    $result=array();
   if($type=="arp")
           $result=getSnmp($ip,$cmName,".1.3.6.1.2.1.4.22.1",4);
       elseif ($type=="tcp")
           $result=getSnmp($ip,$cmName,".1.3.6.1.2.1.6.13.1",5);
       elseif($type=="udp")
           $result=getSnmp($ip,$cmName,".1.3.6.1.2.1.7.5.1",2);
       else if($type=="system")
           $result=getSnmp($ip,$cmName,".1.3.6.1.2.1.1",6);

       else{
       setSnmp($_POST['name'],$_POST['location'],$_POST['contact'],$type);
       return;
    }
    echo json_encode($result);
}
?>

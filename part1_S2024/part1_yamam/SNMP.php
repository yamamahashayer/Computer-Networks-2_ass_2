<?php
// SNMP agent details
$host = '127.0.0.1';
$community = 'public';
$version = SNMP::VERSION_2C; // SNMP version 2

// Define the OID ranges for the SNMP group statistics in MIB2
$oidSNMP =  '1.3.6.1.2.1.11';

// Function to get the names of objects from the provided link and store them in an array

function getObjectNames() {
    // You need to implement this function to fetch and parse the information from the provided link
    // For demonstration purposes, I'll provide a sample array with dummy data
    $objectNames = array(
        '1.3.6.1.2.1.11.1' => 'snmpInPkts',
        '1.3.6.1.2.1.11.2' => 'snmpOutPkts',
        '1.3.6.1.2.1.11.3' => 'snmpInBadVersions',
        '1.3.6.1.2.1.11.4' => 'snmpInBadCommunityNames',
        '1.3.6.1.2.1.11.5' => 'snmpInBadCommunityUses',
        '1.3.6.1.2.1.11.6' => 'snmpInASNParseErrs',
        // '1.3.6.1.2.1.11.7' => 'snmpInBadCommunityNames',
        '1.3.6.1.2.1.11.8' => 'snmpInTooBigs',
        '1.3.6.1.2.1.11.9' => 'snmpInNoSuchNames',
        '1.3.6.1.2.1.11.10' => 'snmpInBadValues',
        '1.3.6.1.2.1.11.11' => 'snmpInReadOnlys',
        '1.3.6.1.2.1.11.12' => 'snmpInGenErrs',
        '1.3.6.1.2.1.11.13' => 'snmpInTotalReqVars',
        '1.3.6.1.2.1.11.14' => 'snmpInTotalSetVars',
        '1.3.6.1.2.1.11.15' => 'snmpInGetRequests',
        '1.3.6.1.2.1.11.16' => 'snmpInGetNexts',
        '1.3.6.1.2.1.11.17' => 'snmpInSetRequests',
        '1.3.6.1.2.1.11.18' => 'snmpInGetResponses',
        '1.3.6.1.2.1.11.19' => 'snmpInTraps',
        '1.3.6.1.2.1.11.20' => 'snmpOutTooBigs',
        '1.3.6.1.2.1.11.21' => 'snmpOutNoSuchNames',
        '1.3.6.1.2.1.11.22' => 'snmpOutBadValues',
        // '1.3.6.1.2.1.11.23' => 'snmpInBadCommunityNames',
        '1.3.6.1.2.1.11.24' => 'snmpOutGenErrs',
        '1.3.6.1.2.1.11.25' => 'snmpOutGetRequests',
        '1.3.6.1.2.1.11.26' => 'snmpOutGetNexts',
        '1.3.6.1.2.1.11.27' => 'snmpOutSetRequests',
        '1.3.6.1.2.1.11.28' => 'snmpOutGetResponses',
        '1.3.6.1.2.1.11.29' => 'snmpOutTraps',
        '1.3.6.1.2.1.11.30' => 'snmpEnableAuthenTraps',

        // Add more mappings as needed
    );
    return $objectNames;
}

function getObjectNames2() {
    // You need to implement this function to fetch and parse the information from the provided link
    // For demonstration purposes, I'll provide a sample array with dummy data
    $objectNames = array(
        'iso.3.6.1.2.1.11.1.0' => 'snmpInPkts',
        'iso.3.6.1.2.1.11.2.0' => 'snmpOutPkts',
        'iso.3.6.1.2.1.11.3.0' => 'snmpInBadVersions',
        'iso.3.6.1.2.1.11.4.0' => 'snmpInBadCommunityNames',
        'iso.3.6.1.2.1.11.5.0' => 'snmpInBadCommunityUses',
        'iso.3.6.1.2.1.11.6.0' => 'snmpInASNParseErrs',
        '1.3.6.1.2.1.11.7' => 'snmpInBadCommunityNames',
        'iso.3.6.1.2.1.11.8.0' => 'snmpInTooBigs',
        'iso.3.6.1.2.1.11.9.0' => 'snmpInNoSuchNames',
        'iso.3.6.1.2.1.11.10.0' => 'snmpInBadValues',
        'iso.3.6.1.2.1.11.11.0' => 'snmpInReadOnlys',
        'iso.3.6.1.2.1.11.12.0' => 'snmpInGenErrs',
        'iso.3.6.1.2.1.11.13.0' => 'snmpInTotalReqVars',
        'iso.3.6.1.2.1.11.14.0' => 'snmpInTotalSetVars',
        'iso.3.6.1.2.1.11.15.0' => 'snmpInGetRequests',
        'iso.3.6.1.2.1.11.16.0' => 'snmpInGetNexts',
        'iso.3.6.1.2.1.11.17.0' => 'snmpInSetRequests',
        'iso.3.6.1.2.1.11.18.0' => 'snmpInGetResponses',
        'iso.3.6.1.2.1.11.19.0' => 'snmpInTraps',
        'iso.3.6.1.2.1.11.20.0' => 'snmpOutTooBigs',
        'iso.3.6.1.2.1.11.21.0' => 'snmpOutNoSuchNames',
        'iso.3.6.1.2.1.11.22.0' => 'snmpOutBadValues',
         '1.3.6.1.2.1.11.23' => 'snmpInBadCommunityNames',
        'iso.3.6.1.2.1.11.24.0' => 'snmpOutGenErrs',
        'iso.3.6.1.2.1.11.25.0' => 'snmpOutGetRequests',
        'iso.3.6.1.2.1.11.26.0' => 'snmpOutGetNexts',
        'iso.3.6.1.2.1.11.27.0' => 'snmpOutSetRequests',
        // 'iso.3.6.1.2.1.11.28.0' => 'snmpOutGetResponses',
        // 'iso.3.6.1.2.1.11.29.0' => 'snmpOutTraps',
        // 'iso.3.6.1.2.1.11.30.0' => 'snmpEnableAuthenTraps',

        // Add more mappings as needed
    );
    return $objectNames;
}
// Connect to SNMP agent
$snmp = new SNMP($version, $host, $community);

// Method 1: Using snmp2_get()
$statisticsByGet = array();

    for ($i = 1; $i <= 30; $i++) {
        if(!($i == 7 || $i == 23)){
        $oid = $oidSNMP . '.' . $i ;
        // echo $oid ;
        // echo "\n";
        $value =  snmp2_get($host, $community, $oid.".0");
        if ($value !== false) {
            // Here, you can parse the OID to get the name and description from getObjectNames() function
            $statisticsByGet[$oid] = $value;
        }}
    }



// Method 2: Using snmp2_walk()
$statisticsByWalk = array();
// foreach ($oidRanges as $oidRange) {
    
    $walkResult = $snmp->walk($oidSNMP);
    if ($walkResult !== false) {
        foreach ($walkResult as $oid => $value) {
            // Here, you can parse the OID to get the name and description from getObjectNames() function
            $statisticsByWalk[$oid] = $value;
        }
    }


// Close SNMP connection
$snmp->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SNMP Group Statistics</title>
    <style>
    * {
  box-sizing: border-box;
}

.row {
  margin-left:-5px;
  margin-right:-5px;
}
  
.column {
  float: left;
  width: 50%;
  padding: 5px;
}

/* Clearfix (clear floats) */
.row::after {
  content: "";
  clear: both;
  display: table;
}

table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}
th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        a {
            display: block;
            padding: 15px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }
        a:hover {
            background-color: #0056b3;
        }

    </style>
</head>
<body>

<h2>SNMP Group Statistics</h2>
<a href="index.html">Back to Home</a>

<!-- Display Method 1: Table By Get -->
<div class="row">
  <div class="column">
<table>
    <caption>Table By Get</caption>
    <tr>
        <th>OID</th>
        <th>Name</th>
        <!-- <th>Description</th> -->
        <th>Value</th>
    </tr>
    <?php foreach ($statisticsByGet as $oid => $value): ?>
        <?php
        // Parse the OID to get the name and description from getObjectNames() function
        $name = isset(getObjectNames()[$oid]) ? getObjectNames()[$oid] : 'Unknown';
        $explodedValueoid = explode('.', $oid);
        $cleanValueoid = end($explodedValueoid);
       ?>
        <tr>
            <td><?php echo $cleanValueoid; ?></td>
            <td><?php echo $name; ?></td>
            <td><?php echo $value; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
<!-- Display Method 2: Table By Walk -->

  <div class="column">
<table>
    <caption>Table By Walk</caption>
    <tr>
        <th>OID</th>
        <th>Name</th>
        <th>Value</th>
    </tr>
    <?php foreach ($statisticsByWalk as $oid => $value): ?>
        <?php
        // Parse the OID to get the name and description from getObjectNames() function
        $name = isset(getObjectNames2()[$oid]) ? getObjectNames2()[$oid] : 'Unknown';
        // $description = 'Description placeholder'; // You need to implement this
       
        $explodedValue = explode(': ', $value);
        $cleanValue = end($explodedValue);

        
        $explodedValueoid = explode('.', $oid);
        // $cleanValueoid = end($explodedValueoid);
        // $parts = explode('.', $oid);

// Get the digit before the last digit
$cleanValueoid = $explodedValueoid[count($explodedValueoid) - 2];


       ?>
        <tr>
            <td><?php echo $cleanValueoid; ?></td>
            <td><?php echo $name; ?></td>
         
            <td><?php echo $cleanValue; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</div>
</div>
</body>
</html>

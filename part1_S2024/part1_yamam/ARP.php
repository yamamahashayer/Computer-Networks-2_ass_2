<?php
// SNMP agent details
$host = '127.0.0.1';
$community = 'public';
$version = SNMP::VERSION_2C; // SNMP version 2

// OID for ARP table
$arpTableOID = '1.3.6.1.2.1.4.22.1.2';

// Connect to SNMP agent
$snmp = new SNMP($version, $host, $community);

// Retrieve ARP table data
$arpTableData = $snmp->walk($arpTableOID);

// Close SNMP connection
$snmp->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARP Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        a {
            display: block;
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 20px;
            width: fit-content;
            margin: 20px auto;
        }
        a:hover {
            background-color: #0056b3;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2 style="text-align: center;">ARP Table</h2>
    <a href="index.html">Back to Home</a>
    
    <table>
        <tr>
            <th>IP Address</th>
            <th>Port Number</th>
            <th>Physical Address</th>
        </tr>
        <?php foreach ($arpTableData as $oid => $physicalAddress): ?>
            <tr>
                <?php
                // Extract IP address and port number from the OID
                $oidParts = explode('.', $oid);
                $ipParts = array_slice($oidParts, -6, 4); // Last 4 parts are the IP address
                $portNumber = $oidParts[count($oidParts) - 2]; // Second last part is the port number
                $ipAddress = implode('.', $ipParts); // Join IP parts into a single string
                ?>
                <td><?php echo $ipAddress; ?></td>
                <td><?php echo $portNumber; ?></td>
                <td><?php echo $physicalAddress; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
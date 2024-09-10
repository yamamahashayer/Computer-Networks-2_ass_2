<?php
// SNMP agent details
$host = '127.0.0.1';
$community = 'public';

// OIDs for UDP table
$udpLocalAddressOID = '1.3.6.1.2.1.7.5.1.1';
$udpLocalPortOID = '1.3.6.1.2.1.7.5.1.2';

// Connect to SNMP agent
$snmp = new SNMP(SNMP::VERSION_2C, $host, $community);

// Retrieve UDP table data
$udpLocalAddresses = $snmp->walk($udpLocalAddressOID);
$udpLocalPorts = $snmp->walk($udpLocalPortOID);

// Close SNMP connection
$snmp->close();

// Function to match OID keys
function getPortForAddress($index, $udpLocalPorts) {
    // The index format for addresses should match the port's format
    $indexParts = explode('.', $index);
    // Last element should be the port number
    $portPart = end($indexParts);

    // Loop through ports to find the match
    foreach ($udpLocalPorts as $portIndex => $port) {
        if (strpos($portIndex, $portPart) !== false) {
            return $port;
        }
    }
    return 'N/A';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDP Table</title>
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
            width: 60%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>UDP Table</h2>
        <a href="index.html">Back to Home</a>

        <table>
            <tr>
                <th>OID</th>
                <th>UDP Local Address</th>
                <th>UDP Local Port</th>
            </tr>
            <?php foreach ($udpLocalAddresses as $index => $address): ?>
                <tr>
                    <td><?php echo $index; ?></td>
                    <td><?php echo $address; ?></td>
                    <td><?php echo getPortForAddress($index, $udpLocalPorts); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>

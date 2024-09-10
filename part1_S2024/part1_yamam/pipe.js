function getSnmpData(type) {
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "server.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            const data = JSON.parse(xhr.responseText);
            if(type=="system")
                updateSystem(data);
            else  updateTable(data);
        }
    };
    xhr.send("type=" + type);
}

function updateTable(data) {
    const tableBody = document.getElementById("table-body");
    tableBody.innerHTML = "";

    data.forEach(function (rowData) {
        const newRow = document.createElement("td");
        rowData.forEach(function (cellData) {
            const newCell = document.createElement("tr");
            newCell.textContent = cellData;
            newRow.appendChild(newCell);
        });
        tableBody.appendChild(newRow);
    });
}
function updateSystem(data) {
    const input = [
        document.getElementById("des"),
        document.getElementById("obj"),
        document.getElementById("time"),
        document.getElementById("contact"),
        document.getElementById("name"),
        document.getElementById("location"),
    ];

    for (let i = 0; i < input.length; i++) {
        const mod = String(data[i]).replace(String(data[i]).split(':')[0] +": ", '');
        input[i].value = mod;
    }
}
function setSnmpData(type){
    const newName = document.getElementById("name").value;
    const newLocation = document.getElementById("location").value;
    const newContact = document.getElementById("contact").value;
    const xhr = new XMLHttpRequest();
    xhr.open("POST", "server.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    const params = "type="+type +
        "&name=" + encodeURIComponent(newName) +
        "&location=" + encodeURIComponent(newLocation) +
        "&contact=" + encodeURIComponent(newContact);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
           console.log(xhr.responseText);
        }
    };
    xhr.send(params);
}
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test Javascript</title>
</head>
<body>
     <div>
        <table id="myTable" border="1">
            <tr>
            <td>Ligne1 cellule1</td>
            <td>Ligne1 cellule2</td>
            </tr>
            <tr>
            <td>Ligne2 cellule1</td>
            <td>Ligne2 cellule2</td>
            </tr>
        </table>
     </div>

     <button id="insertNewRow" onclick="insertRow()"> Ajouterune nouvelle ligne</button>

     <script>
        function insertRow() {
            var foo=
            document.getElementById('myTable').insertRow(0);
            var cell1 = foo.insertCell(0);
            var cell2 = foo.insertCell(1);
            cell1.innerHTML = "NvllLigneCellule1";
            cell2.innerHTML = "NvllLigneCellule2";
            }

     </script>
</body>
</html>

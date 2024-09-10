<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ministère de la justice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
        }
        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        button {
            margin:25px;
            padding: 10px 20px;
            font-size: 16px;
            color: #fff;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .header .user-info {
            font-size: 16px;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #1dd200;
            color: #fff;
            font-weight: bold;
        }
        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        table tr:hover {
            background-color: #ddd;
        }
        table td, table th {
            text-align: center;
        }
        .signature{
            position: relative;
            margin-top: 5%;
            left: 65%;
        }
        .info{
            position: relative;
            left: 70%;
        }
        .visa{
            position: relative;
            margin-top: 4%;
        }
    </style>
</head>
<body>
<button onclick="addPdf('export')" class="export">imprimer en PDF</button>
<div class="container" id="export">
    <div class="header">
        <div class="user-info">
            <h1>
                {{ \Illuminate\Support\Facades\Auth::user()->usertype == 1 ? 'D.R.A.P '.\Illuminate\Support\Facades\DB::table('region')->where('id',\Illuminate\Support\Facades\Auth::user()->region)->value('nom') : 'Agent du Ministere' }}
            </h1>
            @if(\Illuminate\Support\Facades\Auth::user()->usertype == 2)
                <h3>Liste des matériels des provinces : {{ implode(', ', $provinces->toArray()) }}</h3>
            @endif
            <h3>Date d'impression: {{ \Carbon\Carbon::now()->Format('d-m-Y') }}</h3>
        </div>
    </div>
    <table>
        <thead>
        <tr>
            <th>Materiel</th>
            <th>Donneur</th>
            <th>Camp</th>
            <th>quantite</th>
            <th>Date d'obtention</th>
        </tr>
        </thead>
        <tbody>
        @foreach( $materiels as $materiel )
            <tr>
                <td>{{ $materiel->materiel }}</td>
                <td>{{ $materiel->colab }}</td>
                <td>{{ $materiel->camp }}</td>
                <td>{{ number_format($materiel->quantite,2,',','.') }}</td>
                <td>{{ $materiel->datedon }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="visa">
        <h3>(visa du DRAP)</h3>
    </div>
    <div class="info">
        <h3>Fait à ………………………, le ………………………</h3>
    </div>
    <div class="signature">
        <h3>Le chef du service régional de la production<h3>
    </div>
</div>
<script src="{{ asset('assets/js/html2pdf.bundle.min.js') }}"></script>
<script>
    function addPdf(id) {
        var element = document.getElementById(id);
        element.style.padding = '20px';
        element.style.fontSize = "small";

        var now = new Date();
        var dateStr = now.getFullYear() + "-" +
            ("0" + (now.getMonth() + 1)).slice(-2) + "-" +
            ("0" + now.getDate()).slice(-2) + "_" +
            ("0" + now.getHours()).slice(-2) + "-" +
            ("0" + now.getMinutes()).slice(-2) + "-" +
            ("0" + now.getSeconds()).slice(-2);

        var fileName = "Details_materiel_" + dateStr + ".pdf";

        html2pdf().from(element).set({
            filename: fileName,
            jsPDF: {unit: 'pt', format: 'a4', orientation: 'landscape'}
        }).save();
    }
</script>

</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Complaint PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<h1>Complaint Details</h1>
<table>
    <tbody>
    <tr>
        <th>Attribute</th>
        <th>Value</th>
    </tr>


    @foreach($attributes as $attribute => $value)
        @if ($attribute !== 'created_at' && $attribute !== 'updated_at' && $attribute !=='id')
            <tr>
                <td>{{ $attribute }}</td>
                <td>{{ $value }}</td>
            </tr>
        @endif
    @endforeach
    </tbody>
</table>
</body>
</html>

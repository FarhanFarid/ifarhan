<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Suspected ADR Report</title>
</head>
<body>
    <h2>Suspected ADR Report</h2>
    <table border="1" cellpadding="5" cellspacing="0">
        <thead>
            <tr>
                <th>PRN</th>
                <th>Episode No</th>
                <th>Onset At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($report as $item)
                <tr>
                    <td>{{ $item['prn'] ?? 'N/A' }}</td>
                    <td>{{ $item['episodeno'] ?? 'N/A' }}</td>
                    <td>{{ $item['onset_at'] ?? 'N/A' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

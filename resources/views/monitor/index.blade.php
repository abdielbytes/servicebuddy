<!DOCTYPE html>
<html>
<head>
    <title>ServiceBuddy Monitor</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 30px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ccc;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
    </style>
</head>
<body>
<h1>🖥 ServiceBuddy Monitoring</h1>

<h2>HTTP Request Logs</h2>
<table>
    <thead>
    <tr>
        <th>Time</th>
        <th>Method</th>
        <th>URL</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($requestLogs as $log)
        <tr>
            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            <td>{{ $log->method }}</td>
            <td>{{ $log->url }}</td>
            <td>{{ $log->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $requestLogs->links() }}

<h2>Database Query Logs</h2>
<table>
    <thead>
    <tr>
        <th>Time</th>
        <th>SQL Query</th>
        <th>Bindings</th>
        <th>Execution Time</th>
    </tr>
    </thead>
    <tbody>
    @foreach($queryLogs as $log)
        <tr>
            <td>{{ $log->created_at->format('Y-m-d H:i:s') }}</td>
            <td>{{ $log->sql }}</td>
            <td>{{ $log->bindings }}</td>
            <td>{{ $log->time }} ms</td>
        </tr>
    @endforeach
    </tbody>
</table>

{{ $queryLogs->links() }}
</body>
</html>

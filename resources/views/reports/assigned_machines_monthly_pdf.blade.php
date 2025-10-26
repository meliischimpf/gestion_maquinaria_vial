<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Máquinas Asignadas - {{ $monthName }} {{ $year }}</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        @page {
            margin: 50px 25px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #333;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #1a56db;
        }
        .header img {
            height: 50px;
            margin-bottom: 10px;
        }
        .title {
            font-size: 16pt;
            font-weight: bold;
            color: #1a56db;
            margin: 5px 0;
        }
        .subtitle {
            font-size: 12pt;
            color: #4b5563;
            margin-bottom: 10px;
        }
        .report-info {
            margin: 15px 0;
            padding: 10px;
            background-color: #f8fafc;
            border-radius: 4px;
            font-size: 9pt;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 15px 0;
            font-size: 8pt;
        }
        th {
            background-color: #1a56db;
            color: white;
            padding: 8px;
            text-align: left;
            font-weight: 600;
        }
        td {
            padding: 7px;
            border: 1px solid #e5e7eb;
        }
        tr:nth-child(even) {
            background-color: #f9fafb;
        }
        .footer {
            position: fixed;
            bottom: -30px;
            left: 0;
            right: 0;
            height: 50px;
            text-align: center;
            font-size: 8pt;
            color: #6b7280;
            border-top: 1px solid #e5e7eb;
            padding-top: 10px;
        }
        .page-number:after {
            content: counter(page);
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8pt;
            font-weight: 500;
        }
        .badge-success {
            background-color: #d1fae5;
            color: #065f46;
        }
        .badge-warning {
            background-color: #fef3c7;
            color: #92400e;
        }
        .badge-danger {
            background-color: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="title">REPORTE DE MÁQUINAS ASIGNADAS</div>
        <div class="subtitle">{{ $monthName }} {{ $year }}</div>
        <div class="report-info">
            Generado el: {{ now()->format('d/m/Y H:i') }} | 
            Total de registros: {{ $assignments->count() }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Máquina (SN)</th>
                <th>Obra Asignada</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin Real</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($assignments as $assignment)
                <tr>
                    <td>{{ $assignment->machine->brand ?? 'N/A' }} {{ $assignment->machine->model ?? 'N/A' }} (SN: {{ $assignment->machine->serial_number ?? 'N/A' }})</td>
                    <td>{{ $assignment->work->name ?? 'N/A' }}</td>
                    <td>{{ $assignment->start_date ? \Carbon\Carbon::parse($assignment->start_date)->format('d/m/Y') : 'N/A' }}</td>
                    <td>{{ $assignment->end_date ? \Carbon\Carbon::parse($assignment->end_date)->format('d/m/Y') : 'Activa' }}</td>
                    <td>
                        @if($assignment->end_date)
                            Finalizada
                        @else
                            Activa
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No hay asignaciones que coincidan con el mes y año seleccionados.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <div>Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</div>
    </div>
</body>
</html>
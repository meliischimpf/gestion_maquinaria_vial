<!DOCTYPE html>

<html>

<head>

    <title>Reporte de Máquinas Asignadas - {{ $monthName }} {{ $year }}</title>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <style>


        body {

            font-family: sans-serif;

            font-size: 10px;

            margin: 20px;

        }

        h1 {

            text-align: center;

            font-size: 18px;

            margin-bottom: 20px;

        }

        h2 {

            text-align: center;

            font-size: 14px;

            margin-bottom: 15px;

        }

        table {

            width: 100%;

            border-collapse: collapse;

            margin-bottom: 20px;

        }

        th, td {

            border: 1px solid #ccc;

            padding: 8px;

            text-align: left;

        }

        th {

            background-color: #f2f2f2;

        }

        .footer {

            text-align: center;

            font-size: 8px;

            position: fixed; 

            bottom: 20px;

            left: 0;

            right: 0;

        }

    </style>

</head>

<body>

    <h1>Reporte de Máquinas Asignadas</h1>

    <h2>Mes: {{ $monthName }} - Año: {{ $year }}</h2>



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

        Generado el: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}

    </div>

</body>

</html>
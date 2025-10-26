<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #1a56db;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            padding: 20px;
            border: 1px solid #e5e7eb;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }
        .alert {
            background-color: #fef3c7;
            border-left: 4px solid #d97706;
            padding: 12px;
            margin: 15px 0;
            border-radius: 4px;
        }
        .details {
            background-color: #f9fafb;
            border-radius: 4px;
            padding: 15px;
            margin: 15px 0;
        }
        .detail-item {
            margin-bottom: 8px;
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 8px;
        }
        .detail-label {
            font-weight: 600;
            color: #4b5563;
        }
        .detail-value {
            font-weight: 500;
            color: #111827;
        }
        .footer {
            margin-top: 25px;
            padding-top: 15px;
            border-top: 1px solid #e5e7eb;
            text-align: center;
            color: #6b7280;
            font-size: 14px;
        }
        .button {
            display: inline-block;
            background-color: #1a56db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 4px;
            margin: 15px 0;
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🚧 Mantenimiento Requerido</h1>
    </div>
    
    <div class="content">
        <div class="alert">
            <strong>¡Atención!</strong> La máquina <strong>{{ $machineName }}</strong> ha alcanzado el límite de kilómetros programado y requiere mantenimiento preventivo.
        </div>

        <h2>📋 Detalles de la Máquina</h2>
        <div class="details">
            <div class="detail-item">
                <span class="detail-label">ID de Máquina:</span>
                <span class="detail-value">#{{ $machineId }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Kilómetros en última asignación:</span>
                <span class="detail-value">{{ number_format($kmTraveledAssignment, 0, ',', '.') }} km</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Kilómetros actuales (reinicio):</span>
                <span class="detail-value">{{ number_format($currentKm, 0, ',', '.') }} km</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Kilómetros totales acumulados:</span>
                <span class="detail-value">{{ number_format($kmAtLastMaintenance, 0, ',', '.') }} km</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">ID de Asignación:</span>
                <span class="detail-value">#{{ $assignmentId }}</span>
            </div>
        </div>

        <p>Se ha registrado automáticamente una nueva orden de mantenimiento para esta máquina y su contador de kilómetros ha sido reiniciado.</p>
        
        <p>Por favor, proceda a programar el mantenimiento correspondiente lo antes posible para garantizar el correcto funcionamiento del equipo.</p>
        
        <div style="text-align: center; margin: 25px 0;">
            <a href="{{ route('machines.show', $machineId) }}" class="button">Ver Detalles de la Máquina</a>
        </div>

        <div class="footer">
            <p>Este es un mensaje automático, por favor no responda a este correo.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
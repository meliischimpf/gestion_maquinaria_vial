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
            background-color: #dc2626;
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
            background-color: #fef2f2;
            border-left: 4px solid #dc2626;
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
            background-color: #dc2626;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
            font-weight: 500;
            font-size: 16px;
            transition: background-color 0.3s;
        }
        .button:hover {
            background-color: #b91c1c;
        }
        .recommendation {
            background-color: #f0fdf4;
            border-left: 4px solid #10b981;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>🏭 Evaluación de Venta Recomendada</h1>
    </div>
    
    <div class="content">
        <div class="alert">
            <strong>¡Atención!</strong> La máquina <strong>{{ $machineName }}</strong> ha superado el umbral de kilometraje establecido para su vida útil operativa.
        </div>

        <h2>📊 Datos de la Máquina</h2>
        <div class="details">
            <div class="detail-item">
                <span class="detail-label">Identificación:</span>
                <span class="detail-value">{{ $machineName }} (ID: {{ $machineId }})</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Kilometraje Total:</span>
                <span class="detail-value">{{ number_format($lifetimeKm, 0, ',', '.') }} km</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Estado:</span>
                <span class="detail-value" style="color: #dc2626; font-weight: 600;">Sobrepasó el límite de vida útil</span>
            </div>
        </div>

        <div class="recommendation">
            <h3>📋 Recomendación</h3>
            <p>Esta máquina ha alcanzado un kilometraje que sugiere considerar su venta o desincorporación. Se recomienda realizar una evaluación técnica y económica para determinar la mejor acción a seguir.</p>
            
            <p>Beneficios potenciales de la venta:</p>
            <ul>
                <li>Optimización de la flota</li>
                <li>Reducción de costos de mantenimiento</li>
                <li>Oportunidad de renovación tecnológica</li>
            </ul>
        </div>
        
        <div style="text-align: center; margin: 25px 0;">
            <a href="{{ route('machine.show', $machineId) }}" class="button">
                📋 Ver Ficha Técnica Completa
            </a>
        </div>

        <div class="footer">
            <p>Este es un mensaje generado automáticamente. Por favor, no responda a este correo.</p>
            <p>© {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>
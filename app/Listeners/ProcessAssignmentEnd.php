<?php

namespace App\Listeners;

use App\Events\AssignmentEnded;
use App\Models\Machine;
use App\Models\Maintenance;
use App\Models\Parameter;
use App\Models\User; 
use App\Models\MaintenanceType;
use App\Mail\MaintenanceNotification;
use App\Mail\MachineForSaleNotification; 
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;



class ProcessAssignmentEnd
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    
    public function handle(AssignmentEnded $event): void
    {
        $assignment = $event->assignment;

        if (!$assignment->machine) {
            Log::warning("Asignación ID {$assignment->id} finalizada sin máquina asociada. No se procesarán los kilómetros.");
            return;
        }

        $machine = $assignment->machine;

        DB::transaction(function () use ($assignment, $machine) {
            try {
                $machine->current_km += $assignment->km_traveled;
                $machine->lifetime_km += $assignment->km_traveled; 

                $maintenanceParameter = Parameter::where('name', 'km_per_maintenance')->first();
                $kmMaintenanceThreshold = $maintenanceParameter ? (int)$maintenanceParameter->value : 0;

                if ($kmMaintenanceThreshold <= 0) {
                    Log::error('El parámetro "km_per_maintenance" no está configurado, es cero o negativo. El chequeo de mantenimiento no funcionará para la máquina ID: ' . $machine->id);
                } else {
                    if ($machine->current_km >= $kmMaintenanceThreshold) {
                        $maintenanceType = MaintenanceType::first();
                        if ($maintenanceType) {
                            Maintenance::create([
                                'realization_date' => now(),
                                'machine_id' => $machine->id,
                                'km_at_maintenance' => $machine->current_km, 
                                'maintenanceType_id' => $maintenanceType->id,
                            ]);
                        } else {
                            Log::warning('No se encontró un MaintenanceType para registrar el mantenimiento de la máquina ID: ' . $machine->id);
                        }


                        $machine->current_km = 0; 

                        $adminUser = User::first(); 

                        if ($adminUser && !empty(config('mail.from.address'))) {
                             try {
                                Mail::to($adminUser->email)
                                ->send(new MaintenanceNotification($machine, $assignment));
                                Log::info('Correo de mantenimiento enviado para máquina ID: ' . $machine->id);
                             } catch (\Exception $mailEx) {
                                Log::error("Error al enviar el correo de mantenimiento para máquina ID {$machine->id}: " . $mailEx->getMessage());
                             }
                        } else {
                            Log::warning('No se pudo enviar correo de mantenimiento para máquina ID: ' . $machine->id . '. No se encontró usuario admin o el mail no está configurado.');
                        }
                    }
                }

                $saleThresholdParameter = Parameter::where('name', 'km_for_sale')->first(); 
                $kmForSaleThreshold = $saleThresholdParameter ? (int)$saleThresholdParameter->value : 0;

                if ($kmForSaleThreshold > 0 && $machine->lifetime_km >= $kmForSaleThreshold) {

                    $adminUser = User::first(); 
                    if ($adminUser && !empty(config('mail.from.address'))) {
                        try {
                            Mail::to($adminUser->email)->send(new MachineForSaleNotification($machine));
                            Log::info('Correo de notificación de venta enviado para máquina ID: ' . $machine->id . '. Total de KM de vida útil: ' . $machine->lifetime_km);
                        } catch (\Exception $mailEx) {
                            Log::error("Error al enviar el correo de venta para máquina ID {$machine->id}: " . $mailEx->getMessage());
                        }
                    } else {
                        Log::warning('No se pudo enviar correo de venta para máquina ID: ' . $machine->id . '. No se encontró usuario admin o el mail no está configurado para notificación de venta.');
                    }
                }

                $machine->save();

            } catch (\Exception $e) {
                Log::error("Error crítico en el Listener ProcessAssignmentEnd para máquina ID {$machine->id}: " . $e->getMessage());
                throw $e;
            }
        });
    }
}
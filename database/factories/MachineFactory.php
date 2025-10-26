<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Factory as Faker;
use App\Models\Machine;
use App\Models\MachineType;
use App\Models\Status;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Machine>
 */
class MachineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    /**
     * Mapeo de tipos de máquina a sus respectivas imágenes
     * 
     * @var array
     */
    protected $machineTypeImages = [
        // Excavadora
        1 => 'https://images.pexels.com/photos/95687/pexels-photo-95687.jpeg',
        
        // Retroexcavadora - Imagen específica de Pexels
        2 => 'https://images.pexels.com/photos/461789/pexels-photo-461789.jpeg',
        
        // 'Motoniveladora', 
        3 => 'https://images.pexels.com/photos/18812422/pexels-photo-18812422.jpeg',
        
        // Pala Cargadora
        4 => 'https://images.pexels.com/photos/15109998/pexels-photo-15109998.jpeg',
        
        // 'Compactadora', 
        5 => 'https://images.pexels.com/photos/32576307/pexels-photo-32576307.jpeg',
        
        // 'Aplanadora', 
        6 => 'https://images.pexels.com/photos/32967188/pexels-photo-32967188.jpeg',

        // 'Dumper', 
        7 => 'https://images.pexels.com/photos/27627483/pexels-photo-27627483.jpeg',
        
        // 'Grúa Móvil', 
        8 => 'https://images.pexels.com/photos/33488898/pexels-photo-33488898.jpeg',
       
        // Bulldozer
        9 => 'https://images.pexels.com/photos/1009926/pexels-photo-1009926.jpeg',
        
        // 'Perforadora',
        10 => 'http://ksdrillmachine.com.ar/products/2-1-3-rotary-blasthole-drilling-rig_03.jpg',
        
    ];
    
    // Imagen por defecto si no hay imágenes para el tipo de máquina
    protected $defaultImage = 'https://images.unsplash.com/photo-1605000797499-95a51c5269ae?w=800&auto=format&fit=crop&q=80';

    /**
     * Obtiene una imagen aleatoria basada en el tipo de máquina
     * 
     * @param int $typeId
     * @return string
     */
    protected function getRandomMachineImage($typeId)
    {
        $typeId = $typeId ?? 1; // Default to first type if not provided
        return $this->machineTypeImages[$typeId] ?? $this->defaultImage;
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = Faker::create('es_AR');
        
        // Obtener un tipo de máquina aleatorio
        $typeId = $faker->numberBetween(1, MachineType::count());
        
        // Obtener una marca aleatoria
        $brand = $faker->randomElement([
            'Caterpillar', 'Komatsu', 'Volvo', 'Hitachi', 'Liebherr',
            'JCB', 'Doosan', 'Case', 'New Holland', 'John Deere',
            'Hyundai', 'Kobelco', 'Sany', 'XCMG', 'Terex'
        ]);

        // Definir modelos basados en la marca
        $models = [
            'Caterpillar' => ['D6', 'D8', '320', '336', '349', '950', '980'],
            'Komatsu' => ['PC200', 'PC300', 'PC400', 'D65', 'D85'],
            'Volvo' => ['EC220', 'EC300', 'EC480', 'L120', 'L150'],
            'Hitachi' => ['ZX200', 'ZX350', 'ZX470', 'ZX870'],
            'Liebherr' => ['R 920', 'R 956', 'R 9800', 'PR 776'],
            'JCB' => ['3CX', '4CX', 'JS130', 'JS200', 'JS330'],
            'Doosan' => ['DX140', 'DX225', 'DX300', 'DX530'],
            'Case' => ['580', '850', '1150', '1650'],
            'New Holland' => ['C245', 'C305', 'E140', 'E215'],
            'John Deere' => ['310', '350', '470', '670'],
            'Hyundai' => ['R210', 'R320', 'R520', 'R800'],
            'Kobelco' => ['SK140', 'SK210', 'SK350', 'SK500'],
            'Sany' => ['SY16', 'SY35', 'SY75', 'SY215'],
            'XCMG' => ['XE60', 'XE150', 'XE215', 'XE370'],
            'Terex' => ['TC62', 'TC125', 'TC280', 'TC360']
        ];

        $model = $faker->randomElement($models[$brand] ?? ['Standard']);
        $image = $this->getRandomMachineImage($typeId);

        return [
            'serial_number' => strtoupper($faker->bothify('???-####')),
            'type_id' => $typeId,
            'brand' => $brand,
            'model' => $model,
            'image' => $image,
            'status_id' => $faker->numberBetween(1, Status::count()),
            'current_km' => 0,
            'lifetime_km' => $faker->numberBetween(1000, 100000),
        ];
    }
}

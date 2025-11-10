// database/seeders/ItemSeeder.php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            ['code' => 'BRG001', 'name' => 'Kardus A4', 'stock' => 100, 'location' => 'Rak 1A'],
            ['code' => 'BRG002', 'name' => 'Tinta Printer', 'stock' => 25, 'location' => 'Rak 2B'],
            ['code' => 'BRG003', 'name' => 'Lakban Bening', 'stock' => 60, 'location' => 'Rak 1C'],
            ['code' => 'BRG004', 'name' => 'Amplop Coklat', 'stock' => 120, 'location' => 'Rak 3D'],
            ['code' => 'BRG005', 'name' => 'Pulpen Hitam', 'stock' => 200, 'location' => 'Rak 1B'],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}

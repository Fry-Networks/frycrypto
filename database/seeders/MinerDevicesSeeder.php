<?php

namespace Database\Seeders;

use App\Models\MinerDevices;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MinerDevicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MinerDevices::create(['email' => 'thefarringtonchannel@gmail.com', 'order_number' => 'Youtuber', 'algorand_address' => '4IKR3U4PFKNS3ZQQWWB7QAACV4H7WD3IAEQQ3535D77J5PMZGZ7PEVTHAI']);
        MinerDevices::create(['email' => 'business@swancastlecrypto.com', 'order_number' => 'Youtuber', 'algorand_address' => 'T43GGVEJMFVL6WRTHR24SCJTB4TEURHK5KJE37PZ65RBVHANANFCKXERJA']);
        MinerDevices::create(['email' => 'nerdydudestuff@gmail.com', 'order_number' => 'youtuber', 'algorand_address' => 'OGSYLCVIDJKJFS3EUP3WTZTUNLL7YHT4K7RLBUMXRLDJ6HMS4GYTFTTVIQ']);
        MinerDevices::create(['email' => 'contact@cryptojar.net', 'order_number' => 'youtuber', 'algorand_address' => 'Q6WI4AOTFIO6USJ5PFWGXEHCWXA2NRM4Z3FMDOHESOAMH4VIYKDV67KY7Q']);
        MinerDevices::create(['email' => 'thenordiccrypto@gmail.com', 'order_number' => 'youtuber', 'algorand_address' => 'O5QOGJD2FNIYUDJ4BIL3GKFFH7P7H6FDIMNYXBNXJ3SGMYRVMWFRQVW7GY']);
        MinerDevices::create(['email' => 'ebaysales266@gmail.com', 'order_number' => 'youtuber', 'algorand_address' => 'T3G6T2VRXYG7V342RW3OEF2TUSSHXRCLAVZB6ODXP6WFDNMIZE423GZTIU']);
        MinerDevices::create(['email' => 'dylansherrard92@gmail.com', 'order_number' => 'youtuber', 'algorand_address' => '6XYZUYHYZHV6O4UFBAM3E5R3UJXK44JMDF2A2JRPWIQ64GDFSKYOL7YXGU']);
        MinerDevices::create(['email' => 'salihovic365@gmail.com', 'order_number' => 'youtuber', 'algorand_address' => '2EBK735SGXMF762MAK6AWKB2EOVKCPQEFVRIPWLTXBN64U5APFRTJSUQ4I']);
        MinerDevices::create(['email' => 'rst@mac.com', 'order_number' => '10311', 'algorand_address' => 'EGU7IAPWJZVHYYPJIHMH5LOVXJMNKMNSD22NBSXNLVZT2CSI6DRCD2UXPI']);
    }
}

<?php

namespace Database\Seeders;

use App\Models\LogStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    private $logatatuses = [
        ['name' => 'Order Received', 'name_mm' => 'အော်ဒါလက်ခံရရှိ', 'serial' => 1, 'color' => '#23b848'],
        ['name' => 'Order Processing', 'name_mm' => 'အမှာစာ စီမံဆောင်ရွက်ပေးခြင်း', 'serial' => 2, 'color' => '#D87B64'],
        ['name' => 'Ready To Dispatch', 'name_mm' => 'ပို့ရန်အဆင်သင့်', 'serial' => 3, 'color' => '#D87B64'],
        ['name' => 'Order Dispatched', 'name_mm' => 'အော်ဒါ ပို့ပြီးပါပြီ', 'serial' => 4, 'color' => '#D87B64'],
        ['name' => 'At Local Facility', 'name_mm' => 'At Local Facility', 'serial' => 5, 'color' => '#D87B64'],
        ['name' => 'Out For Delivery', 'name_mm' => 'ပေးပို့ခြင်း', 'serial' => 6, 'color' => '#D87B64'],
        ['name' => 'Delivered', 'name_mm' => 'ပို့ဆောင်ပေးခဲ့သည်', 'serial' => 7, 'color' => '#D87B64'],
        ['name' => 'Failed to collect payment', 'name_mm' => 'ငွေပေးချေမှု မအောင်မြင်ပါ', 'serial' => 8, 'color' => '#D87B64'],
        ['name' => 'Falied to contact Consignee', 'name_mm' => 'ကုန်ပို့သူကို ဆက်သွယ်၍မရပါ', 'serial' => 9, 'color' => '#D87B64'],
        ['name' => 'Shipment Refused by Consignee', 'name_mm' => 'ပို့ဆောင်သူမှ ငြင်းဆိုထားသည်', 'serial' => 10, 'color' => '#D87B64']
    ];
    public function run()
    {
        foreach ($this->logatatuses as $logatatus) {
            LogStatus::factory()->create($logatatus);
        }
    }
}

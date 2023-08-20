<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    private  $order_statuses = [
      ['name'=>'Order Received','name_mm'=>'အော်ဒါလက်ခံရရှိ','serial'=>1,
       'color'=>'#23b848'],
      ['name'=>'Order Processing','name_mm'=>'အမှာစာ စီမံဆောင်ရွက်ပေးခြင်း','serial'=>2,
      'color'=>'#d87b64'],
      ['name'=>'Ready To Dispatch','name_mm'=>'ပို့ရန်အဆင်သင့်','serial'=>3,
      'color'=>'#d87b64'],
      ['name'=>'Order Dispatched','name_mm'=>'အော်ဒါ ပို့ပြီးပါပြီ','serial'=>4,
      'color'=>'#d87b64'],
      ['name'=>'At Local Facility','name_mm'=>'Local Facility မှာ','serial'=>5,
      'color'=>'#d87b64'],
      ['name'=>'Out For Delivery','name_mm'=>'အရောက်ပို့ရန် အပြင်','serial'=>6,
      'color'=>'#d87b64'],
      ['name'=>'Delivered','name_mm'=>'ပို့ဆောင်ပေးသည်','serial'=>11,
      'color'=>'#d87b64'],
      ['name'=>'Failed to collect payment','name_mm'=>'ငွေပေးချေမှု ကောက်ခံရန် မအောင်မြင်ပါ','serial'=>8,
      'color'=>'#d87b64'],
      ['name'=>'falied to contact Consignee','name_mm'=>'ကုန်ပို့သူကို ဆက်သွယ်၍မရပါ','serial'=>9,
      'color'=>'#d87b64'],
      ['name'=>'Shipment Refused by Consignee','name_mm'=>'ပို့ဆောင်သူမှ ငြင်းဆိုထားသည်','serial'=>10,
      'color'=>'#d87b64']
    ];
    public function run()
    {
        foreach ($this->order_statuses as $order_status) {
            OrderStatus::factory()->create($order_status);
        }
    }
}

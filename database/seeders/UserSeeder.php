<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the API users database seed.
     *
     * @return void
     */
    public function run()
    {
        // Demo API user, api_key=xuusogercnjpzsvyqznfyuceqczpidamjsezxsxwykppudhzgmtgnoxpgahf
        User::factory()->APIUser()->DemoAPIUser()->create();
    }
}

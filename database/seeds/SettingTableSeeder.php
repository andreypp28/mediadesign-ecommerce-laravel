<?php

use Illuminate\Database\Seeder;
use App\Models\Setting; 

class SettingTableSeeder extends Seeder {

	public function run()
	{
        DB::table('settings')->delete();
        
		Setting::create([
			'name'      => 'site.title',
			'module'    => 'site',
			'value'     => 'RockDesign High End Business Cards | Free Business Card Templates',
		]);
        
        Setting::create([
            'name'      => 'site.description',
            'module'    => 'site',
            'value'     => 'High end business cards and free business cards templates!',
        ]);
        
        Setting::create([
            'name'      => 'site.keywords',
            'module'    => 'site',
            'value'     => 'Black business card, Black business cards, Duplex Business cards, High end business cards, Triplex business cards, letterpress business cards, plastic business cards, folders, metal business cards, letterhead, flyers, spot uv, foil stamp, lamination, glos',
        ]);
        
        Setting::create([
            'name'      => 'site.list_limit',
            'module'    => 'site',
            'value'     => 10,
        ]);
        
        Setting::create([
            'name'      => 'site.status',
            'module'    => 'site',
            'value'     => 1,
        ]);
        
        Setting::create([
            'name'      => 'site.author',
            'module'    => 'site',
            'value'     => '',
        ]);
        
        Setting::create([
            'name'      => 'site.email',
            'module'    => 'site',
            'value'     => 'admin@rockdesign.com',
        ]);
        
        Setting::create([
            'name'      => 'site.owner',
            'module'    => 'site',
            'value'     => 'Administrator',
        ]);
        
        $this->command->info('The site settings are configured!');
	}

}

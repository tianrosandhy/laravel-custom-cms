<?php

namespace Module\Main\Console;

use Illuminate\Console\Command;
use Module\Main\Models\SettingStructure;

class DefaultSetting extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'default:setting';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Init default setting for site CMS';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    	$data = [
    		[
                'param' => 'login_background',
                'name' => 'Admin Login Background',
                'description' => 'Image background used for admin login page',
                'default_value' => '',
                'type' => 'image',
                'group' => 'admin',
            ],
            [
                'param' => 'logo',
                'name' => 'Admin Image Logo',
                'description' => 'Image logo used for admin page',
                'default_value' => null,
                'type' => 'image',
                'group' => 'admin',
            ],
            [
                'param' => 'favicon',
                'name' => 'Admin Favicon',
                'description' => 'Image favicon used for admin page',
                'default_value' => null,
                'type' => 'image',
                'group' => 'admin',
            ],

	    	[
	    		'param' => 'theme',
	    		'name' => 'Admin Theme (pages/klorofil)',
	    		'description' => 'Admin theme used',
	    		'default_value' => 'pages',
	    		'type' => 'text',
	    		'group' => 'admin',
	    	],
	    	[
	    		'param' => 'title',
	    		'name' => 'Site Title',
	    		'description' => '',
	    		'default_value' => 'Laravel CMS',
	    		'type' => 'text',
	    		'group' => 'site',	    		
	    	],
	    	[
	    		'param' => 'subtitle',
	    		'name' => 'Site Subtitle',
	    		'description' => '',
	    		'default_value' => 'Lorem ipsum dolor sit amet',
	    		'type' => 'text',
	    		'group' => 'site',
	    	],
	    	[
	    		'param' => 'description',
	    		'name' => 'Site Description',
	    		'description' => '',
	    		'default_value' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste tenetur nulla enim repellat deserunt odit quasi possimus ipsa aperiam, quidem!',
	    		'type' => 'textarea',
	    		'group' => 'site',
	    	],
            [
                'param' => 'logo',
                'name' => 'Site Image Logo',
                'description' => 'Image logo used for site',
                'default_value' => null,
                'type' => 'image',
                'group' => 'site',
            ],
	    	[
	    		'param' => 'favicon',
	    		'name' => 'Site Favicon',
	    		'description' => 'Site icon in browser title section',
	    		'default_value' => null,
	    		'type' => 'image',
	    		'group' => 'site',
	    	],    	

    	];

    	$n = 0;
    	foreach($data as $row){
    		$cek = SettingStructure::where('param', $row['param'])
    			->where('group', $row['group'])->first();

    		if(empty($cek)){
    			$instance = new SettingStructure();
    			foreach($row as $field => $value){
    				$instance->{$field} = $value;
    			}
    			$instance->save();

    			$this->info('Setting '.$row['group'].'.'.$row['param'].' has been created.');
    			$n++;
    		}
    	}


    	if($n == 0){
    		$this->info('All default setting parameter is already in the database');
    	}

    }
}

<?php

namespace Module\Base\Console;

use Illuminate\Console\Command;
use Module\Base\Models\SettingStructure;

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
        $this->actionRunner();
    }

    public function actionRunner($title=null, $description=null){
        $data = [
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
                'param' => 'title',
                'name' => 'Site Title',
                'description' => '',
                'default_value' => ($title ? $title : 'Laravel CMS'),
                'type' => 'text',
                'group' => 'site',              
            ],
            [
                'param' => 'subtitle',
                'name' => 'Site Subtitle',
                'description' => '',
                'default_value' => 'Laravel Based Site',
                'type' => 'text',
                'group' => 'site',
            ],
            [
                'param' => 'description',
                'name' => 'Site Description',
                'description' => '',
                'default_value' => ($description ? $description : 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Adipisci architecto dolor excepturi, saepe eum amet!'),
                'type' => 'textarea',
                'group' => 'site',
            ],
            [
                'param' => 'keywords',
                'name' => 'Site Keywords',
                'description' => '',
                'default_value' => '',
                'type' => 'text',
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
            [
                'param' => 'image',
                'name' => 'Site SEO Image',
                'description' => 'Default SEO Image for site',
                'default_value' => null,
                'type' => 'image',
                'group' => 'site',
            ],
            [
                'param' => 'phone',
                'name' => 'Site Phone Number',
                'description' => 'Site Phone Number / Call Center',
                'default_value' => '(0896) 2222 4614',
                'type' => 'text',
                'group' => 'site',
            ],
            [
                'param' => 'mail_receiver',
                'name' => 'Website Email Receiver',
                'description' => 'All functional site email receiver',
                'default_value' => 'tianrosandhy@gmail.com',
                'type' => 'text',
                'group' => 'site'
            ],

            [
                'param' => 'facebook',
                'name' => 'Facebook Link',
                'description' => 'Your facebook URL',
                'default_value' => 'https://facebook.com/tianEXE',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'twitter',
                'name' => 'Twitter Link',
                'description' => 'Your twitter URL',
                'default_value' => 'https://twitter.com/tianrosandhy',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'instagram',
                'name' => 'Instagram Link',
                'description' => 'Your instagram URL',
                'default_value' => 'https://instagram.com/tianrosandhy',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'youtube',
                'name' => 'Youtube Link',
                'description' => 'Your youtube URL',
                'default_value' => '',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'whatsapp',
                'name' => 'Whatsapp Number',
                'description' => 'Your whatsapp phone number',
                'default_value' => '6289622224614',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'appstore',
                'name' => 'Apple App Store URL',
                'description' => 'Your Apple App Store URL',
                'default_value' => '',
                'type' => 'text',
                'group' => 'social'
            ],
            [
                'param' => 'playstore',
                'name' => 'Google Playstore URL',
                'description' => 'Your Google Playstore URL',
                'default_value' => '',
                'type' => 'text',
                'group' => 'social'
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
                $n++;
            }
        }
    }
}

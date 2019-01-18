<?php
namespace Module\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Artisan;
use Module\Main\Console\DefaultSetting;
use Module\Main\Console\SetRole;

class InstallController extends Controller{

	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index(){
		$has_install = $this->checkHasInstall();
		//redirect to base route if already installed
		$db = $this->checkDatabaseConnection();
		$symlink = $this->checkSymlink();
		$module = $this->checkModuleNamespace();

		return view('main::install', compact(
			'db',
			'symlink',
			'module',
			'has_install'
		));
	}

	public function process(){
		$db = $this->checkDatabaseConnection();
		if($db){
			return url('install')->with(['error' => 'Please fix the database connection problem first']);
		}

		$validate = Validator::make($this->request->all(), [
			'name' => 'required',
			'email' => 'required|email|strict_mail',
			'password' => 'required|min:6'
		], [
			'email.strict_mail' => 'Email is not accepted'
		]);

		if($validate->fails()){
			return back()->withInput()->with([
				'error' => $validate->errors()->first()
			]);
		}

		//kalau sudah oke : hajar

		#pertama2 migrate dulu~
		Artisan::call('migrate');
		
		#buat symlink jika blm ada
		if($this->checkSymlink()){
			Artisan::call('storage:link');
		}

		#publish vendor jika belum dijalankan
		Artisan::call('vendor:publish', [
			'--tag' => 'tianrosandhy-cms'
		]);

		#buat admin baru
        self::createUser($this->request->email, $this->request->email, $this->request->password);
        (new SetRole)->actionRunner();
        (new DefaultSetting)->actionRunner($this->request->title, $this->request->description);

        #buat penanda kalau install sudah berhasil dijalankan
        $this->createInstallHint();

        //sudah sukses.. redirect ke login p4n3lb04rd
        return redirect()->route('admin.splash')->with([
        	'success' => 'CMS Installation has been finished. Now you can use this CMS'
        ]);
	}

	protected function checkHasInstall(){
		return is_file('install.cms');
	}

	protected function createInstallHint(){
		if(!$this->checkHasInstall()){
			$file = fopen('install.cms', 'w');
			fwrite($file, date('Y-m-d H:i:s'));
			fclose($file);
			return true;
		}
		return false;
	}


	protected function createUser($email, $username, $password){
		DB::table('users')->insert([
            'name' => $username,
            'email' => $email,
            'password' => bcrypt($password),
            'role_id' => 1, //default
            'image' => '',
            'activation_key' => null,
            'is_active' => 1,
            'created_at' => date('Y-m-d H:i:s')
        ]);
	}


	protected function checkDatabaseConnection(){
		try{
			//check connection exists
			#will return error if connection failed
			DB::table(DB::raw('DUAL'))->first([DB::raw(1)]);
		}catch(\Exception $e){
			return 'Wrong database connection';
		}

		try{
			//check database exists
			#will return error if database not exists
			DB::select('SHOW TABLES');
		}catch(\Exception $e){
			return 'Database not exists';
		}

		return false;
	}

	protected function checkSymlink(){
		$cek = is_file('storage/.gitignore');
		if($cek){
			return false;
		}
		return 'Symlink is still not created';
	}

	protected function checkModuleNamespace(){
		$dir_exists = is_dir(base_path('modules'));
		if(!$dir_exists){
			return '"modules" directory not exists in base project';
		}

		try{
			$composer = file_get_contents(base_path('composer.json'));
			$composer = json_decode($composer, true);

			if(isset($composer['autoload']['psr-4']['Module\\'])){
				$namespaceName = $composer['autoload']['psr-4']['Module\\'];
				if($namespaceName == 'modules/' || $namespaceName == 'modules\\'){
					return false;
				}
				else{
					return 'Invalid namespace directory value. "Module\\" value must be "modules/"';
				}
			}
			else{
				return '"Module\\" key is still not exists in autoload->psr-4';
			}
		}catch(\Exception $e){
			return 'Failed to grab composer.json file. Please check the permission';
		}
	}

}
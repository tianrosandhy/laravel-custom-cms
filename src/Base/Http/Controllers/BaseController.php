<?php
namespace Module\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Validator;
use Artisan;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

use Module\Base\Console\DefaultSetting;
use Module\Base\Console\SetRole;

class BaseController extends Controller
{
	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index(){
		//redirect to base route if already installed
		$db = $this->checkDatabaseConnection();
		$has_install = $this->checkHasInstall();
		$symlink = $this->checkSymlink();
		$module = $this->checkModuleNamespace();
		$publish = $this->checkVendorPublish();

		return view('base::install', compact(
			'db',
			'symlink',
			'module',
			'has_install',
			'publish'
		));
	}

	public function process(){
		$db = $this->checkDatabaseConnection();
		if($db){
			return url('install')->with(['error' => 'Please fix the database connection problem first']);
		}

		$validate = Validator::make($this->request->all(), [
			'name' => 'required',
			'email' => 'required|email',
			'password' => 'required|min:6'
		]);

		if($validate->fails()){
			return back()->withInput()->with([
				'error' => $validate->errors()->first()
			]);
		}

		//kalau sudah oke : hajar


		#pertama : copy folder MainSource ke folder modules
		$source = __DIR__.'/../../../MainSource';
		$module_dir = base_path('modules/Main');
		if(!is_dir($module_dir)){
			copy_directory($source, $module_dir);
		}


		#publish vendor jika belum dijalankan
		Artisan::call('vendor:publish', [
			'--tag' => 'tianrosandhy-cms'
		]);


		#selanjutnya migrate dulu~
		Artisan::call('migrate');
		
		#buat symlink jika blm ada
		if($this->checkSymlink()){
			Artisan::call('storage:link');
		}

		#buat admin baru
        self::createUser($this->request->name, $this->request->email, $this->request->password);
        (new SetRole)->actionRunner();
        (new DefaultSetting)->actionRunner($this->request->title, $this->request->description);        

        #buat penanda kalau install sudah berhasil dijalankan
        $this->createInstallHint();

        //sudah sukses.. redirect ke login p4n3lb04rd
        return redirect('install')->with([
        	'success' => 'CMS Installation has been finished. Now you can use this CMS'
        ]);
	}

	protected function checkHasInstall(){
		try{
			DB::table('cms_installs')->get();
			return true;
		}catch(\Illuminate\Database\QueryException $e){
			return false;
		}
	}

	protected function createInstallHint(){
		if(!$this->checkHasInstall()){
			//create installation simple table
			Schema::create('cms_installs', function($table){
				$table->datetime('created_at');
			});
			DB::table('cms_installs')->insert([
				'created_at' => date('Y-m-d H:i:s')
			]);
		}
		return false;
	}

	protected function checkVendorPublish(){
		//ketauan ato nggaknya dari folder maxsol di public aja
		if(is_dir(config('cms.admin.assets'))){
			if(count(scandir(config('cms.admin.assets'))) > 3){
				return false;
			}
		}
		return 'Assets still not published';
	}


	protected function createUser($username, $email, $password){
		$check = DB::table('users')->where('email', $email)->get();

		if($check->count() == 0){
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
		//else do nothing
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
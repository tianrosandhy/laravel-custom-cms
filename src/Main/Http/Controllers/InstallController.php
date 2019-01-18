<?php
namespace Module\Main\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class InstallController extends Controller{

	public $request;

	public function __construct(Request $req){
		$this->request = $req;
	}

	public function index(){
		//generate condition check if user has install CMS or not.
		//redirect to base route if already installed
		$db = $this->checkDatabaseConnection();
		$symlink = $this->checkSymlink();
		$module = $this->checkModuleNamespace();

		return view('main::install', compact(
			'db',
			'symlink',
			'module'
		));
	}

	public function process(){
		$db = $this->checkDatabaseConnection();
		if($db){
			return url('install')->with(['error' => 'Please fix the database connection problem first']);
		}

		
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
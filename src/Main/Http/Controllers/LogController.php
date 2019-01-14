<?php
namespace Module\Main\Http\Controllers;

use Module\Main\Http\Repository\CrudRepository;
use Module\Main\Http\Controllers\AdminBaseController;
use Module\Main\Http\Skeleton\LogSkeleton;

use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LogController extends AdminBaseController
{

	public function repo(){
		//mendefinisikan repo / model apa yang ingin digunakan
		//inputan berupa inisial sesuai yang didaftarkan di config('model')
		return 'log';
	}

	public function skeleton(){
		return new LogSkeleton;
	}

    //default index page
    public function index(){
        $title = self::usedLang('index.title');
        $hint = $this->hint();

        $active_log = $this->request->active_log;
        $available_log = $this->getAvailableFileLog();
        $file_log = $this->getFileLog($active_log);

        return view('main::log', compact(
            'title',
            'hint',
            'available_log',
            'active_log',
            'file_log'
        ));
    }

    public function getFileLog($filename=''){
        $available = $this->getAvailableFileLog();
        if(strlen($filename) > 0){
            if(in_array($filename, $available)){
                $logpath = $this->logPath($filename);
                if(is_file($logpath)){
                    return file_get_contents($logpath);
                }
            }
        }
        return false;
    }


    public function getAvailableFileLog(){
        $path = $this->logPath();
        if(is_dir($path)){
            $list = scandir($path);
            //buang . , .. , .gitignore , laravel.log
            $list = array_values(array_diff($list, [
                '.',
                '..',
                '.gitignore'
            ]));

            if($list){
                return $list;
            }
        }
        return [];
    }

    protected function logPath($path=''){
        return storage_path('logs') . (strlen($path) > 0 ? '/'.$path : '');
    }


    public function export(){
        $active_log = $this->request->active_log;
        $file_log = $this->getFileLog($active_log);
        if(strlen($file_log) > 0){
            header('Content-Type: text/plain');
            header('Content-Disposition: attachment; filename="'.$active_log.'"');

            echo $file_log;
            exit();
        }
    }

	public function languageData(){
		return [
			'index.title' => 'Log Data',
			'create.title' => 'Add New Log',
			'edit.title' => 'Edit Log Data',

			'store.success' => 'Log data has been saved',
			'update.success' => 'Log data has been updated',
			'delete.success' => 'Log data has been deleted',
		];
	}

	public function delete($id=0){
		if(!$this->repo->exists($id)){
			abort(404);
		}

		$data = $this->repo->show($id);

		$this->repo->delete($id);
		$this->removeLanguage($data);

		return [
			'type' => 'success',
			'message' => self::usedLang('delete.success')
		];
	}


}
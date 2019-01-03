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
        \Validator::make($this->request->all(), [
            'date_a' => 'required|date',
            'date_b' => 'required|date',
        ])->validate();

        $tgl_a = date('Y-m-d', strtotime($this->request->date_a));
        $tgl_b = date('Y-m-d', strtotime($this->request->date_b));
        if(strtotime($tgl_a) > strtotime($tgl_b)){
            //harus dituker
            $tgl_c = $tgl_a;
            $tgl_a = $tgl_b; 
            $tgl_b = $tgl_c;
        }

        if($tgl_a <> $tgl_b){
            $filename = setting('site.title').' Log '.$tgl_a.'-'.$tgl_b.'.txt';
        }
        else{
            $filename = setting('site.title').' Log '.$tgl_a.'.txt';
        }
        $tgl_a .= ' 00:00:00';
        $tgl_b .= ' 23:59:59';


        //kalo ga ada request->clear_log artinya export
        $model = (new CrudRepository('log'))->model;
        if($this->request->clear_log){
            $model
                ->whereBetween('created_at', [$tgl_a, $tgl_b])
                ->delete();

            return back()->with('success', 'Log data has been deleted');
        }
        else{
            //search log data by date range
            $data = $model
                ->whereBetween('created_at', [$tgl_a, $tgl_b])
                ->orderBy('created_at', 'ASC')
                ->get();

            if($data->count() == 0){
                return back()->withErrors(['error' => 'No log data in range ' . $tgl_a .' - '.$tgl_b]);
            }
            else{
                $output = '';

                foreach($data as $row){
                    $output.= date('Y-m-d H:i:s', strtotime($row->created_at))."\r\n";
                    $output.= "URL = ".$row->url."\r\n";
                    $output.= "LABEL = ".$row->label."\r\n";
                    $output.= "JSON DATA = ".$row->data."\r\n";
                    $output.= "=================\r\n\r\n";
                }

                //output as log text document
                $headers = [
                  'Content-type' => 'text/plain', 
                  'Content-Disposition' => sprintf('attachment; filename="%s"', $filename),
                  'Content-Length' => strlen($output)
                ];


                $response = new StreamedResponse();
                $response->setCallBack(function () use($output) {
                    echo $output;
                });

                $disposition = $response->headers->makeDisposition(ResponseHeaderBag::DISPOSITION_ATTACHMENT, $filename);
                $response->headers->set('Content-Disposition', $disposition);
                return $response;
            }
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
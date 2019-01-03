<?php
namespace Module\Post\Http\Skeleton;

use Module\Main\DataTable\DataTable;
use DataStructure;
use DataSource;

class PostSkeleton extends DataTable
{

	//MANAGE STRUKTUR DATA KOLOM DAN FORM
	public function __construct(){
		$this->request = request();
		//default fields
		$this->setModel('post');

		$this->structure[] = DataStructure::checker();

		$this->structure[] = DataStructure::field('created_at')
			->name('Created At')
			->hideForm()
			->inputType('date');

		$this->structure[] = DataStructure::field('title')
			->name('Title')
			->formColumn(12)
			->createValidation('required', true);

		$this->structure[] = DataStructure::field('slug')
			->name('Slug')
			->formColumn(12)
			->inputType('slug')
			->slugTarget('title')
			->createValidation('required', true);

		$this->structure[] = DataStructure::field('category[]')
			->name('Category')
			->formColumn(12)
			->searchable(false)
			->orderable(false)
			->inputType('select_multiple')
			->dataSource(
				DataSource::model('category')
					->options('name')
			)
			->valueSource('post_to_category', 'post_id', 'category_id') //relasi get value utk relasi many to many
			->createValidation('required', true);


		$this->structure[] = DataStructure::field('tags')
			->name('Tags')
			->orderable(false)
			->formColumn(12)
			->inputType('tags');

		$this->structure[] = DataStructure::field('excerpt')
			->name('Excerpt')
			->formColumn(12)
			->hideTable()
			->inputType('textarea');

		$this->structure[] = DataStructure::field('body')
			->name('Post Content')
			->formColumn(12)
			->inputType('richtext')
			->createValidation('required', true);

		$this->structure[] = DataStructure::field('image')
			->name('Image')
			->searchable(false)
			->orderable(false)
			->formColumn(12)
			->inputType('image')
			->setImageDirPath(config('module-setting.post.upload_path'));

		$this->structure[] = DataStructure::field('related_to[]')
			->name('Related To')
			->hideTable()
			->formColumn(12)
			->inputType('select_multiple')
			->dataSource(DataSource::model('post')->options('title'))
			->valueSource('post_related', 'post_source', 'post_related_id');

		$this->structure[] = DataStructure::field('is_active')
			->name('Is Active')
			->formColumn(6)
			->inputType('radio')
			->dataSource(DataSource::setList([
				'0' => 'Draft',
				'1' => 'Active'
			]));

		$this->structure[] = DataStructure::field('featured')
			->name('Home Featured')
			->formColumn(6)
			->inputType('radio')
			->dataSource(DataSource::setList([
				'0' => 'No',
				'1' => 'Yes'
			]));

		
	}


	public function rowFormat($row, $as_excel=false){
		return [
            'id' => $this->checkerFormat($row),
			'title' => $row->outputTranslate('title'),
			'slug' => $row->outputTranslate('slug'),
			'tags' => tagToHtml($row->outputTranslate('tags'), 'label-default'),
			'category' => implode(', ', self::getCategory($row->id)),
			'image' => $as_excel ? filenameOnly($row->image) : '<img src="'. $row->getThumbnailUrl('image', 'thumb') .'" style="height:80px">',
			'is_active' => $as_excel ? $row->is_active : view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'is_active',
				'url' => admin_url('post/switch'),
				'value' => $row->is_active
			])->render(),
			'excerpt' => $as_excel ? $row->excerpt : '',
			'body' => $as_excel ? $row->body : substr(strip_tags($row->body), 0, 300).'...',
			'click' => $as_excel ? $row->click : '',
			'created_at' => $as_excel ? $row->created_at : date('d F Y H:i:s', strtotime($row->created_at)),
			'featured' => $as_excel ? $row->featured :  view('main::inc.switchery', [
				'id' => $row->id, 
				'field' => 'featured',
				'url' => admin_url('post/switch'),
				'value' => $row->featured
			])->render(),

			'action' => self::editButton($row) . self::deleteButton($row)
		];
	}
	

	protected function editButton($row){
		if(has_access('admin.post.update')){
			return $this->actionButton(
				'Edit', 
				url()->route('admin.post.edit', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-info edit-btn'],
					'data-id' => $row->id
				]
			);
		}
	}

	protected function deleteButton($row){
		if(has_access('admin.post.delete')){
			return $this->actionButton(
				'Delete', 
				url()->route('admin.post.delete', ['id' => $row->id]), 
				[
					'class' => ['btn', 'btn-sm', 'btn-danger delete-button'],
					'data-id' => $row->id
				]
			);
		}
	}


	protected function getCategory($post_id){
		$model = $this->model->with('categories')->find($post_id);
		$out = [];
		foreach($model->categories as $row){
			$out[] = $row->category->name;
		}

		return $out;
	}



}
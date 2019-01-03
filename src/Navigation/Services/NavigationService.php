<?php
namespace Module\Navigation\Services;
use Illuminate\Contracts\Foundation\Application;
use Module\Navigation\Models\Navigation;

class NavigationService
{

    public function __construct(Application $app)
    {
        $this->app = $app;
    }


    public function urlGenerate($group_name){
        $data = self::generate($group_name);
        $out = [];
        foreach($data as $label => $row){
            $out[$label]['url'] = self::getAbsoluteUrl($row);
            $out[$label]['new_tab'] = $row['new_tab'];
            if(isset($row['children'])){
                foreach($row['children'] as $l => $r){
                    $out[$label]['children'][$l]['url'] = self::getAbsoluteUrl($r);
                    $out[$label]['children'][$l]['new_tab'] = $r['new_tab'];

                    if(isset($r['children'])){
                        foreach($r['children'] as $ll => $rr){
                            $out[$label]['children'][$l]['children'][$ll]['url'] = self::getAbsoluteUrl($rr);
                            $out[$label]['children'][$l]['children'][$ll]['new_tab'] = $rr['new_tab'];
                        }
                    }
                    
                }
            }
        }

        return $out;
    }

    protected function getAbsoluteUrl($row){
        if(strlen($row['url']) > 0){
            //normal URL
            if(substr($row['url'], 0, 1) == '#'){
                $url = $row['url'];
            }
            else{
                $url = url($row['url']);
            }
        }
        else{
            //route
            if(\Route::has($row['route'])){
                if(strlen($row['parameter']) > 0){
                    if(json_decode($row['parameter'])){
                        $url = url()->route($row['route'], json_decode($row['parameter'], true));
                    }
                    else{
                        //fallback default parameter : slug
                        $url = url()->route($row['route'], ['slug' => $row['parameter']]);
                    }
                }
                else{
                    $url = url()->route($row['route']);
                }
            }
            else{
                //fallbacknya : ga kemana2
                $url = '#';
            }
        }

        return $url;
    }



    public function generate($group_name){
        $out = [];
        $qry = Navigation::where('group_name', $group_name)->first();
        if($qry->id){
            foreach($qry->lists->where('parent', 0) as $row){
                $type = $row->type;
                $olahType = self::getRawUrlParameterByType($row);

                $out[$row->title] = [
                    'url' => $olahType['url'],
                    'route' => $olahType['route'],
                    'parameter' => $olahType['parameter'],
                    'new_tab' => $row->new_tab,
                ];
                if($row->children->count() > 0){
                    foreach($row->children as $r){
                        $subOlahType = self::getRawUrlParameterByType($r);

                        $out[$row->title]['children'][$r->title] = [
                            'url' => $subOlahType['url'],
                            'route' => $subOlahType['route'],
                            'parameter' => $subOlahType['parameter'],
                            'new_tab' => $r->new_tab
                        ];

                        if($r->children->count() > 0){
                            foreach($r->children as $s){
                                $subSubOlahType = self::getRawUrlParameterByType($s);

                                $out[$row->title]['children'][$r->title]['children'][$s->title] = [
                                    'url' => $subSubOlahType['url'],
                                    'route' => $subSubOlahType['route'],
                                    'parameter' => $subSubOlahType['parameter'],
                                    'new_tab' => $s->new_tab
                                ];

                            }
                        }

                    }
                }
            }
            return $out;
        }
        return false;
    }



    protected function getRawUrlParameterByType($row){
        $type = $row->type;
        if($type == 'post-category'){
            $url = '';
            $route = config('admin.navigation_route_used.category_slug', 'front.category');
            $parameter = strlen($row->category_slug) > 0 ? $row->category_slug : '-';
        }
        elseif($type == 'post'){
            $url = '';
            $route = config('admin.navigation_route_used.post_slug', 'front.post.detail');
            $parameter = strlen($row->post_slug) > 0 ? $row->post_slug : '-';
        }
        elseif($type == 'page'){
            $url = '';
            $route = config('admin.navigation_route_used.page_slug', 'front.page.detail');
            $parameter = strlen($row->page_slug) > 0 ? $row->page_slug : '-';
        }
        else{
            $url = $row->url;
            $route = $row->route;
            $parameter = $row->parameter;
        }

        return [
            'url' => $url,
            'route' => $route,
            'parameter' => $parameter
        ];
    }



}
<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class PageController extends _CrudController
{
    protected $passingDataHome;
    protected $passingDataProduct;

    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'list' => 0,
            ],
            'key' => [
                'edit' => 0,
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'select',
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataHome = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'landingpage_title' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'our_product_button_text' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'landingpage_background' => [
                'type' => 'image',
                'path' => '/homepage',
            ],
            'homepage_title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'homepage_content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'homepage_background' => [
                'type' => 'image',
                'path' => '/homepage',
            ],
            'about_image' => [
                'path' => '/img',
                'type' => 'image',
            ],
            'about_title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'about_content' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'contact_logo' => [
                'path' => '/homepage',
                'type' => 'image'
            ],
            'contact_title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'contact_name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'contact_details' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'texteditor',
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'select',
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ]);

        $this->passingDataProduct = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'key' => [
                'edit' => 0,
            ],
            'title' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'other_category_text' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'filter_text' => [
                'validate' => [
                    'edit' => 'required'
                ],
            ],
            'status' => [
                'validate' => [
                    'edit' => 'required'
                ],
                'type' => 'select',
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ]);

        parent::__construct(
            $request, 'general.page', 'page', 'Page', 'page',
            $passingData
        );

        $this->data['listSet'] = [
            'status' => get_list_active_inactive(),
        ];
    }

    public function edit($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->landingpage_title = $getValue['landingpage_title'] ?? null;
            $getData->our_product_button_text = $getValue['our_product_button_text'] ?? null;
            $getData->landingpage_background = isset($getValue['landingpage_background']) ? asset($getValue['landingpage_background']) : asset('assets/cms/images/no-img.png');
            $getData->homepage_title = $getValue['homepage_title'] ?? null;
            $getData->homepage_content = $getValue['homepage_content'] ?? null;
            $getData->homepage_background = isset($getValue['homepage_background']) ? asset($getValue['homepage_background']) : asset('assets/cms/images/no-img.png');
            $getData->about_image = isset($getValue['about_image']) ? asset($getValue['about_image']) : asset('assets/cms/images/no-img.png');
            $getData->about_title = $getValue['about_title'] ?? null;
            $getData->about_content = $getValue['about_content'] ?? null;
            $getData->contact_logo = isset($getValue['contact_logo']) ? asset($getValue['contact_logo']) : asset('assets/cms/images/no-img.png');
            $getData->contact_title = $getValue['contact_title'] ?? null;
            $getData->contact_name = $getValue['contact_name'] ?? null;
            $getData->contact_details = $getValue['contact_details'] ?? null;
        }
        else if($getData->key == 'product') {
            $passingData = $this->passingDataProduct;
            $getData->title = $getValue['title'] ?? null;
            $getData->other_category_text = $getValue['other_category_text'] ?? null;
            $getData->filter_text = $getValue['filter_text'] ?? null;
        }
        else {
            $getData->title = $getValue['title'] ?? null;
        }

        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function show($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->landingpage_title = $getValue['landingpage_title'] ?? null;
            $getData->our_product_button_text = $getValue['our_product_button_text'] ?? null;
            $getData->landingpage_background = isset($getValue['landingpage_background']) ? asset($getValue['landingpage_background']) : asset('assets/cms/images/no-img.png');
            $getData->homepage_title = $getValue['homepage_title'] ?? null;
            $getData->homepage_content = $getValue['homepage_content'] ?? null;
            $getData->homepage_background = isset($getValue['homepage_background']) ? asset($getValue['homepage_background']) : asset('assets/cms/images/no-img.png');
            $getData->about_image = isset($getValue['about_image']) ? asset($getValue['about_image']) : asset('assets/cms/images/no-img.png');
            $getData->about_title = $getValue['about_title'] ?? null;
            $getData->about_content = $getValue['about_content'] ?? null;
            $getData->contact_logo = isset($getValue['contact_logo']) ? asset($getValue['contact_logo']) : asset('assets/cms/images/no-img.png');
            $getData->contact_title = $getValue['contact_title'] ?? null;
            $getData->contact_name = $getValue['contact_name'] ?? null;
            $getData->contact_details = $getValue['contact_details'] ?? null;
        }
        else if($getData->key == 'product') {
            $passingData = $this->passingDataProduct;
            $getData->title = $getValue['title'] ?? null;
            $getData->other_category_text = $getValue['other_category_text'] ?? null;
            $getData->filter_text = $getValue['filter_text'] ?? null;
        }
        else {
            $getData->title = $getValue['title'] ?? null;
        }

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getValue = json_decode($getData->value, true);

        $passingData = $this->passingData;
        if($getData->key == 'homepage') {
            $passingData = $this->passingDataHome;
            $getData->landingpage_title = $getValue['landingpage_title'] ?? null;
            $getData->our_product_button_text = $getValue['our_product_button_text'] ?? null;
            $getData->landingpage_background = isset($getValue['landingpage_background']) ? asset($getValue['landingpage_background']) : asset('assets/cms/images/no-img.png');
            $getData->homepage_title = $getValue['homepage_title'] ?? null;
            $getData->homepage_content = $getValue['homepage_content'] ?? null;
            $getData->homepage_background = isset($getValue['homepage_background']) ? asset($getValue['homepage_background']) : asset('assets/cms/images/no-img.png');
            $getData->about_image = isset($getValue['about_image']) ? asset($getValue['about_image']) : asset('assets/cms/images/no-img.png');
            $getData->about_title = $getValue['about_title'] ?? null;
            $getData->about_content = $getValue['about_content'] ?? null;
            $getData->contact_logo = isset($getValue['contact_logo']) ? asset($getValue['contact_logo']) : asset('assets/cms/images/no-img.png');
            $getData->contact_title = $getValue['contact_title'] ?? null;
            $getData->contact_name = $getValue['contact_name'] ?? null;
            $getData->contact_details = $getValue['contact_details'] ?? null;
        }
        else if($getData->key == 'product') {
            $passingData = $this->passingDataProduct;
            $getData->title = $getValue['title'] ?? null;
            $getData->other_category_text = $getValue['other_category_text'] ?? null;
            $getData->filter_text = $getValue['filter_text'] ?? null;
        }
        else {
            $getData->title = $getValue['title'] ?? null;
        }

        $getListCollectData = collectPassingData($passingData, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType, $id);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data, $getData);

        $value = [];

        if($getData->key == 'homepage') {
            $value['landingpage_title'] = $data['landingpage_title'];
            $value['our_product_button_text'] = $data['our_product_button_text'];
            $value['landingpage_background'] = $data['landingpage_background'] ?? $getData->landingpage_background;
            $value['homepage_title'] = $data['homepage_title'];
            $value['homepage_content'] = $data['homepage_content'];
            $value['homepage_background'] = $data['homepage_background'] ?? $getData->homepage_background;
            $value['about_image'] = $data['about_image'] ?? $getData->about_image;
            $value['about_title'] = $data['about_title'];
            $value['about_content'] = $data['about_content'];
            $value['contact_logo'] = $data['contact_logo'] ?? $getData->contact_logo;
            $value['contact_title'] = $data['contact_title'];
            $value['contact_name'] = $data['contact_name'];
            $value['contact_details'] = $data['contact_details'];
            unset($data['landingpage_title']);
            unset($data['our_product_button_text']);
            unset($data['landingpage_background']);
            unset($data['homepage_title']);
            unset($data['homepage_content']);
            unset($data['homepage_background']);
            unset($data['about_image']);
            unset($data['about_title']);
            unset($data['about_content']);
            unset($data['contact_logo']);
            unset($data['contact_title']);
            unset($data['contact_name']);
            unset($data['contact_details']);
        }
        else if($getData->key == 'product') {
            $value['title'] = $data['title'];
            $value['other_category_text'] = $data['other_category_text'];
            $value['filter_text'] = $data['filter_text'];
            unset($data['title']);
            unset($data['other_category_text']);
            unset($data['filter_text']);
        }
        else {
            $value['title'] = $data['title'];
            unset($data['title']);
        }

        $data['value'] = json_encode($value);

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

}

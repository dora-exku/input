<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputRequest;
use App\Models\Input;
use App\Models\School;
use App\Services\WechatService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class InputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('input.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, WechatService $wechatService)
    {
//        if (Cache::get('qrcode.' . $request->ip()) != 1) {
//            return redirect()->route('root');
//        }
        // 检查openid是否存在

        $schoolId = $request->get('school_id', 0);
        if ($schoolId === 0) {
            $schoolId = School::getDefaultId();
        }
        $school = School::query()->where('id', $schoolId)->first();

        $openid = $request->session()->get('openid');
        $code = $request->get('code', null);
        if (is_null($openid) && is_null($code)) {
            $wechatService->getAuthUrl($request->url() . '?school_id=' . $schoolId);
        } else if (!is_null($code) && is_null($openid)) {
            $openid = $wechatService->getUserAccessToken($code);
            $request->session()->put('openid', $openid);
        }


        if ($school->is_open) {
            return view('input.create', [
                'input' => new Input(),
                'no' => time() . rand(100000, 999999),
                'input_ip' => ip2long(\request()->ip()),
                'class_number_parent' => Input::CLASS_NUMBER_PARENT,
                'class_number_child' => Input::CLASS_NUMBER_CHILD,
                'price' => [
                    1 => 300,
                    2 => 200,
                    3 => 100,
                    4 => 300,
                    5 => 200,
                    6 => 100,
                    7 => 300,
                    8 => 200,
                    9 => 100,
                    10 => 300,
                    11 => 200,
                    12 => 100,
                ],
                'school' => $school
            ]);
        } else {
            return view('input.close');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InputRequest $inputRequest, Input $input)
    {
        $input->create($inputRequest->only([
            'no',
            'input_ip',
            'fullname',
            'id_card',
            'phone',
            'remark',
            'payment_method',
            'total_amount',
            'class_number_parent',
            'class_number_child',
            'school_id'
        ]));

        return redirect()->route('pay.view', ['order' => $inputRequest->validationData()['no']]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

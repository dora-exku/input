<?php

namespace App\Http\Controllers;

use App\Http\Requests\InputRequest;
use App\Models\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

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
    public function create(Request $request)
    {
//        if (Cache::get('qrcode.' . $request->ip()) != 1) {
//            return redirect()->route('root');
//        }

        return view('input.create', [
            'input' => new Input(),
            'no' => time() . rand(100000, 999999),
            'input_ip' => ip2long(\request()->ip())
        ]);
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
            'payment_method'
        ]));

        return redirect()->route('input.index');
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

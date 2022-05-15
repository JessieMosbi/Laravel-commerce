<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = DB::table('products')->get();
        return response(collect($data));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->getData();
        $newData = $request->all();
        $data->push(collect($newData));
        return response($data);
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
        $form = $request->all();
        $data = $this->getData();
        $selectedData = $data->where('id', $id)->first();
        $selectedData = $selectedData->merge(collect($form));
        return response($selectedData);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = $this->getData();
        $data = $data->filter(function ($product) use ($id) {
            return $product['id'] !== (int)$id;
        });
        return response($data->values());
    }

    /**
     *  Get fake data
     *
     * @return \Illuminate\Support\Collection
     */
    private function getData(): \Illuminate\Support\Collection
    {
        return collect([
            collect([
                'id' => 1,
                'name' => 'Product 1',
                'description' => 'This is product 1.',
                'price' => 100
            ]),
            collect([
                'id' => 2,
                'name' => 'Product 2',
                'description' => 'This is product 2.',
                'price' => 299
            ])
        ]);
    }
}

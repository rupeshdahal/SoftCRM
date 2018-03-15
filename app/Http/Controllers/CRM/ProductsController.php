<?php

namespace App\Http\Controllers\CRM;

use App\Http\Controllers\Controller;
use App\Language;
use App\Models\ProductsModel;
use Validator;
use Illuminate\Support\Facades\Input;
use View;
use Request;
Use Illuminate\Support\Facades\Redirect;
use Config;

class ProductsController extends Controller
{
    /**
     * @return array
     */
    private function getDataAndPagination()
    {
        $dataWithProducts = [
            'products' => ProductsModel::all()->sortByDesc('created_at'),
            'productsPaginate' => ProductsModel::paginate(Config::get('crm_settings.pagination_size'))
        ];

        return $dataWithProducts;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('crm.products.index')->with($this->getDataAndPagination());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('crm.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $allInputs = Input::all();

        $validator = Validator::make($allInputs, ProductsModel::getRules('STORE'));

        if ($validator->fails()) {
            return Redirect::to('products/create')->with('message_danger', $validator->errors());
        } else {
            if ($product = ProductsModel::insertRow($allInputs)) {
                SystemLogsController::insertSystemLogs('Product has been add with id: '. $product, 200);
                return Redirect::to('products')->with('message_success', Language::getMessage('messages.SuccessProductsStore'));
            } else {
                return Redirect::back()->with('message_success', Language::getMessage('messages.ErrorProductsStore'));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $dataOfProducts = ProductsModel::find($id);

        return View::make('crm.products.show')
            ->with([
                'products' => $dataOfProducts,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $productsDetails = ProductsModel::find($id);

        return View::make('crm.products.edit')
            ->with('products', $productsDetails);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $allInputs = Input::all();

        $validator = Validator::make($allInputs, ProductsModel::getRules('STORE'));

        if ($validator->fails()) {
            return Redirect::back()->with('message_danger', $validator);
        } else {
            if (ProductsModel::updateRow($id, $allInputs)) {
                return Redirect::to('products')->with('message_success', Language::getMessage('messages.SuccessProductsStore'));
            } else {
                return Redirect::back()->with('message_danger', Language::getMessage('messages.ErrorProductsStore'));
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $productsDetails = ProductsModel::find($id);
        $productsDetails->delete();

        SystemLogsController::insertSystemLogs('ProductsModel has been deleted with id: ' . $productsDetails->id, 200);


        return Redirect::to('products')->with('message_success', Language::getMessage('messages.SuccessProductsDelete'));
    }

    /**
     * @param $id
     * @param $value
     * @return mixed
     */
    public function isActiveFunction($id, $value)
    {
        $productsDetails = ProductsModel::find($id);

        if (ProductsModel::setActive($productsDetails->id, $value)) {
            SystemLogsController::insertSystemLogs('ProductsModel has been enabled with id: ' . $productsDetails->id, 200);
            return Redirect::back()->with('message_success', Language::getMessage('messages.SuccessProductsActive'));
        } else {
            return Redirect::back()->with('message_danger', Language::getMessage('messages.ProductsIsActived'));
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function search()
    {
        $getValueInput = Request::input('search');
        $findProductsByValue = count(ProductsModel::trySearchProductsByValue('full_name', $getValueInput, 10));
        $dataOfProducts = $this->getDataAndPagination();

        if (!$findProductsByValue > 0) {
            return redirect('products')->with('message_danger', Language::getMessage('messages.ThereIsNoProducts'));
        } else {
            $dataOfProducts += ['products_search' => $findProductsByValue];
            Redirect::to('products/search')->with('message_success', 'Find ' . $findProductsByValue . ' products!');
        }

        return View::make('crm.products.index')->with($dataOfProducts);
    }
}

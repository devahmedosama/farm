<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use \App\Http\Controllers\Admin as Admin ;
Route::get('/', function () {
    return view('welcome');
});
Route::get('login', function () {
    return view('welcome');
})->name('login');
Route::get('admin/logout',function(){
    \Auth::logout();
    return redirect('/')
            ->with('yes',trans('home.Loged Out Successfully'));
});
Route::post('login',[Admin\UserController::class,'post_login']);

Route::group(['middleware'=>['admin'],'prefix'=>'admin'],function(){

    Route::get('/',[Admin\HomeController::class,'index']);
    Route::get('general',[Admin\HomeController::class,'general']);
    Route::get('data-entry',[Admin\HomeController::class,'data_entry']);
    Route::get('edit-entry',[Admin\HomeController::class,'edit_entry']);
    


    //equipemnts 
    Route::get('test',[Admin\TestController::class,'index']);

    Route::get('equipments',[Admin\EquipmentController::class,'index']);
    Route::get('equipments/add',[Admin\EquipmentController::class,'add']);
    Route::get('equipments/edit/{id}',[Admin\EquipmentController::class,'edit']);
    Route::get('equipments/delete/{id}',[Admin\EquipmentController::class,'delete']);
    Route::post('equipments/add',[Admin\EquipmentController::class,'post_add']);
    Route::post('equipments/edit/{id}',[Admin\EquipmentController::class,'post_edit']);

    //permission
    Route::get('permissions',[Admin\PermissionController::class,'index']);
    Route::get('permissions/add',[Admin\PermissionController::class,'add']);
    Route::get('permissions/edit/{id}',[Admin\PermissionController::class,'edit']);
    Route::get('permissions/delete/{id}',[Admin\PermissionController::class,'delete']);
    Route::post('permissions/add',[Admin\PermissionController::class,'post_add']);
    Route::post('permissions/edit/{id}',[Admin\PermissionController::class,'post_edit']);

    //plant-types 
    Route::get('plant-types',[Admin\PlantTypeController::class,'index']);
    Route::get('plant-types/add',[Admin\PlantTypeController::class,'add']);
    Route::get('plant-types/edit/{id}',[Admin\PlantTypeController::class,'edit']);
    Route::get('plant-types/delete/{id}',[Admin\PlantTypeController::class,'delete']);
    Route::post('plant-types/add',[Admin\PlantTypeController::class,'post_add']);
    Route::post('plant-types/edit/{id}',[Admin\PlantTypeController::class,'post_edit']);

    //nurseries 
    Route::get('nurseries',[Admin\NurseryController::class,'index']);
    Route::get('nurseries/add',[Admin\NurseryController::class,'add']);
    Route::get('nurseries/edit/{id}',[Admin\NurseryController::class,'edit']);
    Route::get('nurseries/delete/{id}',[Admin\NurseryController::class,'delete']);
    Route::post('nurseries/add',[Admin\NurseryController::class,'post_add']);
    Route::post('nurseries/edit/{id}',[Admin\NurseryController::class,'post_edit']);

    //products 
    Route::get('products',[Admin\ProductController::class,'index']);
    Route::get('products/add',[Admin\ProductController::class,'add']);
    Route::get('products/edit/{id}',[Admin\ProductController::class,'edit']);
    Route::get('products/delete/{id}',[Admin\ProductController::class,'delete']);
    Route::post('products/add',[Admin\ProductController::class,'post_add']);
    Route::post('products/edit/{id}',[Admin\ProductController::class,'post_edit']);

    //product-types 
    Route::get('product-types',[Admin\ProductTypeController::class,'index']);
    Route::get('product-types/add',[Admin\ProductTypeController::class,'add']);
    Route::get('product-types/edit/{id}',[Admin\ProductTypeController::class,'edit']);
    Route::get('product-types/delete/{id}',[Admin\ProductTypeController::class,'delete']);
    Route::post('product-types/add',[Admin\ProductTypeController::class,'post_add']);
    Route::post('product-types/edit/{id}',[Admin\ProductTypeController::class,'post_edit']);

    //stock-types 
    Route::get('stock-types',[Admin\StockTypeController::class,'index']);
    Route::get('stock-types/add',[Admin\StockTypeController::class,'add']);
    Route::get('stock-types/edit/{id}',[Admin\StockTypeController::class,'edit']);
    Route::get('stock-types/delete/{id}',[Admin\StockTypeController::class,'delete']);
    Route::post('stock-types/add',[Admin\StockTypeController::class,'post_add']);
    Route::post('stock-types/edit/{id}',[Admin\StockTypeController::class,'post_edit']);


    //units 
    Route::get('units',[Admin\UnitController::class,'index']);
    Route::get('units/add',[Admin\UnitController::class,'add']);
    Route::get('units/edit/{id}',[Admin\UnitController::class,'edit']);
    Route::get('units/delete/{id}',[Admin\UnitController::class,'delete']);
    Route::post('units/add',[Admin\UnitController::class,'post_add']);
    Route::post('units/edit/{id}',[Admin\UnitController::class,'post_edit']);


    //suppliers 
    Route::get('suppliers',[Admin\SupplierController::class,'index']);
    Route::get('suppliers/add',[Admin\SupplierController::class,'add']);
    Route::get('suppliers/edit/{id}',[Admin\SupplierController::class,'edit']);
    Route::get('suppliers/delete/{id}',[Admin\SupplierController::class,'delete']);
    Route::post('suppliers/add',[Admin\SupplierController::class,'post_add']);
    Route::post('suppliers/ajax-add',[Admin\SupplierController::class,'ajax_add']);
    Route::post('suppliers/edit/{id}',[Admin\SupplierController::class,'post_edit']);


    //stocks 
    Route::get('stocks',[Admin\StockController::class,'index']);
    Route::get('stocks/add',[Admin\StockController::class,'add']);
    Route::get('stocks/move',[Admin\StockController::class,'move']);
    Route::post('stocks/move',[Admin\StockController::class,'post_move']);
    Route::get('stocks/edit/{id}',[Admin\StockController::class,'edit']);
    Route::get('stocks/delete/{id}',[Admin\StockController::class,'delete']);
    Route::post('stocks/add',[Admin\StockController::class,'post_add']);
    Route::post('stocks/edit/{id}',[Admin\StockController::class,'post_edit']);
    Route::get('stock/moves',[Admin\StockController::class,'stock_moves']);
    Route::get('moves/delete/{id}',[Admin\StockController::class,'delete_moves']);

    //fertilization-types 
    Route::get('fertilization-types',[Admin\FertilizationTypeController::class,'index']);
    Route::get('fertilization-types/add',[Admin\FertilizationTypeController::class,'add']);
    Route::get('fertilization-types/edit/{id}',[Admin\FertilizationTypeController::class,'edit']);
    Route::get('fertilization-types/delete/{id}',[Admin\FertilizationTypeController::class,'delete']);
    Route::post('fertilization-types/add',[Admin\FertilizationTypeController::class,'post_add']);
    Route::post('fertilization-types/edit/{id}',[Admin\FertilizationTypeController::class,'post_edit']);

    //fertilization-types 
    Route::get('stock-items',[Admin\StockItemController::class,'index']);
    Route::get('stock-items/add',[Admin\StockItemController::class,'add']);
    Route::get('stock-items/edit/{id}',[Admin\StockItemController::class,'edit']);
    Route::get('stock-items/delete/{id}',[Admin\StockItemController::class,'delete']);
    Route::post('stock-items/add',[Admin\StockItemController::class,'post_add']);
    Route::post('stock-items/edit/{id}',[Admin\StockItemController::class,'post_edit']);


     //fertilization-types 
    Route::get('fertilization',[Admin\FertilizationController::class,'index']);
    Route::get('fertilization/add',[Admin\FertilizationController::class,'add']);
    Route::get('fertilization/edit/{id}',[Admin\FertilizationController::class,'edit']);
    Route::get('fertilization/delete/{id}',[Admin\FertilizationController::class,'delete']);
    Route::post('fertilization/add',[Admin\FertilizationController::class,'post_add']);
    Route::post('fertilization/edit/{id}',[Admin\FertilizationController::class,'post_edit']);


    //medicines 
    Route::get('medicine',[Admin\MedicineController::class,'index']);
    Route::get('medicine/add',[Admin\MedicineController::class,'add']);
    Route::get('medicine/edit/{id}',[Admin\MedicineController::class,'edit']);
    Route::get('medicine/delete/{id}',[Admin\MedicineController::class,'delete']);
    Route::post('medicine/add',[Admin\MedicineController::class,'post_add']);
    Route::post('medicine/edit/{id}',[Admin\MedicineController::class,'post_edit']);


    //farms 
    Route::get('my-farm',[Admin\FarmController::class,'my_farm']);
    Route::get('farms',[Admin\FarmController::class,'index']);
    Route::get('farms/add',[Admin\FarmController::class,'add']);
    Route::get('farms/edit/{id}',[Admin\FarmController::class,'edit']);
    Route::get('farms/delete/{id}',[Admin\FarmController::class,'delete']);
    Route::post('farms/add',[Admin\FarmController::class,'post_add']);
    Route::post('farms/edit/{id}',[Admin\FarmController::class,'post_edit']);

    // areas
    Route::get('areas',[Admin\AreaController::class,'index']);
    Route::get('areas/add',[Admin\AreaController::class,'add']);
    Route::get('areas/edit/{id}',[Admin\AreaController::class,'edit']);
    Route::get('areas/delete/{id}',[Admin\AreaController::class,'delete']);
    Route::post('areas/add',[Admin\AreaController::class,'post_add']);
    Route::post('areas/edit/{id}',[Admin\AreaController::class,'post_edit']);


    //seedling-moves 
    Route::get('seedling-moves',[Admin\SeedlingMoveController::class,'index']);
    Route::get('seedling-moves/add',[Admin\SeedlingMoveController::class,'add']);
    Route::get('seedling-moves/edit/{id}',[Admin\SeedlingMoveController::class,'edit']);
    Route::get('seedling-moves/delete/{id}',[Admin\SeedlingMoveController::class,'delete']);
    Route::post('seedling-moves/add',[Admin\SeedlingMoveController::class,'post_add']);
    Route::post('seedling-moves/edit/{id}',[Admin\SeedlingMoveController::class,'post_edit']);


    //clients 
    Route::get('clients',[Admin\ClientController::class,'index']);
    Route::get('clients/add',[Admin\ClientController::class,'add']);
    Route::get('clients/edit/{id}',[Admin\ClientController::class,'edit']);
    Route::get('clients/delete/{id}',[Admin\ClientController::class,'delete']);
    Route::post('clients/add',[Admin\ClientController::class,'post_add']);
    Route::post('clients/edit/{id}',[Admin\ClientController::class,'post_edit']);


    //sells 
    Route::get('sells',[Admin\SellController::class,'index']);
    Route::get('sells/add',[Admin\SellController::class,'add']);
    Route::get('sells/edit/{id}',[Admin\SellController::class,'edit']);
    Route::get('sells/delete/{id}',[Admin\SellController::class,'delete']);
    Route::post('sells/add',[Admin\SellController::class,'post_add']);
    Route::post('sells/edit/{id}',[Admin\SellController::class,'post_edit']);


    //employees 
    Route::get('employees/land',[Admin\EmployeeController::class,'show']);
    Route::get('employees/show/{id}',[Admin\EmployeeController::class,'single']);
    Route::get('employees',[Admin\EmployeeController::class,'index']);
    Route::get('employees/add',[Admin\EmployeeController::class,'add']);
    Route::get('employees/edit/{id}',[Admin\EmployeeController::class,'edit']);
    Route::get('employees/delete/{id}',[Admin\EmployeeController::class,'delete']);
    Route::post('employees/add',[Admin\EmployeeController::class,'post_add']);
    Route::post('employees/edit/{id}',[Admin\EmployeeController::class,'post_edit']);
    Route::post('vacations/add/{id}',[Admin\EmployeeController::class,'add_vacation']);
    Route::get('vacations/delete/{id}',[Admin\EmployeeController::class,'delete_vacation']);
    Route::get('vacations/print/{id}',[Admin\EmployeeController::class,'print']);
    Route::get('vacations/{id}',[Admin\EmployeeController::class,'vacations']);

    //equipmentuses 
    Route::get('equipmentuses',[Admin\EquipmentUseController::class,'index']);
    Route::get('equipmentuses/add',[Admin\EquipmentUseController::class,'add']);
    Route::get('equipmentuses/edit/{id}',[Admin\EquipmentUseController::class,'edit']);
    Route::get('equipmentuses/delete/{id}',[Admin\EquipmentUseController::class,'delete']);
    Route::post('equipmentuses/add',[Admin\EquipmentUseController::class,'post_add']);
    Route::post('equipmentuses/edit/{id}',[Admin\EquipmentUseController::class,'post_edit']);
    Route::get('equipmentuses/return-back/{id}',[Admin\EquipmentUseController::class,'return_back']);

    //alerts 
    Route::get('alerts',[Admin\AlertController::class,'index']);
    Route::get('alerts/add',[Admin\AlertController::class,'add']);
    Route::get('alerts/finish/{id}',[Admin\AlertController::class,'finish']);
    Route::get('alerts/edit/{id}',[Admin\AlertController::class,'edit']);
    Route::get('alerts/delete/{id}',[Admin\AlertController::class,'delete']);
    Route::post('alerts/add',[Admin\AlertController::class,'post_add']);
    Route::post('alerts/edit/{id}',[Admin\AlertController::class,'post_edit']);

    //users 
    Route::get('users',[Admin\UserController::class,'index']);
    Route::get('users/add',[Admin\UserController::class,'add']);
    Route::get('users/edit/{id}',[Admin\UserController::class,'edit']);
    Route::get('users/delete/{id}',[Admin\UserController::class,'delete']);
    Route::post('users/add',[Admin\UserController::class,'post_add']);
    Route::post('users/edit/{id}',[Admin\UserController::class,'post_edit']);
    Route::get('profile',[Admin\ProfileController::class,'profile']);
    Route::post('profile',[Admin\ProfileController::class,'post_profile']);

    //fertilizations 
    Route::get('fertilization/state/{id}',[Admin\FertilizationPlanController::class,'change_state']);
    Route::get('fertilizations',[Admin\FertilizationPlanController::class,'index']);
    Route::get('fertilizations/add',[Admin\FertilizationPlanController::class,'add']);
    Route::get('fertilizations/edit/{id}',[Admin\FertilizationPlanController::class,'edit']);
    Route::get('fertilizations/delete/{id}',[Admin\FertilizationPlanController::class,'delete']);
    Route::post('fertilizations/plan/add',[Admin\FertilizationPlanController::class,'post_add']);
    Route::post('fertilizations/edit/{id}',[Admin\FertilizationPlanController::class,'post_edit']);
    Route::get('fertilizations/return-back/{id}',[Admin\FertilizationPlanController::class,'return_back']);
    Route::get('fertilization-plans',[Admin\FertilizationPlanController::class,'all_items']);
    Route::get('fertilization-plans/edit/{id}',[Admin\FertilizationPlanController::class,'edit']);
    Route::get('fertilization-plans/delete/{id}',[Admin\FertilizationPlanController::class,'delete']);
    Route::post('fertilization-plans/edit/{id}',[Admin\FertilizationPlanController::class,'post_edit']);
    

    //Route::get('fertilizatin/items',[Admin\FertilizationPlanController::class,'return_back'])
    //medicines 
    Route::get('medicines/plans/add',[Admin\PesticidePlanController::class,'add']);
    Route::post('medicines/plans/add',[Admin\PesticidePlanController::class,'post_add']);
    Route::get('pesticides',[Admin\PesticidePlanController::class,'index']);
    Route::get('pesticides/state/{id}',[Admin\PesticidePlanController::class,'change_state']);
     Route::get('pesticide-plans',[Admin\PesticidePlanController::class,'all_items']);
    Route::get('pesticide-plans/edit/{id}',[Admin\PesticidePlanController::class,'edit']);
    Route::get('pesticide-plans/delete/{id}',[Admin\PesticidePlanController::class,'delete']);
    Route::post('pesticide-plans/edit/{id}',[Admin\PesticidePlanController::class,'post_edit']);
    

     //companies 
    Route::get('companies',[Admin\CompanyController::class,'index']);
    Route::get('companies/add',[Admin\CompanyController::class,'add']);
    Route::get('companies/edit/{id}',[Admin\CompanyController::class,'edit']);
    Route::get('companies/delete/{id}',[Admin\CompanyController::class,'delete']);
    Route::post('companies/add',[Admin\CompanyController::class,'post_add']);
    Route::post('companies/add-ajax',[Admin\CompanyController::class,'ajax_add']);
    Route::post('companies/edit/{id}',[Admin\CompanyController::class,'post_edit']);

    // reports 
    Route::get('reports',[Admin\ReportController::class,'index']);
    Route::get('reports/farms',[Admin\ReportController::class,'farms']);
    Route::get('reports/sells',[Admin\ReportController::class,'sells']);
    Route::get('reports/sells-print/{id}',[Admin\ReportController::class,'sell_print']);
    Route::get('reports/stocks',[Admin\ReportController::class,'stocks']);
    Route::get('reports/moves',[Admin\ReportController::class,'moves']);


});
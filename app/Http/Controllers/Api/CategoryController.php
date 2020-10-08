<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\GeneralTrait;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    USE GeneralTrait;

    public function index()
    {
       $categories = Category::NameLang()->get();
       //return response()->json($categories);
       return $this->returnData('categories' , $categories) ;
    }


    public function getCategory(Request $request)
    {
       $category = Category::NameLang()->find($request->id);
        
       if(!$category) 
       {
             return $this->returnErrors('001' , 'هذا القسم غير موجود') ;
       }else
       {
             return $this->returnData('category' , $category) ;
       }
       
    }



    public function changeStatus(Request $request)
    {
        $category = Category::NameLang()->find($request->id);

        $category ? $category->update(['active' => $request->active]) : '';

        return $this->returnSuccessMessage( 'تم تغيير الحاله بنجاح') ;
    }
    
    



}

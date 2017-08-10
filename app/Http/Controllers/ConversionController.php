<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversion;
use League\Fractal\Manager;
use App\Http\Transformers\ConversionTransformer;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Resource\Collection;

class ConversionController extends Controller
{
      public function index()
    {	
		//Extract the user id to retrieve the conversion, this user exist for the use of middleware
		$userid  = Auth::user()->id;
		
		$fractal = new Manager();

		$ConversionData = Conversion::where('user_id', '=', $userid)->orderBy('created_at','desc');
		$resource 		= new Collection($ConversionData, new ConversionTransformer);

        return  $fractal->createData($resource)->toJson();
    }

       
}

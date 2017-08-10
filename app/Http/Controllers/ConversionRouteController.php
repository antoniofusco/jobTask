<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversion;
use League\Fractal\Manager;
use App\Http\Transformers\ConversionTransformer;
use Illuminate\Support\Facades\Auth;
use League\Fractal\Resource\Collection;
use App\IntegerConversion;

class ConversionRouteController extends Controller
{
    /**
     * Display a listing of the conversion by user.
     *
     * @return json
     */
    public function index()
    {
	   // Call the function extract to extract all the conversion
       return $this->extract(0);
    }
	
	/**
     * Display a listing of the conversion by user limit 10.
     *
     * @return json
     */
    public function show()
    {
	   // Call the function extract to extract all the conversion
       return $this->extract(10);
    }
	
	
	/**
     * Internal function to retrieve conversion from db
     * @param int 
     * @return json
     */
	    private function extract(int $limit)
    {
        //Extract the user id to retrieve the conversion, this user exist for the use of middleware
		$userid  = Auth::user()->id;
		// initialaze the manager
		$fractal = new Manager();
		
		// extract the data filtered by user and check the limit variable
		if($limit>0){
		$ConversionData = Conversion::where('user_id', '=', $userid)->skip(0)->take($limit)->orderBy('created_at','desc')->get();
		}
		else
		{
		$ConversionData = Conversion::where('user_id', '=', $userid)->orderBy('created_at','desc')->get();
		}
		// Check the data
		if($ConversionData->isEmpty())
		{
			$errorArray = array("error"=>"No data to show!");
			return response()->json($errorArray);
		}
		else
		{
			// Convert the data
			$resource 		= new Collection($ConversionData, new ConversionTransformer);
			// Transform the data
			return  $fractal->createData($resource)->toJson();
			
		}
    }
	
    /**
     * Convert and store number
     *
     * @return json
     */
    public function store(Request $request)
    {
		 //Extract the user id to retrieve the conversion, this user exist for the use of middleware
		$userid  = Auth::user()->id;
		 $this->validate($request, [
				'number' => 'required|max:3999|min:1'
		 ]);
		 // Read number from request
         $number = (integer)$request->input('number');
		 $interfaceConversion = new IntegerConversion();
		 $roman  =  $interfaceConversion->toRomanNumerals($number);
		 //Check if $roman variable has an error
		 if(is_array($roman))
		 {
			return response()->json($roman); 
		 }
		 else
		 {
			 // Insert the data in db with orm
			 $conversion = new Conversion;
			 $conversion->number	=	$number;
			 $conversion->roman		=	$roman;
			 $conversion->user_id	=	$userid;
			 $conversion->save();
			 $successArray = array("success"=>"true");
			 return response()->json($successArray); 
		 }
		 
    }
}

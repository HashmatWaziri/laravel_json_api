<?php

class DbreportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			
					
		return 'restricted areas';
		
//	$dbreports = Dbreport::where('user_id', Auth::user()->id)->get();
//	
//	return Response::json(array(
//						'error' => false,
//						'data' => $dbreports),
//				200
//				);
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
			
			
			$newdbreport = Input::json();


		$dbreport = new Dbreport;
		$dbreport->user_id = Auth::user()->id;
		$dbreport->tx_date = $newdbreport->get('date');
		$dbreport->status = $newdbreport->get('status');
		$dbreport->total = $newdbreport->get('total');
		$dbreport->telco = $newdbreport->get('telco');

		// add some validation right before inserting the data into the database.
		
		$rules = array(
							'date' => 'required|date',
							'status' => 'required|boolean',
							'total' => 'required|numeric',
							'telco' => 'required|string'
							
		);
		
		$validtaion = Validator::make(input::all(),$rules);
		
		
		if($validtaion->fails()){
		
				return Response::json($validation->errors());
				
		}else{
				
				$dbreport->save;
				
					
				
	
		}
//		return Response::eloquent($dbreport); // return the json of the instance that has just been inserted
			
//			return View::make('api.show')->with('data', $dbreport);
	}
			/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
			
		// make sure the current user owns the requested resource
			$dbreport = Dbreport::where('user_id', Auth::user()->id) // authenticating the users
						->where('id', $id)
						->take(1)
						->get();    // select * from `dbreports` where id = some parameter from user limit 1
		
return Response::eloquent($dbreport); // displaying the result as json
			
//			return View::make('api.show')->with('data', $dbreport);
			
	}
		
		
		
		
		// convert the array to json type
		
//		return Response::json(array(
//							'error' => false,
//							'record added' => $dbreport));
	
	





	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}


//$ curl -u admin:admin123 -H "Content-Type: application/json" -X POST -d '{"date
//":"2010-05-03","status":"1","total":"78541","telco":"umobile"}' http://localhos
//t/api/dbreport/api/v1

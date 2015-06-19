<?php

class DbreportController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
			$date = Request::get('date');
			$state = Request::get('state');
			$total = Request::get('total');
			$telco = Request::get('telco');
			
			if ($date == '' && $state == '' && $total == '' && $telco == ''){
					
					$dbreport = Dbreport::all();
					
			}else{
					$dbreport = Db::table('dbreports')
								->where('tx_date', '=', "$date")
								->or_where('state','=', "$state")
								->or_where('total','=', "$total")
								->or_where('telco','=', "$telco")
								->get();
					
			}
//	$dbreports = Dbreport::where('user_id', Auth::user()->id)->get();
	
	return Response::json(array(
						'error' => false,
						'data' => $dbreports),
				200
				);
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
			
			
			$dbreport = new Dbreport;
			$dbreport->user_id = Auth::user()->id;
		$dbreport->tx_date = Request::get('date');
		$dbreport->status = Request::get('status');
		$dbreport->total = Request::get('total');
		$dbreport->telco = Request::get('telco');
		
		// add some validation right before inserting the data into the database.
		
		$rules = array(
							'date' => 'required|date',
							'status' => 'required|boolean',
							'total' => 'required|numeric',
							'telco' => 'required|string'
							
		);
		
		$validtaion = Validator::make(Request::all(),$rules);
		if($validtaion->fails()){
			return Response::json($validation->errors()->toArray());
				
		}
		else {
				
		
	if($dbreport->save){
			return Response::json(array(
								'error' => false,
								'msg' => 'data inserted successfully'
			),
						200
						);
	}else{
			return Response::json(array(
								'error'=> true,
								'msg' => 'issue inserting data. Please check data type you have inserted'
			),
						200);
	}
		
		}
		
		
		
		// convert the array to json type
		
		return Response::json(array(
							'error' => false,
							'record added' => $dbreport));
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$dbreport = Dbreport::find($id); // fetching a record via the id parameter passed by the client
		
		
		
		return Response::json(array( // sending the result as a JSON response
							'error' => false,
							'report' => $dbreport),
							200
		)->setCallback(Request::get('callback'));
	}


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

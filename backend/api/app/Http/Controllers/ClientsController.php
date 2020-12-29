<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Lib\DataPrepare;
use App\Lib\ErrorCodes;
use App\Models\Clients;

class ClientsController extends Controller
{
    public function index()
    {
        $Clients    = new Clients();
        $allClients = $Clients->all();

        return response()->json([            
            'clients' =>$allClients]);

    }
	
	    public function getId($id)
    {
        $Clients    = new Clients();
        $allClients = $Clients->all($id);

        return response()->json([            
            'clients' =>$allClients]);

    }

    public function store(Request $request) 
    {
        $Customers    = new Clients();
        $ret         = $Customers->insert($request);

        return response()->json(
             dataPrepare::successMessage(
                'Cliente inserido com sucesso!',
                ErrorCodes::COD_SUBMITTED_SUCCESSFULLY ,
            )
        ,200);  
    }

    public function update(Request $request, $id) 
    {
        $Clients    = new Clients();
        $ret = $Clients->update($request, $id);

        return response()->json(
             dataPrepare::successMessage(
                'Cliente alterado com sucesso!',
                ErrorCodes::COD_SUBMITTED_SUCCESSFULLY ,
            )
        ,200);  
    }

    public function destroy(Request $request, $id) 
    {
        $Clients    = new Clients();
        $ret = $Clients->delete($id);

        return response()->json(
             dataPrepare::successMessage(
                'Cliente deletado com sucesso!',
                ErrorCodes::COD_SUBMITTED_SUCCESSFULLY ,
            )
        ,200);  
    }
}


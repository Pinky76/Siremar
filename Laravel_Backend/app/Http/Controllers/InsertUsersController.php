<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 use App\Models\Insertusers;
 use DB;


class InsertUsersController extends Controller
{
    //
    public function LoadResidents(){
        return DB::select('select * from Register where Role = "Resident"');
    }
    public function fetch_Name($Email)
    {
        $usersfetch = DB::table('Register')->where('Email', $Email)->get();
        return response()->json([
            'status'=>200,
            'usersfetch'=>$usersfetch,
        ]);
    }

    public function totalCount(){
        return DB::select('select Count(*) as TCount from Register');
    }   

    public function residentCount(){
        return DB::select('select Count(*) as countB from Register where Role = "Resident"');
    } 
    public function insertUsers(Request $request){
        
        if ($request->input('MoveInDate') !="" && $request->input('MoveOutDate') == "" )
        {
        $users = new Insertusers();
        $users->uName=$request->input('uName');
        $users->Password=$request->input('Password');
        $users->Email=$request->input('Email');
        $users->Role=$request->input('Role');
        $users->Contact=$request->input('Contact');
        $users->MoveInDate=$request->input('MoveInDate');
        // $users->MoveOutDate=$request->input('MoveOutDate');
        $users->DateOfBirth=$request->input('DateOfBirth');
        $users->PlaceOfBirth=$request->input('PlaceOfBirth');
        $users->save();
        }
        elseif($request->input('MoveInDate') =="" && $request->input('MoveOutDate') == "")
        {
            $users = new Insertusers();
            $users->uName=$request->input('uName');
            $users->Password=$request->input('Password');
            $users->Email=$request->input('Email');
            $users->Role=$request->input('Role');
            $users->Contact=$request->input('Contact');
            // $users->MoveInDate=$request->input('MoveInDate');
            // $users->MoveOutDate=$request->input('MoveOutDate');
            $users->DateOfBirth=$request->input('DateOfBirth');
            $users->PlaceOfBirth=$request->input('PlaceOfBirth');
            $users->save();
            }
            else
            {
                $users = new Insertusers();
                $users->uName=$request->input('uName');
                $users->Password=$request->input('Password');
                $users->Email=$request->input('Email');
                $users->Role=$request->input('Role');
                $users->Contact=$request->input('Contact');
                $users->MoveInDate=$request->input('MoveInDate');
                $users->MoveOutDate=$request->input('MoveOutDate');
                $users->DateOfBirth=$request->input('DateOfBirth');
                $users->PlaceOfBirth=$request->input('PlaceOfBirth');
                $users->save();
                }
        return response()->json([
            'status'=>200,
            'message'=>'User added successfully',
        ]);
    }

    public function edit_Rfetch($id)
    {
        $usersfetch = Insertusers::find($id);
        return response()->json([
            'status'=>200,
            'usersfetch'=>$usersfetch,
        ]);
    }

    public function edit_R(Request $request,$id){
        
        $users = Insertusers::find($id);

       
        $users->uName=$request->input('uName');
        $users->Password=$request->input('Password');
        $users->Email=$request->input('Email');
        $users->Role=$request->input('Role');
        $users->Contact=$request->input('Contact');
        $users->MoveInDate=$request->input('MoveInDate');
        $users->MoveOutDate=$request->input('MoveOutDate');
        $users->DateOfBirth=$request->input('DateOfBirth');
        $users->PlaceOfBirth=$request->input('PlaceOfBirth');
        $users->update();
        
        return response()->json([
            'status'=>200,
            'message'=>'User added successfully',
        ]);
    }

    public function deleteResident($id)
    {
        $users = Insertusers::find($id);
        $users->delete();
        return response()->json([
            'status'=>200,
            'message'=>$users,
        ]);
    }


}

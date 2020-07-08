<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\user;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lsUsers = user::paginate(5);
        return view('layouts_back_end.User.list')->with(['lsUsers' => $lsUsers]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('layouts_back_end.User.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate(
            [
              //truong name ko dc null (required), max 255 ki tu va min 3 ki tu
              //name la duy nhat trong categories (unique)
              'name' => 'required|max:255|min:3|unique:users',
              'email' => 'required|max:255|min:3|unique:users',
              'password' => 'required',
              'roles' =>'required'
            ]
          );
    
          $users = new user();
          
          $users->name = $request->name;
          $users->email = $request->email; //name 1 trung voi ten trong table con name 2 trung view
          $users->password = $request->password;
          $users->roles = $request->roles;
          $users->save();
    
          $request->session()->flash('success', 'Users was successful!');
          return redirect()->route("user_manage.index");
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
        $users = user::find($id);
        return view('layouts_back_end.User.edit')-> with(['users_'=> $users]);
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
        dd($request->id);
        try{
            $ep = user::find($request->id);

            $ep->name = $request->name;
            $ep->email = $request->email;
            $ep->roles = $request->role;
    
            $ep->save();

            return response()->json(['status' => 1, 'message' => "Sửa thông tin thành công"]);
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json(['status' => 0, 'message' => 'Có lỗi!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        try {
            $id = user::find($request->id);

            if ($id != null) {
                $id->delete();
                return response()->json(['status' => 1, 'message' => 'Xóa thành công']);
            } else {
                return response()->json(['status' => 0, 'message' => 'Không tồn tại.']);
            }
        } catch (\Exception $e) {
            $e->getMessage();
            return response()->json(['status' => 0, 'message' => 'Có lỗi']);
        }
    }
}

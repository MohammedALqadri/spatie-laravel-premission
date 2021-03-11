<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $admin = Admin::all();
        return view('cms.admin.index', ['admin' => $admin]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('cms.admin.create');
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
        $request->validate([
            'name' => 'required|string|min:3',

            'email' => 'required|email|unique:admins,email',
            'password' => 'required|string|min:4',
            'gender' => 'required|string|in:Male,Female',
            'image'=>'required',
            'mobile' => 'required|string|min:6|unique:admins,mobile',
            'status' => 'string|in:on,off'
        ]);

        $AdminImage = $request->file('image');

        $timeNow = Carbon::now();

        $time = $timeNow->minute . '_' . $timeNow->second;

        $name = $time . '_' . $request->get('name') . '_' . $AdminImage->getClientOriginalName();

        $AdminImage->move('images/admins/', $name);

        $admin = new Admin();
        $admin->name = $request->get('name');

        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));
        $admin->gender = $request->get('gender');
        $admin->status = $request->get('status') == "on" ? "Active" : "Blocked";
        $admin->mobile = $request->get('mobile');
        $admin->admin_image = $name;
        $isSaved = $admin->save();
        if ($isSaved) {
            return redirect()->route('cms.admin.index');
        }
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
        $admin = Admin::with('blogs')->where('status','Active')->find($id);




        return view('cms.admin.profile',['admin'=>$admin]);


    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $admins = Admin::find($id);
        return view('cms.admin.edit',['admins'=>$admins]);
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
        //
        $request->request->add(['id'=>$id]);
        $request->validate([
            'id'=>'required|exists:admins,id',
            'name' => 'required|string|min:3',

            'email' => 'required|email|unique:admins,email,'.$id,

            'gender' => 'required|string|in:Male,Female',
            'mobile' => 'required|string|numeric|unique:admins,mobile,'.$id,
            'status' => 'string|in:on,off'
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->get('name');

        $admin->email = $request->get('email');
        $admin->password = Hash::make($request->get('password'));
        $admin->gender = $request->get('gender');
        $admin->status = $request->get('status') == "on" ? "Active" : "Blocked";
        $admin->mobile = $request->get('mobile');
        $isSaved = $admin->save();
        if ($isSaved) {
            return redirect()->route('cms.admin.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $isDeleted = Admin::destroy($id);
        if($isDeleted){
            return redirect()->back();
        }
    }

    public function editProfile($id)
    {
        //

        $admin = Admin::find($id);

        if($admin->id == Auth()->user()->id){
            return view('cms.admin.profileEdit',['admin'=>$admin]);

        }








    }
    public function updateProfile(Request $request, $id)
    {
        $request->request->add(['id'=>$id]);
        $request->validate([
            'id'=>'required|exists:admins,id',
            'name' => 'required|string|min:3',

            'email' => 'required|email|unique:admins,email,'.$id,


            'mobile' => 'required|string|numeric|unique:admins,mobile,'.$id,
            'status' => 'string|in:on,off'
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->get('name');

        $admin->email = $request->get('email');



        $admin->mobile = $request->get('mobile');
        $isSaved = $admin->save();
        if ($isSaved) {
            return redirect()->back();
        }


    }


    public function editpassword($id)
    {
        //
        $admin = Admin::where('status','Active')->find($id);



        return view('cms.admin.passwordEdit',['admin'=>$admin]);


    }


    public function updatepassword(Request $request, $id)
    {
        $request->request->add(['id'=>$id]);
        $request->validate([
            'id'=>'required|exists:admins,id',
            'old_password'=>'required',
            'new_password'=>'required',


        ]);

        $admin = Admin::find($id);

          if (Hash::check($request->get('new_password'), Auth()->user()->password)) {


             $admin->password = Hash::make($request->get('new_password'));
                $isSaved = $admin->save();


          if ($isSaved) {
            return redirect()->route('admin.show',[Auth()->user()->id]);
            }



        }



    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\User;
use App\Rules\MatchOldPassword;
use App\Traits\ResponseStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
  use ResponseStatus;

  function __construct()
  {
    $this->middleware('can:users-list', ['only' => ['index', 'show']]);
    $this->middleware('can:users-create', ['only' => ['create', 'store']]);
    $this->middleware('can:users-edit', ['only' => ['edit', 'update']]);
    $this->middleware('can:users-delete', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {
    $config['title'] = "Users";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Users"],
    ];
    if ($request->ajax()) {
      $data = User::with('roles');

      if($request->filled('role_id')){
        $data->whereRoleId($request['role_id']);
      }

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<div class="btn-group dropend">
                            <button type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="' . route('users.edit', $row->id) . '">Edit</a></li>
                                <li><a href="#" data-bs-toggle="modal" data-bs-target="#modalReset" data-bs-id="' . $row->id . '" class="dropdown-item">Reset Password</a></li>
                                <li><a class="dropdown-item btn-delete" href="#" data-id ="' . $row->id . '" >Hapus</a></li>
                            </ul>
                          </div>';
          return $actionBtn;
        })->make();
    }
    return view('pages.backend.users.index', compact('config'));
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'role_id' => 'required|integer',
      'name' => 'required',
      'username' => 'required|alpha_dash|unique:users',
      'password' => 'required|between:6,255|confirmed',
      'email' => 'required|unique:users,email|email',
      'active' => 'required|between:0,1',
      'image' => 'image|mimes:jpg,png,jpeg',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $dimensions = [array('300', '300', 'thumbnail')];
      try {
        $img = isset($request->image) && !empty($request->image) ? FileUpload::uploadImage('image', $dimensions) : NULL;
        $data = User::create([
          'role_id' => $request['role_id'],
          'name' => ucwords($request['name']),
          'image' => $img,
          'email' => $request['email'],
          'username' => $request['username'],
          'password' => Hash::make($request['password']),
          'active' => $request['active'],
        ]);

        $data->app_settings()->create([
          'user_id' => $data->id,
          'type' => 'setting',
          'name' => 'layout_setting',
          'status' => 1,
          'value' => json_encode(config('app_settings')),
          'is_global' => 1,
        ]);

        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('users.index')));
      } catch (\Throwable $throw) {
        DB::rollBack();
        Log::error($throw);
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function create()
  {
    $config['title'] = "Tambah User";
    $config['breadcrumbs'] = [
      ['url' => route('users.index'), 'title' => "Role"],
      ['url' => '#', 'title' => "Tambah User"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('users.store')
    ];
    return view('pages.backend.users.form', compact('config'));
  }

  public function edit($id)
  {
    $config['title'] = "Edit Role";
    $config['breadcrumbs'] = [
      ['url' => route('users.index'), 'title' => "Users"],
      ['url' => '#', 'title' => "Edit User"],
    ];
    $data = User::with('roles')->where('id', $id)->first();
    $config['form'] = (object)[
      'method' => 'PUT',
      'action' => route('users.update', $id)
    ];
    return view('pages.backend.users.form', compact('config', 'data'));
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'role_id' => 'required|integer',
      'name' => 'required',
      'username' => 'required|alpha_dash|unique:users,username,' . $request['username'] . ',username',
      'password' => 'between:6,255|confirmed|nullable',
      'email' => 'required|email|unique:users,email,' . $request['email'] . ',email',
      'active' => 'required|between:0,1',
    ]);
    if ($validator->passes()) {
      DB::beginTransaction();
      $image = NULL;
      $dimensions = [array('300', '300', 'thumbnail')];
      try {
        $data = User::findOrFail($id);
        if (isset($request['image']) && !empty($request['image'])) {
          $image = FileUpload::uploadImage('image', $dimensions, 'storage', $data['image']);
        }
        $data->update([
          'role_id' => $request['role_id'],
          'name' => ucwords($request['name']),
          'email' => $request['email'],
          'username' => $request['username'],
          'active' => $request['active'],
          'image' => $image,
        ]);
        DB::commit();
        $response = response()->json($this->responseStore(true, NULL, route('users.index')));
      } catch (\Throwable $throw) {
        Log::error($throw);
        DB::rollBack();
        $response = response()->json(['error' => $throw->getMessage()]);
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function destroy($id)
  {
    $response = response()->json($this->responseDelete(false));
    $data = User::find($id);
    DB::beginTransaction();
    try {
      if ($data->delete()) {
        Storage::disk('public')->delete(["images/original/$data->image", "images/thumbnail/$data->image"]);
        $response = response()->json($this->responseDelete(true));
      }
      DB::commit();
    } catch (\Throwable $throw) {
      Log::error($throw);
      $response = response()->json(['error' => $throw->getMessage()]);
    }
    return $response;
  }

  public function resetpassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'id' => 'required|integer',
    ]);

    if ($validator->passes()) {
      $data = User::find($request->id);
      $data->password = Hash::make($data['email']);
      if ($data->save()) {
        $response = response()->json($this->responseUpdate(true));;
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function changepassword()
  {
    $config['title'] = "Ganti Password";
    $config['breadcrumbs'] = [
      ['url' => '#', 'title' => "Ganti Password"],
    ];
    $config['form'] = (object)[
      'method' => 'POST',
      'action' => route('update-change-password', auth()->id())
    ];
    return view('pages.backend.users.change-password', compact('config'));
  }

  public function updatechangepassword(Request $request)
  {
    $data = Auth::user();

    $validator = Validator::make($request->all(), [
      'old_password' => ['required', new MatchOldPassword(Auth::id())],
      'password' => 'required|between:6,255|confirmed',
    ]);

    if ($validator->passes()) {
      $data->password = Hash::make($request['password']);
      if ($data->save()) {
        $response = response()->json($this->responseUpdate(true, route('dashboard')));
      }
    } else {
      $response = response()->json(['error' => $validator->errors()->all()]);
    }
    return $response;
  }

  public function select2(Request $request){
    $page = $request->page;
    $resultCount = 10;
    $offset = ($page - 1) * $resultCount;
    $data = User::where('name', 'LIKE', '%' . $request->q . '%')
      ->orderBy('name')
      ->skip($offset)
      ->take($resultCount)
      ->selectRaw('id, name as text')
      ->get();

    $count = User::where('name', 'LIKE', '%' . $request->q . '%')
      ->count();

    $endCount = $offset + $resultCount;
    $morePages = $count > $endCount;

    $results = array(
      "results" => $data,
      "pagination" => array(
        "more" => $morePages
      )
    );

    return response()->json($results);
  }

}

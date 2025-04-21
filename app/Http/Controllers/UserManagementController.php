<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\DataTables;

class UserManagementController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index(Request $request)
    {
        $page_title = 'User Management';
        if ($request->ajax()) {
            $customers = Customer::orderBy('id', 'DESC')->get();
            $users = User::where('id', '!=', auth()->user()->id)->orderBy('id', 'DESC')->get();
            $array = [];
            foreach ($customers as $customer) {
                $array[] = [
                    'id' => $customer->id,
                    'f_name' => $customer->f_name,
                    'l_name' => $customer->l_name,
                    'email' => $customer->email,
                    'phone' => $customer->phone,
                    'address' => $customer->address,
                    'address1' => $customer->address1,
                    'city' => $customer->city,
                    'role' => 'customer',
                    'is_active' => $customer->is_active,
                ];
            }
            foreach ($users as $user) {
                $array[] = [
                    'id' => $user->id,
                    'f_name' => $user->name,
                    'l_name' => '',
                    'email' => $user->email,
                    'phone' => '',
                    'address' => '',
                    'address1' => '',
                    'city' => '',
                    'role' => 'employee',
                    'is_active' => $user->is_active,
                ];
            }
            $customers = collect($array)->sortByDesc('id')->values()->all();
            // dd($customers);
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<p><strong>' . $row['f_name'] . ' ' . $row['l_name'] ?? '' . '</strong></p>';
                })
                ->addColumn('role', function ($row) {
                    if ($row['role'] == 'customer') {
                        $role = '<div class="badge badge-success">Customer</div>';
                    } else {
                        $role = '<div class="badge badge-warning">Employee / Admin</div>';
                    }
                    return $role;
                })
                ->addColumn('email', function ($row) {
                    return '<a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a>';
                })
                ->addColumn('phone', function ($row) {
                    return '<a href="tel:' . $row['phone'] . '">' . $row['phone'] . '</a>';
                })
                ->addColumn('Address', function ($row) {
                    return '<p>' . $row['address'] . '</p>';
                })
                ->addColumn('Address1', function ($row) {
                    return '<p>' . $row['address1'] . '</p>';
                })
                ->addColumn('City', function ($row) {
                    return '<p>' . $row['city'] . '</p>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.user-management.edit', ['id' => $row['id'], 'role' => $row['role']]) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    if ($row['is_active'] == 0) {
                        $btn .= '<a href="' . route('admin.user-management.destroy', [$row['id'], 'status' => 'suspand', 'role' => $row['role']]) . '" class="btn btn-danger">Suspand account</a>';
                    } else {
                        $btn .= '<a href="' . route('admin.user-management.destroy', [$row['id'], 'status' => 'active', 'role' => $row['role']]) . '" class="btn btn-success">Activate account</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['id', 'name', 'role', 'email', 'phone', 'address', 'address1', 'city', 'action'])
                ->make(true);
        }

        return view('admin.user-management.index', compact('page_title'));
    }
    public function create(Request $request)
    {
        $page_title = 'Create User';
        // dd('aa');
        return view('admin.user-management.create', compact('page_title','request'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        // Logic to store the user
        if ($request->user_type == 2) {
            // $request->validate([
            //     'f_name' => 'required',
            //     'l_name' => 'required',
            //     'email' => 'required|email|unique:customers,email',
            //     'phone' => 'required',
            //     'address' => 'required',
            //     'address1' => 'required',
            //     'city' => 'required',
            //     'state' => 'required',
            //     'zip' => 'required'
            // ]);
            $check_if_exist = Customer::where('email', $request->email)->first();
            if ($check_if_exist) {
                return redirect()->back()->with('error', 'User already exists');
            }
            $customer = new Customer();
            $customer->user_id = auth()->user()->id;
            $customer->f_name = $request->f_name;
            $customer->l_name = $request->l_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->address = $request->address;
            $customer->address1 = $request->address1;
            $customer->city = $request->city;
            $customer->state = $request->state;

            $customer->zip = $request->zip;
            $customer->save();
        } else {
            $check_if_exist = User::where('email', $request->email)->first();

            if ($check_if_exist) {
                return redirect()->back()->with('error', 'User already exists');
            }

            $user = new User();
            $user->name =  $request->employee_f_name . ' ' . $request->employee_l_name;
            $user->email = $request->employee_email;
            $user->password = Hash::make($request->password);
            $user->role = $request->user_type;
            if ($request->hasFile('profile_avatar')) {
                $file = $request->file('profile_avatar');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('user-images'), $filename);
                $user->profile_avatar = $filename;
            } else {
                $user->profile_avatar = 'default.jpg';
            }
            $user->save();
        }
        return redirect()->route('admin.user-management.index')->with('success', 'User created successfully');
    }
    public function edit(Request $request, $id)
    {
        $page_title = 'Update User';
        if ($request->role == 'customer') {
            $user = Customer::findorfail($id);
        } else {
            $user = User::findorfail($id);
        }
        // dd($user);
        return view('admin.user-management.edit', compact('id', 'page_title', 'request', 'user'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        // Logic to update the user
        if ($request->role == 'customer') {
            $request->validate([
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|email|unique:customers,email',
                'phone' => 'required',
                'address' => 'required',
                'address1' => 'required',
                'city' => 'required',
                'state' => 'required',
                'zip' => 'required'
            ]);
            $user = Customer::find($id)->update(array(
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'address1' => $request->address1,
                'city' => $request->city,
                'state' => $request->state,
                'zip' => $request->zip
            ));
        } else {
            $user = User::findorfail($id);
            if ($request->hasFile('profile_avatar')) {
                $file = $request->file('profile_avatar');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('user-images'), $filename);
            } else {

                $filename = $user->profile_avatar;
            }

            if ($request->password != null) {
                $password = Hash::make($request->password);
            } else {
                $password = $user->password;
            }
            User::where('id', $id)->update(array(
                'name' => $request->f_name . ' ' . $request->l_name,
                'email' => $request->email,
                'role' => $request->user_type,
                'profile_avatar' => $filename,
                'password' => $password,
            ));
        }


        return redirect()->route('admin.user-management.index')->with('success', 'User updated successfully');
    }
    public function destroy(Request $request, $id)
    {
        // Logic to delete the user
        if ($request->role == 'customer') {
            if ($request->status == 'suspand') {
                Customer::where('id', $id)->update(array(
                    'is_active' => 1
                ));
            } else {
                Customer::where('id', $id)->update(array(
                    'is_active' => 0
                ));
            }
        } else {
            if ($request->status == 'suspand') {
                User::where('id', $id)->update(array(
                    'is_active' => 1
                ));
            } else {
                User::where('id', $id)->update(array(
                    'is_active' => 0
                ));
            }
        }
        return redirect()->route('admin.user-management.index')->with('success', 'User account status has been updated successfully');
    }

    public function customers(Request $request)
    {
        $page_title = 'All Clients';
        $customers = Customer::where('is_active', 0)->orderBy('id', 'DESC')->get();

        if ($request->ajax()) {
            return DataTables::of($customers)
                ->addIndexColumn()
                ->addColumn('name', function ($row) {
                    return '<p><strong>' . $row['f_name'] . ' ' . $row['l_name'] ?? '' . '</strong></p>';
                })
                ->addColumn('role', function ($row) {
                    if ($row['role'] == 'customer') {
                        $role = '<div class="badge badge-success">Customer</div>';
                    } else {
                        $role = '<div class="badge badge-warning">Employee / Admin</div>';
                    }
                    return $role;
                })
                ->addColumn('email', function ($row) {
                    return '<a href="mailto:' . $row['email'] . '">' . $row['email'] . '</a>';
                })
                ->addColumn('phone', function ($row) {
                    return '<a href="tel:' . $row['phone'] . '">' . $row['phone'] . '</a>';
                })
                ->addColumn('Address', function ($row) {
                    return '<p>' . $row['address'] . '</p>';
                })
                ->addColumn('Address1', function ($row) {
                    return '<p>' . $row['address1'] . '</p>';
                })
                ->addColumn('City', function ($row) {
                    return '<p>' . $row['city'] . '</p>';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('admin.user-management.edit', ['id' => $row['id'], 'role' => $row['role']]) . '" class="edit btn btn-primary btn-sm">Edit</a>';
                    if ($row['is_active'] == 0) {
                        $btn .= '<a href="' . route('admin.user-management.destroy', [$row['id'], 'status' => 'suspand', 'role' => $row['role']]) . '" class="btn btn-danger">Suspand account</a>';
                    } else {
                        $btn .= '<a href="' . route('admin.user-management.destroy', [$row['id'], 'status' => 'active', 'role' => $row['role']]) . '" class="btn btn-success">Activate account</a>';
                    }

                    return $btn;
                })
                ->rawColumns(['id', 'name', 'role', 'email', 'phone', 'address', 'address1', 'city', 'action'])
                ->make(true);
        }
        return view('Admin.user-management.customers', get_defined_vars());
    }
}

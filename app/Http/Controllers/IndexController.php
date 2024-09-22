<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Personil;
use App\Models\Weapon;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    public function index(Request $request)
    {
        $user_role = $request->user()->role;
        switch ($user_role) {
            case 'staff-it':
                return redirect()->intended('/staff-it');
            case 'approver':
                return redirect()->intended('/approver');
            case 'user':
                return redirect()->intended('/user');
            default:
                return redirect('/user');
        }
        dd($user_role);
    }
    public function indexStaffIT(Request $request)
    {
        $count_akun = Akun::all()->count();
        $count_personil = Personil::all()->count();
        $count_weapon = Weapon::all()->count();

        return view('staffit.home.index', compact('count_akun', 'count_personil', 'count_weapon'));
    }

    public function indexApprover(Request $request)
    {
        $count_akun = Akun::all()->count();
        $count_personil = Personil::all()->count();
        $count_weapon = Weapon::all()->count();

        return view('approver.home.index', compact('count_akun', 'count_personil', 'count_weapon'));
    }
}

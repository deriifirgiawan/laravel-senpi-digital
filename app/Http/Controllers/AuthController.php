<?php

namespace App\Http\Controllers;

use App\Models\Akun;
use App\Models\Personil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Validation\ValidationException;
use PhpParser\Node\Expr\Cast\Object_;
use stdClass;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.index');
    }
    public function login(Request $request)
    {

        $request->validate([
            'username_or_email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('password');
        $loginField = filter_var($request->username_or_email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $credentials[$loginField] = $request->username_or_email;

        if (Auth::attempt($credentials)) {
            return $this->redirectToBasedOnRole(Auth::user()->role);
        }

        throw ValidationException::withMessages([
            'username_or_email' => [trans('auth.failed')],
        ]);
    }
    protected function redirectToBasedOnRole($role)
    {
        switch ($role) {
            case 'staff-it':
                return redirect()->intended('/staff-it');
            case 'approver':
                return redirect()->intended('/approver');
            case 'user':
                return redirect()->intended('/user');
            default:
                return redirect('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/login');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function showCheckEmailForm()
    {
        return view('auth.email-forgot-password');
    }

    public function showChangePasswordForm()
    {
        return view('auth.change-password');
    }
    public function register(Request $request)
    {
        $request->validate([
            'nrp' => 'required',
            'nama' => 'required',
            'pangkat' => 'required',
            'kesatuan' => 'required',
            'username' => 'required|unique:akun',
            'email' => 'required|unique:akun|email',
            'password' => 'required|min:6',
        ]);
        // Memulai transaksi
        try {
            DB::transaction(function () use ($request) {
                $personil = Personil::where('nrp', $request->nrp)->first();
                if ($personil) {
                    $personilData = [
                        'nrp' => $request->nrp,
                        'nama' => $request->nama,
                        'pangkat' => $request->pangkat,
                        'jabatan' => $request->jabatan,
                        'kesatuan' => $request->kesatuan,
                    ];

                    $personil = Personil::findOrFail($personil->id_personil);
                    $personil->update($personilData);
                    $akunData = [
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'email' => $request->email,
                        'role' => 'user',
                        'personil_id' => $personil->id_personil,
                    ];


                    // Buat objek Akun baru
                    Akun::create($akunData);
                } else {
                    $personilData = [
                        'nrp' => $request->nrp,
                        'nama' => $request->nama,
                        'pangkat' => $request->pangkat,
                        'jabatan' => $request->jabatan,
                        'kesatuan' => $request->kesatuan,
                    ];
                    $akunData = [
                        'username' => $request->username,
                        'password' => Hash::make($request->password),
                        'email' => $request->email,
                        'role' => 'user',
                    ];

                    $personil = Personil::create($personilData);

                    // Buat objek Akun baru dan hubungkan dengan Personil
                    $akun = new Akun($akunData);
                    $personil->akun()->save($akun);
                }
            });
            return redirect()->route('login')->with('success', 'Data berhasil disimpan.');
        } catch (\Throwable $th) {
            dd($th);
            return redirect()->route('register')->with('error', 'Data gagal register.');
        }
    }
    public function sendEmailForgot(Request $request)
    {
        $email = $request->input('email'); // Get the email from the request

        // Find the first Akun where email matches the given email
        $akun = Akun::where('email', $email)->first();
        if (!$akun) {
            return redirect()->route('forgot-password')->with('error', 'Data Akun Tidak Ada');
        }
        $id_akun = base64_encode($akun->id_akun);
        $mjApiKeyPublic = "d4c596d23bfb249d2e8f11d8e35d7fe7";
        $mjApiKeyPrivate = "241b83dc27da35a52580cc225eb83a65";
        $senderEmail = "ilham@ucun.dev";
        $recipientEmail = $email;
        $resetLink = url("/forgot-password/change-password?id_akun=$id_akun");

        $response = Http::withBasicAuth($mjApiKeyPublic, $mjApiKeyPrivate)
            ->post('https://api.mailjet.com/v3.1/send', [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => $senderEmail,
                            'Name' => 'Support Team'
                        ],
                        'To' => [
                            [
                                'Email' => $recipientEmail,
                                'Name' => 'User'
                            ]
                        ],
                        'Subject' => 'Password Reset Request',
                        'TextPart' => "Hello, It seems like you requested a password reset. If this was you, please use the following link to reset your password: $resetLink",
                        'HTMLPart' => "<h3>Hello,</h3><p>It seems like you requested a password reset. If this was you, please use the following link to reset your password:</p><p><a href=\"$resetLink\">Reset Password</a></p><p>If you did not request a password reset, please ignore this email.</p><br />Best regards,<br />Support Team"
                    ]
                ]
            ]);
        if ($response->successful()) {
            return redirect()->route('forgot-password')->with('success', 'Password reset email sent successfully.');
        } else {
            return redirect()->route('forgot-password')->with('error', 'Failed to send password reset email. try again');
        }
    }
    public function searchNrp(Request $request)
    {
        $nrp = $request->input("nrp");

        // Retrieve the first personil along with their akun based on the nrp
        $personil = Personil::with('akun')
            ->where('nrp', $nrp)
            ->first();

        $response = new stdClass();
        $response->data = $personil;

        // Check if the personil exists
        if (!$personil) {
            $response->can_register = true;
        } else {
            // Check if the personil has an associated akun
            $response->can_register = $personil->akun === null;
        }

        return response()->json($response);
    }

    public function updatePassword(Request $request)
    {
        $id_akun = base64_decode($request->query('id_akun'));
        // dd($request->);
        if ($request->password != $request->confirm_password) {
            return redirect()->route('forgot-password.change-password', ['id_akun' => $request->query('id_akun')])->with('error', 'Password not match');
        }
        $akun = Akun::findOrFail($id_akun);
        $akunData = [
            'password' => Hash::make($request->password),
        ];
        $akun->update($akunData);
        return redirect()->route('login')->with('success', 'Data berhasil disimpan.');
    }
}

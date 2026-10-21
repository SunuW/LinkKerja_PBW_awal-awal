<?php
 
namespace App\Http\Controllers;
 
use App\Models\Perusahaan;
use App\Models\ProfilPencariKerja;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
 
class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
 
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (! Auth::attempt($credentials)) {
            return back()->withErrors(['email' => 'Email atau kata sandi salah.'])->onlyInput('email');
        }
 
        $request->session()->regenerate();
 
        return Auth::user()->isPerekrut()
            ? redirect()->route('perekrut.dashboard')
            : redirect()->route('pencari.beranda');
    }
 
    public function showRegister()
    {
        return view('auth.register');
    }
 
    public function register(Request $request)
    {
        $data = $request->validate([
            'role' => ['required', 'in:pencari_kerja,perekrut'],
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', Password::min(8)],
            'nama_perusahaan' => ['required_if:role,perekrut', 'nullable', 'string', 'max:150'],
        ]);
 
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
        ]);
 
        if ($user->role === 'perekrut') {
            Perusahaan::create([
                'id_user' => $user->id,
                'nama_perusahaan' => $data['nama_perusahaan'],
            ]);
        } else {
            ProfilPencariKerja::create(['id_user' => $user->id]);
        }
 
        Auth::login($user);
 
        return $user->isPerekrut()
            ? redirect()->route('perekrut.dashboard')
            : redirect()->route('pencari.beranda');
    }
 
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
 
        return redirect()->route('login');
    }
}

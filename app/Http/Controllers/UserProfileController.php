<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class UserProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(): View
    {
        $user = Auth::user();
        $userPegawai = Pegawai::where('nama', $user->name)->first();
        $userMahasiswa = Mahasiswa::where('nama', $user->name)->first();
        debug($userMahasiswa);
        debug($userPegawai);
        debug($user);
        return view('admin.a_profile.profile', [
            'userMahasiswa' => $userMahasiswa,
            'userPegawai' => $userPegawai,
            'user' => $user,
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10240',
        ]);

        $user = Auth::user();
        // dd($user, $dosen);
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/profile_pictures');
            $image->move($destinationPath, $name);

            // Hapus gambar lama jika ada
            if ($user->profile_picture) {
                $oldImagePath = public_path('/profile_pictures/' . $user->profile_picture);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
            DB::beginTransaction();
            try {
                $user->profile_picture = $name;
                $user->save();

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.edit')->with('error', 'Profile updated failed');
            }
        }

        return redirect()->route('profile.edit')->with('gambar', 'Profile updated successfully');
    }

    public function resetProfilePicture()
    {
        $user = Auth::user();
        if ($user->profile_picture) {
            $oldImagePath = public_path('/profile_pictures/' . $user->profile_picture);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        DB::beginTransaction();
            try {
                $user->profile_picture = null;
                $user->save();

                DB::commit();
            } catch (\Throwable $th) {
                DB::rollback();
                return redirect()->route('profile.edit')->with('error', 'Profile Reset failed');
            }
        return redirect()->route('profile.edit')->with('reset', 'Profile Reset successfully');
    }

    public function updatePassword(Request $request)
    {
        // Validate input
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|max:30|confirmed',
        ]);

        // Check if current password matches
        if (!Hash::check($request->current_password, auth()->user()->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        // Update the user's password
        auth()->user()->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->route('profile.edit')->with('password', 'Password updated successfully');
    }
}

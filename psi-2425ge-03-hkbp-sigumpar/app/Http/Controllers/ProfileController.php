<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /* ─────────────────────────────────────────
     |  Tampilkan form edit profil
     ───────────────────────────────────────── */
    public function edit(Request $request): View
    {
        return view('profile.edit', ['user' => $request->user()]);
    }

    /* ─────────────────────────────────────────
     |  Simpan perubahan profil
     ───────────────────────────────────────── */
    public function update(ProfileUpdateRequest $request): RedirectResponse
{
    $user = $request->user();

    /* Ambil data umum (tanpa partner_*)
    ------------------------------------------------*/
    $data = $request->only([
        'name',
        'email',
        'wa_number',
        'age',
        'location',
        'full_name',
        'father_name',
        'mother_name',
        'address',
        'jenis_kelamin',
    ]);

    /* Ambil input pasangan
    ------------------------------------------------*/
    $partnerName      = $request->input('partner_name');
    $partnerWa        = $request->input('partner_wa');
    $partnerAddress   = $request->input('partner_address');
    $partnerAge       = $request->input('partner_age');
    $partnerLocation  = $request->input('partner_location');

    /* Simpan ke field pasangan sesuai jenis kelamin
    ------------------------------------------------*/
    if ($request->input('jenis_kelamin') === 'laki-laki') {
        $data['wife_name']         = $partnerName;
        $data['wife_wa']           = $partnerWa;
        $data['wife_address']      = $partnerAddress;
        $data['wife_age']          = $partnerAge;
        $data['wife_location']     = $partnerLocation;

        $data['husband_name']      = null;
        $data['husband_wa']        = null;
        $data['husband_address']   = null;
        $data['husband_age']       = null;
        $data['husband_location']  = null;
    } elseif ($request->input('jenis_kelamin') === 'perempuan') {
        $data['husband_name']      = $partnerName;
        $data['husband_wa']        = $partnerWa;
        $data['husband_address']   = $partnerAddress;
        $data['husband_age']       = $partnerAge;
        $data['husband_location']  = $partnerLocation;

        $data['wife_name']         = null;
        $data['wife_wa']           = null;
        $data['wife_address']      = null;
        $data['wife_age']          = null;
        $data['wife_location']     = null;
    }

    /* Reset email verifikasi jika email berubah
    ------------------------------------------------*/
    if ($user->email !== $data['email']) {
        $data['email_verified_at'] = null;
    }

    /* Simpan perubahan & redirect
    ------------------------------------------------*/
    $user->fill($data)->save();

    return Redirect::route('profile.edit')->with('status', 'profile-updated');
}


    /* ─────────────────────────────────────────
     |  Hapus akun
     ───────────────────────────────────────── */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}

<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class ProfileSettings extends Component
{
    public $name = '';

    public $email = '';

    public $phone = '';

    public $birthday = '';

    public $current_password = '';

    public $password = '';

    public $password_confirmation = '';

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->birthday = $user->birthday;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'birthday' => ['nullable', 'date'],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated');
        session()->flash('success', 'Profile updated successfully!');
    }

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        $user = Auth::user();

        $user->update([
            'password' => Hash::make($this->password),
        ]);

        $this->reset(['current_password', 'password', 'password_confirmation']);

        $this->dispatch('password-updated');
        session()->flash('success', 'Password updated successfully!');
    }

    public function save()
    {
        // Combined save or individual?
        // The UI has one "Save Changes" button at the bottom.
        // So I should probably try to save both if changed, or just save profile if password is empty.

        $this->updateProfile();

        if (! empty($this->current_password) || ! empty($this->password)) {
            $this->updatePassword();
        }
    }

    public function cancel()
    {
        $this->mount();
        $this->reset(['current_password', 'password', 'password_confirmation']);
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.profile-settings');
    }
}

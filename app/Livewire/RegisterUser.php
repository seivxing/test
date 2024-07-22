<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;

class RegisterUser extends Component
{
    public $recommendedEmail;
    public $name;
    public $email;
    public $password;
    public $retype_password;
    public $g_recaptcha_response;

    public function create()
    {
        $this->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|max:16',
            'retype_password' => 'required|same:password',
            'g_recaptcha_response' => 'required|captcha',
        ]);

        $this->password = bcrypt($this->password);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $this->reset(['name', 'email', 'password']);
        $this->redirect('/login');
    }

    public function generateNewEmail($email)
    {
        // Split the email address into username and domain parts
        list($username, $domain) = explode('@', $email);

        // Generate a random suffix with a maximum length of 4 characters
        $suffix = substr(str_shuffle('abcdefghijklmnopqrstuvwxyz0123456789'), 0, 4);

        // Generate a new email address by appending the random suffix to the username
        $newEmail = $username  . $suffix . '@' . $domain;

        return $newEmail;
    }
    public function updatedEmail($value)
    {
        // Check if the entered email already exists in the database
        $userExists = User::where('email', $value)->exists();

        // If the email already exists, recommend a new email
        if ($userExists) {
            $this->recommendedEmail = $this->generateNewEmail($value);
        } else {
            $this->recommendedEmail = null;
        }
    }

    public function render()
    {
        return view('livewire.register-user');
    }
}

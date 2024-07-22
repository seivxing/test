<?php

namespace App\Livewire\Pages\Admin\Setting;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class UserSetting extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $user_id;

    public function deleteUser($user_id){
        $this->user_id = $user_id;
    }

    public function destroyUser()
    {
        $user_id = User::find($this->user_id);

        if (!$user_id) {
            session()->flash('error', 'User not found');
            return;
        }

        $user_id->delete();

        session()->flash('message', 'User Deleted successfully');

        $this->dispatch('close-modal');

    }

    public function render()
    {
        $users = User::orderBy('id', 'DESC')->paginate(5);
        return view('livewire.pages.admin.setting.user-setting', ['users' => $users]);
    }
}

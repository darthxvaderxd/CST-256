<?php
namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller {
    public function index(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $search = $request['search'] ?? '';
        $groups = [];

        if (!empty($search)) {
            $groups = Group::where('group', 'LIKE', '%'.$search.'%')
                ->get();

            if ($groups) {
                foreach($groups as $group) {
                    $group->group_user = GroupUser::where('group_id', $group->id)
                        ->where('user_id', $this->user->id)
                        ->first();
                    $group->user_count = GroupUser::where('group_id', $group->id)
                        ->count();
                }
            }
        }

        return view('group_search', [
            'user'   => $this->user,
            'search' => $search,
            'groups' => sizeof($groups) > 0
                ? $groups
                : null,
        ]);
    }

    public function create(Request $request) {
        $groupName = $request['group'] ?? '';
        $group = null;

        if (!empty($groupName)) {
            $group = Group::where('group', strtolower($groupName))
                ->first();
            if (!$group) {
                Group::create([
                    'group' => strtolower($groupName),
                ]);
            }
        }

       return redirect()->to('/groups?search='.$groupName);
    }

    public function join(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $id = (int) $request['id'];
        $group = Group::where('id', $id)
            ->first();

        if ($group) {
            $groupUser = GroupUser::where('group_id', $group->id)
                ->where('user_id', $this->user->id)
                ->first();

            if (!$groupUser) {
                GroupUser::create([
                    'group_id' => $group->id,
                    'user_id'  => $this->user->id,
                ]);
            }
        }

        return redirect()->to('/group?id='.$id);
    }

    public function leave(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $id = (int) $request['id'];
        $group = Group::where('id', $id)
            ->first();

        if ($group) {
            $group_user = GroupUser::where('group_id', $group->id)
                ->where('user_id', $this->user->id)
                ->first();

            if ($group_user) {
                $group_user->delete();
            }
        }

        return redirect()->to('/group?id='.$id);
    }

    public function view(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $id = (int) $request['id'];
        $group = Group::where('id', $id)
            ->first();

        if ($group) {
            $group->group_user = GroupUser::where('group_id', $group->id)
                ->where('user_id', $this->user->id)
                ->first();
            $users = [];

            $groupUsers = GroupUser::where('group_id', $group->id)
                ->get();

            foreach ($groupUsers as $groupUser) {
                $users[] = User::where('id', $groupUser->user_id)
                    ->first();
            }

            $group->users = $users;
        }

        return view('group', [
            'group' => $group,
            'user'  => $this->user,
        ]);
    }

    function userGroups(Request $request) {
        $isValidUser = $this->isValidUserForRoute();
        if ($isValidUser !== true) return $isValidUser;

        $group_users = GroupUser::where('user_id', $this->user->id)
            ->get();

        foreach($group_users as $group_user) {
            $group_user->group = Group::where('id', $group_user->group_id)
                ->first();
            $group_user->group->user_count = GroupUser::where('group_id', $group_user->group_id)
                ->count();
        }


        return view('user_groups', [
            'group_users' => $group_users,
            'user'        => $this->user,
        ]);
    }
}

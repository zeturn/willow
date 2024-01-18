<?php

namespace App\Http\Controllers;

use App\Models\User;

use App\Models\Entry;
use App\Models\EntryBranch;
use App\Models\EntryBranchUser;
use Illuminate\Http\Request;

class EntryBranchUserController extends Controller
{
    // 添加一个用户到分支。
    public function addUser(Request $request, $branchId)
    {
        $branch = EntryBranch::find($branchId);
        if (!$branch) {
            return redirect()->back()->withErrors('Branch not found.');
        }

        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        EntryBranchUser::create([
            'branch_id' => $branchId,
            'user_id' => $request->user_id,
        ]);

        return redirect()->route('entry.show', $branch->entry_id);
    }

    // 从分支中移除一个用户。
    public function removeUser($branchId, $userId)
    {
        $branchUser = EntryBranchUser::where('branch_id', $branchId)
                                     ->where('user_id', $userId)
                                     ->first();

        if (!$branchUser) {
            return redirect()->back()->withErrors('Branch User not found.');
        }

        $branchUser->delete();
        return redirect()->route('entry.show', $branchId);
    }

    public function showUsersBranches($branchId ,$userId,$entryId)
    {
        //dd($branchId ,$userId, $entryId);仔细检查三项数据顺序

        $userBranches = EntryBranchUser::UsersBranches($userId, $entryId);//获取这个用户的这个词条下的所有分支
        //dd($userBranches);

        $entry = Entry::find($entryId);
        $user = User::find($userId);

        return view('entries.branches.usersbrancheslist', ['userBranches' => $userBranches, 'user' => $user, 'userID' => $userId, 'entryID' => $entry, 'entry' => $entry]);
    }


    // 其他的方法...
}

<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //运行工厂，创建100条数据 插入数据表中
        $users = factory(User::class)->times(100)->make();
        User::insert($users->makeVisible(['password', 'remember_token'])->toArray());
        //修改第一个用户，以便以后登录
        $user = User::find(1);
        $user->name = 'dennis';
        $user->email = '1016144734@qq.com';
        $user->password = bcrypt('123456');
        $user->is_admin = true;
        $user->save();

    }
}

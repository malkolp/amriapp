<?php /** @noinspection PhpUndefinedFieldInspection */

namespace Database\Seeders;

use App\Http\back\_Image;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $usr1           = new User();
        $usr1->name     = 'Amril Haq';
        $usr1->identity = '1234567890';
        $usr1->pic      = _Image::setDefaultProfile('Amril Haq', '1234567890', '', true);
        $usr1->email    = 'amrilhaq123@mail.dev';
        $usr1->password = Hash::make('amrilhaq123');
        $usr1->role     = 'super';
        $usr1->save();
    }
}

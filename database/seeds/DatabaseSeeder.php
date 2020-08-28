<?php

use App\User;
use App\Account;
use App\Contact;
use App\Organization;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $account = Account::create(['name' => 'GURGEL CHEM LTDA']);

        factory(User::class)->create([
            'account_id' => $account->id,
            'first_name' => 'Romulo',
            'last_name' => 'Matias',
            'email' => 'comercial@gurgelchem.com.br',
            'owner' => true,
        ]);

        factory(User::class, 5)->create(['account_id' => $account->id]);

        $organizations = factory(Organization::class, 100)
            ->create(['account_id' => $account->id]);

        factory(Contact::class, 100)
            ->create(['account_id' => $account->id])
            ->each(function ($contact) use ($organizations) {
                $contact->update(['organization_id' => $organizations->random()->id]);
            });
    }
}

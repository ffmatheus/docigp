<?php

use App\Data\Models\Entry;
use App\Data\Repositories\Entries as EntriesRepository;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyDepositDate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Entry::disableGlobalScopes();
        Entry::disableEvents();
        $entries = app(Entry::class)->all();

        foreach ($entries as $entry) {
            dump($entry);
            if ($entry['entry_type_name'] = 'Depósito Alerj') {
                DB::table('entries')
                    ->where('id', $entry['id'])
                    ->update(['date' => $entry['date']->firstOfMonth()]);
            }
        }

        Entry::enableGlobalScopes();
        Entry::enableEvents();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}

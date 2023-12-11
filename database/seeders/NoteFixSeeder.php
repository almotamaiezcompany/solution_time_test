<?php

namespace Database\Seeders;

use App\Models\Notes;
use App\Models\Status;
use Illuminate\Database\Seeder;

class NoteFixSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $first_status = Status::first();
        $inCorrectNotes = Notes::doesntHave('status')->get();
        foreach ($inCorrectNotes as $inCorrectNote) {
            $inCorrectNote->status_id = $first_status->id;
            $inCorrectNote->save();
        }
    }
}

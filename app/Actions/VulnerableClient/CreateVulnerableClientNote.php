<?php

namespace App\Actions\VulnerableClient;

use App\Models\VulnerableClient;
use App\Traits\Validators\VulnerableClientNoteValidator;
use Illuminate\Support\Facades\Validator;

class CreateVulnerableClientNote
{
    use VulnerableClientNoteValidator;

    public function create($input, VulnerableClient $client)
    {
        $data = Validator::make($input, $this->vulnerableClientNoteRules(), [], $this->vulnerableClientNoteAttributes())->validate();

        $data['created_by'] = auth()->user()->id;

        $note = $client->notes()->create($data);

        return $note;
    }
}

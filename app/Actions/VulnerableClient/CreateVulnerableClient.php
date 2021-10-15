<?php

namespace App\Actions\VulnerableClient;

use App\Models\VulnerableClient;
use App\Traits\Validators\VulnerableClientNoteValidator;
use App\Traits\Validators\VulnerableClientValidator;
use Illuminate\Support\Facades\Validator;

class CreateVulnerableClient
{
    use VulnerableClientValidator;
    use VulnerableClientNoteValidator;

    public function create($input, $notesInput)
    {
        $data = Validator::make($input, $this->vulnerableClientRules(), [], $this->vulnerableClientAttributes())->validate();

        $vulnerableClientNoterules = $this->vulnerableClientNoteRules();

        $vulnerableClientNoterules['notes'] = ['nullable', 'string'];

        $notesData = Validator::make($notesInput, $vulnerableClientNoterules, [], $this->vulnerableClientNoteAttributes())->validate();

        $vulnerableClient = VulnerableClient::create($data);

        if (isset($notesData['notes'])) {
            $notesData['created_by'] = auth()->user()->id;

            $vulnerableClient->notes()->create($notesData);
        }

        return $vulnerableClient;
    }
}

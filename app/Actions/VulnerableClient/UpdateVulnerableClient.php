<?php

namespace App\Actions\VulnerableClient;

use App\Models\VulnerableClient;
use App\Traits\Validators\VulnerableClientValidator;
use Illuminate\Support\Facades\Validator;

class UpdateVulnerableClient
{
    use VulnerableClientValidator;

    public function update($input, VulnerableClient $client)
    {
        $data = Validator::make($input, $this->vulnerableClientRules(), [], $this->vulnerableClientAttributes())->validate();

        $client->update($data);
    }
}

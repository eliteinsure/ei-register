<?php

namespace App\Traits\Validators;

trait FocusError
{
    public function focusError()
    {
        if (! count($this->getErrorBag())) {
            return false;
        }

        $this->dispatchBrowserEvent('focus-error', $this->getErrorBag()->keys()[0]);
    }
}

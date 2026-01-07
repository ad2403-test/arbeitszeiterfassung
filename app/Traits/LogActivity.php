<?php

namespace App\Traits;

use App\Models\Log;

trait LogActivity
{
    /**
     * Save an activity log
     *
     * @param int $userId
     * @param string $action
     * @param string|null $details
     * @return void
     */
    public function logAction($userId, $action, $details = null)
    {
        Log::create([
            'user_id' => $userId,
            'action' => $action,
            'details' => $details,
        ]);
    }
}

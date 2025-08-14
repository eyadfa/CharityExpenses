<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Log;
trait Auditable
{
    public static function bootAuditable()
    {
        // Log updates only if the model exists
        static::updated(function ($model) {
            if ($model->exists) {
                $changes = $model->getChanges();
                $original = $model->getOriginal();
                Log::info('Original Values: ', $original);
                Log::info('Changes: ', $changes);

                // Check if changes are indeed being detected
                if (empty($changes)) {
                    Log::warning('No changes detected for model ID: ' . $model->id);
                }
                if (!empty($changes)) {
                    // Check for changes in the `is_active` attribute
                    if (array_key_exists('is_active', $changes)) {
                        $oldIsActive = $original['status_cd'] ?? null;
                        $newIsActive = $changes['status_cd'];

                        if ($oldIsActive !== $newIsActive) {
                            // Log activation or deactivation
                            $event = $newIsActive ==1 ? 'activated' : 'deactivated';
                            $model->logEvent($event);
                        }
                    }

                    // Log other updates
                    $model->logEvent('updated');
                }
            }
        });

        // Log creation after the model is saved
        static::created(function ($model) {
            $model->logEvent('created');
        });

        // Log deletion after the model is deleted
        static::deleted(function ($model) {
            $model->logEvent('deleted');
        });
    }

    protected function logEvent($event)
    {
        Log::info($this);
        // Ensure the model has an ID and exists
        if ($this->exists && $this->id !== null) {
            Log::info('Logging event: ' . $event . ' for model ID: ' . $this->id);

            Audit::create([
                'auditable_type' => get_class($this),
                'auditable_id' => $this->id,
                'event' => $event,
                'old_values' => json_encode($this->getOriginal()),
                'new_values' => json_encode($this->getChanges()),
            ]);
        } else {
            Log::warning('Model ID is not set or model does not exist for event: ' . $event);
        }
    }
}

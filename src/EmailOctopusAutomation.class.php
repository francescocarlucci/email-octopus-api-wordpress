<?php

class EmailOctopusAutomation extends EmailOctopusAPI {
    public function start(string $automationId, string $contactId): array {
        $endpoint = "/automations/{$automationId}/queue";
        $payload = [
            'contact_id' => $contactId,
        ];

        return $this->request('POST', $endpoint, $payload);
    }
}

<?php

class EmailOctopusContact extends EmailOctopusAPI {
    public function list(array $queryParams = []): array {
        $this->ensureListId();

        $query = !empty($queryParams) ? '?' . http_build_query($queryParams) : '';
        $endpoint = "/lists/{$this->listId}/contacts{$query}";

        return $this->request('GET', $endpoint);
    }

    public function get(string $email): array {
        $this->ensureListId();
        $emailHash = $this->hashEmail($email);
        return $this->request('GET', "/lists/{$this->listId}/contacts/{$emailHash}");
    }

    public function get_id(string $email): ?string {
        $contact = $this->get($email);
        return $contact['id'] ?? null;
    }

    public function create(string $email, array $fields = [], array $tags = [], string $status = 'subscribed'): array {
        $this->ensureListId();

        $payload = [
            'email_address' => $email,
            'fields'        => $fields,
            'tags'          => $tags,
            'status'        => $status,
        ];

        return $this->request('POST', "/lists/{$this->listId}/contacts", $payload);
    }

    public function update(string $email, array $fields = [], array $tags = [], string $status = 'subscribed'): array {
        $this->ensureListId();
        $emailHash = $this->hashEmail($email);

        $payload = [
            'email_address' => $email,
            'fields'        => $fields,
            'tags'          => $tags,
            'status'        => $status,
        ];

        return $this->request('PUT', "/lists/{$this->listId}/contacts/{$emailHash}", $payload);
    }

    public function upsert(string $email, array $fields = [], array $tags = [], string $status = 'subscribed'): array {
        $this->ensureListId();

        $payload = [
            'email_address' => $email,
            'fields'        => $fields,
            'tags'          => $tags,
            'status'        => $status,
        ];

        return $this->request('PUT', "/lists/{$this->listId}/contacts", $payload);
    }

    public function updateMultiple(array $contacts): array {
        $this->ensureListId();

        $payload = [
            'contacts' => $contacts,
        ];

        return $this->request('PUT', "/lists/{$this->listId}/contacts/batch", $payload);
    }

    public function delete(string $email): array {
        $this->ensureListId();
        $emailHash = $this->hashEmail($email);
        return $this->request('DELETE', "/lists/{$this->listId}/contacts/{$emailHash}");
    }
}

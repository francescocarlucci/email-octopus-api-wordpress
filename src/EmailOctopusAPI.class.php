<?php

class EmailOctopusAPI {
    protected string $apiKey;
    protected ?string $listId = null;
    protected string $baseUrl = 'https://api.emailoctopus.com';

    public function __construct() {
        if (!defined('EMAILOCTOPUS_API_KEY')) {
            throw new \RuntimeException("EMAILOCTOPUS_API_KEY constant is not defined.");
        }
        $this->apiKey = EMAILOCTOPUS_API_KEY;
    }

    public function setListId(string $listId): void {
        $this->listId = $listId;
    }

    protected function ensureListId(): void {
        if (!$this->listId) {
            throw new \InvalidArgumentException("List ID must be set before making a request.");
        }
    }

    protected function hashEmail(string $email): string {
        return md5(strtolower(trim($email)));
    }

    protected function request(string $method, string $endpoint, array $body = []): array {
        $url = $this->baseUrl . $endpoint;

        $args = [
            'method'  => strtoupper($method),
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type'  => 'application/json',
            ],
        ];

        if (!empty($body)) {
            $args['body'] = wp_json_encode($body);
        }

        $response = wp_remote_request($url, $args);

        $status = wp_remote_retrieve_response_code($response);
        $decodedBody = json_decode(wp_remote_retrieve_body($response), true);

        if (defined('EMAILOCTOPUS_API_LOGGING') && EMAILOCTOPUS_API_LOGGING == true) {
            error_log(sprintf(
                'EmailOctopus API %s %s - Status: %d - Response: %s',
                $method,
                $endpoint,
                $status,
                wp_json_encode($decodedBody)
            ));
        }

        return is_array($decodedBody) ? $decodedBody : []; // 204 responses return an empty body
    }
}

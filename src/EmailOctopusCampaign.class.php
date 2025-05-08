<?php

class EmailOctopusCampaign extends EmailOctopusAPI {
    public function list(int $limit = 10, ?string $startingAfter = null): array {
        $query = ['limit' => $limit];
        if ($startingAfter !== null) {
            $query['starting_after'] = $startingAfter;
        }

        $endpoint = '/campaigns?' . http_build_query($query);
        return $this->request('GET', $endpoint);
    }

    public function get(string $campaignId): array {
        return $this->request('GET', "/campaigns/{$campaignId}");
    }

    public function getReports(string $campaignId): array {
        return $this->request('GET', "/campaigns/{$campaignId}/reports");
    }

    public function getReportLinks(string $campaignId): array {
        return $this->request('GET', "/campaigns/{$campaignId}/reports/links");
    }

    public function getReportSummary(string $campaignId): array {
        return $this->request('GET', "/campaigns/{$campaignId}/reports/summary");
    }
}

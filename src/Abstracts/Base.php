<?php

namespace DirectAff\Abstracts;

abstract class Base
{
    /** @var string The base URL for the API. */
    protected string $baseUrl = '';


    /** @var string The secret API key for authentication. */
    protected string $secretApiKey = '';


    /** @var int The brand ID. */
    protected int $brandId;


    /**
     * Set the base URL for the API.
     *
     * @param string $url The API base URL.
     * @return self
     */
    public function setBaseUrl(string $url): self
    {
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \InvalidArgumentException("Invalid URL format.");
        }
        $this->baseUrl = $url;
        return $this;
    }


    /**
     * Set the secret API key for authentication.
     *
     * @param string $key The secret API key.
     * @return self
     */
    public function setSecretApiKey(string $key): self
    {
        $this->secretApiKey = $key;
        return $this;
    }


    /**
     * Set the brand ID.
     *
     * @param int $id The brand ID.
     * @return self
     */
    public function setBrandId(int $id): self
    {
        $this->brandId = $id;
        return $this;
    }


    /**
     * Register a user.
     *
     * @param array $params Registration parameters.
     * @return array Response from the API.
     */
    public function register(array $params): array
    {
    }


    /**
     * Send deposit data to tracking software
     *
     * @param array $params Deposit parameters.
     * @return array Response from the API.
     */
    public function deposit(array $params): array
    {
    }


    /**
     * Send withdrawal data to tracking software
     *
     * @param array $params Withdraw parameters.
     * @return array Response from the API.
     */
    public function withdraw(array $params): array
    {
    }


    /**
     * Send chargeback data to tracking software
     *
     * @param array $params Chargeback parameters.
     * @return array Response from the API.
     */
    public function chargeback(array $params): array
    {
    }


    /**
     * Send bonus added response to tracking software
     *
     * @param array $params Bonus added parameters.
     * @return array Response from the API.
     */
    public function bonusAdded(array $params): array
    {
    }


    /**
     * Send bonus removed response to tracking software
     *
     * @param array $params Bonus removed parameters.
     * @return array Response from the API.
     */
    public function bonusRemoved(array $params): array
    {
    }


    /**
     * send bet and win amount to tracking software
     *
     * @param array $params betWin parameters.
     * @return array Response from the API.
     */
    public function betWin(array $params): array
    {
    }


    /**
     * Make a HTTP POST request to the API.
     *
     * @param array $data Data to be sent in the POST request.
     * @return array Decoded response from the API.
     * @throws \RuntimeException If there's a CURL error or if the API responds with an error.
     */
    protected function makeApiPostRequest(array $data): array
    {
        $ch = curl_init($this->baseUrl);

        // set the secret key and brand ID in the headers
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'd-secret-key: ' . $this->secretApiKey,
            'd-brand-id: ' . $this->brandId
        ));
        curl_setopt($ch, CURLOPT_POST, 0);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data, '', '&'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $res = curl_exec($ch);
        $queryString = http_build_query($data, '', '&');
        // Check if any cURL error occurred
        if (curl_errno($ch)) {
            $errorMsg = curl_error($ch);
            curl_close($ch);
            throw new \RuntimeException("CURL Error: " . $errorMsg);
        }

        // Check HTTP response code for potential issues
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        if ($httpCode >= 500) {
            throw new \RuntimeException("API responded with HTTP code: " . $httpCode);
        }

        $decodedResponse = json_decode($res, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errorDetails = json_last_error_msg();
            throw new \RuntimeException("Failed to decode JSON response. Error: $errorDetails. Response received: " . $res);
        }

        // Check the 'success' status in the response
        if (!$decodedResponse['success']) {
            // If there's a general 'message' in the response
            if (isset($decodedResponse['message'])) {
                return [
                    'success' => false,
                    'error' => $decodedResponse['message']
                ];
            } // If there are detailed field errors in the 'errors' key
            elseif (isset($decodedResponse['errors'])) {
                $errorMessages = [];
                foreach ($decodedResponse['errors'] as $field => $errors) {
                    foreach ($errors as $error) {
                        $errorMessages[] = $field . ': ' . $error;
                    }
                }
                return [
                    'success' => false,
                    'error' => implode(', ', $errorMessages)
                ];
            } // If there's no 'message' or 'errors', but 'success' is false
            else {
                return [
                    'success' => false,
                    'error' => "Unknown error occurred."
                ];
            }
        }


        return $decodedResponse;
    }
}

<?php namespace FSM\Wrike;

use Exception;
use League\OAuth2\Client\Token\AccessToken;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

/**
 * An API Wrapper class for Wrike's v3 API.
 * @todo Attachments
 */
class Wrike
{
    const BASE_URL = 'https://www.wrike.com/api/v3';

    private $provider;
    private $token;
    private $modules = [];

    /**
     * Construct
     *
     * @param WrikeProvider $provider
     */
    public function __construct(WrikeProvider $provider)
    {
        $this->provider = $provider;
        $this->maybeAuthorize();
    }



    /**
     * Instantiate extra modules when called
     *
     * @param string $module Module name
     * @param mixed  $params
     */
    public function __call($module, $params)
    {
        if (!array_key_exists($module, $this->modules)) {
            $class = __NAMESPACE__ . "\\Modules\\" . $module;

            if (!class_exists($class)) {
                throw new \Exception("Class {$class} undefined");
            }

            $this->modules[strtolower($module)] = new $class($this);
        }

        return $this->modules[strtolower($module)];
    }



    /**
     * Authorize or retrieve the session token.
     */
    private function maybeAuthorize()
    {
        if (session_status() !== PHP_SESSION_ACTIVE) {
            session_start();
        }

        if (!isset($_SESSION['wrike_token']) || !$_SESSION['wrike_token'] instanceof AccessToken) {
            $this->authenticate();
        } elseif ($_SESSION[ 'wrike_token' ]->getExpires() < time()) {
            $token = $this->provider->getAccessToken('refresh_token', ['refresh_token' => $_SESSION['wrike_token']->getRefreshToken()]);
            $_SESSION['wrike_token'] = $token;
        }
        $this->token = $_SESSION['wrike_token'];
    }



    /**
     * Authenticate using the OAuth2 provider.
     */
    private function authenticate()
    {
        if (!isset($_GET['code'])) {
            $this->provider->authorize(
                [],
                function ($url, $oauth) {
                    $_SESSION[ 'wrike_oauth2_state' ] = $oauth->getState();
                    header('Location: ' . $url);
                    exit;
                }
            );
        } elseif (empty($_GET['state']) || (urlencode($_GET['state']) !== $_SESSION['wrike_oauth2_state'])) {
            unset($_SESSION[ 'wrike_oauth2_state' ]);
            throw new \Exception('Invalid State');
        } else {
            $token = $this->provider->getAccessToken('authorization_code', ['code' => urlencode($_GET['code'])]);
            $_SESSION[ 'wrike_oauth2_state' ] = $this->provider->getState();
            $_SESSION[ 'wrike_token' ] = $token;
            header('Location: /');
            exit;
        }
    }



    /**
     * Prepare options for sending via the API
     */

    private function prepOptions($options = [])
    {
        if (array_key_exists('body', $options) && is_array($options['body'])) {
            foreach ($options['body'] as $key => $value) {
                if (is_array($value)) {
                    $options['body'][$key] = json_encode($value);
                }
            }
        }

        if (array_key_exists('params', $options) && is_array($options['params'])) {
            foreach ($options['params'] as $key => $value) {
                if (is_array($value)) {
                    $options['params'][$key] = json_encode($value);
                }
            }
        }

        return $options;
    }



    /**
     * Create a new request and return its output
     * @param  array  $options Options for the request
     * @return mixed
     */
    public function requestFactory($options = [])
    {
        if (!array_key_exists('method', $options)) {
            throw new Exception\RequestException('Please provide a request method');
        }

        $method = strtoupper($options['method']);
        if (!array_key_exists('action', $options)) {
            throw new Exception\RequestException('Please provide an action URL');
        }

        $options = $this->prepOptions($options);

        $qsa = null;
        if (array_key_exists('params', $options)) {
            $qsa = http_build_query($options[ 'params' ]);
        }

        $action = self::BASE_URL . $options[ 'action' ] . ( $qsa ? '?' . $qsa : '' );

        $response = $this->provider->getResponse(
            $this->provider->getAuthenticatedRequest(
                $method,
                $action,
                $this->token,
                $options
            )
        );
        
        return $response['data'];
    }
}

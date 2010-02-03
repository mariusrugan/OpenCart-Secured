<?php
final class Url {
  	public function http($route) {
		$token = '';

		if (defined('ADMIN'))
		{
			$token = $this->getToken();
		}

		return HTTP_SERVER . 'index.php?' . $token . 'route=' . str_replace('&', '&amp;', $route);
  	}

  	public function https($route) {
		$token = '';

		if (defined('ADMIN'))
		{
			$token = $this->getToken(16);
		}

		if (HTTPS_SERVER != '') {
	  		$link = HTTPS_SERVER . 'index.php?' . $token . 'route=' . str_replace('&', '&amp;', $route);
		} else {
	  		$link = HTTP_SERVER . 'index.php?' . $token . 'route=' . str_replace('&', '&amp;', $route);
		}

		return $link;
  	}

	private function getToken($length)
	{
		$session = Registry::get('session');

		if (!isset($session->data['user_id']))
		{
			return '';
		}

		$request = Registry::get('request');

		if (isset($request->get['token']))
		{
			return 'token=' . $request->get['token']. '&amp;';
		}

		return '';
	}
}
?>
<?php
/**
Copyright 2012-2014 Bart Verheyde
bart.verheyde@ugent.be

This file is part of Booked Scheduler.

Booked Scheduler is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

Booked Scheduler is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Booked Scheduler.  If not, see <http://www.gnu.org/licenses/>.
 */

require_once(ROOT_DIR . '/lib/Config/namespace.php');

class CnertaCASOptions
{
	public function __construct()
	{
		require_once(dirname(__FILE__) . '/CnertaCASConfig.php');

		Configuration::Instance()->Register(dirname(__FILE__) . '/CnertaCAS.config.php', CnertaCASConfig::CONFIG_ID);
	}

	private function GetConfig($keyName, $converter = null)
	{
		return Configuration::Instance()->File(CnertaCASConfig::CONFIG_ID)->GetKey($keyName, $converter);
	}

	public function IsCasDebugOn()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_DEBUG_ENABLED, new BooleanConverter());
	}

	public function HasCertificate()
	{
		$cert = $this->Certificate();
		return !empty($cert);
	}

	public function Certificate()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_CERTIFICATE);
	}

	public function CasVersion()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_VERSION);
	}

	public function HostName()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_SERVER_HOSTNAME);
	}

	public function Port()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_PORT, new IntConverter());
	}

	public function ServerUri()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_SERVER_URI);
	}

	public function DebugFile()
	{
		return $this->GetConfig(CnertaCASConfig::DEBUG_FILE);
	}

	public function ChangeSessionId()
	{
		return $this->GetConfig(CnertaCASConfig::CAS_CHANGESESSIONID, new BooleanConverter());
	}

	public function CasHandlesLogouts()
	{
		$servers = $this->LogoutServers();
		return !empty($servers);
	}

	public function LogoutServers()
	{
		$servers = $this->GetConfig(CnertaCASConfig::CAS_LOGOUT_SERVERS);

		if (empty($servers))
		{
			return array();
		}

		$servers = explode(',', $servers);

		for ($i = 0; $i < count($servers); $i++)
		{
			$servers[$i] = trim($servers[$i]);
		}

		return $servers;
	}

	public function EmailSuffix()
	{
		return $this->GetConfig(CnertaCASConfig::EMAIL_SUFFIX);
	}


}

?>
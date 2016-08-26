# PXaaS dashboard

The PXaaS dashboard enables the configuration of the Squid proxy on demand.
The configuration parameters are stored in a MySQL database.
For a new configuration to take effect, the `squid.conf` and `squidGuard.conf` files are
modified accordingly by the `apache2` process and a restart of the `squid3` service puts
these in effect.


## Requirements

* [vPXaaS](https://github.com/T-NOVA/proxy-build) VM deployed on a host


## Changelog

v1.3  Refactoring

  Enhancements:
  * secure service control
  * code refactoring

  Fixes:
  * works on Alpine Linux

v1.2  Update

  Enhancements:
  * added more blacklists
  * adapted to Debian Jessie
  * updated yii to v2.0.5

  Fixes:
  * fixed the migration table creation
  * uniform user information
  * removed debugging code

v1.1  Bugfix

  Fixes:
  * Uses new blacklist sources
  * Bulk blacklist import to speed up deployment

v1.0  Initial release

  New features:
  * User management: Creation of user accounts for providing access to proxy services.
  * Access control: Users must enter their credentials in their browsers in order to surf the web.
  * Bandwidth limitation: Bandwidth limitations can be introduced to a group of users.
  * Website filtering: Restricted access to a list of websites for a group of users. Pre-defined lists with urls are provided.
  * Web caching: Cache web content and improve response time.
  * User anonymity: Users can surf the web anonymously.

[![PHP Composer](https://github.com/idmarinas/advertising-bundle/actions/workflows/php.yml/badge.svg)](https://github.com/idmarinas/advertising-bundle/actions/workflows/php.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=alert_status)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)

![GitHub release](https://img.shields.io/github/release/idmarinas/advertising-bundle.svg)
![GitHub Release Date](https://img.shields.io/github/release-date/idmarinas/advertising-bundle.svg)
![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/idmarinas/advertising-bundle)
[![Build in PHP](https://img.shields.io/badge/PHP-^8.0-8892BF.svg?logo=php)](http://php.net/)

![GitHub issues](https://img.shields.io/github/issues/idmarinas/advertising-bundle.svg)
![GitHub pull requests](https://img.shields.io/github/issues-pr/idmarinas/advertising-bundle.svg)
![Github commits (since latest release)](https://img.shields.io/github/commits-since/idmarinas/advertising-bundle/latest.svg)
![GitHub commit activity](https://img.shields.io/github/commit-activity/w/idmarinas/advertising-bundle.svg)
![GitHub last commit](https://img.shields.io/github/last-commit/idmarinas/advertising-bundle.svg)

![GitHub top language](https://img.shields.io/github/languages/top/idmarinas/advertising-bundle.svg)
![GitHub language count](https://img.shields.io/github/languages/count/idmarinas/advertising-bundle.svg)

[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=reliability_rating)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=bugs)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=security_rating)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=vulnerabilities)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=sqale_rating)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=sqale_index)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=code_smells)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=coverage)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=idmarinas_advertising-bundle&metric=duplicated_lines_density)](https://sonarcloud.io/dashboard?id=idmarinas_advertising-bundle)

[![PayPal.Me - The safer, easier way to pay online!](https://img.shields.io/badge/donate-help_my_project-ffaa29.svg?logo=paypal&cacheSeconds=86400)](https://www.paypal.me/idmarinas)
[![Liberapay - Donate](https://img.shields.io/liberapay/receives/IDMarinas.svg?logo=liberapay&cacheSeconds=86400)](https://liberapay.com/IDMarinas/donate)
[![Twitter](https://img.shields.io/twitter/url/http/shields.io.svg?style=social&cacheSeconds=86400)](https://twitter.com/idmarinas)

# AdvertisingBundle
Show network ads in your Symfony App. Come with the Adsense Network and Generic network for add your own network.

## Installation ##

### Composer ###

```bash
  composer require idmarinas/advertising-bundle
```

## Usage ##

Configuration reference:

```yaml
# config/packages/idm_advertising.yaml

idm_advertising:
    enable: true # Enable/disable advertising bundle. default false
    networks: # Required
        adsense: # Default configuration for AdSense Advertising
            type: adsense
            # service_network: idm_advertising.adsense # Custom service provider, ID of service
            enable: true # Enable/disable advertising provider
            client: null # "data-ad-client" ca-pub-XXXXXXX11XXX9
            banners: # Banners of ads (As many as you need with the same format). Required
                banner_header:
                    style: 'display:block' # style="" tag in <ins>
                    slot: 0 #  "data-ad-slot" Slot ID of Ad block 8XXXXX1
                    format: 'auto' # "data-ad-format" Values: "rectangle", "vertical" or "horizontal"
                    responsive: true # "data-full-width-responsive"
                other_banner:
                    style: 'display:block'
                    slot: 0
                    format: 'auto'
                    responsive: true
        generic: 
            type: generic # Required
            service_network: 'your.service.id' # Required
            banners: # Required
                custom_zone: 
                    config: 'for your custom network banner'
```

Usage in your templates:

```twig
<!-- Code of your template -->
<!-- .... -->

{{ advertising_banner('adsense', 'banner_header') }}

{{ advertising_banner('generic', 'custom_zone') }}

<!-- .... -->
<!-- Code of your template -->
```

The First argument is the network name, and the second argument is the name of banner.

For last need print scripts for your banners:

```twig
<!-- Before </body> tag -->

<!-- This print all scripts -->
{{ advertising_scripts() }}

<!-- This print scripts for adsense network -->
{{ advertising_scripts('adsense') }}
```